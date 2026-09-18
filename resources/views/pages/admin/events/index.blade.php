@extends('layouts.admin')

@section('content')
<div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin py-space-lg">
    <div class="flex justify-between items-center mb-space-md">
        <h1 class="text-headline-md font-bold text-indigo-night">Manajemen Event</h1>
        <a href="{{ route('admin.events.create') }}" class="px-space-md py-2 bg-primary text-cloud-white rounded-lg hover:bg-indigo-night transition-colors">
            + Tambah Event
        </a>
    </div>

    @if(session('success'))
        <div class="bg-primary/20 text-indigo-night p-4 rounded-lg mb-space-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-surface-container-low text-secondary text-label-md uppercase tracking-wider">
                        <th class="p-4 border-b border-outline-variant font-semibold">Poster</th>
                        <th class="p-4 border-b border-outline-variant font-semibold">Info Event</th>
                        <th class="p-4 border-b border-outline-variant font-semibold">Jadwal</th>
                        <th class="p-4 border-b border-outline-variant font-semibold">Status</th>
                        <th class="p-4 border-b border-outline-variant font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @foreach($events as $event)
                    <tr class="hover:bg-surface-container-low/30 transition-colors group">
                        <td class="p-4 w-24">
                            @if($event->poster_path)
                                <img src="{{ Storage::url($event->poster_path) }}" alt="{{ $event->title }}" class="w-16 h-16 object-cover rounded-xl shadow-sm">
                            @else
                                <div class="w-16 h-16 bg-surface-container-high rounded-xl flex items-center justify-center text-outline">
                                    <span class="material-symbols-outlined">image</span>
                                </div>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-indigo-night text-base mb-1">{{ $event->title }}</div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-semibold px-2 py-0.5 rounded bg-surface-container-high text-on-surface-variant">{{ $event->subtitle ?? 'Event' }}</span>
                                @if($event->is_featured)
                                    <span class="text-xs font-bold px-2 py-0.5 rounded bg-primary-container text-on-primary-container flex items-center gap-1"><span class="material-symbols-outlined text-[12px]">star</span> Unggulan</span>
                                @endif
                                @if($event->is_aftermovie)
                                    <span class="text-xs font-bold px-2 py-0.5 rounded bg-torii-vermilion/10 text-torii-vermilion flex items-center gap-1"><span class="material-symbols-outlined text-[12px]">smart_display</span> Aftermovie</span>
                                @endif
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex flex-col gap-1 text-sm">
                                <div class="flex items-center gap-1 text-on-surface">
                                    <span class="material-symbols-outlined text-[16px] text-secondary">calendar_today</span>
                                    {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') : '-' }}
                                </div>
                                <div class="flex items-center gap-1 text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[16px] text-secondary">schedule</span>
                                    {{ $event->start_time ? \Carbon\Carbon::parse($event->start_time)->format('H:i') : '-' }} WIB
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide {{ $event->status === 'completed' ? 'bg-sakura-tint text-torii-vermilion' : 'bg-gold-shrine/20 text-gold-shrine' }}">
                                {{ $event->status === 'completed' ? 'Selesai' : 'Mendatang' }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex items-center justify-end gap-2 opacity-100 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.events.edit', $event) }}" class="w-8 h-8 rounded-lg bg-surface-container hover:bg-primary hover:text-on-primary text-secondary flex items-center justify-center transition-colors" title="Edit Event">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus event ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-surface-container hover:bg-error hover:text-on-error text-secondary flex items-center justify-center transition-colors" title="Hapus Event">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($events->isEmpty())
                    <tr>
                        <td colspan="5" class="p-8 text-center flex flex-col items-center justify-center text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl mb-2 text-outline">event_busy</span>
                            <span class="font-bold">Belum ada data event.</span>
                            <span class="text-sm">Klik tombol "Tambah Event" di atas untuk membuat event baru.</span>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
