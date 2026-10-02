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
        $data = self::getPengurusData();

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
    public static function getPengurusData(): array
    {
        // Fetch all pengurus from database, ordered by urutan
        $allPengurus = Pengurus::with('user')->orderBy('urutan')->get();

        // Helper: resolve avatar URL
        $resolveAvatar = function (?string $avatar, string $nama): string {
            if ($avatar && $avatar !== 'default-avatar.png' && Storage::disk('public')->exists($avatar)) {
                return Storage::url($avatar);
            }
            // Fallback: use pengurus_dummy.jpg
            return asset('assets/kepengurusan/pengurus_dummy.jpg');
        };

        // Helper: clean sub_jabatan from Advisor, Coach, Leader, Vice Leader
        $cleanSubJabatan = function (?string $sub, string $default): string {
            if (!$sub) return $default;
            $cleaned = str_replace(
                ['• Advisor / ', '• Advisor /', 'Advisor / ', 'Advisor /', 'Advisor', 
                 '• Coach / ', '• Coach /', 'Coach / ', 'Coach /', 'Coach',
                 '• Leader / ', '• Leader /', 'Leader / ', 'Leader /', '• Leader ', '• Leader', 'Leader',
                 '• Vice Leader / ', '• Vice Leader /', 'Vice Leader / ', 'Vice Leader /', 'Vice Leader', 'Vice Leader / 副部長'],
                ['', '', '', '', '',
                 '', '', '', '', '',
                 '', '', '', '', '', '', '',
                 '', '', '', '', '', '副部長'],
                $sub
            );
            $cleaned = trim($cleaned, " \t\n\r\0\x0B•-");
            return !empty($cleaned) ? $cleaned : $default;
        };

        // ---- Pembina Ekstrakurikuler ----
        $pembinaRecord = $allPengurus->first(function ($p) {
            return $p->divisi === 'Pembina' || str_contains($p->jabatan, 'Pembina') || str_contains($p->nama, 'Kikie');
        });

        $pembina = $pembinaRecord ? [
            'nama' => $pembinaRecord->user ? $pembinaRecord->user->name : $pembinaRecord->nama,
            'jabatan' => $pembinaRecord->jabatan,
            'sub_jabatan' => $cleanSubJabatan($pembinaRecord->sub_jabatan ?? null, '顧問'),
            'kelas' => $pembinaRecord->kelas ?? 'Guru Pembina',
            'avatar' => ($pembinaRecord->avatar && $pembinaRecord->avatar !== 'default-avatar.png' && Storage::disk('public')->exists($pembinaRecord->avatar))
                ? Storage::url($pembinaRecord->avatar)
                : asset('assets/kepengurusan/kikie_sensei.jpg'),
            'badge_color' => 'bg-emerald-600 text-white',
            'badge_style' => 'background-color: #059669; color: #ffffff;',
        ] : [
            'nama' => 'Kikie Astri Mahdalika S.Pd',
            'jabatan' => 'Pembina Ekstrakurikuler',
            'sub_jabatan' => '顧問',
            'kelas' => 'Guru Pembina',
            'avatar' => asset('assets/kepengurusan/kikie_sensei.jpg'),
            'badge_color' => 'bg-emerald-600 text-white',
            'badge_style' => 'background-color: #059669; color: #ffffff;',
        ];

        // ---- Pelatih Ekstrakurikuler ----
        $pelatihRecord = $allPengurus->first(function ($p) {
            return $p->divisi === 'Pelatih' || str_contains($p->jabatan, 'Pelatih') || str_contains($p->nama, 'Ayu');
        });

        $pelatih = $pelatihRecord ? [
            'nama' => $pelatihRecord->user ? $pelatihRecord->user->name : $pelatihRecord->nama,
            'jabatan' => $pelatihRecord->jabatan ?? 'Pelatih Ekstrakurikuler',
            'sub_jabatan' => $cleanSubJabatan($pelatihRecord->sub_jabatan ?? null, '指導員'),
            'kelas' => $pelatihRecord->kelas ?? 'Pelatih ANC',
            'avatar' => ($pelatihRecord->avatar && $pelatihRecord->avatar !== 'default-avatar.png' && Storage::disk('public')->exists($pelatihRecord->avatar))
                ? Storage::url($pelatihRecord->avatar)
                : asset('assets/kepengurusan/mba_ayu.jpg'),
            'badge_color' => 'bg-emerald-600 text-white',
            'badge_style' => 'background-color: #059669; color: #ffffff;',
        ] : [
            'nama' => 'Ayu Tsaltsa Savira',
            'jabatan' => 'Pelatih Ekstrakurikuler',
            'sub_jabatan' => '指導員',
            'kelas' => 'Pelatih ANC',
            'avatar' => asset('assets/kepengurusan/mba_ayu.jpg'),
            'badge_color' => 'bg-emerald-600 text-white',
            'badge_style' => 'background-color: #059669; color: #ffffff;',
        ];

        // ---- Pengurus Inti (BPH) ----
        $pengurusIntiRecords = $allPengurus->where('divisi', 'Pengurus Inti');

        // Ketua Umum
        $ketuaRecord = $pengurusIntiRecords->firstWhere('jabatan', 'Ketua Umum');
        $ketua = $ketuaRecord ? [
            'nama' => $ketuaRecord->user ? $ketuaRecord->user->name : $ketuaRecord->nama,
            'jabatan' => $ketuaRecord->jabatan,
            'sub_jabatan' => $cleanSubJabatan($ketuaRecord->sub_jabatan ?? null, '会長'),
            'kelas' => $ketuaRecord->kelas,
            'avatar' => $resolveAvatar($ketuaRecord->avatar, $ketuaRecord->nama),
            'badge_color' => 'bg-primary text-white',
            'badge_style' => 'background-color: #2563eb; color: #ffffff;',
        ] : [
            'nama' => '-', 'jabatan' => 'Ketua Umum', 'sub_jabatan' => '会長',
            'kelas' => '-', 'avatar' => asset('assets/kepengurusan/pengurus_dummy.jpg'), 'badge_color' => 'bg-primary text-white',
            'badge_style' => 'background-color: #2563eb; color: #ffffff;',
        ];

        // Wakil Ketua
        $wakilRecord = $pengurusIntiRecords->firstWhere('jabatan', 'Wakil Ketua');
        $wakil = $wakilRecord ? [
            'nama' => $wakilRecord->user ? $wakilRecord->user->name : $wakilRecord->nama,
            'jabatan' => $wakilRecord->jabatan,
            'sub_jabatan' => $cleanSubJabatan($wakilRecord->sub_jabatan ?? null, '副部長'),
            'kelas' => $wakilRecord->kelas,
            'avatar' => $resolveAvatar($wakilRecord->avatar, $wakilRecord->nama),
            'badge_color' => 'bg-sky-500 text-white',
            'badge_style' => 'background-color: #0284c7; color: #ffffff;',
        ] : [
            'nama' => '-', 'jabatan' => 'Wakil Ketua', 'sub_jabatan' => '副部長',
            'kelas' => '-', 'avatar' => asset('assets/kepengurusan/pengurus_dummy.jpg'), 'badge_color' => 'bg-sky-500 text-white',
            'badge_style' => 'background-color: #0284c7; color: #ffffff;',
        ];

        // Bendahara (1 & 2)
        $bendahara = $pengurusIntiRecords
            ->filter(fn ($p) => str_starts_with($p->jabatan, 'Bendahara'))
            ->values()
            ->map(fn ($p) => [
                'nama' => $p->user ? $p->user->name : $p->nama,
                'jabatan' => $p->jabatan,
                'kelas' => $p->kelas,
                'avatar' => $resolveAvatar($p->avatar, $p->nama),
            ])->toArray();

        // Sekretaris (1 & 2)
        $sekretaris = $pengurusIntiRecords
            ->filter(fn ($p) => str_starts_with($p->jabatan, 'Sekretaris'))
            ->values()
            ->map(fn ($p) => [
                'nama' => $p->user ? $p->user->name : $p->nama,
                'jabatan' => $p->jabatan,
                'kelas' => $p->kelas,
                'avatar' => $resolveAvatar($p->avatar, $p->nama),
            ])->toArray();

        // Humas (1 & 2)
        $humas = $pengurusIntiRecords
            ->filter(fn ($p) => str_starts_with($p->jabatan, 'Humas'))
            ->values()
            ->map(fn ($p) => [
                'nama' => $p->user ? $p->user->name : $p->nama,
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
            'nama' => $p->user ? $p->user->name : $p->nama,
            'divisi' => $p->divisi,
            'jabatan' => $p->jabatan,
            'kelas' => $p->kelas,
            'avatar' => $resolveAvatar($p->avatar, $p->nama),
            'tag_color' => $tagColors[$p->divisi] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',
        ])->toArray();

        $pengurusInti = [
            'pembina' => $pembina,
            'pelatih' => $pelatih,
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
                'nama' => $p->user ? $p->user->name : $p->nama,
                'kelas' => $p->kelas,
                'divisi' => $p->divisi,
                'jabatan' => 'Anggota Divisi',
                'avatar' => $resolveAvatar($p->avatar, $p->nama),
            ])->toArray();
            $totalAnggota += count($anggotaDivisi[$divisi]);
        }

        // ---- All Members (Flat list for search/filter) ----
        $allMembers = [];

        // Pembina
        $allMembers[] = [
            'nama' => $pembina['nama'],
            'jabatan' => $pembina['jabatan'],
            'sub_jabatan' => $pembina['sub_jabatan'],
            'divisi' => 'Pembina',
            'kategori' => 'pembina',
            'kelas' => $pembina['kelas'],
            'avatar' => $pembina['avatar'],
            'role_badge' => 'Pembina Ekstrakurikuler',
            'badge_bg' => 'bg-emerald-600',
            'badge_style' => 'background-color: #059669; color: #ffffff;',
            'tag_color' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300',
            'order' => 0,
        ];

        // Pelatih
        $allMembers[] = [
            'nama' => $pelatih['nama'],
            'jabatan' => $pelatih['jabatan'],
            'sub_jabatan' => $pelatih['sub_jabatan'],
            'divisi' => 'Bidang Kepelatihan',
            'kategori' => 'pelatih',
            'kelas' => $pelatih['kelas'],
            'avatar' => $pelatih['avatar'],
            'role_badge' => 'Pelatih Ekstrakurikuler',
            'badge_bg' => 'bg-emerald-600',
            'badge_style' => 'background-color: #059669; color: #ffffff;',
            'tag_color' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300',
            'order' => 0,
        ];

        // Ketua
        $allMembers[] = [
            'nama' => $ketua['nama'],
            'jabatan' => $ketua['jabatan'],
            'sub_jabatan' => $ketua['sub_jabatan'],
            'divisi' => 'Pengurus Inti',
            'kategori' => 'inti',
            'kelas' => $ketua['kelas'],
            'avatar' => $ketua['avatar'],
            'role_badge' => 'Ketua Umum',
            'badge_bg' => 'bg-blue-600',
            'badge_style' => 'background-color: #2563eb; color: #ffffff;',
            'tag_color' => 'bg-blue-100 text-blue-700 dark:bg-blue-950 dark:text-blue-300',
            'order' => 1,
        ];

        // Wakil
        $allMembers[] = [
            'nama' => $wakil['nama'],
            'jabatan' => $wakil['jabatan'],
            'sub_jabatan' => $wakil['sub_jabatan'],
            'divisi' => 'Pengurus Inti',
            'kategori' => 'inti',
            'kelas' => $wakil['kelas'],
            'avatar' => $wakil['avatar'],
            'role_badge' => 'Wakil Ketua',
            'badge_bg' => 'bg-sky-600',
            'badge_style' => 'background-color: #0284c7; color: #ffffff;',
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

        $totalInti = 2 + count($pengurusIntiRecords) + count($koordinatorRecords);
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
