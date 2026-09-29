<?php

namespace App\Filament\Anggota\Resources\DaftarInventaris\Tables;

use App\Models\InventarisItem;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DaftarInventarisTable
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
                TextColumn::make('jumlah_tersedia')
                    ->label('Unit Tersedia')
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger')
                    ->formatStateUsing(fn ($state) => $state > 0 ? "Tersedia: {$state} unit" : "Habis / Dipinjam")
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
                    ->label('Tempat Simpan')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('kategori')
                    ->label('Filter Kategori')
                    ->options(InventarisItem::KATEGORI_OPTIONS),
            ])
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
