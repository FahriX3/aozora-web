<x-filament-panels::page>
    <div class="fe-container" style="display: flex; flex-direction: column; gap: 20px; max-width: 860px;">
        
        {{-- Section 1: Event Unggulan Aktif Saat Ini --}}
        <div class="fe-card">
            <div class="fe-header">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div class="fe-icon-box">
                        <svg width="20" height="20" style="width: 20px !important; height: 20px !important; min-width: 20px !important; max-width: 20px !important; flex-shrink: 0;" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="fe-title">Event Unggulan Saat Ini</h3>
                        <p class="fe-subtitle">Event ini aktif tampil di section Aftermovie / Highlight halaman utama website</p>
                    </div>
                </div>

                @if($currentFeatured)
                    <span class="fe-badge-active">
                        <span style="width: 8px; height: 8px; border-radius: 9999px; background-color: #10b981; display: inline-block;"></span>
                        Tayang di Beranda
                    </span>
                @endif
            </div>

            @if($currentFeatured)
                <div class="fe-current-preview">
                    <div class="fe-preview-row">
                        @if($currentFeatured->poster_path)
                            <img src="{{ Storage::url($currentFeatured->poster_path) }}" alt="{{ $currentFeatured->title }}" width="100" height="100" class="fe-poster" />
                        @else
                            <div class="fe-poster-placeholder">
                                No Image
                            </div>
                        @endif

                        <div style="flex: 1; min-width: 0;">
                            <h4 class="fe-event-title">{{ $currentFeatured->title }}</h4>
                            @if($currentFeatured->subtitle)
                                <span class="fe-event-subtitle">
                                    {{ $currentFeatured->subtitle }}
                                </span>
                            @endif

                            <div class="fe-meta-list">
                                <div>
                                    <span class="fe-meta-label">📅 Tanggal:</span> {{ $currentFeatured->event_date ? \Carbon\Carbon::parse($currentFeatured->event_date)->translatedFormat('d M Y') : '-' }}
                                </div>
                                <div>
                                    <span class="fe-meta-label">📍 Lokasi:</span> {{ $currentFeatured->location ?? '-' }}
                                </div>
                                <div>
                                    <span class="fe-meta-label">🏷️ Status:</span> 
                                    <span class="fe-status-badge {{ $currentFeatured->status === 'completed' ? 'fe-status-completed' : 'fe-status-upcoming' }}">
                                        {{ ucfirst($currentFeatured->status) }}
                                    </span>
                                </div>
                            </div>

                            @if($currentFeatured->youtube_link)
                                <div class="fe-yt-link">
                                    <span style="color: #dc2626; font-size: 14px;">▶️</span>
                                    <a href="{{ $currentFeatured->youtube_link }}" target="_blank">
                                        {{ $currentFeatured->youtube_link }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="fe-empty">
                    <p style="margin: 0;">Belum ada event unggulan yang dipilih saat ini. Silakan pilih event melalui form di bawah.</p>
                </div>
            @endif
        </div>

        {{-- Section 2: Form Ganti Event Unggulan --}}
        <div class="fe-card">
            <div style="margin-bottom: 20px;">
                <h3 class="fe-title" style="margin-bottom: 4px;">Pilih / Perbarui Event Unggulan</h3>
                <p class="fe-subtitle">Pilih event dari database dan cantumkan link video YouTube untuk dijadikan highlight utama di beranda.</p>
            </div>

            <form wire:submit="save" class="fe-form">
                {{-- Dropdown Event --}}
                <div class="fe-field">
                    <label for="event_id" class="fe-label">
                        Pilih Event <span style="color: #ef4444;">*</span>
                    </label>
                    <select 
                        wire:model="event_id" 
                        id="event_id"
                        class="fe-select"
                    >
                        <option value="">-- Pilih Salah Satu Event --</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">
                                {{ $event->title }} ({{ $event->status === 'completed' ? 'Selesai' : 'Akan Datang' }} - {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') : 'Tanpa Tanggal' }})
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <span style="font-size: 12px; color: #ef4444; font-weight: 500;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Input YouTube Link --}}
                <div class="fe-field">
                    <label for="youtube_link" class="fe-label">
                        Link Video YouTube (Aftermovie / Highlight) <span style="color: #ef4444;">*</span>
                    </label>
                    <input 
                        wire:model="youtube_link" 
                        type="url" 
                        id="youtube_link" 
                        placeholder="https://www.youtube.com/watch?v=... atau https://youtu.be/..." 
                        class="fe-input"
                    />
                    <span style="font-size: 11px; color: #64748b;">Video ini akan dimainkan langsung di section Aftermovie Beranda saat pengunjung menekan tombol play.</span>
                    @error('youtube_link')
                        <span style="font-size: 12px; color: #ef4444; font-weight: 500;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Action Button --}}
                <div style="display: flex; justify-content: flex-end; padding-top: 8px;">
                    <button 
                        type="submit" 
                        class="fe-btn"
                    >
                        <svg width="16" height="16" style="width: 16px !important; height: 16px !important; min-width: 16px !important; max-width: 16px !important; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Simpan Event Unggulan</span>
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-filament-panels::page>

