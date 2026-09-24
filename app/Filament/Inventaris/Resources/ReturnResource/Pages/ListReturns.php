<?php

namespace App\Filament\Inventaris\Resources\ReturnResource\Pages;

use App\Filament\Inventaris\Resources\ReturnResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReturns extends ListRecords
{
    protected static string $resource = ReturnResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
