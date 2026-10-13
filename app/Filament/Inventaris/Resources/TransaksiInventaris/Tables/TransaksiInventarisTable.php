<?php

namespace App\Filament\Inventaris\Resources\TransaksiInventaris\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TransaksiInventarisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('inventarisItem.nama_barang')
                    ->label('Nama Barang')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tipe')
                    ->label('Tipe Mutasi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'masuk' => 'success',
                        'keluar' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'masuk' => '📥 Masuk / Kembali',
                        'keluar' => '📤 Keluar / Dipinjam',
                        default => $state,
                    }),
                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->suffix(' unit')
                    ->alignCenter(),
                TextColumn::make('user.name')
                    ->label('Nama Peminjam / PIC')
                    ->searchable(),
                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(40)
                    ->toggleable(),
            ])
            ->defaultSort('tanggal', 'desc')
            ->filters([
                SelectFilter::make('tipe')
                    ->label('Filter Tipe')
                    ->options([
                        'keluar' => 'Keluar / Dipinjam',
                        'masuk' => 'Masuk / Kembali',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
