<?php

namespace App\Filament\Resources\Loans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LoansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('borrower_type')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Internal Borrower')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('external_borrower_name')
                    ->label('External Borrower')
                    ->searchable(),
                TextColumn::make('external_borrower_origin')
                    ->label('External Origin')
                    ->searchable(),
                TextColumn::make('item.name')
                    ->label('Item')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('borrow_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('return_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('condition_when_borrowed')
                    ->searchable(),
                TextColumn::make('condition_when_returned')
                    ->searchable(),
                ImageColumn::make('borrow_proof_image'),
                ImageColumn::make('return_proof_image'),
                TextColumn::make('recordedBy.name')
                    ->label('Borrow Recorded By')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('recorder_ip')
                    ->searchable(),
                TextColumn::make('recorder_location')
                    ->searchable(),
                TextColumn::make('returnRecordedBy.name')
                    ->label('Return Recorded By')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('return_recorder_ip')
                    ->searchable(),
                TextColumn::make('return_recorder_location')
                    ->searchable(),
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
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
