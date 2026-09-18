<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Copy the sample image to storage
        $sampleImageSrc = 'C:\Users\fahri\Desktop\Laravel\aozora-web\stitch_aozora_japanese_club_landing_page\semple.jpg';
        $destPath = storage_path('app/public/events');
        
        if (!File::exists($destPath)) {
            File::makeDirectory($destPath, 0755, true);
        }

        $imageName = 'semple.jpg';
        if (File::exists($sampleImageSrc)) {
            File::copy($sampleImageSrc, $destPath . '/' . $imageName);
        }

        $completedEvent = Event::create([
            'title' => 'Bunkasai Matsuri SMKN 1: "Haru no Hikari"',
            'slug' => 'bunkasai-matsuri-2026',
            'subtitle' => 'ANNUAL MATSURI',
            'description' => 'Pesta kebudayaan akbar dengan Maid & Butler Cafe kreasi siswa, parade Cosplay Walk, stan kuliner Takoyaki & Dorayaki, serta pertunjukan live band lagu anisong.',
            'event_date' => '2026-05-15',
            'start_time' => '08:00',
            'end_time' => '16:00',
            'location' => 'Aula Graha SMKN 1',
            'poster_path' => 'events/' . $imageName,
            'status' => 'completed',
        ]);

        for ($i = 1; $i <= 4; $i++) {
            $completedEvent->documentations()->create([
                'file_path' => 'events/' . $imageName,
                'file_type' => 'image',
            ]);
        }

        Event::create([
            'title' => 'Aozora Nihongo Speech & Quiz Contest',
            'slug' => 'aozora-nihongo-speech-quiz-contest',
            'subtitle' => 'TOURNAMENT & SPEECH',
            'description' => 'Uji ketangkasan berbicara bahasa Jepang di depan juri, disusul kuis cepat tanggap seputar kebudayaan pop Jepang dan geografi kepulauan Nippon.',
            'event_date' => '2026-11-20',
            'start_time' => '09:00',
            'end_time' => '14:00',
            'location' => 'Ruang Teater Mini',
            'poster_path' => 'events/' . $imageName,
            'status' => 'upcoming',
        ]);
    }
}
