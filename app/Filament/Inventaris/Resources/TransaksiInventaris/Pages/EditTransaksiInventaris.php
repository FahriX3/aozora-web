<?php

namespace App\Filament\Inventaris\Resources\TransaksiInventaris\Pages;

use App\Filament\Inventaris\Resources\TransaksiInventaris\TransaksiInventarisResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTransaksiInventaris extends EditRecord
{
    protected static string $resource = TransaksiInventarisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
