<x-filament-panels::page>
    <div class="flex flex-col gap-6 max-w-4xl">
        
        {{-- Section 1: Event Unggulan Aktif Saat Ini --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/90 dark:border-gray-800 p-6 shadow-xs transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 dark:bg-amber-950/50 flex items-center justify-center text-amber-600 dark:text-amber-400 border border-amber-200/80 dark:border-amber-800/60">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-900 dark:text-white m-0">Event Unggulan Saat Ini</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 m-0">Event ini aktif tampil di section Aftermovie / Highlight halaman utama website</p>
                    </div>
                </div>

                @if($currentFeatured)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-300 border border-emerald-200/80 dark:border-emerald-800/60">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Tayang di Beranda
                    </span>
                @endif
            </div>

            @if($currentFeatured)
                <div class="bg-gray-50/80 dark:bg-gray-800/60 rounded-xl border border-gray-200/70 dark:border-gray-700/60 p-5 flex flex-col gap-4">
                    <div class="flex gap-5 items-start">
                        @if($currentFeatured->poster_path)
                            <img src="{{ Storage::url($currentFeatured->poster_path) }}" alt="{{ $currentFeatured->title }}" class="rounded-xl shadow-xs shrink-0 border border-gray-200 dark:border-gray-700" style="width: 100px; height: 100px; min-width: 100px; max-width: 100px; object-fit: cover;" />
                        @else
                            <div class="rounded-xl bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-400 text-xs font-semibold shrink-0" style="width: 100px; height: 100px; min-width: 100px; max-width: 100px;">
                                No Image
                            </div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <h4 class="text-base font-bold text-gray-900 dark:text-white m-0 mb-1 leading-snug">{{ $currentFeatured->title }}</h4>
                            @if($currentFeatured->subtitle)
                                <span class="inline-block text-xs font-bold text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-950/60 px-2 py-0.5 rounded-md mb-2 border border-indigo-200/60 dark:border-indigo-800/40">
                                    {{ $currentFeatured->subtitle }}
                                </span>
                            @endif

                            <div class="flex flex-wrap gap-4 text-xs text-gray-600 dark:text-gray-300 mt-2">
                                <div>
                                    <span class="font-bold text-gray-800 dark:text-gray-200">📅 Tanggal:</span> {{ $currentFeatured->event_date ? \Carbon\Carbon::parse($currentFeatured->event_date)->translatedFormat('d M Y') : '-' }}
                                </div>
                                <div>
                                    <span class="font-bold text-gray-800 dark:text-gray-200">📍 Lokasi:</span> {{ $currentFeatured->location ?? '-' }}
                                </div>
                                <div>
                                    <span class="font-bold text-gray-800 dark:text-gray-200">🏷️ Status:</span> 
                                    <span class="font-semibold px-2 py-0.5 rounded text-[11px] {{ $currentFeatured->status === 'completed' ? 'bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400' : 'bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400' }}">
                                        {{ ucfirst($currentFeatured->status) }}
                                    </span>
                                </div>
                            </div>

                            @if($currentFeatured->youtube_link)
                                <div class="mt-3 flex items-center gap-2 text-xs">
                                    <span class="text-red-600">▶️</span>
                                    <a href="{{ $currentFeatured->youtube_link }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold break-all">
                                        {{ $currentFeatured->youtube_link }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="p-8 text-center bg-gray-50/80 dark:bg-gray-800/40 rounded-xl border border-dashed border-gray-300 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-sm">
                    <p class="m-0">Belum ada event unggulan yang dipilih saat ini. Silakan pilih event melalui form di bawah.</p>
                </div>
            @endif
        </div>

        {{-- Section 2: Form Ganti Event Unggulan --}}
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200/90 dark:border-gray-800 p-6 shadow-xs transition-colors">
            <div class="mb-5">
                <h3 class="text-base font-bold text-gray-900 dark:text-white m-0 mb-1">Pilih / Perbarui Event Unggulan</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 m-0">Pilih event dari database dan cantumkan link video YouTube untuk dijadikan highlight utama di beranda.</p>
            </div>

            <form wire:submit="save" class="flex flex-col gap-5">
                {{-- Dropdown Event --}}
                <div class="flex flex-col gap-1.5">
                    <label for="event_id" class="text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300">
                        Pilih Event <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        wire:model="event_id" 
                        id="event_id"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all"
                    >
                        <option value="">-- Pilih Salah Satu Event --</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">
                                {{ $event->title }} ({{ $event->status === 'completed' ? 'Selesai' : 'Akan Datang' }} - {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') : 'Tanpa Tanggal' }})
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <span class="text-xs text-rose-500 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Input YouTube Link --}}
                <div class="flex flex-col gap-1.5">
                    <label for="youtube_link" class="text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300">
                        Link Video YouTube (Aftermovie / Highlight) <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        wire:model="youtube_link" 
                        type="url" 
                        id="youtube_link" 
                        placeholder="https://www.youtube.com/watch?v=... atau https://youtu.be/..." 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-mono"
                    />
                    <span class="text-[11px] text-gray-500 dark:text-gray-400">Video ini akan dimainkan langsung di section Aftermovie Beranda saat pengunjung menekan tombol play.</span>
                    @error('youtube_link')
                        <span class="text-xs text-rose-500 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Action Button --}}
                <div class="flex justify-end pt-2">
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold cursor-pointer inline-flex items-center gap-2 shadow-xs transition-all"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Simpan Event Unggulan</span>
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-filament-panels::page>
