<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destPath = storage_path('app/public/events');

        if (! File::exists($destPath)) {
            File::makeDirectory($destPath, 0755, true);
        }

        $imageName = 'semple.jpg';
        $fallbackCandidates = [
            public_path('assets/events/'.$imageName),
            base_path('stitch_aozora_japanese_club_landing_page/'.$imageName),
            public_path('assets/DSC02070.jpg'),
        ];

        if (! File::exists($destPath.'/'.$imageName)) {
            foreach ($fallbackCandidates as $source) {
                if (File::exists($source)) {
                    File::copy($source, $destPath.'/'.$imageName);
                    break;
                }
            }
        }

        $posterPath = File::exists($destPath.'/'.$imageName) ? 'events/'.$imageName : null;

        // 1. Bunkasai Matsuri (Completed Event)
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
                'is_featured' => true,
                'is_aftermovie' => true,
                'youtube_link' => 'https://www.youtube.com/watch?v=TceXpTTdTHw',
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

        // 2. Speech & Quiz Contest (Upcoming)
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
                'is_featured' => true,
            ]
        );

        // 3. Workshop Shodo & Origami Tradisional (Upcoming)
        Event::updateOrCreate(
            ['slug' => 'workshop-shodo-origami-tradisional'],
            [
                'title' => 'Workshop Shodo (書道) & Seni Origami Tradisional',
                'subtitle' => 'TRADITIONAL WORKSHOP',
                'description' => 'Pelatihan menulis huruf Kanji menggunakan kuas fude dan tinta sumi tradisional, didampingi pembuatan karya origami 3D orisinal karya peserta.',
                'event_date' => '2026-11-28',
                'start_time' => '15:30',
                'end_time' => '17:15',
                'location' => 'Lab Bahasa 2 Smecone',
                'poster_path' => $posterPath,
                'status' => 'upcoming',
                'is_featured' => true,
            ]
        );

        // 4. Aozora Kaiwa Club & Cosplay Walk (Upcoming)
        Event::updateOrCreate(
            ['slug' => 'aozora-kaiwa-cosplay-walk'],
            [
                'title' => 'Aozora Kaiwa & Cosplay Showcase: "Natsu no Yume"',
                'subtitle' => 'COMMUNITY & SHOWCASE',
                'description' => 'Sesi latihan percakapan santai (Kaiwa) bersama native speaker, dilanjutkan parade kostum karakter anime favorit kreasi anggota divisi Perkap.',
                'event_date' => '2026-12-05',
                'start_time' => '13:00',
                'end_time' => '16:30',
                'location' => 'Area Teater Terbuka SMKN 1',
                'poster_path' => $posterPath,
                'status' => 'upcoming',
                'is_featured' => true,
            ]
        );

        // 5. JLPT Intensive Preparation Camp (Upcoming)
        Event::updateOrCreate(
            ['slug' => 'jlpt-intensive-preparation-camp'],
            [
                'title' => 'JLPT N5 & N4 Intensive Preparation Camp',
                'subtitle' => 'ACADEMIC & CERTIFICATION',
                'description' => 'Bimbingan belajar intensif tata bahasa, kanji, dan simulasi try-out ujian kemampuan bahasa Jepang (JLPT) bersama pemateri senior klub ANC.',
                'event_date' => '2026-12-15',
                'start_time' => '08:30',
                'end_time' => '12:00',
                'location' => 'Ruang Multimedia 1 Smecone',
                'poster_path' => $posterPath,
                'status' => 'upcoming',
                'is_featured' => true,
            ]
        );

        // 6. Japan Pop Culture Day & Anisong Acoustic (Upcoming)
        Event::updateOrCreate(
            ['slug' => 'japan-pop-culture-day-anisong'],
            [
                'title' => 'Japan Pop Culture Day: Anime Screening & Anisong Live',
                'subtitle' => 'MUSIC & POP CULTURE',
                'description' => 'Nonton bareng film animasi pilihan pemenang penghargaan, diiringi sesi live akustik lagu-lagu anime legendaris dari band akustik Aozora.',
                'event_date' => '2026-12-22',
                'start_time' => '14:00',
                'end_time' => '17:00',
                'location' => 'Aula Sasana Krida Smecone',
                'poster_path' => $posterPath,
                'status' => 'upcoming',
                'is_featured' => true,
            ]
        );
    }
}
