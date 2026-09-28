<?php

namespace App\Filament\Inventaris\Resources\InventarisItems\Tables;

use App\Models\InventarisItem;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InventarisItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->square(),
                TextColumn::make('nama_barang')
                    ->label('Nama Barang')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (InventarisItem $record) => $record->kode_barang),
                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn ($state) => InventarisItem::KATEGORI_OPTIONS[$state] ?? $state),
                TextColumn::make('stok_info')
                    ->label('Stok (Tersedia / Total)')
                    ->state(fn (InventarisItem $record) => "{$record->jumlah_tersedia} / {$record->jumlah_total} unit")
                    ->badge()
                    ->color(fn (InventarisItem $record) => $record->jumlah_tersedia > 0 ? 'success' : 'danger')
                    ->alignCenter(),
                TextColumn::make('kondisi')
                    ->label('Kondisi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'baik' => 'success',
                        'rusak_ringan' => 'warning',
                        'rusak_berat' => 'danger',
                        'hilang' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => InventarisItem::KONDISI_OPTIONS[$state] ?? $state),
                TextColumn::make('lokasi_penyimpanan')
                    ->label('Lokasi')
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options(InventarisItem::KATEGORI_OPTIONS),
                SelectFilter::make('kondisi')
                    ->label('Kondisi')
                    ->options(InventarisItem::KONDISI_OPTIONS),
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
