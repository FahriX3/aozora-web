<?php

namespace App\Filament\Inventaris\Widgets;

use App\Models\InventarisItem;
use App\Models\LaporanKerusakan;
use App\Models\TransaksiInventaris;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InventarisStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalItems = InventarisItem::count();
        $totalStok = InventarisItem::sum('jumlah_total');
        $totalTersedia = InventarisItem::sum('jumlah_tersedia');
        $dipinjam = max(0, $totalStok - $totalTersedia);
        $pendingLaporan = LaporanKerusakan::where('status', 'pending')->count();

        return [
            Stat::make('Total Jenis Barang', $totalItems)
                ->description("Total {$totalStok} unit fisik aset")
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('primary'),
            Stat::make('Barang Siap Pakai', "{$totalTersedia} unit")
                ->description('Tersedia di tempat penyimpanan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('Sedang Dipinjam / Keluar', "{$dipinjam} unit")
                ->description('Aktif digunakan kegiatan')
                ->descriptionIcon('heroicon-m-arrow-right-circle')
                ->color($dipinjam > 0 ? 'warning' : 'gray'),
            Stat::make('Laporan Kerusakan Masuk', $pendingLaporan)
                ->description($pendingLaporan > 0 ? 'Perlu tindakan koordinator' : 'Semua tertangani')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($pendingLaporan > 0 ? 'danger' : 'success'),
        ];
    }
}
