<?php

namespace App\Filament\Inventaris\Resources\LaporanKerusakan\Pages;

use App\Filament\Inventaris\Resources\LaporanKerusakan\LaporanKerusakanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaporanKerusakan extends ListRecords
{
    protected static string $resource = LaporanKerusakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
