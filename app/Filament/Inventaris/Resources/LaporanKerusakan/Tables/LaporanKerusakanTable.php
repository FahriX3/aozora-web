<?php

namespace App\Filament\Inventaris\Resources\LaporanKerusakan\Tables;

use App\Models\LaporanKerusakan;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LaporanKerusakanTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Tanggal Lapor')
                    ->date('d M Y H:i')
                    ->sortable(),
                ImageColumn::make('foto_bukti')
                    ->label('Foto')
                    ->disk('public')
                    ->square(),
                TextColumn::make('inventarisItem.nama_barang')
                    ->label('Nama Barang')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pelapor.name')
                    ->label('Pelapor')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
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
                    ->label('Detail Kerusakan')
                    ->limit(40)
                    ->toggleable(),
                TextColumn::make('catatan_koordinator')
                    ->label('Respon Koordinator')
                    ->limit(40)
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Status Laporan')
                    ->options(LaporanKerusakan::STATUS_OPTIONS),
            ])
            ->recordActions([
                EditAction::make()->label('Tinjau / Respon'),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
