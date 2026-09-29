<?php

namespace App\Filament\Anggota\Widgets;

use App\Models\InventarisItem;
use App\Models\LaporanKerusakan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AnggotaOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $userId = auth()->id();
        $totalBarangReady = InventarisItem::where('jumlah_tersedia', '>', 0)->count();
        $laporanSaya = LaporanKerusakan::where('pelapor_user_id', $userId)->count();
        $laporanPending = LaporanKerusakan::where('pelapor_user_id', $userId)->where('status', 'pending')->count();
        $laporanSelesai = LaporanKerusakan::where('pelapor_user_id', $userId)->where('status', 'selesai')->count();

        return [
            Stat::make('Barang Siap Digunakan', "{$totalBarangReady} item")
                ->description('Tersedia untuk kegiatan klub')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
            Stat::make('Laporan Saya', "{$laporanSaya} laporan")
                ->description("{$laporanPending} menunggu, {$laporanSelesai} selesai")
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
            Stat::make('Status Keanggotaan', 'Aktif')
                ->description('Aozora Nihongo Club SMKN 1')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),
        ];
    }
}
