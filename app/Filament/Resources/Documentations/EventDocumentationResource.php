<?php

namespace App\Filament\Resources\Documentations;

use App\Filament\Resources\Documentations\Pages\CreateEventDocumentation;
use App\Filament\Resources\Documentations\Pages\EditEventDocumentation;
use App\Filament\Resources\Documentations\Pages\ListEventDocumentations;
use App\Models\EventDocumentation;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class EventDocumentationResource extends Resource
{
    protected static ?string $model = EventDocumentation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCamera;

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Konten';

    protected static ?string $navigationLabel = 'Galeri & Dokumentasi';

    protected static ?string $modelLabel = 'Dokumentasi';

    protected static ?string $pluralModelLabel = 'Galeri & Dokumentasi';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'caption';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Dokumentasi Event')
                    ->description('Pilih event terkait dan upload file foto/video kegiatan.')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('event_id')
                                ->label('Event Terkait')
                                ->relationship('event', 'title')
                                ->searchable()
                                ->preload()
                                ->required(),
                            Select::make('file_type')
                                ->label('Tipe Media')
                                ->options([
                                    'image' => 'Foto (Gambar)',
                                    'video' => 'Video / Aftermovie',
                                ])
                                ->default('image')
                                ->required(),
                        ]),
                        TextInput::make('caption')
                            ->label('Keterangan / Caption Foto')
                            ->placeholder('Contoh: Suasana Panggung Utama, Stand Kuliner, Cosplay Parade')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        FileUpload::make('file_path')
                            ->label('File Foto / Media')
                            ->image()
                            ->disk('public')
                            ->directory('event-documentations')
                            ->visibility('public')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('file_path')
                    ->label('Preview')
                    ->disk('public')
                    ->square()
                    ->size(60),
                TextColumn::make('event.title')
                    ->label('Nama Event')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->event?->event_date ? date('d M Y', strtotime($record->event->event_date)) : null),
                TextColumn::make('caption')
                    ->label('Keterangan / Caption')
                    ->searchable()
                    ->default('-'),
                TextColumn::make('file_type')
                    ->label('Tipe Media')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'image' => 'info',
                        'video' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Diupload')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('event_id')
                    ->label('Filter Berdasarkan Event')
                    ->relationship('event', 'title')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEventDocumentations::route('/'),
            'create' => CreateEventDocumentation::route('/create'),
            'edit' => EditEventDocumentation::route('/{record}/edit'),
        ];
    }
}
