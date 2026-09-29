<?php

namespace Database\Seeders;

use App\Models\InventarisItem;
use App\Models\LaporanKerusakan;
use App\Models\TransaksiInventaris;
use App\Models\User;
use Illuminate\Database\Seeder;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'nama_barang' => 'Kimono Yukata Wanita (Pink Sakura)',
                'kode_barang' => 'AOZ-CSP-001',
                'kategori' => 'cosplay',
                'deskripsi' => 'Yukata wanita motif bunga sakura pink lengkap dengan obi belt merah dan pita.',
                'jumlah_total' => 6,
                'jumlah_tersedia' => 5,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Lemari Kostum Aozora No. 1',
            ],
            [
                'nama_barang' => 'Kimono Yukata Pria (Navy Seigaiha)',
                'kode_barang' => 'AOZ-CSP-002',
                'kategori' => 'cosplay',
                'deskripsi' => 'Yukata pria motif gelombang tradisional seigaiha navy dengan obi hitam.',
                'jumlah_total' => 4,
                'jumlah_tersedia' => 4,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Lemari Kostum Aozora No. 1',
            ],
            [
                'nama_barang' => 'Set Fude & Suzuri (Kuas & Tinta Shodo)',
                'kode_barang' => 'AOZ-SHD-001',
                'kategori' => 'alat_kaligrafi',
                'deskripsi' => 'Paket kuas kaligrafi fude berbagai ukuran dan wadah tinta batu suzuri.',
                'jumlah_total' => 10,
                'jumlah_tersedia' => 8,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Kotak Kaligrafi Rak B2',
            ],
            [
                'nama_barang' => 'Lampion Matsuri (Chochin Merah Jepang)',
                'kode_barang' => 'AOZ-MTR-001',
                'kategori' => 'properti_matsuri',
                'deskripsi' => 'Lampion gantung merah tulisan kanji Matsuri (祭り) untuk dekorasi stand bunkasai.',
                'jumlah_total' => 12,
                'jumlah_tersedia' => 12,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Gudang Ekstrakurikuler Box C1',
            ],
            [
                'nama_barang' => 'Tirai Noren Pintu Aozora (青空)',
                'kode_barang' => 'AOZ-MTR-002',
                'kategori' => 'properti_matsuri',
                'deskripsi' => 'Tirai kain belah noren khas kedai Jepang dengan sablon kanji 青空.',
                'jumlah_total' => 3,
                'jumlah_tersedia' => 3,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Gudang Ekstrakurikuler Box C1',
            ],
            [
                'nama_barang' => 'Speaker Portable Bluetooth Aozora',
                'kode_barang' => 'AOZ-ELK-001',
                'kategori' => 'elektronik',
                'deskripsi' => 'Speaker wireless 40W dengan 2 mic tanpa kabel untuk latihan anisong dan matsuri.',
                'jumlah_total' => 2,
                'jumlah_tersedia' => 1,
                'kondisi' => 'baik',
                'lokasi_penyimpanan' => 'Lemari Elektronik Ruang OSIS',
            ],
            [
                'nama_barang' => 'Kipas Tari Sensu Tradisional (Emas/Merah)',
                'kode_barang' => 'AOZ-CSP-003',
                'kategori' => 'cosplay',
                'deskripsi' => 'Kipas lipat sensu untuk penampilan tarian yosakoi.',
                'jumlah_total' => 8,
                'jumlah_tersedia' => 7,
                'kondisi' => 'rusak_ringan',
                'lokasi_penyimpanan' => 'Lemari Kostum Aozora No. 2',
            ],
        ];

        foreach ($items as $itemData) {
            $item = InventarisItem::updateOrCreate(
                ['kode_barang' => $itemData['kode_barang']],
                $itemData
            );
        }

        // Sample transaksi & laporan
        $admin = User::where('email', 'admin@aozora.local')->first();
        $koor = User::where('email', 'inventaris@aozora.local')->first() ?? $admin;
        $anggota = User::where('email', 'anggota@aozora.local')->first() ?? $admin;

        $yukataPink = InventarisItem::where('kode_barang', 'AOZ-CSP-001')->first();
        $speaker = InventarisItem::where('kode_barang', 'AOZ-ELK-001')->first();
        $kipas = InventarisItem::where('kode_barang', 'AOZ-CSP-003')->first();

        if ($yukataPink && $anggota) {
            TransaksiInventaris::firstOrCreate([
                'inventaris_item_id' => $yukataPink->id,
                'user_id' => $anggota->id,
                'tipe' => 'keluar',
                'jumlah' => 1,
                'keterangan' => 'Peminjaman untuk sesi photoshoot promosi Matsuri',
                'tanggal' => now()->subDays(2)->toDateString(),
            ]);
        }

        if ($speaker && $koor) {
            TransaksiInventaris::firstOrCreate([
                'inventaris_item_id' => $speaker->id,
                'user_id' => $koor->id,
                'tipe' => 'keluar',
                'jumlah' => 1,
                'keterangan' => 'Latihan Anisong persiapan event',
                'tanggal' => now()->subDays(1)->toDateString(),
            ]);
        }

        if ($kipas && $anggota) {
            LaporanKerusakan::firstOrCreate([
                'inventaris_item_id' => $kipas->id,
                'pelapor_user_id' => $anggota->id,
                'deskripsi_kerusakan' => 'Bilah bambu kedua dari kiri agak renggang saat dibuka cepat sewaktu latihan tari.',
                'status' => 'pending',
                'catatan_koordinator' => null,
            ]);
        }
    }
}
