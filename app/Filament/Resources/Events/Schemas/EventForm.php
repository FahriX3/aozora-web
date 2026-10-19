<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    // TAB 1: Info Dasar Event
                    Step::make('Info Dasar Event')
                        ->description('Judul, deskripsi, tanggal, status, dan poster acara')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Section::make('Identitas Event')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('title')
                                            ->label('Judul Event')
                                            ->placeholder('Contoh: Bunkasai Matsuri SMKN 1: "Haru no Hikari"')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                                        TextInput::make('slug')
                                            ->label('Slug URL')
                                            ->placeholder('bunkasai-matsuri-2026')
                                            ->required()
                                            ->unique('events', 'slug', ignoreRecord: true),
                                    ]),
                                    Grid::make(2)->schema([
                                        TextInput::make('subtitle')
                                            ->label('Subjudul / Kategori Acara')
                                            ->placeholder('Contoh: ANNUAL MATSURI, TOURNAMENT & SPEECH'),
                                        TextInput::make('participants_info')
                                            ->label('Target Peserta / Partisipasi Siswa')
                                            ->placeholder('Contoh: Anggota & Guru SMKN 1 / Terbuka untuk Umum')
                                            ->default('Anggota & Guru SMKN 1'),
                                    ]),
                                    Textarea::make('description')
                                        ->label('Deskripsi Lengkap Acara')
                                        ->rows(4)
                                        ->placeholder('Tuliskan rincian kegiatan, stan, dan hiburan yang akan diselenggarakan...')
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Waktu & Visual')
                                ->schema([
                                    Grid::make(3)->schema([
                                        DatePicker::make('event_date')
                                            ->label('Tanggal Pelaksanaan')
                                            ->required(),
                                        TimePicker::make('start_time')
                                            ->label('Waktu Mulai')
                                            ->seconds(false),
                                        TimePicker::make('end_time')
                                            ->label('Waktu Selesai')
                                            ->seconds(false),
                                    ]),
                                    Grid::make(2)->schema([
                                        Select::make('status')
                                            ->label('Status Event')
                                            ->options([
                                                'upcoming' => 'Upcoming (Mendatang)',
                                                'completed' => 'Completed (Selesai)',
                                            ])
                                            ->default('upcoming')
                                            ->required(),
                                        Toggle::make('is_featured')
                                            ->label('Jadikan Event Unggulan (Satuan)')
                                            ->helperText('Jika aktif, event ini akan selalu tampil di carousel beranda')
                                            ->default(false),
                                    ]),
                                    Grid::make(2)->schema([
                                        TextInput::make('youtube_link')
                                            ->label('Tautan Video YouTube (Aftermovie / Teaser)')
                                            ->placeholder('https://www.youtube.com/watch?v=...'),
                                        TextInput::make('gdrive_link')
                                            ->label('Tautan Google Drive Dokumentasi (Opsional)')
                                            ->placeholder('https://drive.google.com/drive/folders/...')
                                            ->url(),
                                    ]),
                                    FileUpload::make('poster_path')
                                        ->label('Poster Event')
                                        ->image()
                                        ->directory('events')
                                        ->disk('public')
                                        ->visibility('public'),
                                ]),
                        ]),

                    // TAB 2: Rundown Event
                    Step::make('Rundown Event')
                        ->description('Susunan jadwal dan aktivitas selama event berlangsung')
                        ->icon('heroicon-o-clock')
                        ->schema([
                            Section::make('Jadwal & Rundown Acara')
                                ->description('Daftar agenda kegiatan yang akan tampil di halaman detail event.')
                                ->schema([
                                    Repeater::make('rundowns')
                                        ->relationship('rundowns')
                                        ->schema([
                                            TimePicker::make('time')
                                                ->label('Waktu')
                                                ->seconds(false)
                                                ->required(),
                                            TextInput::make('title')
                                                ->label('Nama Aktivitas / Kegiatan')
                                                ->placeholder('Contoh: Registrasi Ulang & Open Gate')
                                                ->required(),
                                            TextInput::make('description')
                                                ->label('Keterangan (Opsional)')
                                                ->placeholder('Contoh: Pintu dibuka untuk umum dan tamu undangan'),
                                        ])
                                        ->columns(3)
                                        ->defaultItems(0)
                                        ->addActionLabel('+ Tambah Baris Rundown')
                                        ->reorderable()
                                        ->collapsible()
                                        ->cloneable(),
                                ]),
                        ]),

                    // TAB 3: Lokasi Event & Penanggung Jawab
                    Step::make('Lokasi & Akses')
                        ->description('Titik koordinat, petunjuk jalan, dan narahubung')
                        ->icon('heroicon-o-map-pin')
                        ->schema([
                            Section::make('Lokasi Utama Acara')
                                ->schema([
                                    Select::make('location_preset')
                                        ->label('Pilihan Cepat Spot SMKN 1 (Opsional)')
                                        ->placeholder('-- Pilih spot SMKN 1 untuk isi otomatis --')
                                        ->options([
                                            'graha' => 'Graha / Aula SMKN 1 Purwokerto',
                                            'lapangan' => 'Lapangan Utama SMKN 1 Purwokerto',
                                            'lab_komputer' => 'Lab Komputer & Multimedia SMKN 1 Purwokerto',
                                            'ruang_anc' => 'Ruang Ekstrakurikuler ANC (Kelas)',
                                            'selasar' => 'Selasar Gedung Timur SMKN 1 Purwokerto',
                                        ])
                                        ->dehydrated(false)
                                        ->live()
                                        ->afterStateUpdated(function ($state, Set $set) {
                                            $presets = [
                                                'graha' => [
                                                    'location' => 'SMK Negeri 1 Purwokerto',
                                                    'specific_location' => 'Gedung Aula Graha SMKN 1',
                                                    'latitude' => '-7.4214266',
                                                    'longitude' => '109.2543831',
                                                ],
                                                'lapangan' => [
                                                    'location' => 'SMK Negeri 1 Purwokerto',
                                                    'specific_location' => 'Lapangan Utama Upacara & Olahraga',
                                                    'latitude' => '-7.4215000',
                                                    'longitude' => '109.2544000',
                                                ],
                                                'lab_komputer' => [
                                                    'location' => 'SMK Negeri 1 Purwokerto',
                                                    'specific_location' => 'Lab Komputer & Multimedia Lantai 2',
                                                    'latitude' => '-7.4213500',
                                                    'longitude' => '109.2543000',
                                                ],
                                                'ruang_anc' => [
                                                    'location' => 'SMK Negeri 1 Purwokerto',
                                                    'specific_location' => 'Ruang Eskul Aozora Nihongo Club',
                                                    'latitude' => '-7.4214500',
                                                    'longitude' => '109.2544500',
                                                ],
                                                'selasar' => [
                                                    'location' => 'SMK Negeri 1 Purwokerto',
                                                    'specific_location' => 'Selasar Gedung Timur SMKN 1',
                                                    'latitude' => '-7.4214800',
                                                    'longitude' => '109.2545000',
                                                ],
                                            ];

                                            if (isset($presets[$state])) {
                                                $set('location', $presets[$state]['location']);
                                                $set('specific_location', $presets[$state]['specific_location']);
                                                $set('latitude', $presets[$state]['latitude']);
                                                $set('longitude', $presets[$state]['longitude']);
                                            }
                                        }),
                                    Grid::make(2)->schema([
                                        TextInput::make('location')
                                            ->label('Nama / Alamat Lokasi Acara')
                                            ->placeholder('Contoh: SMK Negeri 1 Purwokerto atau Gedung Soetedja')
                                            ->required()
                                            ->helperText('Ketik nama tempat lalu klik ikon kaca pembesar untuk cari koordinat otomatis via OpenStreetMap.')
                                            ->suffixAction(
                                                Action::make('searchLocation')
                                                    ->icon('heroicon-m-magnifying-glass')
                                                    ->tooltip('Cari titik koordinat di OpenStreetMap (Gratis)')
                                                    ->action(function ($state, Set $set) {
                                                        if (blank($state)) {
                                                            Notification::make()
                                                                ->title('Alamat masih kosong')
                                                                ->body('Silakan ketik nama lokasi terlebih dahulu.')
                                                                ->warning()
                                                                ->send();
                                                            return;
                                                        }
                                                        try {
                                                            $response = Http::withHeaders([
                                                                'User-Agent' => 'AozoraWeb/1.0 (smkn1purwokerto)'
                                                            ])->timeout(8)->get('https://nominatim.openstreetmap.org/search', [
                                                                'q' => $state,
                                                                'format' => 'json',
                                                                'limit' => 1,
                                                            ]);
                                                            $data = $response->json();
                                                            if ($response->successful() && !empty($data) && isset($data[0]['lat'], $data[0]['lon'])) {
                                                                $set('latitude', (string) $data[0]['lat']);
                                                                $set('longitude', (string) $data[0]['lon']);
                                                                Notification::make()
                                                                    ->title('Titik Lokasi Ditemukan!')
                                                                    ->body('Koordinat: ' . $data[0]['lat'] . ', ' . $data[0]['lon'])
                                                                    ->success()
                                                                    ->send();
                                                            } else {
                                                                Notification::make()
                                                                    ->title('Lokasi Tidak Ditemukan')
                                                                    ->body('Coba gunakan nama resmi seperti "SMK Negeri 1 Purwokerto" atau nama jalan & kota.')
                                                                    ->warning()
                                                                    ->send();
                                                            }
                                                        } catch (\Throwable $e) {
                                                            Notification::make()
                                                                ->title('Gagal Mencari Lokasi')
                                                                ->body($e->getMessage())
                                                                ->danger()
                                                                ->send();
                                                        }
                                                    })
                                            ),
                                        TextInput::make('specific_location')
                                            ->label('Detail Ruangan / Lokasi Spesifik')
                                            ->placeholder('Contoh: Aula Graha Lantai 2 / Lab Bahasa'),
                                    ]),
                                    Grid::make(2)->schema([
                                        TextInput::make('latitude')
                                            ->label('Latitude Koordinat')
                                            ->placeholder('-7.421578')
                                            ->default('-7.4214266'),
                                        TextInput::make('longitude')
                                            ->label('Longitude Koordinat')
                                            ->placeholder('109.254045')
                                            ->default('109.2543831'),
                                    ]),
                                ]),

                            Section::make('Akses & Penanggung Jawab (Narahubung)')
                                ->schema([
                                    Textarea::make('visitor_access_instructions')
                                        ->label('Petunjuk Akses Pengunjung')
                                        ->placeholder('Contoh: Masuk melalui gerbang utama SMKN 1, parkir kendaraan bermotor di area barat.')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                    Textarea::make('location_assistance')
                                        ->label('Bantuan Lokasi & Narahubung Penanggung Jawab')
                                        ->placeholder('Contoh: Jika butuh bantuan atau penjemputan, hubungi Panitia (WA: 0812-xxxx-xxxx / Meja Informasi di Lobby).')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ]),
                        ]),
                ])
                    ->skippable()
                    ->columnSpanFull(),
            ]);
    }
}
