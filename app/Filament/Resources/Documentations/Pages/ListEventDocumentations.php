<?php

namespace App\Filament\Resources\Documentations\Pages;

use App\Filament\Resources\Documentations\EventDocumentationResource;
use App\Models\EventDocumentation;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListEventDocumentations extends ListRecords
{
    protected static string $resource = EventDocumentationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('batch_upload')
                ->label('+ Upload Banyak (Drag & Drop)')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('primary')
                ->modalHeading('Upload Batch Dokumentasi Kegiatan')
                ->modalDescription('Pilih event, lalu tarik & lepas banyak foto atau video kegiatan sekaligus.')
                ->modalWidth('2xl')
                ->form([
                    Select::make('event_id')
                        ->label('Event Terkait')
                        ->relationship('event', 'title')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->columnSpanFull(),
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
                        ->placeholder('Contoh: Suasana Pembukaan, Penampilan Band, Cosplay')
                        ->helperText('Akan diterapkan ke seluruh file yang diunggah bersamaan jika diisi.')
                        ->maxLength(255)
                        ->columnSpanFull(),
                ])
                ->action(function (array $data): void {
                    $eventId = $data['event_id'];
                    $files = (array) ($data['files'] ?? []);
                    $count = 0;

                    foreach ($files as $filePath) {
                        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                        $isVideo = in_array($ext, ['mp4', 'mov', 'avi', 'mkv', 'webm']);

                        EventDocumentation::create([
                            'event_id' => $eventId,
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
        ];
    }
}
