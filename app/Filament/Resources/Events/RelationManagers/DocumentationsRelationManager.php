<?php

namespace App\Filament\Resources\Events\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentationsRelationManager extends RelationManager
{
    protected static string $relationship = 'documentations';

    protected static ?string $title = 'Dokumentasi & Galeri Acara';

    protected static ?string $modelLabel = 'Dokumentasi';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('file_path')
                    ->label('File Foto / Media')
                    ->image()
                    ->disk('public')
                    ->directory('event-documentations')
                    ->visibility('public')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('caption')
                    ->label('Keterangan / Kategori Foto')
                    ->placeholder('Contoh: Suasana Pembukaan, Lomba Cosplay, Penyerahan Hadiah')
                    ->maxLength(255),
                Select::make('file_type')
                    ->label('Tipe Media')
                    ->options([
                        'image' => 'Foto (Gambar)',
                        'video' => 'Video / Aftermovie',
                    ])
                    ->default('image')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('caption')
            ->columns([
                ImageColumn::make('file_path')
                    ->label('Preview')
                    ->disk('public')
                    ->square()
                    ->size(60),
                TextColumn::make('caption')
                    ->label('Keterangan / Caption')
                    ->searchable()
                    ->default('-')
                    ->weight('medium'),
                TextColumn::make('file_type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'image' => 'info',
                        'video' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Waktu Upload')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('+ Upload Dokumentasi'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
