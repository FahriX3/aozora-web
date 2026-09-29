<?php

namespace App\Filament\Inventaris\Resources\Loans\Pages;

use App\Filament\Inventaris\Resources\Loans\LoanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLoan extends EditRecord
{
    protected static string $resource = LoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
