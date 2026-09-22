<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengurus;

class PengurusSeeder extends Seeder
{
    /**
     * Seed the pengurus table with all 52 real members.
     */
    public function run(): void
    {
        Pengurus::truncate();

        $data = [
            // ===== PENGURUS INTI (BPH) - 8 Orang =====
            [
                'nama' => 'Tegar Satrio Utomo',
                'kelas' => 'XI PPLG 2',
                'jabatan' => 'Ketua Umum',
                'sub_jabatan' => 'Leader / 会長',
                'divisi' => 'Pengurus Inti',
                'urutan' => 1,
            ],
            [
                'nama' => 'Deris Novaliza Khusnul Khotimah',
                'kelas' => 'XI TJKT 1',
                'jabatan' => 'Wakil Ketua',
                'sub_jabatan' => 'Vice Leader / 副部長',
                'divisi' => 'Pengurus Inti',
                'urutan' => 2,
            ],
            [
                'nama' => 'Tika Ocha Anindita',
                'kelas' => 'XI AKL 2',
                'jabatan' => 'Sekretaris 1',
                'sub_jabatan' => 'Pengurus Inti',
                'divisi' => 'Pengurus Inti',
                'urutan' => 3,
            ],
            [
                'nama' => 'Amellia Ramdhan Nelista',
                'kelas' => 'XI MPLB 2',
                'jabatan' => 'Sekretaris 2',
                'sub_jabatan' => 'Pengurus Inti',
                'divisi' => 'Pengurus Inti',
                'urutan' => 4,
            ],
            [
                'nama' => 'Zinniroh Al Ashwani',
                'kelas' => 'XI AKL 1',
                'jabatan' => 'Bendahara 1',
                'sub_jabatan' => 'Pengurus Inti',
                'divisi' => 'Pengurus Inti',
                'urutan' => 5,
            ],
            [
                'nama' => 'Fadillah Septi Lintang Ramadhani',
                'kelas' => 'XI TF 1',
                'jabatan' => 'Bendahara 2',
                'sub_jabatan' => 'Pengurus Inti',
                'divisi' => 'Pengurus Inti',
                'urutan' => 6,
            ],
            [
                'nama' => 'Arindhia Syarafana A',
                'kelas' => 'XI TF 1',
                'jabatan' => 'Humas 1',
                'sub_jabatan' => 'Pengurus Inti',
                'divisi' => 'Pengurus Inti',
                'urutan' => 7,
            ],
            [
                'nama' => 'Nur Ngaisatuzzahro',
                'kelas' => 'XI AKL 2',
                'jabatan' => 'Humas 2',
                'sub_jabatan' => 'Pengurus Inti',
                'divisi' => 'Pengurus Inti',
                'urutan' => 8,
            ],

            // ===== KOORDINATOR DIVISI - 12 Orang =====
            [
                'nama' => 'Arkazora Abdullah Azzam',
                'kelas' => 'XI TJKT 2',
                'jabatan' => 'Koordinator Pemateri',
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => 'Pemateri',
                'urutan' => 10,
            ],
            [
                'nama' => 'Lyana Nur Awaliyah',
                'kelas' => 'XI MPLB 2',
                'jabatan' => 'Koordinator Pemateri',
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => 'Pemateri',
                'urutan' => 11,
            ],
            [
                'nama' => 'Faris Ammar Yasin',
                'kelas' => 'XI PPLG 3',
                'jabatan' => 'Koordinator Kegiatan',
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => 'Kegiatan',
                'urutan' => 12,
            ],
            [
                'nama' => 'Maghiezta Altha Funnisa',
                'kelas' => 'XI AKL 1',
                'jabatan' => 'Koordinator Kegiatan',
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => 'Kegiatan',
                'urutan' => 13,
            ],
            [
                'nama' => 'Naila Ajizah',
                'kelas' => 'XI TF 1',
                'jabatan' => 'Koordinator Budaya Bahasa',
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => 'Budaya Bahasa',
                'urutan' => 14,
            ],
            [
                'nama' => 'Zakia Sultonah',
                'kelas' => 'XI PM 2',
                'jabatan' => 'Koordinator Budaya Bahasa',
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => 'Budaya Bahasa',
                'urutan' => 15,
            ],
            [
                'nama' => 'Abiyyu Arma Wijaya',
                'kelas' => 'XI PM 2',
                'jabatan' => 'Koordinator PDD',
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => 'PDD',
                'urutan' => 16,
            ],
            [
                'nama' => 'Damara Ghivary Abrar',
                'kelas' => 'XI PPLG 3',
                'jabatan' => 'Koordinator PDD',
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => 'PDD',
                'urutan' => 17,
            ],
            [
                'nama' => 'Kayla Sandrina H',
                'kelas' => 'XI DKV 2',
                'jabatan' => 'Koordinator Mediakom',
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => 'Mediakom',
                'urutan' => 18,
            ],
            [
                'nama' => 'Queena Eksha Putri',
                'kelas' => 'XI DKV 1',
                'jabatan' => 'Koordinator Mediakom',
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => 'Mediakom',
                'urutan' => 19,
            ],
            [
                'nama' => 'Kayravinnia Secha Putri',
                'kelas' => 'XI PM 2',
                'jabatan' => 'Koordinator Perkap',
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => 'Perkap',
                'urutan' => 20,
            ],
            [
                'nama' => 'Muhammad Fikri Arrasyid',
                'kelas' => 'XI TJKT 2',
                'jabatan' => 'Koordinator Perkap',
                'sub_jabatan' => 'Koordinator Bidang',
                'divisi' => 'Perkap',
                'urutan' => 21,
            ],

            // ===== ANGGOTA DIVISI PEMATERI - 6 Orang =====
            ['nama' => 'Nailul Luna', 'kelas' => 'XI MPLB 3', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Pemateri', 'urutan' => 30],
            ['nama' => 'Diandrasadhya Pramesti', 'kelas' => 'XI PPLG 3', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Pemateri', 'urutan' => 31],
            ['nama' => 'Durotusalisah', 'kelas' => 'XI MPLB 3', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Pemateri', 'urutan' => 32],
            ['nama' => 'Angga Riski Adi Pratama', 'kelas' => 'XI TJKT 1', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Pemateri', 'urutan' => 33],
            ['nama' => 'Isnaini Ramadani Saputri', 'kelas' => 'XI MPLB 3', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Pemateri', 'urutan' => 34],
            ['nama' => 'Hafidz Izaar Wiraaji', 'kelas' => 'XI AKL 5', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Pemateri', 'urutan' => 35],

            // ===== ANGGOTA DIVISI KEGIATAN - 6 Orang =====
            ['nama' => 'Anisa Nur Hidayah', 'kelas' => 'XI PM 1', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Kegiatan', 'urutan' => 40],
            ['nama' => 'Ajeng Aditiya Falsafah', 'kelas' => 'XI AKL 2', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Kegiatan', 'urutan' => 41],
            ['nama' => 'Aini Eka Ramadhani', 'kelas' => 'XI MPLB 3', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Kegiatan', 'urutan' => 42],
            ['nama' => 'Thaleta Indah Antari', 'kelas' => 'XI AKL 2', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Kegiatan', 'urutan' => 43],
            ['nama' => 'Andhika Atha Pramoedya', 'kelas' => 'XI MPLB 1', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Kegiatan', 'urutan' => 44],
            ['nama' => 'Reyshafa Armelia Rochmanto', 'kelas' => 'XI MPLB 3', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Kegiatan', 'urutan' => 45],

            // ===== ANGGOTA DIVISI BUDAYA BAHASA - 5 Orang =====
            ['nama' => 'Nezya Eka Aulia', 'kelas' => 'XI PM 1', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Budaya Bahasa', 'urutan' => 50],
            ['nama' => 'Nabila Putri Shira Nirbana', 'kelas' => 'XI PM 2', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Budaya Bahasa', 'urutan' => 51],
            ['nama' => 'Anggi Novanda Restianti', 'kelas' => 'XI MPLB 3', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Budaya Bahasa', 'urutan' => 52],
            ['nama' => 'Khairatul Kantika M', 'kelas' => 'XI MPLB 3', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Budaya Bahasa', 'urutan' => 53],
            ['nama' => 'Bilqist Ainur Rokhman', 'kelas' => 'XI AKL 1', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Budaya Bahasa', 'urutan' => 54],

            // ===== ANGGOTA DIVISI PDD - 4 Orang =====
            ['nama' => 'Rifki Putra P.', 'kelas' => 'XI PPLG 1', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'PDD', 'urutan' => 60],
            ['nama' => 'Alinda Salsabila Nadhifah', 'kelas' => 'XI PM 2', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'PDD', 'urutan' => 61],
            ['nama' => 'Khayati Juliana Putri', 'kelas' => 'XI PM 2', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'PDD', 'urutan' => 62],
            ['nama' => 'Alfino Nur Rafata', 'kelas' => 'XI TJKT 2', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'PDD', 'urutan' => 63],

            // ===== ANGGOTA DIVISI MEDIAKOM - 5 Orang =====
            ['nama' => 'Ghaitsa Anika Zhaiyan', 'kelas' => 'XI MPLB 3', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Mediakom', 'urutan' => 70],
            ['nama' => 'Mevin Saktia Ramadhan', 'kelas' => 'XI DKV 2', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Mediakom', 'urutan' => 71],
            ['nama' => 'Belinda Jacellyne Queenshaina Indra', 'kelas' => 'XI MPLB 2', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Mediakom', 'urutan' => 72],
            ['nama' => 'Thalita Aurelia Shalsavarella', 'kelas' => 'XI DKV', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Mediakom', 'urutan' => 73],
            ['nama' => 'Ardyta Weningtyas Syahrien', 'kelas' => 'XI MPLB 3', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Mediakom', 'urutan' => 74],

            // ===== ANGGOTA DIVISI PERKAP - 6 Orang =====
            ['nama' => 'Rafandi Ardiansyah', 'kelas' => 'XI PPLG 1', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Perkap', 'urutan' => 80],
            ['nama' => 'Alfeda Faith Manggala Wijaya', 'kelas' => 'XI PPLG 1', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Perkap', 'urutan' => 81],
            ['nama' => 'Devita Alviana', 'kelas' => 'XI PM 1', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Perkap', 'urutan' => 82],
            ['nama' => 'Fairus Raditya Dananjaya', 'kelas' => 'XI AKL 5', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Perkap', 'urutan' => 83],
            ['nama' => 'Deven Hawwary Raysha', 'kelas' => 'XI PPLG 1', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Perkap', 'urutan' => 84],
            ['nama' => 'Akhyar Radithya Cahyadi', 'kelas' => 'XI TJKT 1', 'jabatan' => 'Anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Perkap', 'urutan' => 85],
        ];

        foreach ($data as $item) {
            Pengurus::create($item);
        }
    }
}
