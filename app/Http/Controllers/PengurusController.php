<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * Get structured organization data.
     */
    private function getPengurusData(): array
    {
        // Foto pengurus (menggunakan asset lokal DSC02070.jpg untuk preview)
        $avatar = function (string $name, ?string $bg = 'random', ?string $color = 'fff'): string {
            return asset('assets/DSC02070.jpg');
        };

        // 1. PENGURUS INTI (20 Orang)
        $pengurusInti = [
            // Baris 1: Ketua
            'ketua' => [
                'nama' => 'Tegar Satrio Utomo',
                'jabatan' => 'Ketua Umum',
                'sub_jabatan' => 'Leader / 会長',
                'kelas' => 'XI PPLG 2',
                'avatar' => $avatar('Tegar Satrio Utomo', '0043c0', 'ffffff'),
                'badge_color' => 'bg-primary text-white',
            ],

            // Baris 2: Wakil Ketua
            'wakil' => [
                'nama' => 'Deris Novaliza Khusnul Khotimah',
                'jabatan' => 'Wakil Ketua',
                'sub_jabatan' => 'Vice Leader / 副部長',
                'kelas' => 'XI TJKT 1',
                'avatar' => $avatar('Deris Novaliza Khusnul Khotimah', '38BDF8', '0B1021'),
                'badge_color' => 'bg-sky-500 text-white',
            ],

            // Baris 3: Bendahara & Sekretaris
            'bendahara' => [
                [
                    'nama' => 'Zinniroh Al Ashwani',
                    'jabatan' => 'Bendahara 1',
                    'kelas' => 'XI AKL 1',
                    'avatar' => $avatar('Zinniroh Al Ashwani'),
                ],
                [
                    'nama' => 'Fadillah Septi Lintang Ramadhani',
                    'jabatan' => 'Bendahara 2',
                    'kelas' => 'XI TF 1',
                    'avatar' => $avatar('Fadillah Septi Lintang Ramadhani'),
                ],
            ],

            'sekretaris' => [
                [
                    'nama' => 'Tika Ocha Anindita',
                    'jabatan' => 'Sekretaris 1',
                    'kelas' => 'XI AKL 2',
                    'avatar' => $avatar('Tika Ocha Anindita'),
                ],
                [
                    'nama' => 'Amellia Ramdhan Nelista',
                    'jabatan' => 'Sekretaris 2',
                    'kelas' => 'XI MPLB 2',
                    'avatar' => $avatar('Amellia Ramdhan Nelista'),
                ],
            ],

            // Baris 4: Humas
            'humas' => [
                [
                    'nama' => 'Arindhia Syarafana A',
                    'jabatan' => 'Humas 1',
                    'kelas' => 'XI TF 1',
                    'avatar' => $avatar('Arindhia Syarafana A'),
                ],
                [
                    'nama' => 'Nur Ngaisatuzzahro',
                    'jabatan' => 'Humas 2',
                    'kelas' => 'XI AKL 2',
                    'avatar' => $avatar('Nur Ngaisatuzzahro'),
                ],
            ],

            // Baris 5: Seluruh Koordinator Divisi (12 Orang)
            'koordinator' => [
                [
                    'nama' => 'Arkazora Abdullah Azzam',
                    'divisi' => 'Pemateri',
                    'jabatan' => 'Koordinator Pemateri',
                    'kelas' => 'XI TJKT 2',
                    'avatar' => $avatar('Arkazora Abdullah Azzam'),
                    'tag_color' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300',
                ],
                [
                    'nama' => 'Lyana Nur Awaliyah',
                    'divisi' => 'Pemateri',
                    'jabatan' => 'Koordinator Pemateri',
                    'kelas' => 'XI MPLB 2',
                    'avatar' => $avatar('Lyana Nur Awaliyah'),
                    'tag_color' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300',
                ],
                [
                    'nama' => 'Faris Ammar Yasin',
                    'divisi' => 'Kegiatan',
                    'jabatan' => 'Koordinator Kegiatan',
                    'kelas' => 'XI PPLG 3',
                    'avatar' => $avatar('Faris Ammar Yasin'),
                    'tag_color' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300',
                ],
                [
                    'nama' => 'Maghiezta Altha Funnisa',
                    'divisi' => 'Kegiatan',
                    'jabatan' => 'Koordinator Kegiatan',
                    'kelas' => 'XI AKL 1',
                    'avatar' => $avatar('Maghiezta Altha Funnisa'),
                    'tag_color' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300',
                ],
                [
                    'nama' => 'Naila Ajizah',
                    'divisi' => 'Budaya Bahasa',
                    'jabatan' => 'Koordinator Budaya Bahasa',
                    'kelas' => 'XI TF 1',
                    'avatar' => $avatar('Naila Ajizah'),
                    'tag_color' => 'bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-300',
                ],
                [
                    'nama' => 'Zakia Sultonah',
                    'divisi' => 'Budaya Bahasa',
                    'jabatan' => 'Koordinator Budaya Bahasa',
                    'kelas' => 'XI PM 2',
                    'avatar' => $avatar('Zakia Sultonah'),
                    'tag_color' => 'bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-300',
                ],
                [
                    'nama' => 'Abiyyu Arma Wijaya',
                    'divisi' => 'PDD',
                    'jabatan' => 'Koordinator PDD',
                    'kelas' => 'XI PM 2',
                    'avatar' => $avatar('Abiyyu Arma Wijaya'),
                    'tag_color' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300',
                ],
                [
                    'nama' => 'Damara Ghivary Abrar',
                    'divisi' => 'PDD',
                    'jabatan' => 'Koordinator PDD',
                    'kelas' => 'XI PPLG 3',
                    'avatar' => $avatar('Damara Ghivary Abrar'),
                    'tag_color' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300',
                ],
                [
                    'nama' => 'Kayla Sandrina H',
                    'divisi' => 'Mediakom',
                    'jabatan' => 'Koordinator Mediakom',
                    'kelas' => 'XI DKV 2',
                    'avatar' => $avatar('Kayla Sandrina H'),
                    'tag_color' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300',
                ],
                [
                    'nama' => 'Queena Eksha Putri',
                    'divisi' => 'Mediakom',
                    'jabatan' => 'Koordinator Mediakom',
                    'kelas' => 'XI DKV 1',
                    'avatar' => $avatar('Queena Eksha Putri'),
                    'tag_color' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300',
                ],
                [
                    'nama' => 'Kayravinnia Secha Putri',
                    'divisi' => 'Perkap',
                    'jabatan' => 'Koordinator Perkap',
                    'kelas' => 'XI PM 2',
                    'avatar' => $avatar('Kayravinnia Secha Putri'),
                    'tag_color' => 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-300',
                ],
                [
                    'nama' => 'Muhammad Fikri Arrasyid',
                    'divisi' => 'Perkap',
                    'jabatan' => 'Koordinator Perkap',
                    'kelas' => 'XI TJKT 2',
                    'avatar' => $avatar('Muhammad Fikri Arrasyid'),
                    'tag_color' => 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-300',
                ],
            ],
        ];

        // 2. ANGGOTA DIVISI (32 Orang)
        $rawAnggota = [
            'Pemateri' => [
                ['nama' => 'Nailul Luna', 'kelas' => 'XI MPLB 3'],
                ['nama' => 'Diandrasadhya Pramesti', 'kelas' => 'XI PPLG 3'],
                ['nama' => 'Durotusalisah', 'kelas' => 'XI MPLB 3'],
                ['nama' => 'Angga Riski Adi Pratama', 'kelas' => 'XI TJKT 1'],
                ['nama' => 'Isnaini Ramadani Saputri', 'kelas' => 'XI MPLB 3'],
                ['nama' => 'Hafidz Izaar Wiraaji', 'kelas' => 'XI AKL 5'],
            ],
            'Kegiatan' => [
                ['nama' => 'Anisa Nur Hidayah', 'kelas' => 'XI PM 1'],
                ['nama' => 'Ajeng Aditiya Falsafah', 'kelas' => 'XI AKL 2'],
                ['nama' => 'Aini Eka Ramadhani', 'kelas' => 'XI MPLB 3'],
                ['nama' => 'Thaleta Indah Antari', 'kelas' => 'XI AKL 2'],
                ['nama' => 'Andhika Atha Pramoedya', 'kelas' => 'XI MPLB 1'],
                ['nama' => 'Reyshafa Armelia Rochmanto', 'kelas' => 'XI MPLB 3'],
            ],
            'Budaya Bahasa' => [
                ['nama' => 'Nezya Eka Aulia', 'kelas' => 'XI PM 1'],
                ['nama' => 'Nabila Putri Shira Nirbana', 'kelas' => 'XI PM 2'],
                ['nama' => 'Anggi Novanda Restianti', 'kelas' => 'XI MPLB 3'],
                ['nama' => 'Khairatul Kantika M', 'kelas' => 'XI MPLB 3'],
                ['nama' => 'Bilqist Ainur Rokhman', 'kelas' => 'XI AKL 1'],
            ],
            'PDD' => [
                ['nama' => 'Rifki Putra P.', 'kelas' => 'XI PPLG 1'],
                ['nama' => 'Alinda Salsabila Nadhifah', 'kelas' => 'XI PM 2'],
                ['nama' => 'Khayati Juliana Putri', 'kelas' => 'XI PM 2'],
                ['nama' => 'Alfino Nur Rafata', 'kelas' => 'XI TJKT 2'],
            ],
            'Mediakom' => [
                ['nama' => 'Ghaitsa Anika Zhaiyan', 'kelas' => 'XI MPLB 3'],
                ['nama' => 'Mevin Saktia Ramadhan', 'kelas' => 'XI DKV 2'],
                ['nama' => 'Belinda Jacellyne Queenshaina Indra', 'kelas' => 'XI MPLB 2'],
                ['nama' => 'Thalita Aurelia Shalsavarella', 'kelas' => 'XI DKV'],
                ['nama' => 'Ardyta Weningtyas Syahrien', 'kelas' => 'XI MPLB 3'],
            ],
            'Perkap' => [
                ['nama' => 'Rafandi Ardiansyah', 'kelas' => 'XI PPLG 1'],
                ['nama' => 'Alfeda Faith Manggala Wijaya', 'kelas' => 'XI PPLG 1'],
                ['nama' => 'Devita Alviana', 'kelas' => 'XI PM 1'],
                ['nama' => 'Fairus Raditya Dananjaya', 'kelas' => 'XI AKL 5'],
                ['nama' => 'Deven Hawwary Raysha', 'kelas' => 'XI PPLG 1'],
                ['nama' => 'Akhyar Radithya Cahyadi', 'kelas' => 'XI TJKT 1'],
            ],
        ];

        // Format Anggota Divisi with avatar and metadata
        $anggotaDivisi = [];
        $totalAnggota = 0;

        foreach ($rawAnggota as $divisi => $members) {
            $anggotaDivisi[$divisi] = [];
            foreach ($members as $member) {
                $anggotaDivisi[$divisi][] = [
                    'nama' => $member['nama'],
                    'kelas' => $member['kelas'],
                    'divisi' => $divisi,
                    'jabatan' => 'Anggota Divisi',
                    'avatar' => $avatar($member['nama']),
                ];
                $totalAnggota++;
            }
        }

        // 3. SEMUA PENGURUS (FLATTENED 52 ORANG UNTUK GLOBAL FILTER & SEARCH)
        $allMembers = [];

        // Ketua
        $allMembers[] = [
            'nama' => $pengurusInti['ketua']['nama'],
            'jabatan' => $pengurusInti['ketua']['jabatan'],
            'sub_jabatan' => 'Ketua Umum • Leader / 会長',
            'divisi' => 'Pengurus Inti',
            'kategori' => 'inti',
            'kelas' => $pengurusInti['ketua']['kelas'],
            'avatar' => $pengurusInti['ketua']['avatar'],
            'role_badge' => 'Ketua Umum',
            'badge_bg' => 'bg-blue-600',
            'tag_color' => 'bg-blue-100 text-blue-700 dark:bg-blue-950 dark:text-blue-300',
            'order' => 1,
        ];

        // Wakil
        $allMembers[] = [
            'nama' => $pengurusInti['wakil']['nama'],
            'jabatan' => $pengurusInti['wakil']['jabatan'],
            'sub_jabatan' => 'Wakil Ketua • Vice Leader / 副部長',
            'divisi' => 'Pengurus Inti',
            'kategori' => 'inti',
            'kelas' => $pengurusInti['wakil']['kelas'],
            'avatar' => $pengurusInti['wakil']['avatar'],
            'role_badge' => 'Wakil Ketua',
            'badge_bg' => 'bg-sky-600',
            'tag_color' => 'bg-sky-100 text-sky-700 dark:bg-sky-950 dark:text-sky-300',
            'order' => 2,
        ];

        // Sekretaris (2)
        foreach ($pengurusInti['sekretaris'] as $sek) {
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

        // Bendahara (2)
        foreach ($pengurusInti['bendahara'] as $ben) {
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

        // Humas (2)
        foreach ($pengurusInti['humas'] as $hum) {
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

        // Koordinator Divisi (12)
        foreach ($pengurusInti['koordinator'] as $koor) {
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

        // Anggota Divisi (32)
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

        $totalInti = 1 + 1 + count($pengurusInti['bendahara']) + count($pengurusInti['sekretaris']) + count($pengurusInti['humas']) + count($pengurusInti['koordinator']); // 20
        $totalPengurus = $totalInti + $totalAnggota; // 52

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
