<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\Loan;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class AdminActivityChart extends ChartWidget
{
    protected ?string $heading = 'Aktivitas Kegiatan & Peminjaman Aset Tahunan';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create(null, $month, 1)->translatedFormat('M');
        })->toArray();

        $currentYear = now()->year;

        $eventCounts = [];
        $loanCounts = [];

        for ($m = 1; $m <= 12; $m++) {
            $eventCounts[] = Event::whereYear('event_date', $currentYear)
                ->whereMonth('event_date', $m)
                ->count();

            $loanCounts[] = Loan::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $m)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => "Event Terjadwal ({$currentYear})",
                    'data' => $eventCounts,
                    'borderColor' => '#0D59F2',
                    'backgroundColor' => 'rgba(13, 89, 242, 0.15)',
                    'fill' => 'start',
                ],
                [
                    'label' => "Peminjaman Inventaris ({$currentYear})",
                    'data' => $loanCounts,
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.15)',
                    'fill' => 'start',
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
