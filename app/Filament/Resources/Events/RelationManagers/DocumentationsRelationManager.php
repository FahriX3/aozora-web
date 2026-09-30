<?php

namespace App\Filament\Resources\Events\RelationManagers;

use App\Models\EventDocumentation;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
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
                    ->label('Tap atau drag file di sini')
                    ->helperText('Foto & video • Maks. ukuran per file: 50MB')
                    ->disk('public')
                    ->directory('event-documentations')
                    ->visibility('public')
                    ->maxSize(51200)
                    ->acceptedFileTypes(['image/*', 'video/*'])
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
                Action::make('batch_upload')
                    ->label('+ Upload Banyak (Drag & Drop)')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('primary')
                    ->modalHeading('Upload Batch Dokumentasi Kegiatan')
                    ->modalDescription('Pilih atau tarik & lepas beberapa foto/video sekaligus untuk kegiatan ini.')
                    ->modalWidth('2xl')
                    ->form([
                        FileUpload::make('files')
                            ->label('Tap atau drag file di sini')
                            ->helperText('Foto & video • Maks. ukuran per file: 50MB')
                            ->multiple()
                            ->reorderable()
                            ->disk('public')
                            ->directory('event-documentations')
                            ->visibility('public')
                            ->maxSize(51200)
                            ->acceptedFileTypes(['image/*', 'video/*'])
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('batch_caption')
                            ->label('Keterangan / Caption Bersama (Opsional)')
                            ->placeholder('Contoh: Suasana Lomba Matsuri, Stand Kuliner, Cosplay')
                            ->helperText('Jika diisi, keterangan ini akan diterapkan ke seluruh file yang diunggah.')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])
                    ->action(function (array $data, RelationManager $livewire): void {
                        $event = $livewire->getOwnerRecord();
                        $files = (array) ($data['files'] ?? []);
                        $count = 0;

                        foreach ($files as $filePath) {
                            $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                            $isVideo = in_array($ext, ['mp4', 'mov', 'avi', 'mkv', 'webm']);

                            $event->documentations()->create([
                                'file_path' => $filePath,
                                'file_type' => $isVideo ? 'video' : 'image',
                                'caption' => !empty($data['batch_caption']) ? $data['batch_caption'] : null,
                            ]);
                            $count++;
                        }

                        Notification::make()
                            ->title("Berhasil mengunggah {$count} dokumentasi!")
                            ->success()
                            ->send();
                    }),
                CreateAction::make()
                    ->label('+ Upload Tunggal'),
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

