<?php

namespace App\Filament\Pages;

use App\Models\Event;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class FeaturedEvent extends Page
{
    protected string $view = 'filament.pages.featured-event';

    protected static ?string $navigationLabel = 'Event Unggulan';

    protected static ?string $title = 'Event Unggulan & Aftermovie';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static ?int $navigationSort = 2;

    public ?int $event_id = null;

    public ?string $youtube_link = null;

    public function mount(): void
    {
        $current = Event::where('is_aftermovie', true)->first() 
            ?? Event::where('is_featured', true)->first();

        if ($current) {
            $this->event_id = $current->id;
            $this->youtube_link = $current->youtube_link;
        }
    }

    public function save(): void
    {
        $this->validate([
            'event_id' => 'required|exists:events,id',
            'youtube_link' => 'required|url',
        ], [
            'event_id.required' => 'Pilih salah satu event terlebih dahulu.',
            'event_id.exists' => 'Event yang dipilih tidak valid.',
            'youtube_link.required' => 'Link YouTube video wajib diisi.',
            'youtube_link.url' => 'Format URL YouTube tidak valid. Contoh: https://www.youtube.com/watch?v=... atau https://youtu.be/...',
        ]);

        // Reset semua event lain
        Event::query()->update([
            'is_aftermovie' => false,
            'is_featured' => false,
        ]);

        // Aktifkan event yang dipilih
        $event = Event::findOrFail($this->event_id);
        $event->update([
            'is_aftermovie' => true,
            'is_featured' => true,
            'youtube_link' => $this->youtube_link,
        ]);

        Notification::make()
            ->title('Event Unggulan Berhasil Diperbarui')
            ->body("Event '{$event->title}' sekarang menjadi Event Unggulan utama di beranda.")
            ->success()
            ->send();
    }

    public function getViewData(): array
    {
        return [
            'events' => Event::orderBy('event_date', 'desc')->get(),
            'currentFeatured' => Event::where('is_aftermovie', true)->first() 
                ?? Event::where('is_featured', true)->first(),
        ];
    }
}
