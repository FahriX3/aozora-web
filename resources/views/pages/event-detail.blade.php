@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
@endpush

@section('content')

            <div class="flex flex-col w-full">
                <!-- Subtle Anime/Culture Lattice Background Vector Layer -->
                <div class="relative w-full overflow-hidden">
                    <!-- Faint Ambient Aura -->
                    <div
                        class="absolute -top-24 right-1/4 w-96 h-96 bg-aozora-sky/15 rounded-full blur-3xl pointer-events-none"
                    ></div>
                    <div
                        class="absolute top-80 -left-20 w-80 h-80 bg-sakura-tint/60 rounded-full blur-3xl pointer-events-none"
                    ></div>
                    <div
                        class="absolute top-1/2 right-10 text-[260px] font-headline-lg font-extrabold text-indigo-night/[0.02] select-none pointer-events-none [writing-mode:vertical-rl]"
                    >
                        春光
                    </div>
                    <!-- Main Content Container -->
                    <div
                        class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin py-space-lg md:py-space-xl flex flex-col gap-space-xl"
                    >
                        <!-- Top Navigation & Breadcrumbs -->
                        <div
                            class="flex flex-wrap items-center justify-between gap-space-md"
                        >
                            <div
                                class="flex items-center gap-space-sm text-body-sm font-body-sm text-on-surface-variant"
                            >
                                <a
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-primary font-label-md text-label-md transition-all group"
                                    href="{{ route('events.index') }}"
                                >
                                    <span
                                        class="material-symbols-outlined text-base group-hover:-translate-x-0.5 transition-transform"
                                        >arrow_back</span
                                    >
                                    <span class="">Kembali ke Semua Event</span>
                                </a>
                                <span class="text-outline-variant">/</span>
                                <span
                                    class="hover:text-primary cursor-pointer transition-colors"
                                    >Event &amp; Matsuri</span
                                >
                                <span class="text-outline-variant">/</span>
                                <span
                                    class="text-on-surface font-semibold truncate max-w-[200px] md:max-w-none"
                                    >{{ $event->title }}</span
                                >
                            </div>
                            <div class="flex items-center gap-space-xs">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-torii-vermilion/10 text-torii-vermilion font-label-badge text-label-badge tracking-wider uppercase"
                                >
                                    <span
                                        class="w-2 h-2 rounded-full bg-torii-vermilion animate-pulse"
                                    ></span>
                                    ANNUAL MATSURI • ARSIP DOKUMENTASI LENGKAP
                                </span>
                                <span
                                    class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-badge text-label-badge"
                                >
                                    SMKN 1 PURWOKERTO
                                </span>
                            </div>
                        </div>
                        <!-- Hero Banner Card (Asymmetrical Japanese HUD Style) -->
                        <section
                            class="relative rounded-2xl bg-cloud-white p-space-md md:p-space-xl shadow-[0_4px_24px_-4px_rgba(13,89,242,0.08)] overflow-hidden"
                        >
                            <!-- Decorative Watermark Stamp -->
                            <div
                                class="absolute -right-8 -bottom-10 text-[180px] font-headline-lg font-extrabold text-primary/[0.03] select-none pointer-events-none"
                            >
                                光
                            </div>
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-aozora-sky/20 via-transparent to-transparent pointer-events-none"
                            ></div>
                            <div
                                class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-center relative z-10"
                            >
                                <!-- Text & Context (7 cols) -->
                                <div
                                    class="lg:col-span-7 flex flex-col gap-space-md"
                                >
                                    <div
                                        class="flex flex-wrap items-center gap-space-xs"
                                    >
                                        <span
                                            class="px-3 py-1 rounded-md bg-sakura-tint text-torii-vermilion font-label-badge text-label-badge"
                                        >
                                            🌸 {{ $event->title }}
                                        </span>
                                        <span
                                            class="px-3 py-1 rounded-md bg-secondary-fixed text-primary font-label-badge text-label-badge"
                                        >
                                            {{ $event->subtitle ?? "EVENT" }}
                                        </span>
                                        <span
                                            class="text-secondary font-label-md text-label-md"
                                            >Arsip Resmi Kegiatan Siswa</span
                                        >
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <h1
                                            class="font-headline-lg text-headline-lg text-indigo-night tracking-tight flex flex-wrap items-baseline gap-x-3"
                                        >
                                            <span class=""
                                                >Bunkasai Matsuri:</span
                                            >
                                            <span
                                                class="text-primary font-extrabold"
                                                >Haru no Hikari</span
                                            >
                                            <span
                                                class="font-headline-md text-headline-md text-torii-vermilion font-normal"
                                                >（春の光）</span
                                            >
                                        </h1>
                                        <p
                                            class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed"
                                        >
                                            Merayakan apresiasi budaya Jepang,
                                            karya kreatif origami &amp;
                                            kaligrafi, cosplay ramah siswa, dan
                                            persahabatan antarjurusan di bawah
                                            naungan langit biru SMKN 1
                                            Purwokerto.
                                        </p>
                                    </div>
                                    <!-- Metadata Pills Grid -->
                                    <div
                                        class="grid grid-cols-2 sm:grid-cols-3 gap-space-sm pt-space-xs"
                                    >
                                        <div
                                            class="p-space-sm rounded-xl bg-surface-container-low flex flex-col"
                                        >
                                            <span
                                                class="font-label-md text-label-md text-secondary uppercase flex items-center gap-1"
                                            >
                                                <span
                                                    class="material-symbols-outlined text-sm text-primary"
                                                    >calendar_today</span
                                                >
                                                Pelaksanaan
                                            </span>
                                            <span
                                                class="font-headline-sm text-headline-sm text-on-surface mt-0.5"
                                                >{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</span
                                            >
                                            <span
                                                class="font-body-sm text-body-sm text-on-surface-variant"
                                                >08.00 - 16.00 WIB</span
                                            >
                                        </div>
                                        <div
                                            class="p-space-sm rounded-xl bg-surface-container-low flex flex-col"
                                        >
                                            <span
                                                class="font-label-md text-label-md text-secondary uppercase flex items-center gap-1"
                                            >
                                                <span
                                                    class="material-symbols-outlined text-sm text-torii-vermilion"
                                                    >location_on</span
                                                >
                                                Lokasi Acara
                                            </span>
                                            <span
                                                class="font-headline-sm text-headline-sm text-on-surface mt-0.5"
                                                >Graha SMKN 1</span
                                            >
                                            <span
                                                class="font-body-sm text-body-sm text-on-surface-variant"
                                                >Aula &amp; Selasar Timur</span
                                            >
                                        </div>
                                        <div
                                            class="col-span-2 sm:col-span-1 p-space-sm rounded-xl bg-surface-container-low flex flex-col"
                                        >
                                            <span
                                                class="font-label-md text-label-md text-secondary uppercase flex items-center gap-1"
                                                ><span
                                                    class="material-symbols-outlined text-sm text-gold-shrine"
                                                    >groups</span
                                                >Partisipasi Siswa</span
                                            ><span
                                                class="font-headline-sm text-headline-sm text-on-surface mt-0.5"
                                                >Anggota &amp; Guru</span
                                            ><span
                                                class="font-body-sm text-body-sm text-on-surface-variant"
                                                >Seluruh Angkatan Eskul</span
                                            >
                                        </div>
                                    </div>
                                    @if($event->status === 'completed')
                                    <!-- Action Hub Bar -->
                                    <div
                                        class="flex flex-wrap items-center gap-space-sm pt-space-xs"
                                    >
                                        <a
                                            class="inline-flex items-center gap-space-xs bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg px-space-lg py-space-sm rounded-lg shadow-[0_6px_20px_-2px_rgba(13,89,242,0.35)] transition-all transform hover:-translate-y-0.5"
                                            href="#dokumentasi-galeri"
                                        >
                                            <span
                                                class="material-symbols-outlined text-lg"
                                                >photo_library</span
                                            >
                                            <span class=""
                                                >Jelajahi Dokumentasi</span
                                            >
                                            <span
                                                class="font-label-badge text-label-badge opacity-75"
                                                >写真</span
                                            >
                                        </a>
                                    </div>
                                    @else
                                    <!-- Countdown HUD Card -->
                                    <div
                                        class="bg-indigo-night text-cloud-white p-space-md rounded-xl shadow-xl flex flex-col gap-space-sm mt-space-md"
                                    >
                                        <div
                                            class="flex items-center justify-between"
                                        >
                                            <div
                                                class="flex items-center gap-space-xs"
                                            >
                                                <span
                                                    class="material-symbols-outlined text-aozora-sky text-[20px]"
                                                    >timer</span
                                                >
                                                <span
                                                    class="font-label-md text-label-md text-aozora-sky tracking-wider uppercase"
                                                    >Hitung Mundur Menuju Pintu
                                                    Matsuri Dibuka</span
                                                >
                                            </div>
                                            <span
                                                class="font-label-badge text-label-badge bg-cloud-white/10 px-2 py-0.5 rounded text-cloud-white"
                                                >WIB (UTC+7)</span
                                            >
                                        </div>
                                        <div
                                            class="grid grid-cols-4 gap-space-sm text-center"
                                            id="countdown-timer"
                                        >
                                            <div
                                                class="bg-cloud-white/10 p-space-sm rounded-lg flex flex-col"
                                            >
                                                <span
                                                    class="font-display-hero text-[32px] md:text-[40px] font-extrabold text-cloud-white leading-none"
                                                    id="days"
                                                    >0</span
                                                >
                                                <span
                                                    class="font-label-badge text-label-badge text-surface-dim uppercase mt-1"
                                                    >Hari</span
                                                >
                                            </div>
                                            <div
                                                class="bg-cloud-white/10 p-space-sm rounded-lg flex flex-col"
                                            >
                                                <span
                                                    class="font-display-hero text-[32px] md:text-[40px] font-extrabold text-aozora-sky leading-none"
                                                    id="hours"
                                                    >00</span
                                                >
                                                <span
                                                    class="font-label-badge text-label-badge text-surface-dim uppercase mt-1"
                                                    >Jam</span
                                                >
                                            </div>
                                            <div
                                                class="bg-cloud-white/10 p-space-sm rounded-lg flex flex-col"
                                            >
                                                <span
                                                    class="font-display-hero text-[32px] md:text-[40px] font-extrabold text-cloud-white leading-none"
                                                    id="minutes"
                                                    >00</span
                                                >
                                                <span
                                                    class="font-label-badge text-label-badge text-surface-dim uppercase mt-1"
                                                    >Menit</span
                                                >
                                            </div>
                                            <div
                                                class="bg-cloud-white/10 p-space-sm rounded-lg flex flex-col"
                                            >
                                                <span
                                                    class="font-display-hero text-[32px] md:text-[40px] font-extrabold text-torii-vermilion leading-none"
                                                    id="seconds"
                                                    >00</span
                                                >
                                                <span
                                                    class="font-label-badge text-label-badge text-surface-dim uppercase mt-1"
                                                    >Detik</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <!-- Graphic Mascot Floating HUD Card (5 cols) -->
                                <div class="lg:col-span-5 relative">
                                    <div
                                        class="relative w-full rounded-2xl bg-gradient-to-tr from-surface-container to-surface-container-low p-3 shadow-[0_12px_32px_-4px_rgba(13,89,242,0.12)]"
                                    >
                                        <!-- Visual Hero Banner Image with Persona / Anime Visual Style -->
                                        <div
                                            class="relative w-full h-[320px] md:h-[360px] rounded-xl overflow-hidden bg-indigo-night"
                                        >
                                            @if($event->poster_path)
    <img src="{{ Storage::url($event->poster_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
@else
    <div class="w-full h-full flex items-center justify-center bg-surface-container"><span class="material-symbols-outlined text-4xl text-outline-variant">image</span></div>
@endif
                                            <!-- Inner Tag HUD -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-indigo-night/85 via-transparent to-black/20 flex flex-col justify-between p-space-md text-cloud-white"
                                            >
                                                <div
                                                    class="flex items-center justify-between"
                                                >
                                                    <span
                                                        class="px-2.5 py-1 rounded-full bg-cloud-white/20 backdrop-blur-md font-label-badge text-label-badge flex items-center gap-1"
                                                    >
                                                        <span
                                                            class="w-1.5 h-1.5 rounded-full bg-aozora-sky"
                                                        ></span>
                                                        SMKN 1 ARCHIVE NO.
                                                        2026-FEST
                                                    </span>
                                                    <span
                                                        class="px-2 py-0.5 rounded bg-torii-vermilion font-label-badge text-label-badge"
                                                        >LIVE HIT 100%</span
                                                    >
                                                </div>
                                                <div>
                                                    <span
                                                        class="text-aozora-sky font-label-badge text-label-badge tracking-widest uppercase"
                                                        >Aftermovie &amp; Photo
                                                        Vault</span
                                                    >
                                                    <h3
                                                        class="font-headline-sm text-headline-sm text-cloud-white"
                                                    >
                                                        Semarak Gelar Budaya
                                                        Purwokerto
                                                    </h3>
                                                    <p
                                                        class="font-body-sm text-body-sm text-surface-dim mt-0.5"
                                                    >
                                                        Diabadikan oleh Tim
                                                        Multimedia &amp;
                                                        Jurnalistik SMKN 1
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Floating Quick Stats Floating Chip -->
                                        <div
                                            class="absolute -bottom-4 -left-4 bg-cloud-white/95 backdrop-blur-md px-space-md py-space-sm rounded-xl shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1)] flex items-center gap-3"
                                        >
                                            <div
                                                class="w-10 h-10 rounded-lg bg-sakura-tint text-torii-vermilion flex items-center justify-center font-headline-sm text-headline-sm"
                                            >
                                                春
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-headline-sm text-headline-sm text-indigo-night leading-none"
                                                    >48 Foto &amp; 3 Video</span
                                                >
                                                <span
                                                    class="font-label-md text-label-md text-secondary"
                                                    >Terarsip Siap Unduh</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Section Navigation Tabs -->
                        <div
                            class="sticky top-20 z-30 bg-surface/90 backdrop-blur-md py-2 -mx-margin-mobile px-margin-mobile md:-mx-margin md:px-margin"
                        >
                            <div
                                class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar"
                                id="content-tabs"
                            >
                                @if($event->status === 'completed')
                                <button
                                    class="tab-btn px-space-md py-2 rounded-xl font-label-lg text-label-lg flex items-center gap-2 whitespace-nowrap shadow-sm transition-all bg-primary text-on-primary active"
                                    onclick="switchTab('tab-dokumentasi', this)"
                                >
                                    <span
                                        class="material-symbols-outlined text-lg"
                                        >movie_filter</span
                                    >
                                    <span class=""
                                        >Dokumentasi Foto &amp; Video
                                        (Utama)</span
                                    >
                                    <span
                                        class="px-2 py-0.5 rounded-full bg-cloud-white/20 font-label-badge text-label-badge"
                                        >48+</span
                                    >
                                </button>
                                @endif
                                <button
                                    class="tab-btn px-space-md py-2 rounded-xl font-label-lg text-label-lg flex items-center gap-2 whitespace-nowrap transition-all {{ $event->status === 'completed' ? 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high' : 'bg-primary text-on-primary active shadow-sm' }}"
                                    onclick="switchTab('tab-rundown', this)"
                                >
                                    <span
                                        class="material-symbols-outlined text-lg"
                                        >schedule</span
                                    ><span class=""
                                        >Rundown &amp; Aktivitas Eskul</span
                                    >
                                </button>

                                <button
                                    class="tab-btn px-space-md py-2 rounded-xl hover:bg-surface-container-high font-label-lg text-label-lg flex items-center gap-2 whitespace-nowrap transition-all bg-surface-container text-on-surface-variant"
                                    onclick="switchTab('tab-denah', this)"
                                >
                                    <span
                                        class="material-symbols-outlined text-lg"
                                        >map</span
                                    ><span class=""
                                        >Lokasi Lab &amp; Ruang Praktik</span
                                    >
                                </button>
                            </div>
                        </div>
                        
                        @if($event->status === 'completed')
                        <!-- TAB 1: DOKUMENTASI -->
                        <div class="tab-pane flex flex-col gap-space-2xl" id="tab-dokumentasi">
                            <!-- Featured Video Showcase (Aftermovie Player) -->
                            @if($event->is_aftermovie && $event->youtube_link)
                            <section class="flex flex-col gap-space-md" id="aftermovie-section">
                                <div class="relative w-full rounded-2xl bg-indigo-night shadow-[0_12px_36px_-6px_rgba(11,16,33,0.3)] overflow-hidden aspect-video">
                                    <iframe src="{{ str_replace('watch?v=', 'embed/', $event->youtube_link) }}" class="w-full h-full border-0" allowfullscreen></iframe>
                                </div>
                            </section>
                            @endif

                            <section class="flex flex-col gap-space-lg" id="dokumentasi-galeri">
                                <div>
                                    <div class="flex items-center gap-2 text-primary font-label-badge text-label-badge uppercase tracking-widest">
                                        <span class="material-symbols-outlined text-sm">collections</span>
                                        <span class="">Dokumentasi Lengkap {{ $event->title }}</span>
                                    </div>
                                    <h2 class="font-headline-lg text-headline-lg text-indigo-night">Galeri Sorotan Acara (写真)</h2>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-space-md" id="gallery-grid">
                                    @forelse($event->documentations as $doc)
                                        <div class="gallery-card group relative rounded-2xl bg-cloud-white overflow-hidden shadow-[0_4px_20px_-2px_rgba(13,89,242,0.06)] hover:shadow-[0_12px_32px_-4px_rgba(13,89,242,0.16)] transition-all flex flex-col">
                                            <div class="relative h-64 overflow-hidden bg-surface-container">
                                                @if($doc->file_type === 'video')
                                                    <video src="{{ Storage::url($doc->file_path) }}" class="w-full h-full object-cover"></video>
                                                    <div class="absolute inset-0 flex items-center justify-center bg-black/40"><span class="material-symbols-outlined text-cloud-white text-4xl">play_circle</span></div>
                                                @else
                                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ Storage::url($doc->file_path) }}"/>
                                                @endif
                                            </div>
                                            <div class="p-space-md flex flex-col gap-1.5">
                                                <h3 class="font-label-lg text-label-lg text-indigo-night font-bold truncate">File {{ $doc->file_type }}</h3>
                                                <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="text-primary hover:underline text-sm font-semibold flex items-center gap-1 mt-2">Buka/Unduh <span class="material-symbols-outlined text-[16px]">open_in_new</span></a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-span-full py-12 text-center text-secondary font-medium">Belum ada dokumentasi untuk event ini.</div>
                                    @endforelse
                                </div>
                            </section>
                        </div>
                        @endif

                        <!-- TAB 2: RUNDOWN & JADWAL -->
                        <div class="tab-pane {{ $event->status === 'completed' ? 'hidden' : '' }} flex flex-col gap-space-2xl" id="tab-rundown">
                            <section class="flex flex-col gap-space-lg">
                                <div>
                                    <h2 class="font-headline-lg text-headline-lg text-indigo-night">Jadwal & Rundown Acara</h2>
                                    <p class="font-body-md text-body-md text-on-surface-variant">Timeline aktivitas selama event berlangsung.</p>
                                </div>
                                
                                <div class="flex flex-col relative before:absolute before:top-0 before:bottom-0 before:left-6 before:w-0.5 before:bg-outline-variant/50">
                                    @forelse($event->rundowns as $index => $rundown)
                                    <div class="relative pl-16 py-space-sm group">
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-cloud-white border-4 border-primary shadow-sm z-10 group-hover:scale-125 transition-transform"></div>
                                        <div class="bg-surface-container-lowest p-space-md rounded-2xl border border-outline-variant shadow-sm flex flex-col sm:flex-row sm:items-center gap-space-md group-hover:border-primary/30 group-hover:shadow-md transition-all">
                                            <div class="flex flex-col min-w-[100px]">
                                                <span class="font-headline-md text-headline-md text-primary">{{ \Carbon\Carbon::parse($rundown->time)->format('H:i') }}</span>
                                                <span class="font-label-sm text-label-sm text-secondary">WIB</span>
                                            </div>
                                            <div class="w-full sm:w-px h-px sm:h-12 bg-outline-variant/50"></div>
                                            <div class="flex flex-col flex-1">
                                                <h3 class="font-headline-sm text-headline-sm text-indigo-night">{{ $rundown->title }}</h3>
                                                @if($rundown->description)
                                                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ $rundown->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        <div class="py-12 pl-16 text-secondary font-medium">Jadwal rundown belum tersedia.</div>
                                    @endforelse
                                </div>
                            </section>
                        </div>

                        <!-- TAB 3: DENAH LOKASI -->
                        <div class="tab-pane hidden flex flex-col gap-space-2xl" id="tab-denah">
                            <section class="flex flex-col gap-space-lg">
                                <div>
                                    <h2 class="font-headline-lg text-headline-lg text-indigo-night">Lokasi & Akses</h2>
                                    <p class="font-body-md text-body-md text-on-surface-variant">Informasi denah tempat dan petunjuk akses pengunjung.</p>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-md">
                                    <div class="lg:col-span-2 rounded-2xl overflow-hidden shadow-sm border border-outline-variant bg-surface-container aspect-video md:aspect-auto">
                                        @if($event->latitude && $event->longitude)
                                            <div id="publicMap" class="w-full h-full min-h-[400px] z-10"></div>
                                        @else
                                            <div class="w-full h-full min-h-[400px] flex items-center justify-center bg-surface-container-low text-secondary flex-col gap-2 z-10">
                                                <span class="material-symbols-outlined text-4xl">map</span>
                                                <p>Peta lokasi belum ditambahkan.</p>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex flex-col gap-space-md">
                                        <div class="bg-surface-container-lowest p-space-md rounded-2xl border border-outline-variant shadow-sm flex flex-col gap-3">
                                            <div class="flex items-center gap-2 text-primary font-bold">
                                                <span class="material-symbols-outlined">directions_walk</span>
                                                <h3 class="font-headline-sm">Petunjuk Akses Pengunjung</h3>
                                            </div>
                                            <p class="text-on-surface-variant whitespace-pre-wrap">{{ $event->visitor_access_instructions ?? 'Belum ada petunjuk akses.' }}</p>
                                        </div>

                                        <div class="bg-primary/5 p-space-md rounded-2xl border border-primary/20 shadow-sm flex flex-col gap-3">
                                            <div class="flex items-center gap-2 text-primary font-bold">
                                                <span class="material-symbols-outlined">support_agent</span>
                                                <h3 class="font-headline-sm">Bantuan Lokasi</h3>
                                            </div>
                                            <p class="text-on-surface-variant whitespace-pre-wrap">{{ $event->location_assistance ?? 'Belum ada informasi bantuan.' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                <!-- END MAIN CONTAINER -->
                <!-- Interactive Feedback Toast / Modal Scripts -->
                <script>
                    // Tab Switcher
                    function switchTab(tabId, element) {
                        document
                            .querySelectorAll(".tab-pane")
                            .forEach((el) => el.classList.add("hidden"));
                        document
                            .getElementById(tabId)
                            .classList.remove("hidden");

                        document.querySelectorAll(".tab-btn").forEach((btn) => {
                            btn.classList.remove(
                                "bg-primary",
                                "text-on-primary",
                                "active",
                            );
                            btn.classList.add(
                                "bg-surface-container",
                                "text-on-surface-variant",
                            );
                        });

                        element.classList.remove(
                            "bg-surface-container",
                            "text-on-surface-variant",
                        );
                        element.classList.add(
                            "bg-primary",
                            "text-on-primary",
                            "active",
                        );
                        
                        if (tabId === 'tab-denah' && typeof initPublicMap === 'function') {
                            setTimeout(() => {
                                initPublicMap();
                            }, 100);
                        }
                    }

                    // Gallery Category Filter
                    function filterGallery(category, btn) {
                        const cards =
                            document.querySelectorAll(".gallery-card");
                        const buttons = document.querySelectorAll(
                            ".gallery-filter-btn",
                        );

                        buttons.forEach((b) => {
                            b.classList.remove(
                                "bg-primary",
                                "text-on-primary",
                                "active",
                            );
                            b.classList.add(
                                "bg-surface-container",
                                "text-on-surface-variant",
                            );
                        });
                        btn.classList.remove(
                            "bg-surface-container",
                            "text-on-surface-variant",
                        );
                        btn.classList.add(
                            "bg-primary",
                            "text-on-primary",
                            "active",
                        );

                        cards.forEach((card) => {
                            if (
                                category === "all" ||
                                card.getAttribute("data-cat") === category
                            ) {
                                card.style.display = "flex";
                            } else {
                                card.style.display = "none";
                            }
                        });
                    }

                    // Simulated Video Play Action
                    function playVideoMock(container) {
                        const overlay = container.querySelector(
                            ".group-hover\\:scale-110",
                        );
                        if (overlay) {
                            overlay.classList.add("animate-spin");
                            setTimeout(() => {
                                overlay.classList.remove("animate-spin");
                                alert(
                                    "Memutar Video Official Aftermovie 4K Haru no Hikari SMKN 1 Purwokerto (Simulasi Mode Pemutar).",
                                );
                            }, 300);
                        }
                    }

                    // Download Archive Action
                    function downloadArchiveModal() {
                        alert(
                            "Tautan Google Drive resmi SMKN 1 Purwokerto dibuka: Mengarahkan ke arsip 180+ foto resolusi penuh (1.8 GB). Arigatou!",
                        );
                    }

                    // Upload User Photos Action
                    function uploadModal() {
                        alert(
                            "Formulir Unggah Dokumentasi Siswa: Silakan kirimkan foto hasil jepretan Anda ke tim kurasi Jurnalistik Aozora.",
                        );
                    }

                    @if($event->status !== 'completed' && $event->event_date && $event->start_time)
                    // Live Countdown logic
                    (function () {
                        const targetDate = new Date(
                            "{{ \Carbon\Carbon::parse($event->event_date . ' ' . $event->start_time)->format('M d, Y H:i:s') }} GMT+0700",
                        ).getTime();

                        function updateCountdown() {
                            const now = new Date().getTime();
                            const distance = targetDate - now;

                            if (distance > 0) {
                                const days = Math.floor(
                                    distance / (1000 * 60 * 60 * 24),
                                );
                                const hours = Math.floor(
                                    (distance % (1000 * 60 * 60 * 24)) /
                                        (1000 * 60 * 60),
                                );
                                const minutes = Math.floor(
                                    (distance % (1000 * 60 * 60)) / (1000 * 60),
                                );
                                const seconds = Math.floor(
                                    (distance % (1000 * 60)) / 1000,
                                );

                                const daysEl = document.getElementById("days");
                                const hoursEl = document.getElementById("hours");
                                const minutesEl =
                                    document.getElementById("minutes");
                                const secondsEl =
                                    document.getElementById("seconds");

                                if (daysEl) daysEl.innerText = days;
                                if (hoursEl)
                                    hoursEl.innerText =
                                        hours < 10 ? "0" + hours : hours;
                                if (minutesEl)
                                    minutesEl.innerText =
                                        minutes < 10 ? "0" + minutes : minutes;
                                if (secondsEl)
                                    secondsEl.innerText =
                                        seconds < 10 ? "0" + seconds : seconds;
                            } else {
                                // If the countdown is finished, we could theoretically reload the page
                                // so it changes to "completed" status.
                                document.getElementById('countdown-timer').innerHTML = '<div class="col-span-4 p-space-sm text-center text-cloud-white font-bold">Acara sedang berlangsung atau sudah selesai! Muat ulang halaman.</div>';
                            }
                        }

                        updateCountdown();
                        setInterval(updateCountdown, 1000);
                    })();
                    @endif
                </script>
                
                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
                <script>
                    @if($event->latitude && $event->longitude)
                    let mapInitialized = false;
                    let publicMap;
                    function initPublicMap() {
                        if(mapInitialized) {
                            publicMap.invalidateSize();
                            return;
                        }
                        publicMap = L.map('publicMap').setView([{{ $event->latitude }}, {{ $event->longitude }}], 16);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '© OpenStreetMap contributors'
                        }).addTo(publicMap);
                        
                        L.marker([{{ $event->latitude }}, {{ $event->longitude }}]).addTo(publicMap)
                            .bindPopup("<b>{{ $event->location }}</b><br>Lokasi Event").openPopup();
                            
                        mapInitialized = true;
                        setTimeout(() => {
                            publicMap.invalidateSize();
                        }, 100);
                    }
                    @endif
                </script>
            </div>
@endsection