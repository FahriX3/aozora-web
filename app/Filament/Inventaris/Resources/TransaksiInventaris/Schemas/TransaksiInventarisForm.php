<?php

namespace App\Filament\Inventaris\Resources\TransaksiInventaris\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransaksiInventarisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pencatatan Mutasi Barang')
                    ->description('Catat barang masuk, pengembalian, peminjaman, atau pengeluaran logistik')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('inventaris_item_id')
                                ->label('Barang Inventaris')
                                ->relationship('inventarisItem', 'nama_barang')
                                ->required()
                                ->searchable()
                                ->preload(),
                            Select::make('tipe')
                                ->label('Jenis Mutasi')
                                ->options([
                                    'keluar' => '📤 Keluar / Dipinjam',
                                    'masuk' => '📥 Masuk / Kembali / Tambah Stok',
                                ])
                                ->required(),
                        ]),
                        Grid::make(3)->schema([
                            TextInput::make('jumlah')
                                ->label('Jumlah Unit')
                                ->numeric()
                                ->minValue(1)
                                ->default(1)
                                ->required(),
                            Select::make('user_id')
                                ->label('Peminjam / Penanggung Jawab')
                                ->relationship('user', 'name')
                                ->default(fn () => auth()->id())
                                ->required()
                                ->searchable()
                                ->preload(),
                            DatePicker::make('tanggal')
                                ->label('Tanggal Transaksi')
                                ->default(now())
                                ->required(),
                        ]),
                        Textarea::make('keterangan')
                            ->label('Keperluan / Catatan Transaksi')
                            ->placeholder('Contoh: Dipinjam untuk latihan tari Yosakoi persiapan Bunkasai 2026...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
