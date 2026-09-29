<?php

namespace App\Filament\Inventaris\Resources\LaporanKerusakan\Pages;

use App\Filament\Inventaris\Resources\LaporanKerusakan\LaporanKerusakanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaporanKerusakan extends EditRecord
{
    protected static string $resource = LaporanKerusakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
