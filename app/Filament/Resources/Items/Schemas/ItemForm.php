<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('condition')
                    ->options(['good' => 'Good', 'broken' => 'Broken'])
                    ->default('good')
                    ->required(),
                FileUpload::make('image')
                    ->image(),
                TextInput::make('category'),
            ]);
    }
}
