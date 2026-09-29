<?php

namespace App\Filament\Anggota\Resources\DaftarInventaris\Schemas;

use App\Models\InventarisItem;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DaftarInventarisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Barang')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('nama_barang')
                                ->label('Nama Barang')
                                ->disabled(),
                            TextInput::make('kode_barang')
                                ->label('Kode')
                                ->disabled(),
                        ]),
                        Select::make('kategori')
                            ->label('Kategori')
                            ->options(InventarisItem::KATEGORI_OPTIONS)
                            ->disabled(),
                        Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->disabled()
                            ->columnSpanFull(),
                    ]),

                Section::make('Ketersediaan')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('jumlah_tersedia')
                                ->label('Unit Tersedia')
                                ->disabled(),
                            Select::make('kondisi')
                                ->label('Kondisi')
                                ->options(InventarisItem::KONDISI_OPTIONS)
                                ->disabled(),
                            TextInput::make('lokasi_penyimpanan')
                                ->label('Lokasi Penyimpanan')
                                ->disabled(),
                        ]),
                        FileUpload::make('foto')
                            ->label('Foto Barang')
                            ->image()
                            ->disk('public')
                            ->disabled(),
                    ]),
            ]);
    }
}
