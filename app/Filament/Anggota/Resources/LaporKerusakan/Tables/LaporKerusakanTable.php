<?php

namespace App\Filament\Anggota\Resources\LaporKerusakan\Tables;

use App\Models\LaporanKerusakan;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LaporKerusakanTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Tanggal Lapor')
                    ->date('d M Y')
                    ->sortable(),
                ImageColumn::make('foto_bukti')
                    ->label('Bukti')
                    ->disk('public')
                    ->square(),
                TextColumn::make('inventarisItem.nama_barang')
                    ->label('Nama Barang')
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status Laporan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'danger',
                        'ditinjau' => 'warning',
                        'selesai' => 'success',
                        'ditolak' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => LaporanKerusakan::STATUS_OPTIONS[$state] ?? $state),
                TextColumn::make('deskripsi_kerusakan')
                    ->label('Keluhan Kerusakan')
                    ->limit(35),
                TextColumn::make('catatan_koordinator')
                    ->label('Balasan Koordinator')
                    ->placeholder('Belum ada respon')
                    ->limit(35),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options(LaporanKerusakan::STATUS_OPTIONS),
            ])
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
