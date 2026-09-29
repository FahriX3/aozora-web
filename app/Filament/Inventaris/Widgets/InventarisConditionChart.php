<?php

namespace App\Filament\Inventaris\Widgets;

use App\Models\InventarisItem;
use Filament\Widgets\ChartWidget;

class InventarisConditionChart extends ChartWidget
{
    protected ?string $heading = 'Distribusi Kondisi Fisik Barang Inventaris';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $baik = InventarisItem::where('kondisi', 'baik')->sum('jumlah_total');
        $rusakRingan = InventarisItem::where('kondisi', 'rusak_ringan')->sum('jumlah_total');
        $rusakBerat = InventarisItem::where('kondisi', 'rusak_berat')->sum('jumlah_total');
        $hilang = InventarisItem::where('kondisi', 'hilang')->sum('jumlah_total');

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Unit',
                    'data' => [$baik, $rusakRingan, $rusakBerat, $hilang],
                    'backgroundColor' => [
                        '#10B981', // Emerald (Baik)
                        '#F59E0B', // Amber (Rusak Ringan)
                        '#EF4444', // Red (Rusak Berat)
                        '#6B7280', // Gray (Hilang)
                    ],
                ],
            ],
            'labels' => ['Kondisi Baik', 'Rusak Ringan', 'Rusak Berat', 'Hilang'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
