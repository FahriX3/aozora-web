<?php

namespace App\Filament\Anggota\Resources\LaporKerusakan\Pages;

use App\Filament\Anggota\Resources\LaporKerusakan\LaporKerusakanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaporKerusakan extends ListRecords
{
    protected static string $resource = LaporKerusakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('+ Ajukan Laporan Kerusakan'),
        ];
    }
}
