<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    /**
     * Display a listing of the organizational structure.
     */
    public function index()
    {
        $data = $this->getPengurusData();

        return view('pages.pengurus', [
            'pengurusInti' => $data['pengurusInti'],
            'anggotaDivisi' => $data['anggotaDivisi'],
            'allMembers' => $data['allMembers'],
            'totalPengurus' => $data['totalPengurus'],
            'totalInti' => $data['totalInti'],
            'totalAnggota' => $data['totalAnggota'],
        ]);
    }

    /**
     * Get structured organization data from database.
     */
    private function getPengurusData(): array
    {
        // Fetch all pengurus from database, ordered by urutan
        $allPengurus = Pengurus::orderBy('urutan')->get();

        // Helper: resolve avatar URL
        $resolveAvatar = function (?string $avatar, string $nama): string {
            if ($avatar && $avatar !== 'default-avatar.png' && Storage::disk('public')->exists($avatar)) {
                return Storage::url($avatar);
            }
            // Fallback: use the local asset photo
            return asset('assets/DSC02070.jpg');
        };

        // ---- Pengurus Inti (BPH) ----
        $pengurusIntiRecords = $allPengurus->where('divisi', 'Pengurus Inti');

        // Ketua Umum
        $ketuaRecord = $pengurusIntiRecords->firstWhere('jabatan', 'Ketua Umum');
        $ketua = $ketuaRecord ? [
            'nama' => $ketuaRecord->nama,
            'jabatan' => $ketuaRecord->jabatan,
            'sub_jabatan' => $ketuaRecord->sub_jabatan ?? 'Leader / 会長',
            'kelas' => $ketuaRecord->kelas,
            'avatar' => $resolveAvatar($ketuaRecord->avatar, $ketuaRecord->nama),
            'badge_color' => 'bg-primary text-white',
        ] : [
            'nama' => '-', 'jabatan' => 'Ketua Umum', 'sub_jabatan' => 'Leader / 会長',
            'kelas' => '-', 'avatar' => asset('assets/DSC02070.jpg'), 'badge_color' => 'bg-primary text-white',
        ];

        // Wakil Ketua
        $wakilRecord = $pengurusIntiRecords->firstWhere('jabatan', 'Wakil Ketua');
        $wakil = $wakilRecord ? [
            'nama' => $wakilRecord->nama,
            'jabatan' => $wakilRecord->jabatan,
            'sub_jabatan' => $wakilRecord->sub_jabatan ?? 'Vice Leader / 副部長',
            'kelas' => $wakilRecord->kelas,
            'avatar' => $resolveAvatar($wakilRecord->avatar, $wakilRecord->nama),
            'badge_color' => 'bg-sky-500 text-white',
        ] : [
            'nama' => '-', 'jabatan' => 'Wakil Ketua', 'sub_jabatan' => 'Vice Leader / 副部長',
            'kelas' => '-', 'avatar' => asset('assets/DSC02070.jpg'), 'badge_color' => 'bg-sky-500 text-white',
        ];

        // Bendahara (1 & 2)
        $bendahara = $pengurusIntiRecords
            ->filter(fn ($p) => str_starts_with($p->jabatan, 'Bendahara'))
            ->values()
            ->map(fn ($p) => [
                'nama' => $p->nama,
                'jabatan' => $p->jabatan,
                'kelas' => $p->kelas,
                'avatar' => $resolveAvatar($p->avatar, $p->nama),
            ])->toArray();

        // Sekretaris (1 & 2)
        $sekretaris = $pengurusIntiRecords
            ->filter(fn ($p) => str_starts_with($p->jabatan, 'Sekretaris'))
            ->values()
            ->map(fn ($p) => [
                'nama' => $p->nama,
                'jabatan' => $p->jabatan,
                'kelas' => $p->kelas,
                'avatar' => $resolveAvatar($p->avatar, $p->nama),
            ])->toArray();

        // Humas (1 & 2)
        $humas = $pengurusIntiRecords
            ->filter(fn ($p) => str_starts_with($p->jabatan, 'Humas'))
            ->values()
            ->map(fn ($p) => [
                'nama' => $p->nama,
                'jabatan' => $p->jabatan,
                'kelas' => $p->kelas,
                'avatar' => $resolveAvatar($p->avatar, $p->nama),
            ])->toArray();

        // ---- Koordinator Divisi (12 Orang) ----
        $tagColors = [
            'Pemateri' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300',
            'Kegiatan' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300',
            'Budaya Bahasa' => 'bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-300',
            'PDD' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300',
            'Mediakom' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300',
            'Perkap' => 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-300',
        ];

        $koordinatorRecords = $allPengurus
            ->filter(fn ($p) => str_starts_with($p->jabatan, 'Koordinator'))
            ->values();

        $koordinator = $koordinatorRecords->map(fn ($p) => [
            'nama' => $p->nama,
            'divisi' => $p->divisi,
            'jabatan' => $p->jabatan,
            'kelas' => $p->kelas,
            'avatar' => $resolveAvatar($p->avatar, $p->nama),
            'tag_color' => $tagColors[$p->divisi] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',
        ])->toArray();

        $pengurusInti = [
            'ketua' => $ketua,
            'wakil' => $wakil,
            'bendahara' => $bendahara,
            'sekretaris' => $sekretaris,
            'humas' => $humas,
            'koordinator' => $koordinator,
        ];

        // ---- Anggota Divisi ----
        $anggotaRecords = $allPengurus
            ->filter(fn ($p) => $p->jabatan === 'Anggota' && $p->divisi !== 'Pengurus Inti');

        $anggotaDivisi = [];
        $totalAnggota = 0;

        foreach (['Pemateri', 'Kegiatan', 'Budaya Bahasa', 'PDD', 'Mediakom', 'Perkap'] as $divisi) {
            $members = $anggotaRecords->where('divisi', $divisi)->values();
            $anggotaDivisi[$divisi] = $members->map(fn ($p) => [
                'nama' => $p->nama,
                'kelas' => $p->kelas,
                'divisi' => $p->divisi,
                'jabatan' => 'Anggota Divisi',
                'avatar' => $resolveAvatar($p->avatar, $p->nama),
            ])->toArray();
            $totalAnggota += count($anggotaDivisi[$divisi]);
        }

        // ---- All Members (Flat list for search/filter) ----
        $allMembers = [];

        // Ketua
        $allMembers[] = [
            'nama' => $ketua['nama'],
            'jabatan' => $ketua['jabatan'],
            'sub_jabatan' => 'Ketua Umum • Leader / 会長',
            'divisi' => 'Pengurus Inti',
            'kategori' => 'inti',
            'kelas' => $ketua['kelas'],
            'avatar' => $ketua['avatar'],
            'role_badge' => 'Ketua Umum',
            'badge_bg' => 'bg-blue-600',
            'tag_color' => 'bg-blue-100 text-blue-700 dark:bg-blue-950 dark:text-blue-300',
            'order' => 1,
        ];

        // Wakil
        $allMembers[] = [
            'nama' => $wakil['nama'],
            'jabatan' => $wakil['jabatan'],
            'sub_jabatan' => 'Wakil Ketua • Vice Leader / 副部長',
            'divisi' => 'Pengurus Inti',
            'kategori' => 'inti',
            'kelas' => $wakil['kelas'],
            'avatar' => $wakil['avatar'],
            'role_badge' => 'Wakil Ketua',
            'badge_bg' => 'bg-sky-600',
            'tag_color' => 'bg-sky-100 text-sky-700 dark:bg-sky-950 dark:text-sky-300',
            'order' => 2,
        ];

        // Sekretaris
        foreach ($sekretaris as $sek) {
            $allMembers[] = [
                'nama' => $sek['nama'],
                'jabatan' => $sek['jabatan'],
                'sub_jabatan' => 'Pengurus Inti (BPH)',
                'divisi' => 'Pengurus Inti',
                'kategori' => 'inti',
                'kelas' => $sek['kelas'],
                'avatar' => $sek['avatar'],
                'role_badge' => $sek['jabatan'],
                'badge_bg' => 'bg-indigo-600',
                'tag_color' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-950 dark:text-indigo-300',
                'order' => 3,
            ];
        }

        // Bendahara
        foreach ($bendahara as $ben) {
            $allMembers[] = [
                'nama' => $ben['nama'],
                'jabatan' => $ben['jabatan'],
                'sub_jabatan' => 'Pengurus Inti (BPH)',
                'divisi' => 'Pengurus Inti',
                'kategori' => 'inti',
                'kelas' => $ben['kelas'],
                'avatar' => $ben['avatar'],
                'role_badge' => $ben['jabatan'],
                'badge_bg' => 'bg-emerald-600',
                'tag_color' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300',
                'order' => 4,
            ];
        }

        // Humas
        foreach ($humas as $hum) {
            $allMembers[] = [
                'nama' => $hum['nama'],
                'jabatan' => $hum['jabatan'],
                'sub_jabatan' => 'Pengurus Inti (BPH)',
                'divisi' => 'Pengurus Inti',
                'kategori' => 'inti',
                'kelas' => $hum['kelas'],
                'avatar' => $hum['avatar'],
                'role_badge' => $hum['jabatan'],
                'badge_bg' => 'bg-amber-600',
                'tag_color' => 'bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300',
                'order' => 5,
            ];
        }

        // Koordinator
        foreach ($koordinator as $koor) {
            $allMembers[] = [
                'nama' => $koor['nama'],
                'jabatan' => $koor['jabatan'],
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => $koor['divisi'],
                'kategori' => 'koordinator',
                'kelas' => $koor['kelas'],
                'avatar' => $koor['avatar'],
                'role_badge' => 'Koordinator ' . $koor['divisi'],
                'badge_bg' => 'bg-blue-600',
                'tag_color' => $koor['tag_color'],
                'order' => 6,
            ];
        }

        // Anggota Divisi
        foreach ($anggotaDivisi as $divisi => $members) {
            foreach ($members as $member) {
                $allMembers[] = [
                    'nama' => $member['nama'],
                    'jabatan' => 'Anggota ' . $divisi,
                    'sub_jabatan' => 'Anggota Aktif',
                    'divisi' => $divisi,
                    'kategori' => 'anggota',
                    'kelas' => $member['kelas'],
                    'avatar' => $member['avatar'],
                    'role_badge' => 'Anggota ' . $divisi,
                    'badge_bg' => 'bg-gray-800',
                    'tag_color' => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',
                    'order' => 7,
                ];
            }
        }

        $totalInti = count($pengurusIntiRecords) + count($koordinatorRecords);
        $totalPengurus = $totalInti + $totalAnggota;

        return [
            'pengurusInti' => $pengurusInti,
            'anggotaDivisi' => $anggotaDivisi,
            'allMembers' => $allMembers,
            'totalPengurus' => $totalPengurus,
            'totalInti' => $totalInti,
            'totalAnggota' => $totalAnggota,
        ];
    }
}
