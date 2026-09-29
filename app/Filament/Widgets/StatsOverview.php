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
        return [
            Stat::make('Total Event & Matsuri', Event::count())
                ->description('Event terselenggara & terjadwal')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),
            Stat::make('Event Mendatang', Event::where('status', 'upcoming')->count())
                ->description('Jadwal aktif')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('warning'),
            Stat::make('Total Pengurus Aozora', Pengurus::count())
                ->description('Anggota aktif SMKN 1')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            Stat::make('Pengguna Sistem', User::count())
                ->description('Akun dengan role internal')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('info'),
        ];
    }
}
