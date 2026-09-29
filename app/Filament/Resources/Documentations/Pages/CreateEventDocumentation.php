<?php

namespace App\Filament\Resources\Documentations\Pages;

use App\Filament\Resources\Documentations\EventDocumentationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEventDocumentation extends CreateRecord
{
    protected static string $resource = EventDocumentationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
