<?php

namespace App\Filament\Inventaris\Resources\InventarisItems\Schemas;

use App\Models\InventarisItem;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class InventarisItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Barang')
                    ->description('Nama, kode registrasi, dan kategori klasifikasi barang klub')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('nama_barang')
                                ->label('Nama Barang / Perlengkapan')
                                ->placeholder('Contoh: Kimono Yukata Wanita (Pink Sakura)')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('kode_barang')
                                ->label('Kode Registrasi')
                                ->placeholder('Contoh: AOZ-CSP-001')
                                ->default(fn () => 'AOZ-' . strtoupper(Str::random(6)))
                                ->required()
                                ->unique('inventaris_items', 'kode_barang', ignoreRecord: true),
                        ]),
                        Select::make('kategori')
                            ->label('Kategori')
                            ->options(InventarisItem::KATEGORI_OPTIONS)
                            ->required()
                            ->searchable(),
                        Textarea::make('deskripsi')
                            ->label('Deskripsi & Kelengkapan')
                            ->placeholder('Tuliskan detail perlengkapan, ukuran, dan aksesoris yang menyertai barang ini...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Stok, Kondisi & Tempat Penyimpanan')
                    ->description('Manajemen jumlah unit fisik, status kondisi, dan lokasi simpan')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('jumlah_total')
                                ->label('Total Unit Dimiliki')
                                ->numeric()
                                ->minValue(0)
                                ->default(1)
                                ->required(),
                            TextInput::make('jumlah_tersedia')
                                ->label('Unit Tersedia (Ready)')
                                ->numeric()
                                ->minValue(0)
                                ->default(1)
                                ->required(),
                            Select::make('kondisi')
                                ->label('Status Kondisi')
                                ->options(InventarisItem::KONDISI_OPTIONS)
                                ->default('baik')
                                ->required(),
                        ]),
                        TextInput::make('lokasi_penyimpanan')
                            ->label('Lokasi Penyimpanan')
                            ->placeholder('Contoh: Lemari Kostum Aozora No. 1 / Rak Kaligrafi B2')
                            ->maxLength(255),
                        FileUpload::make('foto')
                            ->label('Foto Barang / Aset')
                            ->image()
                            ->directory('inventaris')
                            ->disk('public')
                            ->visibility('public')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1'),
                    ]),
            ]);
    }
}
