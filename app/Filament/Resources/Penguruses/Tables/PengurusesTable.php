<?php

namespace App\Filament\Resources\Penguruses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PengurusesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular(),
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->searchable(),
                TextColumn::make('divisi')
                    ->label('Divisi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pengurus Inti' => 'primary',
                        'Pemateri' => 'info',
                        'Kegiatan' => 'success',
                        'Budaya Bahasa' => 'danger',
                        'PDD' => 'warning',
                        'Mediakom' => 'purple',
                        'Perkap' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('kelas')
                    ->label('Kelas')
                    ->searchable(),
                TextColumn::make('urutan')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('urutan', 'asc')
            ->filters([
                SelectFilter::make('divisi')
                    ->label('Divisi')
                    ->options([
                        'Pengurus Inti' => 'Pengurus Inti',
                        'Pemateri' => 'Pemateri',
                        'Kegiatan' => 'Kegiatan',
                        'Budaya Bahasa' => 'Budaya Bahasa',
                        'PDD' => 'PDD',
                        'Mediakom' => 'Mediakom',
                        'Perkap' => 'Perkap',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
