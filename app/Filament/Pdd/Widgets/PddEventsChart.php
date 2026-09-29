<?php

namespace App\Filament\Pdd\Widgets;

use App\Models\Event;
use App\Models\EventDocumentation;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class PddEventsChart extends ChartWidget
{
    protected ?string $heading = 'Statistik Event & Publikasi Dokumentasi';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create(null, $month, 1)->translatedFormat('M');
        })->toArray();

        $currentYear = now()->year;

        $eventCounts = [];
        $docCounts = [];

        for ($m = 1; $m <= 12; $m++) {
            $eventCounts[] = Event::whereYear('event_date', $currentYear)
                ->whereMonth('event_date', $m)
                ->count();

            $docCounts[] = EventDocumentation::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $m)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => "Event Terjadwal ({$currentYear})",
                    'data' => $eventCounts,
                    'backgroundColor' => 'rgba(124, 58, 237, 0.65)',
                    'borderColor' => '#7C3AED',
                ],
                [
                    'label' => "Dokumentasi Terupload ({$currentYear})",
                    'data' => $docCounts,
                    'backgroundColor' => 'rgba(14, 165, 233, 0.65)',
                    'borderColor' => '#0EA5E9',
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
