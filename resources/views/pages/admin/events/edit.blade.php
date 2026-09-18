@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    .tab-btn.active { background-color: var(--color-primary, #0043c0); color: #ffffff; font-weight: 700; box-shadow: 0 4px 14px rgba(13,89,242,0.3); }
    .tab-btn:disabled { opacity: 0.5; cursor: not-allowed; }
    #mapPicker { height: 400px; width: 100%; border-radius: 0.75rem; z-index: 10; }
</style>
@endpush

@section('content')
<div class="max-w-5xl mx-auto px-margin-mobile md:px-margin py-space-lg">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-space-lg">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.events.index') }}" class="w-10 h-10 rounded-lg bg-surface-container hover:bg-surface-container-high flex items-center justify-center transition-colors text-secondary">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h1 class="text-headline-sm font-bold text-indigo-night ml-2">Edit Event: {{ $event->title }}</h1>
        </div>
        <button type="button" onclick="document.getElementById('event-form').submit()" class="px-space-md py-2.5 bg-primary hover:bg-indigo-night text-cloud-white rounded-lg font-bold transition-colors flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[20px]">save</span> Simpan Perubahan
        </button>
    </div>

    @if(session('success'))
        <div class="bg-primary-container/50 text-on-primary-container p-4 rounded-xl mb-space-md font-medium border border-primary/20">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-error-container/50 text-on-error-container p-4 rounded-xl mb-space-md border border-error/20">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant overflow-hidden">
        
        <!-- Tab Navigation -->
        <div class="flex overflow-x-auto border-b border-outline-variant p-2 gap-2 bg-surface-container-low no-scrollbar">
            <button class="tab-btn active px-4 py-2.5 rounded-lg font-label-md tracking-wider uppercase transition-all flex items-center gap-2 text-on-surface-variant whitespace-nowrap" onclick="switchTab('tab-general', this)">
                <span class="material-symbols-outlined text-[18px]">info</span> Informasi Umum
            </button>
            <button class="tab-btn px-4 py-2.5 rounded-lg font-label-md tracking-wider uppercase transition-all flex items-center gap-2 text-on-surface-variant whitespace-nowrap" onclick="switchTab('tab-rundown', this)">
                <span class="material-symbols-outlined text-[18px]">schedule</span> Rundown Acara
            </button>
            <button class="tab-btn px-4 py-2.5 rounded-lg font-label-md tracking-wider uppercase transition-all flex items-center gap-2 text-on-surface-variant whitespace-nowrap" onclick="switchTab('tab-location', this)">
                <span class="material-symbols-outlined text-[18px]">map</span> Lokasi & Akses
            </button>
            <button class="tab-btn px-4 py-2.5 rounded-lg font-label-md tracking-wider uppercase transition-all flex items-center gap-2 text-on-surface-variant whitespace-nowrap" onclick="switchTab('tab-documentation', this)" {{ $event->status !== 'completed' ? 'disabled title="Hanya aktif untuk event yang sudah selesai"' : '' }}>
                <span class="material-symbols-outlined text-[18px]">collections</span> Dokumentasi
            </button>
        </div>

        <form id="event-form" action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="p-space-lg">
            @csrf
            @method('PUT')
            
            <!-- TAB 1: GENERAL -->
            <div id="tab-general" class="tab-content active flex flex-col gap-space-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-bold text-indigo-night text-sm">Judul Event *</label>
                        <input type="text" name="title" value="{{ old('title', $event->title) }}" required class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="font-bold text-indigo-night text-sm">Sub Judul / Kategori</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle', $event->subtitle) }}" class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all placeholder-outline" placeholder="Misal: Pensi Tahunan">
                    </div>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="font-bold text-indigo-night text-sm">Deskripsi</label>
                    <textarea name="description" rows="4" class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md p-space-md bg-surface-container-low/50 rounded-xl border border-outline-variant/50">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-bold text-indigo-night text-sm">Tanggal Pelaksanaan</label>
                        <input type="date" name="event_date" value="{{ old('event_date', $event->event_date) }}" class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="font-bold text-indigo-night text-sm">Waktu Mulai</label>
                        <input type="time" name="start_time" value="{{ old('start_time', $event->start_time) }}" class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="font-bold text-indigo-night text-sm">Waktu Selesai</label>
                        <input type="time" name="end_time" value="{{ old('end_time', $event->end_time) }}" class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-bold text-indigo-night text-sm">Status Event *</label>
                        <select name="status" class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all" required>
                            <option value="upcoming" {{ old('status', $event->status) === 'upcoming' ? 'selected' : '' }}>Mendatang (Upcoming)</option>
                            <option value="completed" {{ old('status', $event->status) === 'completed' ? 'selected' : '' }}>Selesai (Completed)</option>
                        </select>
                    </div>
                    
                    <div class="flex flex-col gap-1.5">
                        <label class="font-bold text-indigo-night text-sm">Poster Event</label>
                        <div class="flex items-center gap-4">
                            @if($event->poster_path)
                                <img src="{{ Storage::url($event->poster_path) }}" class="w-16 h-16 object-cover rounded-lg border border-outline-variant">
                            @endif
                            <input type="file" name="poster" accept="image/*" class="w-full p-2 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
                        </div>
                    </div>
                </div>

                <label class="flex items-start gap-3 cursor-pointer bg-primary/5 p-4 rounded-xl border border-primary/20 hover:bg-primary/10 transition-colors">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $event->is_featured) ? 'checked' : '' }} class="mt-1 w-5 h-5 text-primary rounded focus:ring-primary">
                    <div class="flex flex-col">
                        <span class="font-bold text-primary">Jadikan Event Unggulan</span>
                        <span class="text-sm text-on-surface-variant">Event ini akan disorot di Landing Page bagian 'Event & Kegiatan Unggulan'.</span>
                    </div>
                </label>
            </div>

            <!-- TAB 2: RUNDOWN -->
            <div id="tab-rundown" class="tab-content flex flex-col gap-space-md">
                <div class="flex items-center justify-between bg-surface-container-low p-4 rounded-xl border border-outline-variant">
                    <div>
                        <h3 class="font-bold text-indigo-night">Jadwal & Rundown</h3>
                        <p class="text-sm text-on-surface-variant">Atur jadwal aktivitas selama event berlangsung.</p>
                    </div>
                    <button type="button" onclick="addRundownRow()" class="px-4 py-2 bg-surface-container hover:bg-surface-container-high text-primary font-bold rounded-lg transition-colors flex items-center gap-2 border border-outline-variant">
                        <span class="material-symbols-outlined text-[20px]">add</span> Tambah Baris
                    </button>
                </div>

                <div id="rundown-container" class="flex flex-col gap-3">
                    @php 
                        $rundowns = old('rundowns', $event->rundowns->toArray() ?? []); 
                    @endphp
                    @if(count($rundowns) > 0)
                        @foreach($rundowns as $index => $rundown)
                            <div class="rundown-row flex gap-3 items-start bg-cloud-white p-3 rounded-xl border border-outline-variant relative group">
                                <div class="flex flex-col gap-1 w-32">
                                    <input type="time" name="rundowns[{{ $index }}][time]" value="{{ is_array($rundown) ? ($rundown['time'] ?? '') : '' }}" required class="p-2 border border-outline-variant bg-surface-container-lowest rounded-lg focus:outline-primary w-full text-sm">
                                </div>
                                <div class="flex flex-col gap-2 flex-1">
                                    <input type="text" name="rundowns[{{ $index }}][title]" value="{{ is_array($rundown) ? ($rundown['title'] ?? '') : '' }}" required placeholder="Nama Aktivitas" class="p-2 border border-outline-variant bg-surface-container-lowest rounded-lg focus:outline-primary w-full text-sm font-bold text-indigo-night">
                                    <input type="text" name="rundowns[{{ $index }}][description]" value="{{ is_array($rundown) ? ($rundown['description'] ?? '') : '' }}" placeholder="Deskripsi opsional..." class="p-2 border border-outline-variant bg-surface-container-lowest rounded-lg focus:outline-primary w-full text-sm text-secondary">
                                </div>
                                <button type="button" onclick="this.closest('.rundown-row').remove()" class="w-10 h-10 rounded-lg text-secondary hover:bg-error-container hover:text-error transition-colors flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <!-- Empty state placeholder -->
                        <div class="text-center p-8 bg-surface-container-low rounded-xl border border-dashed border-outline-variant text-secondary" id="rundown-empty">
                            Belum ada jadwal rundown. Klik tombol "Tambah Baris" untuk memulai.
                        </div>
                    @endif
                </div>
            </div>

            <!-- TAB 3: LOCATION -->
            <div id="tab-location" class="tab-content flex flex-col gap-space-lg">
                <div class="flex flex-col gap-1.5">
                    <label class="font-bold text-indigo-night text-sm">Nama Lokasi Utama *</label>
                    <input type="text" name="location" value="{{ old('location', $event->location) }}" class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all placeholder-outline" placeholder="Contoh: Graha SMKN 1">
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="font-bold text-indigo-night text-sm">Pilih Titik Lokasi Peta</label>
                    <p class="text-xs text-on-surface-variant mb-2">Klik atau geser pada peta di bawah ini untuk menentukan titik lokasi presisi dari acara Anda.</p>
                    <div id="mapPicker" class="border border-outline-variant shadow-sm"></div>
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $event->latitude ?? '-7.421578') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $event->longitude ?? '109.254045') }}">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-bold text-indigo-night text-sm">Petunjuk Akses Pengunjung</label>
                        <textarea name="visitor_access_instructions" rows="4" class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all placeholder-outline text-sm" placeholder="Masuk melalui gerbang utama, parkir di area barat...">{{ old('visitor_access_instructions', $event->visitor_access_instructions) }}</textarea>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="font-bold text-indigo-night text-sm">Bantuan Lokasi & Kontak</label>
                        <textarea name="location_assistance" rows="4" class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all placeholder-outline text-sm" placeholder="Hubungi panitia via WA: 0812... jika tersesat.">{{ old('location_assistance', $event->location_assistance) }}</textarea>
                    </div>
                </div>
            </div>
        </form>

        <!-- TAB 4: DOCUMENTATION (Separate Form for Dropzone) -->
        <div id="tab-documentation" class="tab-content p-space-lg">
            @if($event->status === 'completed')
                <div class="bg-primary/5 rounded-2xl border border-primary/20 p-space-lg mb-space-lg">
                    <h2 class="text-headline-sm font-bold text-primary mb-2">Unggah Dokumentasi (Drag & Drop)</h2>
                    <p class="text-body-sm text-on-surface-variant mb-space-md">Unggah file foto/video untuk ditampilkan di halaman Galeri (Maks 500MB/file).</p>
                    
                    <form action="{{ route('admin.events.upload-documentation', $event) }}" class="dropzone border-2 border-dashed border-primary/50 rounded-xl bg-cloud-white min-h-[250px] flex items-center justify-center cursor-pointer hover:bg-primary/5 transition-colors" id="my-awesome-dropzone">
                        @csrf
                        <div class="dz-message text-center" data-dz-message>
                            <span class="material-symbols-outlined text-5xl text-primary mb-2 block">cloud_upload</span>
                            <span class="font-bold text-indigo-night text-lg">Tarik file ke sini, atau klik untuk memilih</span>
                        </div>
                    </form>
                </div>

                <div>
                    <h3 class="font-bold text-indigo-night mb-space-sm">Galeri Tersimpan ({{ $event->documentations()->count() }})</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 max-h-[400px] overflow-y-auto p-2 bg-surface-container-low rounded-xl border border-outline-variant">
                        @foreach($event->documentations as $doc)
                            <div class="relative group rounded-xl overflow-hidden bg-cloud-white border border-outline-variant aspect-square shadow-sm">
                                @if($doc->file_type === 'video')
                                    <video src="{{ Storage::url($doc->file_path) }}" class="w-full h-full object-cover"></video>
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/40">
                                        <span class="material-symbols-outlined text-cloud-white text-3xl">play_circle</span>
                                    </div>
                                @else
                                    <img src="{{ Storage::url($doc->file_path) }}" alt="Dokumentasi" class="w-full h-full object-cover">
                                @endif
                                <!-- Simple delete form (optional addition) -->
                                <div class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <form action="{{ route('admin.events.upload-documentation', $event) }}" method="POST" onsubmit="return confirm('Hapus media ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="doc_id" value="{{ $doc->id }}">
                                        <button type="button" class="w-7 h-7 rounded bg-error text-on-error flex items-center justify-center shadow-lg hover:bg-error-container hover:text-error transition-colors" onclick="alert('Fitur hapus individual perlu controller update. Sementara biarkan ini.')">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        @if($event->documentations()->count() === 0)
                            <div class="col-span-full py-8 text-center text-secondary font-medium">Belum ada dokumentasi.</div>
                        @endif
                    </div>
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
                    <div class="w-16 h-16 rounded-full bg-surface-container flex items-center justify-center mb-4 text-outline">
                        <span class="material-symbols-outlined text-3xl">lock</span>
                    </div>
                    <h2 class="text-headline-sm font-bold text-indigo-night mb-2">Tab Dokumentasi Terkunci</h2>
                    <p class="text-on-surface-variant max-w-md">Anda hanya bisa mengunggah foto dan video jika status Event sudah berubah menjadi <b class="text-torii-vermilion">Selesai (Completed)</b>.</p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    // Leaflet Map Initialization
    let map, marker;
    function initMap() {
        if(map) return;
        
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');
        const initialLat = parseFloat(latInput.value);
        const initialLng = parseFloat(lngInput.value);

        map = L.map('mapPicker').setView([initialLat, initialLng], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        marker = L.marker([initialLat, initialLng], {draggable: true}).addTo(map);

        marker.on('dragend', function(e) {
            const position = marker.getLatLng();
            latInput.value = position.lat;
            lngInput.value = position.lng;
        });

        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            latInput.value = e.latlng.lat;
            lngInput.value = e.latlng.lng;
        });
    }

    // Tab Switcher
    function switchTab(tabId, btn) {
        if(btn.hasAttribute('disabled')) return;
        
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        
        document.getElementById(tabId).classList.add('active');
        btn.classList.add('active');

        if(tabId === 'tab-location') {
            initMap();
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        }
    }

    // Dynamic Rundown Rows
    let rundownCount = {{ max(count(old('rundowns', $event->rundowns->toArray() ?? [])), 0) }};
    
    function addRundownRow() {
        const container = document.getElementById('rundown-container');
        const emptyState = document.getElementById('rundown-empty');
        if(emptyState) emptyState.remove();

        const idx = rundownCount++;
        const html = `
            <div class="rundown-row flex gap-3 items-start bg-cloud-white p-3 rounded-xl border border-outline-variant relative group">
                <div class="flex flex-col gap-1 w-32">
                    <input type="time" name="rundowns[${idx}][time]" required class="p-2 border border-outline-variant bg-surface-container-lowest rounded-lg focus:outline-primary w-full text-sm">
                </div>
                <div class="flex flex-col gap-2 flex-1">
                    <input type="text" name="rundowns[${idx}][title]" required placeholder="Nama Aktivitas" class="p-2 border border-outline-variant bg-surface-container-lowest rounded-lg focus:outline-primary w-full text-sm font-bold text-indigo-night">
                    <input type="text" name="rundowns[${idx}][description]" placeholder="Deskripsi opsional..." class="p-2 border border-outline-variant bg-surface-container-lowest rounded-lg focus:outline-primary w-full text-sm text-secondary">
                </div>
                <button type="button" onclick="this.closest('.rundown-row').remove()" class="w-10 h-10 rounded-lg text-secondary hover:bg-error-container hover:text-error transition-colors flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-[20px]">delete</span>
                </button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }

    // Dropzone setup
    Dropzone.autoDiscover = false;
    if(document.getElementById('my-awesome-dropzone')) {
        let dz = new Dropzone("#my-awesome-dropzone", {
            maxFilesize: 500, // MB
            acceptedFiles: "image/*,video/*",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function() {
                this.on("success", function(file, response) {
                    setTimeout(() => window.location.reload(), 1000);
                });
                this.on("error", function(file, response) {
                    console.error(response);
                });
            }
        });
    }
</script>
@endpush
