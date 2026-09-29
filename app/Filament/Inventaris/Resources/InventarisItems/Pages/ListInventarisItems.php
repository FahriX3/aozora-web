<?php

namespace App\Filament\Inventaris\Resources\InventarisItems\Pages;

use App\Filament\Inventaris\Resources\InventarisItems\InventarisItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInventarisItems extends ListRecords
{
    protected static string $resource = InventarisItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
