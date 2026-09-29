<?php

namespace App\Filament\Anggota\Resources\DaftarInventaris\Pages;

use App\Filament\Anggota\Resources\DaftarInventaris\DaftarInventarisResource;
use Filament\Resources\Pages\ListRecords;

class ListDaftarInventaris extends ListRecords
{
    protected static string $resource = DaftarInventarisResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
