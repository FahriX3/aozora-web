<?php

namespace App\Filament\Inventaris\Resources\Loans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LoansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('borrow_proof_image')
                    ->label('Bukti')
                    ->circular(),
                TextColumn::make('borrower_name')
                    ->label('Peminjam')
                    ->getStateUsing(fn ($record) => $record->borrower_type === 'internal' ? $record->user?->name : $record->external_borrower_name . ' (Eksternal)')
                    ->searchable(['external_borrower_name'])
                    ->sortable(),
                TextColumn::make('item.name')
                    ->label('Barang')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('Jml')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'borrowed' => 'warning',
                        'returned' => 'success',
                        'late' => 'danger',
                        'damaged' => 'danger',
                        'lost' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('borrow_date')
                    ->label('Tgl Pinjam')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('return_date')
                    ->label('Tgl Kembali')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'borrowed' => 'Sedang Dipinjam',
                        'returned' => 'Sudah Dikembalikan',
                        'late' => 'Terlambat',
                        'damaged' => 'Rusak',
                        'lost' => 'Hilang',
                    ])
                    ->label('Filter Status'),
            ])
            ->recordActions([
                // Read-only or just view
            ])
            ->toolbarActions([
                //
            ]);
    }
}
