<?php

namespace App\Filament\Inventaris\Resources\InventarisItems\Pages;

use App\Filament\Inventaris\Resources\InventarisItems\InventarisItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInventarisItem extends CreateRecord
{
    protected static string $resource = InventarisItemResource::class;
}
