<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

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
                                            ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                                        TextInput::make('slug')
                                            ->label('Slug URL')
                                            ->placeholder('bunkasai-matsuri-2026')
                                            ->required()
                                            ->unique('events', 'slug', ignoreRecord: true),
                                    ]),
                                    TextInput::make('subtitle')
                                        ->label('Subjudul / Kategori Acara')
                                        ->placeholder('Contoh: ANNUAL MATSURI, TOURNAMENT & SPEECH'),
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
                                        FileUpload::make('poster_path')
                                            ->label('Poster Event')
                                            ->image()
                                            ->directory('events')
                                            ->disk('public')
                                            ->visibility('public'),
                                    ]),
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
                                    TextInput::make('location')
                                        ->label('Nama Lokasi Acara')
                                        ->placeholder('Contoh: Aula Graha SMKN 1 Purwokerto')
                                        ->required(),
                                    Grid::make(2)->schema([
                                        TextInput::make('latitude')
                                            ->label('Latitude Koordinat')
                                            ->placeholder('-7.421578')
                                            ->default('-7.421578'),
                                        TextInput::make('longitude')
                                            ->label('Longitude Koordinat')
                                            ->placeholder('109.254045')
                                            ->default('109.254045'),
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
