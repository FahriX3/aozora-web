@extends('layouts.admin')

@section('title', 'Event Unggulan')

@section('content')
<div class="max-w-4xl mx-auto px-margin-mobile md:px-margin py-space-lg">
    <div class="flex items-center gap-2 mb-space-md">
        <h1 class="text-headline-md font-bold text-indigo-night">Event Unggulan</h1>
    </div>

    @if(session('success'))
        <div class="bg-primary/20 text-indigo-night p-4 rounded-lg mb-space-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-cloud-white rounded-2xl shadow-md p-space-lg mb-space-lg">
        <h2 class="font-headline-sm font-bold text-indigo-night mb-2">Event Saat Ini</h2>
        @if($currentFeatured)
            <div class="bg-surface-container-low border border-outline-variant p-4 rounded-lg flex flex-col md:flex-row items-center gap-4">
                @if($currentFeatured->poster_path)
                    <img src="{{ Storage::url($currentFeatured->poster_path) }}" class="w-32 h-32 object-cover rounded-lg">
                @else
                    <div class="w-32 h-32 bg-surface-container flex items-center justify-center rounded-lg text-outline">No Image</div>
                @endif
                <div class="flex flex-col">
                    <span class="font-bold text-lg text-indigo-night">{{ $currentFeatured->title }}</span>
                    <span class="text-sm text-on-surface-variant mb-2">Tanggal: {{ $currentFeatured->event_date }}</span>
                    <a href="{{ $currentFeatured->youtube_link }}" target="_blank" class="text-primary text-sm underline flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">smart_display</span> Tonton Video YouTube
                    </a>
                </div>
            </div>
        @else
            <p class="text-on-surface-variant text-sm">Belum ada event unggulan yang dipilih.</p>
        @endif
    </div>

    <div class="bg-cloud-white rounded-2xl shadow-md p-space-lg">
        <h2 class="font-headline-sm font-bold text-indigo-night mb-4">Pilih Event Unggulan Baru</h2>
        
        <form action="{{ route('admin.featured-event.store') }}" method="POST" class="flex flex-col gap-space-md">
            @csrf
            
            <div class="flex flex-col gap-1">
                <label class="font-bold text-indigo-night">Pilih Event</label>
                <select name="event_id" required class="p-2 border border-outline-variant rounded-lg focus:outline-primary">
                    <option value="">-- Pilih Event --</option>
                    @foreach($events as $evt)
                        <option value="{{ $evt->id }}" {{ $currentFeatured && $currentFeatured->id === $evt->id ? 'selected' : '' }}>
                            {{ $evt->title }} ({{ $evt->status }})
                        </option>
                    @endforeach
                </select>
                <span class="text-xs text-on-surface-variant">Hanya satu event yang dapat menjadi Event Unggulan di bagian Aftermovie beranda.</span>
            </div>

            <div class="flex flex-col gap-1">
                <label class="font-bold text-indigo-night">Link YouTube Video (Aftermovie / Recap)</label>
                <input type="url" name="youtube_link" value="{{ $currentFeatured ? $currentFeatured->youtube_link : '' }}" required class="p-2 border border-outline-variant rounded-lg focus:outline-primary" placeholder="https://www.youtube.com/watch?v=...">
            </div>

            <div class="pt-space-md flex justify-end">
                <button type="submit" class="px-space-lg py-3 bg-primary text-cloud-white rounded-lg font-bold hover:bg-indigo-night transition-colors">
                    Simpan Event Unggulan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
