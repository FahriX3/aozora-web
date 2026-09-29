<?php

namespace App\Filament\Resources\Documentations\Pages;

use App\Filament\Resources\Documentations\EventDocumentationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEventDocumentations extends ListRecords
{
    protected static string $resource = EventDocumentationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Upload Dokumentasi'),
        ];
    }
}
