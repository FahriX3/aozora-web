<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\Pengurus;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalEvents = Event::count();
        $totalPengurus = Pengurus::count();
        $totalInventaris = \App\Models\InventarisItem::count();
        $totalUsers = User::count();

        return [
            Stat::make('Total Event & Matsuri', $totalEvents)
                ->description(Event::where('status', 'upcoming')->count() . ' event aktif/mendatang')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary')
                ->chart([3, 5, 4, 7, 8, 6, 9]),
            Stat::make('Pengurus Aozora', $totalPengurus)
                ->description('Pengurus aktif SMKN 1')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            Stat::make('Aset Inventaris', $totalInventaris)
                ->description('Barang logistik terdata')
                ->descriptionIcon('heroicon-m-cube')
                ->color('warning'),
            Stat::make('Pengguna Sistem', $totalUsers)
                ->description('Akun internal terdaftar')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('info'),
        ];
    }
}
