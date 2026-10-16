<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::where('status', 'upcoming')
            ->orderBy('event_date', 'asc')
            ->limit(3)
            ->get();

        // Ambil 5 ID event teratas berdasarkan tanggal acara terbaru (baik upcoming maupun selesai)
        $topDateEventIds = Event::orderBy('event_date', 'desc')
            ->limit(5)
            ->pluck('id');

        // Carousel Beranda: Event Unggulan satuan + 5 Event teratas berdasarkan tanggal
        // Prioritas urutan: Event Unggulan terlebih dahulu, lalu status upcoming, lalu tanggal terbaru
        $featuredEvents = Event::where('is_featured', true)
            ->orWhereIn('id', $topDateEventIds)
            ->orderByRaw('CASE WHEN is_featured = 1 THEN 0 ELSE 1 END')
            ->orderByRaw("CASE WHEN status = 'upcoming' THEN 1 ELSE 2 END")
            ->orderBy('event_date', 'desc')
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
}
