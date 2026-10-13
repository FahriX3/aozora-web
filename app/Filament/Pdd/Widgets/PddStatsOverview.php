<?php

namespace App\Filament\Pdd\Widgets;

use App\Models\Event;
use App\Models\EventDocumentation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PddStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalEvents = Event::count();
        $upcomingEvents = Event::where('status', 'upcoming')->count();
        $completedEvents = Event::where('status', 'completed')->count();
        $totalPhotos = EventDocumentation::where('file_type', 'image')->count();
        $totalVideos = EventDocumentation::where('file_type', 'video')->count() + Event::where('is_aftermovie', true)->count();

        return [
            Stat::make('Total Event & Kegiatan', $totalEvents)
                ->description("{$upcomingEvents} mendatang, {$completedEvents} selesai")
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),
            Stat::make('Event Mendatang (Aktif)', $upcomingEvents)
                ->description('Perlu persiapan publikasi & rundowns')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('warning'),
            Stat::make('Dokumentasi Foto', $totalPhotos)
                ->description('Foto galeri event terupload')
                ->descriptionIcon('heroicon-m-camera')
                ->color('success'),
            Stat::make('Aftermovie & Video', $totalVideos)
                ->description('Video & teaser kegiatan klub')
                ->descriptionIcon('heroicon-m-video-camera')
                ->color('info'),
        ];
    }
}
