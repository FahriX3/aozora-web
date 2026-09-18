@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-space-lg">
    <div class="flex flex-col">
        <h1 class="font-headline-lg text-headline-lg font-bold text-on-surface">Selamat Datang, Admin</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant mt-2">Ini adalah pusat kendali untuk mengelola kegiatan, keanggotaan, dan publikasi Aozora Nihongo Club.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-space-lg mt-4">
    <!-- Quick Actions -->
    <a href="{{ route('admin.events.create') }}" class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow flex items-center gap-4 group">
        <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary-container flex items-center justify-center group-hover:bg-primary group-hover:text-on-primary transition-colors">
            <span class="material-symbols-outlined text-2xl">add_circle</span>
        </div>
        <div class="flex flex-col">
            <h3 class="font-headline-sm font-bold text-on-surface">Buat Event Baru</h3>
            <p class="text-sm text-on-surface-variant mt-1">Tambahkan kegiatan atau workshop baru ke jadwal.</p>
        </div>
    </a>
    
    <a href="{{ route('admin.featured-event.index') ?? '#' }}" class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow flex items-center gap-4 group">
        <div class="w-12 h-12 rounded-xl bg-tertiary-container text-on-tertiary-container flex items-center justify-center group-hover:bg-tertiary group-hover:text-on-tertiary transition-colors">
            <span class="material-symbols-outlined text-2xl">smart_display</span>
        </div>
        <div class="flex flex-col">
            <h3 class="font-headline-sm font-bold text-on-surface">Atur Event Unggulan</h3>
            <p class="text-sm text-on-surface-variant mt-1">Pilih event terbaik untuk video aftermovie di beranda.</p>
        </div>
    </a>
</div>
@endsection