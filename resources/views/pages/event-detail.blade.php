@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    .gallery-item-hidden {
        display: none !important;
    }
</style>
@endpush

@section('content')

@php
    $totalPhotos = $event->documentations->where('file_type', 'image')->count();
    $totalVideos = $event->documentations->where('file_type', 'video')->count();
    $totalDocs = $event->documentations->count();
@endphp

<div class="flex flex-col w-full">
    <!-- Subtle Anime/Culture Lattice Background Vector Layer -->
    <div class="relative w-full overflow-x-clip">
        <!-- Faint Ambient Aura -->
        <div class="absolute -top-24 right-1/4 w-96 h-96 bg-aozora-sky/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-80 -left-20 w-80 h-80 bg-sakura-tint/60 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Main Content Container -->
        <div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin py-space-lg md:py-space-xl flex flex-col gap-space-xl">
            <!-- Top Navigation & Breadcrumbs -->
            <div class="flex flex-wrap items-center justify-between gap-space-md">
                <div class="flex items-center gap-space-sm text-body-sm font-body-sm text-on-surface-variant">
                    <a class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-primary font-label-md text-label-md transition-all group" href="{{ route('events.index') }}">
                        <span class="material-symbols-outlined text-base group-hover:-translate-x-0.5 transition-transform">arrow_back</span>
                        <span>Kembali ke Semua Event</span>
                    </a>
                    <span class="text-outline-variant">/</span>
                    <a href="{{ route('events.index') }}" class="hover:text-primary cursor-pointer transition-colors">Event &amp; Matsuri</a>
                    <span class="text-outline-variant">/</span>
                    <span class="text-on-surface font-semibold truncate max-w-[200px] md:max-w-none">{{ $event->title }}</span>
                </div>
                <div class="flex items-center gap-space-xs">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-torii-vermilion/10 text-torii-vermilion font-label-badge text-label-badge tracking-wider uppercase font-bold">
                        <span class="w-2 h-2 rounded-full bg-torii-vermilion animate-pulse"></span>
                        {{ strtoupper($event->subtitle ?? 'ARSIP DOKUMENTASI KEGIATAN') }}
                    </span>
                    <span class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-badge text-label-badge">
                        SMKN 1 PURWOKERTO
                    </span>
                </div>
            </div>

            <!-- Hero Banner Card -->
            <section class="relative rounded-2xl bg-cloud-white p-space-md md:p-space-xl shadow-[0_4px_24px_-4px_rgba(13,89,242,0.08)] overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-aozora-sky/20 via-transparent to-transparent pointer-events-none"></div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-center relative z-10">
                    <!-- Text & Context (7 cols) -->
                    <div class="lg:col-span-7 flex flex-col gap-space-md">
                        <div class="flex flex-wrap items-center gap-space-xs">
                            <span class="px-3 py-1 rounded-md bg-sakura-tint text-torii-vermilion font-label-badge text-label-badge font-bold">
                                {{ $event->subtitle ?? 'EVENT' }}
                            </span>
                            <span class="px-3 py-1 rounded-md {{ $event->status === 'completed' ? 'bg-secondary-fixed text-primary' : 'bg-gold-shrine/15 text-gold-shrine' }} font-label-badge text-label-badge font-bold">
                                {{ $event->status === 'completed' ? 'Selesai (Arsip)' : 'Segera Hadir' }}
                            </span>
                            <span class="text-secondary font-label-md text-label-md">
                                Arsip Resmi Kegiatan Siswa
                            </span>
                        </div>

                        <div class="flex flex-col gap-2">
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-indigo-night tracking-tight leading-tight">
                                {{ $event->title }}
                            </h1>
                            <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed whitespace-pre-line">
                                {{ $event->description ?: 'Kegiatan resmi Aozora Nihongo Club SMK Negeri 1 Purwokerto.' }}
                            </p>
                        </div>

                        <!-- Metadata Pills Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 sm:gap-space-sm pt-space-xs">
                            <!-- Pelaksanaan -->
                            <div class="p-space-sm rounded-xl bg-surface-container-low flex flex-col">
                                <span class="font-label-md text-label-md text-secondary uppercase flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm text-primary">calendar_today</span>
                                    Pelaksanaan
                                </span>
                                <span class="font-headline-sm text-headline-sm text-on-surface mt-0.5 font-bold">
                                    {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') : 'Menyusul' }}
                                </span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">
                                    @if($event->start_time && $event->end_time)
                                        {{ \Carbon\Carbon::parse($event->start_time)->format('H.i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H.i') }} WIB
                                    @elseif($event->start_time)
                                        Mulai {{ \Carbon\Carbon::parse($event->start_time)->format('H.i') }} WIB
                                    @else
                                        Waktu Kegiatan
                                    @endif
                                </span>
                            </div>

                            <!-- Lokasi Acara -->
                            <div class="p-space-sm rounded-xl bg-surface-container-low flex flex-col">
                                <span class="font-label-md text-label-md text-secondary uppercase flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm text-torii-vermilion">location_on</span>
                                    Lokasi Acara
                                </span>
                                <span class="font-headline-sm text-headline-sm text-on-surface mt-0.5 font-bold truncate">
                                    {{ $event->location ?? 'SMK N 1 Purwokerto' }}
                                </span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant truncate">
                                    {{ $event->specific_location ?? 'Kampus SMKN 1' }}
                                </span>
                            </div>

                            <!-- Partisipasi Siswa -->
                            <div class="col-span-1 p-space-sm rounded-xl bg-surface-container-low flex flex-col">
                                <span class="font-label-md text-label-md text-secondary uppercase flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm text-gold-shrine">groups</span>
                                    Partisipasi
                                </span>
                                <span class="font-headline-sm text-headline-sm text-on-surface mt-0.5 font-bold truncate">
                                    {{ $event->participants_info ?? 'Anggota & Guru' }}
                                </span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">
                                    SMKN 1 Purwokerto
                                </span>
                            </div>
                        </div>

                        @if($event->status === 'completed')
                        <!-- Action Hub Bar -->
                        <div class="flex flex-wrap items-center gap-space-sm pt-space-xs">
                            <a class="inline-flex items-center gap-space-xs bg-primary hover:bg-primary/90 text-on-primary font-label-lg text-label-lg px-space-lg py-space-sm rounded-lg shadow-md transition-all transform hover:-translate-y-0.5" href="#dokumentasi-galeri">
                                <span class="material-symbols-outlined text-lg">photo_library</span>
                                <span>Jelajahi Dokumentasi</span>
                                <span class="font-label-badge text-label-badge opacity-80">写真</span>
                            </a>
                            @if($totalDocs > 0)
                            <a class="inline-flex items-center gap-1.5 bg-surface-container hover:bg-surface-container-high text-indigo-night font-label-lg text-label-lg px-4 py-space-sm rounded-lg border border-outline-variant transition-all" href="{{ route('event.download-zip', $event->slug) }}">
                                <span class="material-symbols-outlined text-lg text-primary">folder_zip</span>
                                <span>Unduh Arsip (.ZIP)</span>
                            </a>
                            @endif
                        </div>
                        @else
                        <!-- Countdown HUD Card -->
                        <div class="bg-indigo-night text-cloud-white p-space-md rounded-xl shadow-xl flex flex-col gap-space-sm mt-space-md">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-space-xs">
                                    <span class="material-symbols-outlined text-aozora-sky text-[20px]">timer</span>
                                    <span class="font-label-md text-label-md text-aozora-sky tracking-wider uppercase font-semibold">Hitung Mundur Menuju Pintu Matsuri Dibuka</span>
                                </div>
                                <span class="font-label-badge text-label-badge bg-cloud-white/10 px-2 py-0.5 rounded text-cloud-white">WIB (UTC+7)</span>
                            </div>
                            <div class="grid grid-cols-4 gap-space-sm text-center" id="countdown-timer">
                                <div class="bg-cloud-white/10 p-space-sm rounded-lg flex flex-col">
                                    <span class="font-display-hero text-[32px] md:text-[40px] font-extrabold text-cloud-white leading-none" id="days">0</span>
                                    <span class="font-label-badge text-label-badge text-surface-dim uppercase mt-1">Hari</span>
                                </div>
                                <div class="bg-cloud-white/10 p-space-sm rounded-lg flex flex-col">
                                    <span class="font-display-hero text-[32px] md:text-[40px] font-extrabold text-aozora-sky leading-none" id="hours">00</span>
                                    <span class="font-label-badge text-label-badge text-surface-dim uppercase mt-1">Jam</span>
                                </div>
                                <div class="bg-cloud-white/10 p-space-sm rounded-lg flex flex-col">
                                    <span class="font-display-hero text-[32px] md:text-[40px] font-extrabold text-cloud-white leading-none" id="minutes">00</span>
                                    <span class="font-label-badge text-label-badge text-surface-dim uppercase mt-1">Menit</span>
                                </div>
                                <div class="bg-cloud-white/10 p-space-sm rounded-lg flex flex-col">
                                    <span class="font-display-hero text-[32px] md:text-[40px] font-extrabold text-torii-vermilion leading-none" id="seconds">00</span>
                                    <span class="font-label-badge text-label-badge text-surface-dim uppercase mt-1">Detik</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Graphic Hero Media Card (5 cols) -->
                    <div class="lg:col-span-5 relative">
                        <div class="relative w-full rounded-2xl bg-gradient-to-tr from-surface-container to-surface-container-low p-3 shadow-[0_12px_32px_-4px_rgba(13,89,242,0.12)]">
                            <div class="relative w-full h-[220px] sm:h-[300px] md:h-[360px] rounded-xl overflow-hidden bg-indigo-night group {{ $event->display_image ? 'cursor-pointer' : '' }}"
                                 @if($event->display_image)
                                 onclick="openPosterModal('{{ $event->display_image }}', '{{ addslashes($event->title) }}')"
                                 title="Klik untuk melihat poster lebih besar"
                                 @endif>
                                @if($event->display_image)
                                    <img src="{{ $event->display_image }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute top-3 right-3 z-20 px-2.5 py-1 rounded-full bg-black/60 backdrop-blur-md text-white text-xs font-semibold flex items-center gap-1 opacity-90 group-hover:opacity-100 transition-opacity shadow-md pointer-events-none">
                                        <span class="material-symbols-outlined text-sm">zoom_in</span>
                                        <span>Perbesar</span>
                                    </div>
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-surface-container text-secondary gap-2">
                                        <span class="material-symbols-outlined text-5xl text-outline-variant">image</span>
                                        <span class="text-xs font-semibold">Poster Dokumentasi</span>
                                    </div>
                                @endif
                                <!-- Inner Tag HUD -->
                                <div class="absolute inset-0 bg-gradient-to-t from-indigo-night/90 via-transparent to-black/30 flex flex-col justify-between p-space-md text-cloud-white">
                                    <div class="flex items-center justify-between">
                                        <span class="px-2.5 py-1 rounded-full bg-cloud-white/20 backdrop-blur-md font-label-badge text-label-badge flex items-center gap-1 font-semibold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-aozora-sky"></span>
                                            SMKN 1 ARCHIVE NO. {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('Y') : date('Y') }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded {{ $event->status === 'completed' ? 'bg-torii-vermilion' : 'bg-gold-shrine text-indigo-night font-bold' }} font-label-badge text-label-badge">
                                            {{ $event->status === 'completed' ? 'TERLAKSANA' : 'MENDATANG' }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-aozora-sky font-label-badge text-label-badge tracking-widest uppercase font-bold">
                                            {{ $event->is_aftermovie ? 'Aftermovie & Video Vault' : 'Galeri Dokumentasi Resmi' }}
                                        </span>
                                        <h3 class="font-headline-sm text-headline-sm text-cloud-white line-clamp-2">
                                            {{ $event->title }}
                                        </h3>
                                        <p class="font-body-sm text-body-sm text-surface-dim mt-0.5">
                                            Diabadikan oleh Tim Multimedia &amp; Jurnalistik SMKN 1
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Floating Quick Stats Floating Chip -->
                            <div class="mt-3 sm:mt-0 sm:absolute sm:-bottom-4 sm:-left-4 bg-cloud-white/95 backdrop-blur-md px-3 sm:px-space-md py-2 sm:py-space-sm rounded-xl shadow-md sm:shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1)] flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-sakura-tint text-torii-vermilion flex items-center justify-center font-headline-sm text-headline-sm">
                                    <span class="material-symbols-outlined text-xl">collections</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-headline-sm text-headline-sm text-indigo-night leading-none font-bold">
                                        {{ $totalPhotos }} Foto @if($totalVideos > 0) & {{ $totalVideos }} Video @endif
                                    </span>
                                    <span class="font-label-md text-label-md text-secondary">
                                        Terarsip Siap Unduh
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section Navigation Tabs -->
            <div class="sticky top-20 z-30 bg-surface/90 backdrop-blur-md py-2 -mx-margin-mobile px-margin-mobile md:-mx-margin md:px-margin">
                <div class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar" id="content-tabs">
                    @if($event->status === 'completed')
                    <button class="tab-btn px-3 sm:px-space-md py-2 rounded-xl text-xs sm:text-label-lg font-label-lg flex items-center gap-2 whitespace-nowrap shadow-sm transition-all bg-primary text-on-primary active font-bold" onclick="switchTab('tab-dokumentasi', this)">
                        <span class="material-symbols-outlined text-lg">movie_filter</span>
                        <span>Dokumentasi Foto &amp; Video</span>
                        <span class="px-2 py-0.5 rounded-full bg-cloud-white/20 font-label-badge text-label-badge">{{ $totalDocs }}</span>
                    </button>
                    @endif

                    <button class="tab-btn px-3 sm:px-space-md py-2 rounded-xl text-xs sm:text-label-lg font-label-lg flex items-center gap-2 whitespace-nowrap transition-all {{ $event->status === 'completed' ? 'bg-surface-container text-on-surface-variant hover:bg-surface-container-high' : 'bg-primary text-on-primary active shadow-sm font-bold' }}" onclick="switchTab('tab-rundown', this)">
                        <span class="material-symbols-outlined text-lg">schedule</span>
                        <span>Rundown &amp; Aktivitas Eskul</span>
                        @if($event->rundowns->count() > 0)
                            <span class="px-2 py-0.5 rounded-full bg-surface-container-high font-label-badge text-label-badge text-secondary">{{ $event->rundowns->count() }}</span>
                        @endif
                    </button>

                    <button class="tab-btn px-3 sm:px-space-md py-2 rounded-xl hover:bg-surface-container-high text-xs sm:text-label-lg font-label-lg flex items-center gap-2 whitespace-nowrap transition-all bg-surface-container text-on-surface-variant" onclick="switchTab('tab-denah', this)">
                        <span class="material-symbols-outlined text-lg">map</span>
                        <span>Lokasi &amp; Akses Peta</span>
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
                    <!-- Gallery Top Header & Actions -->
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2 text-primary font-label-badge text-label-badge uppercase tracking-widest font-bold">
                                <span class="material-symbols-outlined text-sm">collections</span>
                                <span>Dokumentasi Lengkap {{ $event->title }}</span>
                            </div>
                            <h2 class="font-headline-lg text-2xl sm:text-3xl text-indigo-night font-bold">Galeri Sorotan Acara</h2>
                            <p class="text-sm text-on-surface-variant mt-1" id="gallery-status-text">
                                Menampilkan <span class="font-bold text-indigo-night" id="gallery-visible-count">0</span> dari {{ $totalDocs }} arsip dokumentasi
                            </p>
                        </div>

                        <!-- Action Buttons: Download ZIP & Google Drive -->
                        <div class="flex flex-wrap items-center gap-2">
                            @if($totalDocs > 0)
                            <a href="{{ route('event.download-zip', $event->slug) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-primary text-white font-bold text-sm shadow hover:bg-indigo-night transition-all">
                                <span class="material-symbols-outlined text-lg">download</span>
                                <span>Unduh Semua (.ZIP)</span>
                            </a>
                            @endif

                            @if($event->gdrive_link)
                            <a href="{{ $event->gdrive_link }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-surface-container hover:bg-surface-container-high text-indigo-night font-bold text-sm border border-outline-variant transition-all">
                                <span class="material-symbols-outlined text-lg text-primary">cloud</span>
                                <span>Google Drive</span>
                                <span class="material-symbols-outlined text-xs">open_in_new</span>
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- Gallery Type Filters -->
                    @if($totalDocs > 0)
                    <div class="flex items-center gap-2 border-b border-outline-variant/40 pb-3">
                        <button class="gallery-type-btn px-4 py-1.5 rounded-lg text-sm font-bold transition-all bg-primary text-white active cursor-pointer" onclick="filterGalleryType('all', this)">
                            Semua ({{ $totalDocs }})
                        </button>
                        <button class="gallery-type-btn px-4 py-1.5 rounded-lg text-sm font-semibold transition-all bg-surface-container text-on-surface-variant hover:bg-surface-container-high cursor-pointer" onclick="filterGalleryType('image', this)">
                            Foto ({{ $totalPhotos }})
                        </button>
                        @if($totalVideos > 0)
                        <button class="gallery-type-btn px-4 py-1.5 rounded-lg text-sm font-semibold transition-all bg-surface-container text-on-surface-variant hover:bg-surface-container-high cursor-pointer" onclick="filterGalleryType('video', this)">
                            Video ({{ $totalVideos }})
                        </button>
                        @endif
                    </div>
                    @endif

                    <!-- Gallery Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-space-md" id="gallery-grid">
                        @forelse($event->documentations as $index => $doc)
                            @php
                                $isExternal = \Illuminate\Support\Str::startsWith($doc->file_path, ['http://', 'https://']);
                                $fullHdUrl = $isExternal ? $doc->file_path : Storage::url($doc->file_path);
                                // COMPRESSED THUMBNAIL WHEN NOT IN FULL VIEW:
                                $thumbnailUrl = ($doc->file_type === 'image' && !$isExternal)
                                    ? route('event.thumbnail', $doc->id)
                                    : $fullHdUrl;
                            @endphp
                            <div class="gallery-card group relative rounded-2xl bg-cloud-white overflow-hidden shadow-[0_4px_20px_-2px_rgba(13,89,242,0.06)] hover:shadow-[0_12px_32px_-4px_rgba(13,89,242,0.16)] transition-all flex flex-col cursor-pointer {{ $index >= 12 ? 'gallery-item-hidden gallery-item-extra' : '' }}"
                                 data-type="{{ $doc->file_type }}"
                                 data-index="{{ $index }}"
                                 data-src="{{ $fullHdUrl }}"
                                 data-caption="{{ $doc->caption ?: ($doc->file_type === 'video' ? 'Video Dokumentasi' : 'Foto Dokumentasi ' . ($index + 1)) }}"
                                 onclick="openLightbox({{ $index }})">
                                <div class="relative h-48 sm:h-60 overflow-hidden bg-surface-container">
                                    @if($doc->file_type === 'video')
                                        <video src="{{ $fullHdUrl }}#t=0.5" class="w-full h-full object-cover" preload="metadata"></video>
                                        <div class="absolute inset-0 flex items-center justify-center bg-black/40 group-hover:bg-black/20 transition-colors">
                                            <span class="w-12 h-12 rounded-full bg-primary/90 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                                <span class="material-symbols-outlined text-2xl ml-0.5">play_arrow</span>
                                            </span>
                                        </div>
                                    @else
                                        <!-- Compressed optimized thumbnail loaded here! -->
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                             src="{{ $thumbnailUrl }}"
                                             alt="{{ $doc->caption ?: 'Dokumentasi' }}"
                                             loading="lazy"/>
                                    @endif
                                    <!-- Hover Badge -->
                                    <div class="absolute bottom-2 right-2 px-2.5 py-1 rounded-md bg-black/60 backdrop-blur-sm text-white text-xs font-semibold flex items-center gap-1 opacity-90 group-hover:opacity-100 transition-opacity">
                                        <span class="material-symbols-outlined text-xs">{{ $doc->file_type === 'video' ? 'videocam' : 'zoom_in' }}</span>
                                        <span>{{ $doc->file_type === 'video' ? 'Putar Video' : 'Lihat HD' }}</span>
                                    </div>
                                </div>
                                <div class="p-3 sm:p-space-md flex items-center justify-between gap-2">
                                    <h3 class="font-label-md text-label-md text-indigo-night font-bold truncate">
                                        {{ $doc->caption ?: ($doc->file_type === 'video' ? 'Video Kegiatan' : 'Foto #' . ($index + 1)) }}
                                    </h3>
                                    <span class="text-[11px] text-secondary font-semibold uppercase px-2 py-0.5 rounded bg-surface-container">
                                        {{ $doc->file_type }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-16 text-center text-secondary font-medium bg-cloud-white rounded-2xl border border-outline-variant/40 flex flex-col items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-4xl text-outline-variant">photo_library</span>
                                <p>Belum ada dokumentasi untuk event ini.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Load More & Show All Controls -->
                    @if($totalDocs > 12)
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-4" id="gallery-controls">
                        <button id="btn-load-more" onclick="loadMoreGallery(12)" class="px-6 py-2.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-indigo-night font-bold text-sm flex items-center gap-2 transition-all shadow-sm cursor-pointer">
                            <span class="material-symbols-outlined text-lg">expand_more</span>
                            <span>Tampilkan Lebih Banyak (+12)</span>
                        </button>
                        <button id="btn-show-all" onclick="showAllGallery()" class="px-6 py-2.5 rounded-xl bg-primary/10 hover:bg-primary/20 text-primary font-bold text-sm flex items-center gap-2 transition-all cursor-pointer">
                            <span class="material-symbols-outlined text-lg">grid_view</span>
                            <span>Tampilkan Semua ({{ $totalDocs }})</span>
                        </button>
                    </div>
                    @endif
                </section>
            </div>
            @endif

            <!-- TAB 2: RUNDOWN & JADWAL -->
            <div class="tab-pane {{ $event->status === 'completed' ? 'hidden' : '' }} flex flex-col gap-space-2xl" id="tab-rundown">
                <section class="flex flex-col gap-space-lg">
                    <div>
                        <h2 class="font-headline-lg text-2xl sm:text-3xl text-indigo-night font-bold">Jadwal &amp; Rundown Acara</h2>
                        <p class="font-body-md text-body-md text-on-surface-variant">Timeline aktivitas selama event berlangsung.</p>
                    </div>
                    
                    <div class="flex flex-col relative before:absolute before:top-0 before:bottom-0 before:left-3 sm:before:left-6 before:w-0.5 before:bg-outline-variant/50">
                        @forelse($event->rundowns as $index => $rundown)
                        <div class="relative pl-10 sm:pl-16 py-space-sm group">
                            <div class="absolute left-1.5 sm:left-4 top-1/2 -translate-y-1/2 w-3.5 sm:w-4 h-3.5 sm:h-4 rounded-full bg-cloud-white border-4 border-primary shadow-sm z-10 group-hover:scale-125 transition-transform"></div>
                            <div class="bg-surface-container-lowest p-space-md rounded-2xl border border-outline-variant shadow-sm flex flex-col sm:flex-row sm:items-center gap-space-md group-hover:border-primary/30 group-hover:shadow-md transition-all">
                                <div class="flex flex-col min-w-[100px]">
                                    <span class="font-headline-md text-headline-md text-primary font-bold">{{ \Carbon\Carbon::parse($rundown->time)->format('H:i') }}</span>
                                    <span class="font-label-sm text-label-sm text-secondary">WIB</span>
                                </div>
                                <div class="w-full sm:w-px h-px sm:h-12 bg-outline-variant/50"></div>
                                <div class="flex flex-col flex-1">
                                    <h3 class="font-headline-sm text-headline-sm text-indigo-night font-bold">{{ $rundown->title }}</h3>
                                    @if($rundown->description)
                                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ $rundown->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="py-12 pl-10 sm:pl-16 text-secondary font-medium">Jadwal rundown belum tersedia untuk kegiatan ini.</div>
                        @endforelse
                    </div>
                </section>
            </div>

            <!-- TAB 3: DENAH LOKASI & AKSES PETA -->
            <div class="tab-pane hidden flex flex-col gap-space-2xl" id="tab-denah">
                <section class="flex flex-col gap-space-lg">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <h2 class="font-headline-lg text-2xl sm:text-3xl text-indigo-night font-bold">Lokasi &amp; Akses Peta</h2>
                            <p class="font-body-md text-body-md text-on-surface-variant">Informasi peta tempat dan petunjuk akses pengunjung.</p>
                        </div>
                        
                        <!-- Open Google Maps Navigation Button -->
                        @php
                            $mapQuery = ($event->latitude && $event->longitude)
                                ? ($event->latitude . ',' . $event->longitude)
                                : urlencode(($event->location ?: 'SMK Negeri 1 Purwokerto') . ' Purwokerto');
                        @endphp
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $mapQuery }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white font-bold text-sm shadow hover:bg-indigo-night transition-all whitespace-nowrap self-start sm:self-auto">
                            <span class="material-symbols-outlined text-lg">directions</span>
                            <span>Buka di Google Maps (Rute)</span>
                            <span class="material-symbols-outlined text-xs">open_in_new</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-md">
                        <div class="lg:col-span-2 rounded-2xl overflow-hidden shadow-sm border border-outline-variant bg-surface-container aspect-video md:aspect-auto">
                            @if($event->latitude && $event->longitude)
                                <div id="publicMap" class="w-full h-full min-h-[400px] z-10"></div>
                            @else
                                <div class="w-full h-full min-h-[400px] flex items-center justify-center bg-surface-container-low text-secondary flex-col gap-2 z-10">
                                    <span class="material-symbols-outlined text-4xl">map</span>
                                    <p>Peta lokasi koordinat belum ditambahkan.</p>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex flex-col gap-space-md">
                            <!-- Info Ruangan & Lokasi -->
                            <div class="bg-surface-container-lowest p-space-md rounded-2xl border border-outline-variant shadow-sm flex flex-col gap-2">
                                <div class="flex items-center gap-2 text-primary font-bold">
                                    <span class="material-symbols-outlined">place</span>
                                    <h3 class="font-headline-sm font-bold">Detail Tempat</h3>
                                </div>
                                <div class="text-sm text-indigo-night font-bold">{{ $event->location ?? 'SMK Negeri 1 Purwokerto' }}</div>
                                @if($event->specific_location)
                                    <div class="text-xs text-secondary font-medium">{{ $event->specific_location }}</div>
                                @endif
                            </div>

                            <div class="bg-surface-container-lowest p-space-md rounded-2xl border border-outline-variant shadow-sm flex flex-col gap-3">
                                <div class="flex items-center gap-2 text-primary font-bold">
                                    <span class="material-symbols-outlined">directions_walk</span>
                                    <h3 class="font-headline-sm font-bold">Petunjuk Akses Pengunjung</h3>
                                </div>
                                <p class="text-on-surface-variant whitespace-pre-wrap text-sm leading-relaxed">{{ $event->visitor_access_instructions ?? 'Masuk melalui gerbang utama SMK Negeri 1 Purwokerto.' }}</p>
                            </div>

                            <div class="bg-primary/5 p-space-md rounded-2xl border border-primary/20 shadow-sm flex flex-col gap-3">
                                <div class="flex items-center gap-2 text-primary font-bold">
                                    <span class="material-symbols-outlined">support_agent</span>
                                    <h3 class="font-headline-sm font-bold">Bantuan Lokasi</h3>
                                </div>
                                <p class="text-on-surface-variant whitespace-pre-wrap text-sm leading-relaxed">{{ $event->location_assistance ?? 'Jika membutuhkan bantuan di lokasi, hubungi panitia Aozora atau meja informasi di aula utama.' }}</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
</div>

<!-- ======================================================================= -->
<!-- CUSTOM FULL-RESPONSIVE LIGHTBOX MODAL (SAFE FOR MOBILE HP & DESKTOP) -->
<!-- ======================================================================= -->
<div id="lightbox-modal"
     class="fixed inset-0 z-[99999] hidden opacity-0 transition-opacity duration-300 ease-out flex flex-col justify-between bg-black/95 backdrop-blur-xl select-none"
     role="dialog"
     aria-modal="true"
     style="touch-action: pan-y;">

    <!-- 1. TOP HEADER (Floating Frosted Glass Bar) -->
    <header class="w-full px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between text-white z-50 bg-gradient-to-b from-black/90 via-black/50 to-transparent">
        <div class="flex items-center gap-2 sm:gap-3 min-w-0">
            <span class="px-2.5 py-1 rounded-full bg-aozora-sky/20 border border-aozora-sky/40 text-aozora-sky text-xs font-bold tracking-wider uppercase whitespace-nowrap" id="lightbox-counter">
                Foto 1 / 1
            </span>
            <h4 id="lightbox-caption" class="text-xs sm:text-sm md:text-base font-semibold truncate text-white/90 max-w-[140px] sm:max-w-md">
                Caption
            </h4>
        </div>

        <div class="flex items-center gap-2 sm:gap-3 shrink-0">
            <span class="hidden sm:inline-flex items-center px-2 py-0.5 rounded text-[10px] font-extrabold bg-white/10 text-white/70 border border-white/20">
                HD
            </span>
            <a id="lightbox-download" href="#" target="_blank" download
               class="inline-flex items-center gap-1.5 px-3 py-1.5 sm:py-2 rounded-xl bg-white/10 hover:bg-white/25 active:scale-95 text-white text-xs sm:text-sm font-semibold transition-all border border-white/15 shadow-sm"
               title="Unduh File Asli">
                <span class="material-symbols-outlined text-base sm:text-lg">download</span>
                <span class="hidden sm:inline">Unduh HD</span>
            </a>

            <!-- DEDICATED PROMINENT CLOSE (X) BUTTON IN TOP RIGHT -->
            <button type="button"
                    onclick="closeLightbox()"
                    id="lightbox-close-btn"
                    class="w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/15 hover:bg-torii-vermilion active:bg-torii-vermilion text-white border border-white/30 hover:border-white/60 shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-105 active:scale-95 cursor-pointer ml-1 sm:ml-2"
                    aria-label="Tutup Pop-up (Esc)"
                    title="Tutup (Esc)">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </header>

    <!-- 2. MAIN MEDIA STAGE (Centered & Safe-Bounded) -->
    <main class="flex-1 relative flex items-center justify-center p-2 sm:p-6 overflow-hidden w-full h-full"
          id="lightbox-stage"
          onclick="handleBackdropClick(event)">

        <!-- Desktop Left Arrow -->
        <button onclick="prevLightbox(event)" id="lightbox-prev-btn"
                class="hidden sm:flex absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 w-12 h-12 lg:w-14 lg:h-14 rounded-full bg-black/40 hover:bg-primary/90 text-white items-center justify-center backdrop-blur-md border border-white/20 shadow-xl transition-all transform hover:scale-110 active:scale-95 z-20 cursor-pointer"
                title="Sebelumnya (←)">
            <span class="material-symbols-outlined text-3xl">chevron_left</span>
        </button>

        <!-- Media Container -->
        <div class="relative max-w-[96vw] sm:max-w-[85vw] max-h-[72vh] sm:max-h-[82vh] flex items-center justify-center" id="lightbox-content-box">
            <!-- Loading Indicator -->
            <div id="lightbox-spinner" class="absolute inset-0 flex items-center justify-center pointer-events-none hidden">
                <div class="w-10 h-10 border-4 border-white/20 border-t-primary rounded-full animate-spin"></div>
            </div>

            <img id="lightbox-img" src="" alt="Preview"
                 class="hidden max-h-[72vh] sm:max-h-[82vh] max-w-full object-contain rounded-xl shadow-2xl transition-all duration-300 transform scale-100 select-none"/>

            <video id="lightbox-video" src="" controls autoplay
                   class="hidden max-h-[72vh] sm:max-h-[82vh] max-w-full rounded-xl shadow-2xl bg-black border border-white/10"></video>
        </div>

        <!-- Desktop Right Arrow -->
        <button onclick="nextLightbox(event)" id="lightbox-next-btn"
                class="hidden sm:flex absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 w-12 h-12 lg:w-14 lg:h-14 rounded-full bg-black/40 hover:bg-primary/90 text-white items-center justify-center backdrop-blur-md border border-white/20 shadow-xl transition-all transform hover:scale-110 active:scale-95 z-20 cursor-pointer"
                title="Berikutnya (→)">
            <span class="material-symbols-outlined text-3xl">chevron_right</span>
        </button>
    </main>

    <!-- 3. MOBILE BOTTOM CONTROL DOCK (Thumb-Friendly on Phones) -->
    <footer class="sm:hidden w-full px-4 py-3 pb-6 flex items-center justify-between text-white z-30 bg-gradient-to-t from-black/90 via-black/50 to-transparent">
        <button onclick="prevLightbox(event)" class="px-3.5 py-2 rounded-xl bg-white/15 hover:bg-white/25 active:scale-95 flex items-center gap-1 text-xs font-bold transition-all border border-white/15">
            <span class="material-symbols-outlined text-base">chevron_left</span>
            <span>Sebelumnya</span>
        </button>

        <span class="text-xs text-white/60 font-medium">
            Geser ↔ untuk ganti
        </span>

        <button onclick="nextLightbox(event)" class="px-3.5 py-2 rounded-xl bg-primary hover:bg-primary/90 active:scale-95 flex items-center gap-1 text-xs font-bold transition-all shadow-md">
            <span>Berikutnya</span>
            <span class="material-symbols-outlined text-base">chevron_right</span>
        </button>
    </footer>
</div>

<!-- ============================================================== -->
<!-- JAVASCRIPT: TAB SWITCHER, COUNTDOWN, LIGHTBOX & LOAD MORE -->
<!-- ============================================================== -->
<script>
    // Tab Switcher
    function switchTab(tabId, element) {
        document.querySelectorAll(".tab-pane").forEach((el) => el.classList.add("hidden"));
        const target = document.getElementById(tabId);
        if (target) target.classList.remove("hidden");

        document.querySelectorAll(".tab-btn").forEach((btn) => {
            btn.classList.remove("bg-primary", "text-on-primary", "active", "font-bold");
            btn.classList.add("bg-surface-container", "text-on-surface-variant");
        });

        if (element) {
            element.classList.remove("bg-surface-container", "text-on-surface-variant");
            element.classList.add("bg-primary", "text-on-primary", "active", "font-bold");
        }

        if (tabId === 'tab-denah' && typeof initPublicMap === 'function') {
            setTimeout(() => {
                initPublicMap();
            }, 100);
        }
    }
    window.switchTab = switchTab;

    // ================= LIGHTBOX & GALLERY LOGIC =================
    let currentGalleryIndex = 0;
    let galleryItems = [];
    let currentFilterType = 'all';

    function initGalleryData() {
        galleryItems = [];
        const cards = document.querySelectorAll('.gallery-card');
        cards.forEach((card, index) => {
            const type = card.getAttribute('data-type') || 'image';
            const src = card.getAttribute('data-src') || '';
            const caption = card.getAttribute('data-caption') || (type === 'video' ? 'Video Dokumentasi' : 'Foto Dokumentasi ' + (index + 1));
            galleryItems.push({
                index: index,
                type: type,
                src: src,
                caption: caption,
                element: card
            });
        });
        updateVisibleCounter();
    }
    window.initGalleryData = initGalleryData;

    function updateVisibleCounter() {
        const visibleCards = document.querySelectorAll('.gallery-card:not(.gallery-item-hidden)');
        const counterEl = document.getElementById('gallery-visible-count');
        if (counterEl) {
            counterEl.innerText = visibleCards.length;
        }

        const loadMoreBtn = document.getElementById('btn-load-more');
        const showAllBtn = document.getElementById('btn-show-all');
        const hiddenInFilter = document.querySelectorAll('.gallery-card.gallery-item-extra.gallery-item-hidden');
        
        if (loadMoreBtn) {
            loadMoreBtn.style.display = hiddenInFilter.length > 0 ? 'inline-flex' : 'none';
        }
        if (showAllBtn) {
            showAllBtn.style.display = hiddenInFilter.length > 0 ? 'inline-flex' : 'none';
        }
    }
    window.updateVisibleCounter = updateVisibleCounter;

    function loadMoreGallery(count = 12) {
        const hiddenCards = document.querySelectorAll('.gallery-card.gallery-item-extra.gallery-item-hidden');
        let unhidden = 0;
        hiddenCards.forEach((card) => {
            if (unhidden < count) {
                if (currentFilterType === 'all' || card.getAttribute('data-type') === currentFilterType) {
                    card.classList.remove('gallery-item-hidden');
                    card.classList.remove('gallery-item-extra');
                    unhidden++;
                }
            }
        });
        updateVisibleCounter();
    }
    window.loadMoreGallery = loadMoreGallery;

    function showAllGallery() {
        const cards = document.querySelectorAll('.gallery-card');
        cards.forEach((card) => {
            if (currentFilterType === 'all' || card.getAttribute('data-type') === currentFilterType) {
                card.classList.remove('gallery-item-hidden');
                card.classList.remove('gallery-item-extra');
            }
        });
        updateVisibleCounter();
    }
    window.showAllGallery = showAllGallery;

    function filterGalleryType(type, button) {
        currentFilterType = type;

        // Button active state
        document.querySelectorAll('.gallery-type-btn').forEach(btn => {
            btn.classList.remove('bg-primary', 'text-white', 'active', 'font-bold');
            btn.classList.add('bg-surface-container', 'text-on-surface-variant');
        });
        if (button) {
            button.classList.remove('bg-surface-container', 'text-on-surface-variant');
            button.classList.add('bg-primary', 'text-white', 'active', 'font-bold');
        }

        let matchedCount = 0;
        document.querySelectorAll('.gallery-card').forEach((card, idx) => {
            const cardType = card.getAttribute('data-type');
            if (type === 'all' || cardType === type) {
                matchedCount++;
                if (matchedCount <= 12) {
                    card.classList.remove('gallery-item-hidden');
                    card.classList.remove('gallery-item-extra');
                } else {
                    card.classList.add('gallery-item-hidden');
                    card.classList.add('gallery-item-extra');
                }
            } else {
                card.classList.add('gallery-item-hidden');
            }
        });

        updateVisibleCounter();
    }
    window.filterGalleryType = filterGalleryType;

    // Lightbox Controls
    function openLightbox(index) {
        if (!galleryItems || galleryItems.length === 0) {
            initGalleryData();
        }

        let item = galleryItems[index];
        if (!item) {
            const cards = document.querySelectorAll('.gallery-card');
            const card = cards[index] || document.querySelector(`.gallery-card[data-index="${index}"]`);
            if (card) {
                item = {
                    index: index,
                    type: card.getAttribute('data-type') || 'image',
                    src: card.getAttribute('data-src'),
                    caption: card.getAttribute('data-caption') || 'Dokumentasi',
                    element: card
                };
            }
        }

        if (!item || !item.src) {
            console.warn('Lightbox: data tidak ditemukan untuk index', index);
            return;
        }

        currentGalleryIndex = index;

        const modal = document.getElementById('lightbox-modal');
        const img = document.getElementById('lightbox-img');
        const video = document.getElementById('lightbox-video');
        const caption = document.getElementById('lightbox-caption');
        const counter = document.getElementById('lightbox-counter');
        const download = document.getElementById('lightbox-download');
        const spinner = document.getElementById('lightbox-spinner');

        if (!modal) return;

        if (caption) caption.innerText = item.caption;
        if (counter) {
            const total = galleryItems.length > 0 ? galleryItems.length : document.querySelectorAll('.gallery-card').length;
            counter.innerText = (item.type === 'video' ? 'Video ' : 'Foto ') + (index + 1) + ' / ' + total;
        }
        if (download) download.href = item.src;

        if (item.type === 'video') {
            if (img) {
                img.classList.add('hidden');
                img.removeAttribute('src');
            }
            if (spinner) spinner.classList.add('hidden');
            if (video) {
                video.classList.remove('hidden');
                video.src = item.src;
                video.play().catch(() => {});
            }
        } else {
            if (video) {
                video.pause();
                video.removeAttribute('src');
                video.load();
                video.classList.add('hidden');
            }
            if (img) {
                img.classList.remove('hidden');
                if (spinner) spinner.classList.remove('hidden');
                img.onload = function() {
                    if (spinner) spinner.classList.add('hidden');
                };
                img.onerror = function() {
                    if (spinner) spinner.classList.add('hidden');
                };
                img.src = item.src;
                if (img.complete && spinner) {
                    spinner.classList.add('hidden');
                }
            }
        }

        modal.classList.remove('hidden');
        requestAnimationFrame(() => {
            modal.classList.remove('opacity-0');
        });
        document.body.classList.add('overflow-hidden');

        // Hide AI Sora Floating Widget while popup is open
        const soraWidget = document.getElementById('sora-chat-widget');
        if (soraWidget) {
            soraWidget.style.setProperty('display', 'none', 'important');
        }
    }
    window.openLightbox = openLightbox;

    // Single Media (e.g. Hero Poster)
    function openPosterModal(src, caption) {
        const modal = document.getElementById('lightbox-modal');
        const img = document.getElementById('lightbox-img');
        const video = document.getElementById('lightbox-video');
        const captionEl = document.getElementById('lightbox-caption');
        const counter = document.getElementById('lightbox-counter');
        const download = document.getElementById('lightbox-download');
        const spinner = document.getElementById('lightbox-spinner');

        if (!modal) return;
        if (captionEl) captionEl.innerText = caption || 'Poster Acara';
        if (counter) counter.innerText = 'Poster Event';
        if (download) download.href = src;

        if (video) {
            video.pause();
            video.removeAttribute('src');
            video.load();
            video.classList.add('hidden');
        }
        if (img) {
            img.classList.remove('hidden');
            if (spinner) spinner.classList.remove('hidden');
            img.onload = function() {
                if (spinner) spinner.classList.add('hidden');
            };
            img.src = src;
            if (img.complete && spinner) spinner.classList.add('hidden');
        }

        modal.classList.remove('hidden');
        requestAnimationFrame(() => {
            modal.classList.remove('opacity-0');
        });
        document.body.classList.add('overflow-hidden');

        const soraWidget = document.getElementById('sora-chat-widget');
        if (soraWidget) {
            soraWidget.style.setProperty('display', 'none', 'important');
        }
    }
    window.openPosterModal = openPosterModal;

    function closeLightbox() {
        const modal = document.getElementById('lightbox-modal');
        if (!modal) return;

        const video = document.getElementById('lightbox-video');
        if (video) {
            video.pause();
            video.removeAttribute('src');
            video.load();
        }
        const img = document.getElementById('lightbox-img');
        if (img) {
            img.removeAttribute('src');
        }

        modal.classList.add('opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 200);

        // Restore AI Sora Floating Widget when popup is closed
        const soraWidget = document.getElementById('sora-chat-widget');
        if (soraWidget) {
            soraWidget.style.removeProperty('display');
        }
    }
    window.closeLightbox = closeLightbox;

    function handleBackdropClick(event) {
        if (event.target.id === 'lightbox-modal' || event.target.id === 'lightbox-stage') {
            closeLightbox();
        }
    }
    window.handleBackdropClick = handleBackdropClick;

    function prevLightbox(e) {
        if (e) e.stopPropagation();
        if (!galleryItems || galleryItems.length === 0) initGalleryData();
        if (galleryItems.length === 0) return;
        currentGalleryIndex = (currentGalleryIndex - 1 + galleryItems.length) % galleryItems.length;
        openLightbox(currentGalleryIndex);
    }
    window.prevLightbox = prevLightbox;

    function nextLightbox(e) {
        if (e) e.stopPropagation();
        if (!galleryItems || galleryItems.length === 0) initGalleryData();
        if (galleryItems.length === 0) return;
        currentGalleryIndex = (currentGalleryIndex + 1) % galleryItems.length;
        openLightbox(currentGalleryIndex);
    }
    window.nextLightbox = nextLightbox;

    // Attach Swipe & Key Listeners safely
    let touchStartX = 0;
    let touchStartY = 0;
    let touchEndX = 0;
    let touchEndY = 0;

    function handleSwipe() {
        const diffX = touchEndX - touchStartX;
        const diffY = touchEndY - touchStartY;
        if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 45) {
            if (diffX < 0) {
                nextLightbox();
            } else {
                prevLightbox();
            }
        } else if (diffY > 90 && Math.abs(diffY) > Math.abs(diffX)) {
            closeLightbox();
        }
    }

    function initLightboxListeners() {
        const modalEl = document.getElementById('lightbox-modal');
        if (modalEl && !modalEl._hasSwipeListeners) {
            modalEl._hasSwipeListeners = true;
            modalEl.addEventListener('touchstart', function (e) {
                touchStartX = e.changedTouches[0].screenX;
                touchStartY = e.changedTouches[0].screenY;
            }, { passive: true });

            modalEl.addEventListener('touchend', function (e) {
                touchEndX = e.changedTouches[0].screenX;
                touchEndY = e.changedTouches[0].screenY;
                handleSwipe();
            }, { passive: true });
        }
    }

    // Keyboard navigation (registered once globally)
    if (!window._hasLightboxKeyboard) {
        window._hasLightboxKeyboard = true;
        window.addEventListener('keydown', function (e) {
            const modal = document.getElementById('lightbox-modal');
            if (!modal || modal.classList.contains('hidden')) return;

            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') prevLightbox();
            if (e.key === 'ArrowRight') nextLightbox();
        });
    }

    // Auto-init on all lifecycle events: DOMContentLoaded, Livewire navigate, and immediate execution!
    initGalleryData();
    initLightboxListeners();

    document.addEventListener('DOMContentLoaded', function () {
        initGalleryData();
        initLightboxListeners();
    });

    document.addEventListener('livewire:navigated', function () {
        initGalleryData();
        initLightboxListeners();
    });

    // Countdown logic
    @if($event->status !== 'completed' && $event->event_date && $event->start_time)
    (function () {
        const targetDate = new Date("{{ \Carbon\Carbon::parse($event->event_date . ' ' . $event->start_time)->format('M d, Y H:i:s') }} GMT+0700").getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance > 0) {
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                const daysEl = document.getElementById("days");
                const hoursEl = document.getElementById("hours");
                const minutesEl = document.getElementById("minutes");
                const secondsEl = document.getElementById("seconds");

                if (daysEl) daysEl.innerText = days;
                if (hoursEl) hoursEl.innerText = hours < 10 ? "0" + hours : hours;
                if (minutesEl) minutesEl.innerText = minutes < 10 ? "0" + minutes : minutes;
                if (secondsEl) secondsEl.innerText = seconds < 10 ? "0" + seconds : seconds;
            } else {
                const timerEl = document.getElementById('countdown-timer');
                if (timerEl) {
                    timerEl.innerHTML = '<div class="col-span-4 p-space-sm text-center text-cloud-white font-bold">Acara sedang berlangsung atau telah terlaksana. Muat ulang halaman.</div>';
                }
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
            .bindPopup("<b>{{ addslashes($event->location ?? 'SMK Negeri 1 Purwokerto') }}</b><br>{{ addslashes($event->specific_location ?? 'Lokasi Acara') }}").openPopup();
            
        mapInitialized = true;
        setTimeout(() => {
            publicMap.invalidateSize();
        }, 100);
    }
    @endif
</script>
@endsection