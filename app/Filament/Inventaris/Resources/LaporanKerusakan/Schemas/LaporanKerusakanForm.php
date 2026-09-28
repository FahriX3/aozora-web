<?php

namespace App\Filament\Inventaris\Resources\LaporanKerusakan\Schemas;

use App\Models\LaporanKerusakan;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LaporanKerusakanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Laporan Kerusakan')
                    ->description('Rincian laporan barang yang mengalami kendala/kerusakan')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('inventaris_item_id')
                                ->label('Barang Yang Rusak')
                                ->relationship('inventarisItem', 'nama_barang')
                                ->required()
                                ->searchable()
                                ->preload(),
                            Select::make('pelapor_user_id')
                                ->label('Anggota Pelapor')
                                ->relationship('pelapor', 'name')
                                ->required()
                                ->searchable()
                                ->preload(),
                        ]),
                        Textarea::make('deskripsi_kerusakan')
                            ->label('Deskripsi Kerusakan')
                            ->rows(3)
                            ->required()
                            ->columnSpanFull(),
                        FileUpload::make('foto_bukti')
                            ->label('Foto Bukti Kerusakan')
                            ->image()
                            ->directory('laporan_kerusakan')
                            ->disk('public')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ]),

                Section::make('Tanggapan Koordinator & Status')
                    ->description('Tindakan verifikasi, perbaikan, dan penetapan status laporan')
                    ->schema([
                        Select::make('status')
                            ->label('Status Penanganan')
                            ->options(LaporanKerusakan::STATUS_OPTIONS)
                            ->default('pending')
                            ->required(),
                        Textarea::make('catatan_koordinator')
                            ->label('Catatan & Tindak Lanjut Koordinator')
                            ->placeholder('Contoh: Sudah diperbaiki dengan pengeleman ulang bilah bambu / Diajukan penggantian baru...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
