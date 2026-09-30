<?php

namespace App\Filament\Inventaris\Resources\Items\Schemas;

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
                \Filament\Schemas\Components\Section::make('Detail Barang')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nama Barang')
                                ->required(),
                            TextInput::make('category')
                                ->label('Kategori Barang')
                                ->required(),
                        ]),
                        Textarea::make('description')
                            ->label('Deskripsi Lengkap')
                            ->columnSpanFull(),
                        \Filament\Schemas\Components\Grid::make(2)->schema([
                            TextInput::make('quantity')
                                ->label('Jumlah Stok')
                                ->required()
                                ->numeric()
                                ->default(1),
                            Select::make('condition')
                                ->label('Kondisi Barang')
                                ->options([
                                    'good' => 'Baik', 
                                    'broken' => 'Rusak',
                                ])
                                ->default('good')
                                ->required(),
                        ]),
                        FileUpload::make('image')
                            ->label('Foto Barang')
                            ->image()
                            ->imageEditor()
                            ->directory('items'),
                    ]),
            ]);
    }
}
