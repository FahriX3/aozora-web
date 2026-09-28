<?php

namespace App\Filament\Anggota\Resources\LaporKerusakan\Schemas;

use App\Models\LaporanKerusakan;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LaporKerusakanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Formulir Laporan Kerusakan Barang')
                    ->description('Laporkan barang yang mengalami kerusakan atau kendala saat kegiatan berlangsung')
                    ->schema([
                        Hidden::make('pelapor_user_id')
                            ->default(fn () => auth()->id()),
                        Select::make('inventaris_item_id')
                            ->label('Pilih Barang')
                            ->relationship('inventarisItem', 'nama_barang')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Textarea::make('deskripsi_kerusakan')
                            ->label('Detail Kerusakan / Kendala')
                            ->placeholder('Jelaskan secara rinci kondisi kerusakan, bagian mana yang rusak, dan bagaimana kejadiannya...')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),
                        FileUpload::make('foto_bukti')
                            ->label('Unggah Foto Bukti Kerusakan')
                            ->image()
                            ->directory('laporan_kerusakan')
                            ->disk('public')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ]),

                Section::make('Status Penanganan & Catatan Koordinator')
                    ->description('Informasi tindak lanjut dari Koordinator Inventaris')
                    ->visible(fn (?LaporanKerusakan $record) => $record !== null)
                    ->schema([
                        Select::make('status')
                            ->label('Status Laporan')
                            ->options(LaporanKerusakan::STATUS_OPTIONS)
                            ->disabled(),
                        Textarea::make('catatan_koordinator')
                            ->label('Tanggapan Koordinator')
                            ->disabled()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
