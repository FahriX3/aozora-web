<?php

namespace App\Filament\Inventaris\Resources\InventarisItems\Pages;

use App\Filament\Inventaris\Resources\InventarisItems\InventarisItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInventarisItem extends EditRecord
{
    protected static string $resource = InventarisItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
