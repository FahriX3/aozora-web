<x-filament-panels::page>
    <div style="display: flex; flex-direction: column; gap: 1.5rem; max-width: 56rem;">
        
        {{-- Section 1: Event Unggulan Aktif Saat Ini --}}
        <div style="background-color: #ffffff; border-radius: 1rem; border: 1px solid #e5e7eb; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 2rem; height: 2rem; border-radius: 0.5rem; background-color: #fef3c7; display: flex; align-items: center; justify-content: center; color: #d97706;">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <div>
                        <h3 style="font-size: 1.125rem; font-weight: 700; color: #111827; margin: 0;">Event Unggulan Saat Ini</h3>
                        <p style="font-size: 0.8125rem; color: #6b7280; margin: 0;">Event ini aktif tampil di section Aftermovie / Highlight halaman utama</p>
                    </div>
                </div>

                @if($currentFeatured)
                    <span style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                        <span style="width: 0.5rem; height: 0.5rem; border-radius: 9999px; background-color: #10b981;"></span>
                        Tayang di Beranda
                    </span>
                @endif
            </div>

            @if($currentFeatured)
                <div style="background-color: #f9fafb; border-radius: 0.75rem; border: 1px solid #f3f4f6; padding: 1.25rem; display: flex; flex-direction: column; gap: 1rem;">
                    <div style="display: flex; gap: 1.25rem; align-items: flex-start;">
                        @if($currentFeatured->poster_path)
                            <img src="{{ Storage::url($currentFeatured->poster_path) }}" alt="{{ $currentFeatured->title }}" style="width: 7rem; height: 7rem; object-fit: cover; border-radius: 0.75rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); flex-shrink: 0;" />
                        @else
                            <div style="width: 7rem; height: 7rem; border-radius: 0.75rem; background-color: #e5e7eb; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 0.75rem; font-weight: 600; flex-shrink: 0;">
                                No Image
                            </div>
                        @endif

                        <div style="flex: 1; min-width: 0;">
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                                <h4 style="font-size: 1.125rem; font-weight: 700; color: #111827; margin: 0; line-height: 1.3;">{{ $currentFeatured->title }}</h4>
                            </div>
                            @if($currentFeatured->subtitle)
                                <span style="display: inline-block; font-size: 0.75rem; font-weight: 700; color: #0043c0; background-color: #e0e7ff; padding: 0.125rem 0.5rem; border-radius: 0.375rem; margin-bottom: 0.5rem;">
                                    {{ $currentFeatured->subtitle }}
                                </span>
                            @endif

                            <div style="display: flex; flex-wrap: wrap; gap: 1rem; font-size: 0.8125rem; color: #4b5563; margin-top: 0.5rem;">
                                <div>
                                    <span style="font-weight: 600;">📅 Tanggal:</span> {{ $currentFeatured->event_date ? \Carbon\Carbon::parse($currentFeatured->event_date)->translatedFormat('d M Y') : '-' }}
                                </div>
                                <div>
                                    <span style="font-weight: 600;">📍 Lokasi:</span> {{ $currentFeatured->location ?? '-' }}
                                </div>
                                <div>
                                    <span style="font-weight: 600;">🏷️ Status:</span> 
                                    <span style="font-weight: 600; color: {{ $currentFeatured->status === 'completed' ? '#059669' : '#0284c7' }};">
                                        {{ ucfirst($currentFeatured->status) }}
                                    </span>
                                </div>
                            </div>

                            @if($currentFeatured->youtube_link)
                                <div style="margin-top: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                                    <span style="color: #dc2626; font-size: 1rem;">▶️</span>
                                    <a href="{{ $currentFeatured->youtube_link }}" target="_blank" style="font-size: 0.8125rem; color: #0043c0; text-decoration: underline; font-weight: 600; word-break: break-all;">
                                        {{ $currentFeatured->youtube_link }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div style="padding: 2rem; text-align: center; background-color: #f9fafb; border-radius: 0.75rem; border: 1px dashed #d1d5db; color: #6b7280; font-size: 0.875rem;">
                    <p style="margin: 0;">Belum ada event unggulan yang dipilih saat ini. Silakan pilih event melalui form di bawah.</p>
                </div>
            @endif
        </div>

        {{-- Section 2: Form Ganti Event Unggulan --}}
        <div style="background-color: #ffffff; border-radius: 1rem; border: 1px solid #e5e7eb; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="margin-bottom: 1.25rem;">
                <h3 style="font-size: 1.125rem; font-weight: 700; color: #111827; margin: 0 0 0.25rem 0;">Pilih / Perbarui Event Unggulan</h3>
                <p style="font-size: 0.8125rem; color: #6b7280; margin: 0;">Pilih event dari daftar database dan cantumkan link video YouTube untuk dijadikan highlight di beranda.</p>
            </div>

            <form wire:submit="save" style="display: flex; flex-direction: column; gap: 1.25rem;">
                {{-- Dropdown Event --}}
                <div style="display: flex; flex-direction: column; gap: 0.375rem;">
                    <label for="event_id" style="font-size: 0.875rem; font-weight: 600; color: #374151;">
                        Pilih Event <span style="color: #ef4444;">*</span>
                    </label>
                    <select 
                        wire:model="event_id" 
                        id="event_id"
                        style="width: 100%; padding: 0.625rem 0.875rem; border-radius: 0.5rem; border: 1px solid #d1d5db; background-color: #ffffff; font-size: 0.875rem; color: #111827; outline: none; transition: border-color 0.15s;"
                    >
                        <option value="">-- Pilih Salah Satu Event --</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">
                                {{ $event->title }} ({{ $event->status === 'completed' ? 'Selesai' : 'Akan Datang' }} - {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') : 'Tanpa Tanggal' }})
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <span style="font-size: 0.75rem; color: #ef4444;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Input YouTube Link --}}
                <div style="display: flex; flex-direction: column; gap: 0.375rem;">
                    <label for="youtube_link" style="font-size: 0.875rem; font-weight: 600; color: #374151;">
                        Link Video YouTube (Aftermovie / Highlight) <span style="color: #ef4444;">*</span>
                    </label>
                    <div style="position: relative;">
                        <input 
                            wire:model="youtube_link" 
                            type="url" 
                            id="youtube_link" 
                            placeholder="https://www.youtube.com/watch?v=... atau https://youtu.be/..." 
                            style="width: 100%; padding: 0.625rem 0.875rem; border-radius: 0.5rem; border: 1px solid #d1d5db; background-color: #ffffff; font-size: 0.875rem; color: #111827; outline: none; transition: border-color 0.15s;"
                        />
                    </div>
                    <span style="font-size: 0.75rem; color: #6b7280;">Video ini akan dimainkan langsung di section Aftermovie Beranda saat tombol play ditekan.</span>
                    @error('youtube_link')
                        <span style="font-size: 0.75rem; color: #ef4444;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Action Button --}}
                <div style="display: flex; justify-content: flex-end; padding-top: 0.5rem;">
                    <button 
                        type="submit" 
                        style="padding: 0.625rem 1.5rem; border-radius: 0.5rem; background-color: #0043c0; color: #ffffff; font-size: 0.875rem; font-weight: 700; border: none; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 2px 6px rgba(0,67,192,0.3); transition: background-color 0.15s;"
                    >
                        <svg style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Event Unggulan
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-filament-panels::page>
