<?php

namespace App\Filament\Anggota\Resources\LaporKerusakan\Pages;

use App\Filament\Anggota\Resources\LaporKerusakan\LaporKerusakanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLaporKerusakan extends CreateRecord
{
    protected static string $resource = LaporKerusakanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['pelapor_user_id'] = auth()->id();
        $data['status'] = 'pending';

        return $data;
    }
}
