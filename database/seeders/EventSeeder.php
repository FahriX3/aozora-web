<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Illuminate\Support\Facades\File;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destPath = storage_path('app/public/events');
        
        if (!File::exists($destPath)) {
            File::makeDirectory($destPath, 0755, true);
        }

        $imageName = 'semple.jpg';
        $fallbackImage = public_path('assets/DSC02070.jpg');
        if (File::exists($fallbackImage) && !File::exists($destPath . '/' . $imageName)) {
            File::copy($fallbackImage, $destPath . '/' . $imageName);
        }

        $posterPath = File::exists($destPath . '/' . $imageName) ? 'events/' . $imageName : null;

        $completedEvent = Event::updateOrCreate(
            ['slug' => 'bunkasai-matsuri-2026'],
            [
                'title' => 'Bunkasai Matsuri SMKN 1: "Haru no Hikari"',
                'subtitle' => 'ANNUAL MATSURI',
                'description' => 'Pesta kebudayaan akbar dengan Maid & Butler Cafe kreasi siswa, parade Cosplay Walk, stan kuliner Takoyaki & Dorayaki, serta pertunjukan live band lagu anisong.',
                'event_date' => '2026-05-15',
                'start_time' => '08:00',
                'end_time' => '16:00',
                'location' => 'Aula Graha SMKN 1',
                'poster_path' => $posterPath,
                'status' => 'completed',
            ]
        );

        if ($completedEvent->documentations()->count() === 0 && $posterPath) {
            for ($i = 1; $i <= 4; $i++) {
                $completedEvent->documentations()->create([
                    'file_path' => $posterPath,
                    'file_type' => 'image',
                ]);
            }
        }

        Event::updateOrCreate(
            ['slug' => 'aozora-nihongo-speech-quiz-contest'],
            [
                'title' => 'Aozora Nihongo Speech & Quiz Contest',
                'subtitle' => 'TOURNAMENT & SPEECH',
                'description' => 'Uji ketangkasan berbicara bahasa Jepang di depan juri, disusul kuis cepat tanggap seputar kebudayaan pop Jepang dan geografi kepulauan Nippon.',
                'event_date' => '2026-11-20',
                'start_time' => '09:00',
                'end_time' => '14:00',
                'location' => 'Ruang Teater Mini',
                'poster_path' => $posterPath,
                'status' => 'upcoming',
            ]
        );
    }
}
