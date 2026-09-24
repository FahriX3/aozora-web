<?php

namespace App\Filament\Resources\Loans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LoanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('borrower_type')
                    ->required()
                    ->default('internal'),
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('external_borrower_name'),
                TextInput::make('external_borrower_origin'),
                TextInput::make('item_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                DatePicker::make('borrow_date')
                    ->required(),
                DatePicker::make('return_date'),
                TextInput::make('status')
                    ->required()
                    ->default('borrowed'),
                TextInput::make('condition_when_borrowed')
                    ->required()
                    ->default('good'),
                TextInput::make('condition_when_returned'),
                FileUpload::make('borrow_proof_image')
                    ->image(),
                FileUpload::make('return_proof_image')
                    ->image(),
                TextInput::make('recorded_by_id')
                    ->numeric(),
                TextInput::make('recorder_ip'),
                TextInput::make('recorder_location'),
                TextInput::make('return_recorded_by_id')
                    ->numeric(),
                TextInput::make('return_recorder_ip'),
                TextInput::make('return_recorder_location'),
            ]);
    }
}
