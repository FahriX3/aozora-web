<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::where('status', 'upcoming')
            ->orderBy('event_date', 'asc')
            ->limit(3)
            ->get();

        // Carousel Beranda: Khusus Event Unggulan saja (is_featured = true)
        // Sesuai filter admin: Jika unggulan 3 tampil 3, jika 15 tampil 15
        $featuredEvents = Event::where('is_featured', true)
            ->orderByRaw("CASE WHEN status = 'upcoming' THEN 1 ELSE 2 END")
            ->orderBy('event_date', 'asc')
            ->get();

        $aftermovieEvent = Event::with('documentations')->where('is_aftermovie', true)->first();
        $pengurusData = PengurusController::getPengurusData();

        return view('pages.home', array_merge([
            'upcomingEvents' => $upcomingEvents,
            'featuredEvents' => $featuredEvents,
            'aftermovieEvent' => $aftermovieEvent,
        ], $pengurusData));
    }

    public function list(Request $request)
    {
        $query = Event::query();

        if ($request->has('filter')) {
            $filter = $request->filter;
            if (in_array($filter, ['upcoming', 'completed'])) {
                $query->where('status', $filter);
            }
        }

        // Upcoming events first, then by date descending
        $events = $query->orderByRaw("CASE WHEN status = 'upcoming' THEN 1 ELSE 2 END")
            ->orderBy('event_date', 'desc')
            ->paginate(9);

        return view('pages.events', compact('events'));
    }

    public function show($slug)
    {
        $event = Event::with('documentations')->where('slug', $slug)->firstOrFail();

        return view('pages.event-detail', compact('event'));
    }

    public function downloadZip($slug)
    {
        $event = Event::with('documentations')->where('slug', $slug)->firstOrFail();

        if ($event->documentations->isEmpty()) {
            return back()->with('error', 'Belum ada dokumentasi untuk event ini.');
        }

        $filesToZip = [];
        foreach ($event->documentations as $doc) {
            if (Str::startsWith($doc->file_path, ['http://', 'https://'])) {
                continue;
            }
            $fullPath = Storage::disk('public')->path($doc->file_path);
            if (file_exists($fullPath)) {
                $filesToZip[] = [
                    'path' => $fullPath,
                    'name' => basename($doc->file_path),
                ];
            }
        }

        if (empty($filesToZip)) {
            if (!empty($event->gdrive_link)) {
                return redirect()->away($event->gdrive_link);
            }
            return back()->with('error', 'File dokumentasi fisik tidak ditemukan di server lokal.');
        }

        $tempDir = storage_path('app/temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $safeTitle = Str::slug($event->title) ?: 'event-' . $event->id;
        $zipFileName = 'Dokumentasi-' . $safeTitle . '.zip';
        $zipFilePath = $tempDir . '/' . uniqid('zip_') . '.zip';

        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($filesToZip as $f) {
                $zip->addFile($f['path'], $f['name']);
            }
            $zip->close();
        } else {
            return back()->with('error', 'Gagal memproses file arsip ZIP.');
        }

        return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
    }

    public function thumbnail($id)
    {
        $doc = \App\Models\EventDocumentation::find($id);
        if (!$doc) {
            abort(404);
        }

        if (Str::startsWith($doc->file_path, ['http://', 'https://'])) {
            return redirect()->away($doc->file_path);
        }

        $originalPath = Storage::disk('public')->path($doc->file_path);
        if (!file_exists($originalPath)) {
            abort(404);
        }

        if ($doc->file_type === 'video') {
            return response()->file($originalPath);
        }

        $thumbDir = storage_path('app/public/thumbnails');
        if (!is_dir($thumbDir)) {
            mkdir($thumbDir, 0755, true);
        }

        $hash = md5($doc->file_path . '_w550_q75');
        $thumbPath = $thumbDir . '/' . $hash . '.jpg';

        if (file_exists($thumbPath)) {
            return response()->file($thumbPath, [
                'Content-Type' => 'image/jpeg',
                'Cache-Control' => 'public, max-age=31536000, immutable',
            ]);
        }

        try {
            $imageInfo = @getimagesize($originalPath);
            if (!$imageInfo) {
                return response()->file($originalPath);
            }

            $origW = $imageInfo[0];
            $origH = $imageInfo[1];
            $mime = $imageInfo['mime'];

            $targetW = 550;
            if ($origW > $targetW) {
                $targetH = (int) round(($origH / $origW) * $targetW);
            } else {
                $targetW = $origW;
                $targetH = $origH;
            }

            $src = null;
            if ($mime === 'image/jpeg' || $mime === 'image/jpg') {
                $src = @imagecreatefromjpeg($originalPath);
            } elseif ($mime === 'image/png') {
                $src = @imagecreatefrompng($originalPath);
            } elseif ($mime === 'image/webp' && function_exists('imagecreatefromwebp')) {
                $src = @imagecreatefromwebp($originalPath);
            }

            if (!$src) {
                return response()->file($originalPath);
            }

            if (function_exists('exif_read_data') && ($mime === 'image/jpeg' || $mime === 'image/jpg')) {
                $exif = @exif_read_data($originalPath);
                if (!empty($exif['Orientation'])) {
                    switch ($exif['Orientation']) {
                        case 3:
                            $src = imagerotate($src, 180, 0);
                            break;
                        case 6:
                            $src = imagerotate($src, -90, 0);
                            $tmp = $targetW;
                            $targetW = $targetH;
                            $targetH = $tmp;
                            break;
                        case 8:
                            $src = imagerotate($src, 90, 0);
                            $tmp = $targetW;
                            $targetW = $targetH;
                            $targetH = $tmp;
                            break;
                    }
                }
            }

            $dst = imagecreatetruecolor($targetW, $targetH);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $targetW, $targetH, imagesx($src), imagesy($src));
            imagejpeg($dst, $thumbPath, 75);

            imagedestroy($src);
            imagedestroy($dst);

            return response()->file($thumbPath, [
                'Content-Type' => 'image/jpeg',
                'Cache-Control' => 'public, max-age=31536000, immutable',
            ]);
        } catch (\Throwable $e) {
            return response()->file($originalPath);
        }
    }
}
