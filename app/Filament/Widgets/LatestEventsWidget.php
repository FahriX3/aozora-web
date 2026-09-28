<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestEventsWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Event & Matsuri Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(Event::query()->latest('event_date')->limit(5))
            ->columns([
                ImageColumn::make('poster_path')
                    ->label('Poster')
                    ->disk('public')
                    ->square(),
                TextColumn::make('title')
                    ->label('Judul Event')
                    ->weight('bold')
                    ->description(fn (Event $record) => $record->subtitle),
                TextColumn::make('event_date')
                    ->label('Tanggal Pelaksanaan')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('location')
                    ->label('Lokasi'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'upcoming' => 'info',
                        'completed' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'upcoming' => 'Mendatang',
                        'completed' => 'Selesai',
                        default => $state,
                    }),
            ])
            ->paginated(false);
    }
}
