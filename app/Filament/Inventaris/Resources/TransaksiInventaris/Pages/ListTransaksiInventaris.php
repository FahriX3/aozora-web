<?php

namespace App\Filament\Inventaris\Resources\TransaksiInventaris\Pages;

use App\Filament\Inventaris\Resources\TransaksiInventaris\TransaksiInventarisResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransaksiInventaris extends ListRecords
{
    protected static string $resource = TransaksiInventarisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
