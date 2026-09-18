@extends('layouts.app')

@section('content')
<div class="flex flex-col w-full min-h-screen">
    <!-- HERO SECTION -->
    <section class="w-full pt-12 pb-8 relative bg-surface overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-aozora-sky/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin relative z-10 flex flex-col items-center text-center">
            <div class="inline-flex items-center gap-space-xs px-space-md py-1 rounded-full bg-primary/10 text-primary font-label-badge text-label-badge mb-space-sm font-bold">
                <span class="">🌸 SEMUA EVENT & MATSURI</span>
            </div>
            <h1 class="font-headline-lg text-4xl md:text-5xl text-indigo-night font-extrabold tracking-tight mb-4">
                Arsip Kegiatan Aozora
            </h1>
            <p class="font-body-md text-on-surface-variant max-w-2xl mx-auto">
                Eksplorasi seluruh kegiatan dan acara yang pernah atau akan diselenggarakan oleh ekstrakurikuler Aozora Nihongo Club.
            </p>
        </div>
    </section>

    <!-- FILTER SECTION -->
    <section class="w-full pb-8 relative z-10">
        <div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin flex justify-center">
            <div class="inline-flex p-1 rounded-xl bg-surface-container shadow-inner">
                <a href="{{ route('events.index') }}" class="px-6 py-2.5 rounded-lg font-label-md text-label-md transition-all {{ !request('filter') ? 'bg-cloud-white text-primary shadow-sm font-bold' : 'text-secondary hover:text-indigo-night' }}">
                    Semua Agenda
                </a>
                <a href="{{ route('events.index', ['filter' => 'upcoming']) }}" class="px-6 py-2.5 rounded-lg font-label-md text-label-md transition-all {{ request('filter') === 'upcoming' ? 'bg-cloud-white text-primary shadow-sm font-bold' : 'text-secondary hover:text-indigo-night' }}">
                    Mendatang (Upcoming)
                </a>
                <a href="{{ route('events.index', ['filter' => 'completed']) }}" class="px-6 py-2.5 rounded-lg font-label-md text-label-md transition-all {{ request('filter') === 'completed' ? 'bg-cloud-white text-primary shadow-sm font-bold' : 'text-secondary hover:text-indigo-night' }}">
                    Selesai (Completed)
                </a>
            </div>
        </div>
    </section>

    <!-- EVENTS GRID -->
    <section class="w-full pb-24 relative z-10">
        <div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin">
            
            @if($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-space-lg mb-space-xl">
                @foreach($events as $event)
                <div class="rounded-2xl bg-cloud-white shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1.5 {{ $event->status === 'completed' ? 'bg-torii-vermilion' : 'bg-gold-shrine' }}"></div>
                    
                    @if($event->poster_path)
                    <div class="w-full h-48 overflow-hidden bg-surface-container-low">
                        <img src="{{ Storage::url($event->poster_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    @else
                    <div class="w-full h-48 overflow-hidden bg-surface-container-low flex items-center justify-center">
                        <span class="material-symbols-outlined text-5xl text-surface-container-highest">image</span>
                    </div>
                    @endif

                    <div class="p-space-lg flex-1 flex flex-col">
                        <!-- Header Tags -->
                        <div class="flex items-center justify-between gap-space-xs mb-space-sm">
                            <span class="px-2.5 py-1 rounded-full {{ $event->status === 'completed' ? 'bg-sakura-tint text-torii-vermilion' : 'bg-gold-shrine/15 text-gold-shrine' }} font-label-badge text-label-badge font-bold uppercase truncate">
                                {{ $event->subtitle ?? 'EVENT' }}
                            </span>
                            <span class="font-label-badge text-label-badge text-secondary font-medium">
                                {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}
                            </span>
                        </div>
                        <!-- Title & Time -->
                        <h3 class="font-headline-sm text-headline-sm text-indigo-night font-bold group-hover:{{ $event->status === 'completed' ? 'text-torii-vermilion' : 'text-gold-shrine' }} transition-colors">
                            {{ $event->title }}
                        </h3>
                        <div class="flex items-center gap-space-xs text-on-surface-variant font-body-sm text-body-sm mt-space-xs">
                            <span class="material-symbols-outlined text-sm {{ $event->status === 'completed' ? 'text-torii-vermilion' : 'text-gold-shrine' }}">schedule</span>
                            <span class="">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }} WIB</span>
                        </div>
                        <div class="flex items-center gap-space-xs text-on-surface-variant font-body-sm text-body-sm mt-1">
                            <span class="material-symbols-outlined text-sm text-primary">location_on</span>
                            <span class="truncate">{{ $event->location }}</span>
                        </div>
                        
                        <!-- Description -->
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-space-sm leading-relaxed line-clamp-3">
                            {{ $event->description }}
                        </p>
                        
                        @if($event->status === 'completed')
                        <!-- Documentation indicator -->
                        <div class="mt-space-md p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between mt-auto">
                            <div class="flex items-center gap-space-xs text-primary font-label-badge text-label-badge">
                                <span class="material-symbols-outlined text-base">photo_library</span>
                                <span class="">📸 {{ $event->documentations()->count() }} Dokumentasi</span>
                            </div>
                        </div>
                        @else
                        <div class="mt-space-md p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between mt-auto">
                            <div class="flex items-center gap-space-xs text-primary font-label-badge text-label-badge">
                                <span class="material-symbols-outlined text-base">campaign</span>
                                <span class="">Segera Hadir</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="px-space-lg pb-space-lg">
                        <a href="{{ route('event.detail', $event->slug) }}" class="w-full py-2.5 rounded-lg {{ $event->status === 'completed' ? 'bg-surface-container hover:bg-torii-vermilion hover:text-cloud-white' : 'bg-surface-container hover:bg-gold-shrine hover:text-indigo-night' }} text-indigo-night font-label-md text-label-md font-bold transition-colors flex items-center justify-center gap-space-xs">
                            <span class="">{{ $event->status === 'completed' ? 'Lihat Dokumentasi' : 'Registrasi / Detail' }}</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- PAGINATION -->
            <div class="flex justify-center mt-space-xl">
                {{ $events->links() }}
            </div>
            
            @else
            <!-- EMPTY STATE -->
            <div class="w-full flex flex-col items-center justify-center py-20 text-center">
                <div class="w-24 h-24 rounded-full bg-surface-container flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-5xl text-secondary">event_busy</span>
                </div>
                <h3 class="font-headline-sm text-indigo-night mb-2">Belum ada agenda</h3>
                <p class="text-secondary">Tidak ada event yang ditemukan untuk filter ini.</p>
                @if(request('filter'))
                <a href="{{ route('events.index') }}" class="mt-6 px-6 py-2.5 rounded-full bg-primary text-cloud-white font-bold hover:bg-indigo-night transition-colors">Tampilkan Semua</a>
                @endif
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
