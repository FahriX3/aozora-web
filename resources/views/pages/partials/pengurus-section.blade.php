{{-- SECTION: DAFTAR PENGURUS ORGANISASI AOZORA NIHONGO CLUB --}}
<section class="w-full py-16 md:py-24 bg-surface-container-low/60 border-y border-surface-container-high/60 relative overflow-hidden" id="pengurus">
    {{-- Subtle Japanese Kanji Background Accent --}}
    <div class="absolute -right-12 top-10 text-[180px] font-extrabold text-primary-container/[0.03] select-none pointer-events-none -z-0">
        組織
    </div>

    <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="flex flex-col items-center text-center max-w-3xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-rose-100 shadow-xs text-xs font-bold uppercase tracking-wider mb-3">
                <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Logo" class="w-4 h-4 rounded-full object-cover ring-1 ring-rose-200" />
                <span class="text-rose-600">STRUKTUR ORGANISASI ANC</span>
                <span class="text-gray-300">•</span>
                <span class="text-gray-500">2026/2027</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-indigo-night tracking-tight font-headline-lg">
                Pengurus &amp; Anggota <span class="text-primary">Aozora Nihongo Club</span>
            </h2>
            <p class="text-on-surface-variant text-sm md:text-base mt-2.5 leading-relaxed max-w-2xl">
                Sinergi siswa-siswi SMKN 1 Purwokerto yang berdedikasi memajukan kegiatan pembelajaran, festival kebudayaan matsuri, dan komunitas kreatif jejepangan.
            </p>
            
            {{-- Quick Summary Stats --}}
            <div class="flex flex-wrap items-center justify-center gap-3 mt-6">
                <div class="px-4 py-2 rounded-xl bg-white border border-gray-200 shadow-xs flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-primary"></span>
                    <span class="text-xs font-bold text-gray-900">{{ $totalPengurus ?? 36 }} Pengurus Aktif</span>
                </div>
                <div class="px-4 py-2 rounded-xl bg-white border border-gray-200 shadow-xs flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    <span class="text-xs font-bold text-gray-900">6 Divisi Peminatan</span>
                </div>
                <div class="px-4 py-2 rounded-xl bg-white border border-gray-200 shadow-xs flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                    <span class="text-xs font-bold text-gray-900">SMKN 1 Purwokerto</span>
                </div>
            </div>
        </div>

        {{-- BPH / PENGURUS INTI (Ketua & Wakil) --}}
        <div class="mb-14">
            <div class="flex items-center gap-2 mb-6">
                <span class="w-1.5 h-5 rounded-full bg-primary"></span>
                <h3 class="text-lg font-bold text-gray-900 font-headline-sm tracking-tight">Badan Pengurus Harian (BPH)</h3>
                <span class="text-xs text-gray-500 font-medium">執行役員</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto mb-6">
                {{-- Ketua Umum Card --}}
                @php
                    $ketua = $pengurusInti['ketua'] ?? null;
                    $wakil = $pengurusInti['wakil'] ?? null;
                @endphp
                <div class="bg-white rounded-2xl p-6 border border-gray-200/90 shadow-sm hover:shadow-md transition-shadow flex items-center gap-5">
                    <div class="relative shrink-0">
                        <img 
                            src="{{ $ketua['avatar'] ?? asset('assets/DSC02070.jpg') }}" 
                            alt="{{ $ketua['nama'] ?? 'Ketua Umum' }}" 
                            class="w-20 h-20 rounded-2xl object-cover ring-2 ring-primary/20 shadow-sm"
                        />
                        <span class="absolute -bottom-1.5 -right-1 px-2 py-0.5 rounded-full bg-primary text-white text-[10px] font-bold shadow-xs">会長</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="inline-flex items-center gap-1.5 self-start px-2.5 py-0.5 rounded-md bg-blue-50 text-primary text-[11px] font-bold mb-1">
                            <span>👑 {{ $ketua['jabatan'] ?? 'Ketua Umum' }}</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 font-headline-sm leading-snug">{{ $ketua['nama'] ?? '-' }}</h4>
                        <span class="text-xs text-gray-500 mt-0.5">Kelas {{ $ketua['kelas'] ?? '-' }} &bull; {{ $ketua['sub_jabatan'] ?? 'Leader' }}</span>
                    </div>
                </div>

                {{-- Wakil Ketua Card --}}
                <div class="bg-white rounded-2xl p-6 border border-gray-200/90 shadow-sm hover:shadow-md transition-shadow flex items-center gap-5">
                    <div class="relative shrink-0">
                        <img 
                            src="{{ $wakil['avatar'] ?? asset('assets/DSC02070.jpg') }}" 
                            alt="{{ $wakil['nama'] ?? 'Wakil Ketua' }}" 
                            class="w-20 h-20 rounded-2xl object-cover ring-2 ring-sky-400/20 shadow-sm"
                        />
                        <span class="absolute -bottom-1.5 -right-1 px-2 py-0.5 rounded-full bg-sky-600 text-white text-[10px] font-bold shadow-xs">副会長</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="inline-flex items-center gap-1.5 self-start px-2.5 py-0.5 rounded-md bg-sky-50 text-sky-700 text-[11px] font-bold mb-1">
                            <span>🤝 {{ $wakil['jabatan'] ?? 'Wakil Ketua' }}</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 font-headline-sm leading-snug">{{ $wakil['nama'] ?? '-' }}</h4>
                        <span class="text-xs text-gray-500 mt-0.5">Kelas {{ $wakil['kelas'] ?? '-' }} &bull; {{ $wakil['sub_jabatan'] ?? 'Vice Leader' }}</span>
                    </div>
                </div>
            </div>

            {{-- Sekretaris, Bendahara, Humas Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Sekretaris --}}
                @foreach(($pengurusInti['sekretaris'] ?? []) as $sek)
                    <div class="bg-white rounded-xl p-4 border border-gray-200 flex items-center gap-3.5 hover:border-indigo-200 transition-colors">
                        <img src="{{ $sek['avatar'] ?? asset('assets/DSC02070.jpg') }}" alt="{{ $sek['nama'] }}" class="w-12 h-12 rounded-xl object-cover ring-1 ring-gray-200 shrink-0" />
                        <div class="flex flex-col min-w-0">
                            <span class="text-[11px] font-bold text-indigo-600 uppercase tracking-wider">{{ $sek['jabatan'] }}</span>
                            <span class="text-sm font-bold text-gray-900 truncate">{{ $sek['nama'] }}</span>
                            <span class="text-xs text-gray-500">Kelas {{ $sek['kelas'] }}</span>
                        </div>
                    </div>
                @endforeach

                {{-- Bendahara --}}
                @foreach(($pengurusInti['bendahara'] ?? []) as $ben)
                    <div class="bg-white rounded-xl p-4 border border-gray-200 flex items-center gap-3.5 hover:border-emerald-200 transition-colors">
                        <img src="{{ $ben['avatar'] ?? asset('assets/DSC02070.jpg') }}" alt="{{ $ben['nama'] }}" class="w-12 h-12 rounded-xl object-cover ring-1 ring-gray-200 shrink-0" />
                        <div class="flex flex-col min-w-0">
                            <span class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">{{ $ben['jabatan'] }}</span>
                            <span class="text-sm font-bold text-gray-900 truncate">{{ $ben['nama'] }}</span>
                            <span class="text-xs text-gray-500">Kelas {{ $ben['kelas'] }}</span>
                        </div>
                    </div>
                @endforeach

                {{-- Humas --}}
                @foreach(($pengurusInti['humas'] ?? []) as $hum)
                    <div class="bg-white rounded-xl p-4 border border-gray-200 flex items-center gap-3.5 hover:border-amber-200 transition-colors">
                        <img src="{{ $hum['avatar'] ?? asset('assets/DSC02070.jpg') }}" alt="{{ $hum['nama'] }}" class="w-12 h-12 rounded-xl object-cover ring-1 ring-gray-200 shrink-0" />
                        <div class="flex flex-col min-w-0">
                            <span class="text-[11px] font-bold text-amber-600 uppercase tracking-wider">{{ $hum['jabatan'] }}</span>
                            <span class="text-sm font-bold text-gray-900 truncate">{{ $hum['nama'] }}</span>
                            <span class="text-xs text-gray-500">Kelas {{ $hum['kelas'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 6 DIVISI & KOORDINATOR --}}
        <div>
            <div class="flex items-center gap-2 mb-6">
                <span class="w-1.5 h-5 rounded-full bg-torii-vermilion"></span>
                <h3 class="text-lg font-bold text-gray-900 font-headline-sm tracking-tight">Divisi Peminatan &amp; Kegiatan</h3>
                <span class="text-xs text-gray-500 font-medium">専門部門</span>
            </div>

            @php
                $divisiMeta = [
                    'Pemateri' => ['icon' => 'menu_book', 'desc' => 'Kaiwa (percakapan), tata bahasa (bunpou), huruf kanji & persiapan JLPT.', 'color' => 'indigo'],
                    'Kegiatan' => ['icon' => 'celebration', 'desc' => 'Perencanaan agenda rutin, matsuri, perayaan bunkasai, & lomba.', 'color' => 'emerald'],
                    'Budaya Bahasa' => ['icon' => 'palette', 'desc' => 'Shodo (kaligrafi), origami, tari tradisional, & eksplorasi budaya.', 'color' => 'rose'],
                    'PDD' => ['icon' => 'photo_camera', 'desc' => 'Dokumentasi visual, fotografi kegiatan, liputan, & arsip event.', 'color' => 'amber'],
                    'Mediakom' => ['icon' => 'campaign', 'desc' => 'Manajemen media sosial, publikasi konten kreatif, & narahubung.', 'color' => 'purple'],
                    'Perkap' => ['icon' => 'inventory_2', 'desc' => 'Inventaris aset properti cosplay, yukata, sound, & perlengkapan klub.', 'color' => 'cyan'],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(['Pemateri', 'Kegiatan', 'Budaya Bahasa', 'PDD', 'Mediakom', 'Perkap'] as $divName)
                    @php
                        $meta = $divisiMeta[$divName] ?? ['icon' => 'groups', 'desc' => '', 'color' => 'blue'];
                        $koors = collect($pengurusInti['koordinator'] ?? [])->where('divisi', $divName)->values();
                        $members = collect($anggotaDivisi[$divName] ?? []);
                    @endphp
                    <div class="bg-white rounded-2xl p-5 border border-gray-200/90 shadow-xs flex flex-col justify-between hover:border-gray-300 transition-all">
                        <div>
                            {{-- Divisi Header --}}
                            <div class="flex items-start justify-between gap-3 mb-3">
                                <div>
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-gray-100 text-gray-800 text-[11px] font-bold mb-1">
                                        <span class="material-symbols-outlined text-xs">{{ $meta['icon'] }}</span>
                                        <span>Divisi {{ $divName }}</span>
                                    </div>
                                    <h4 class="text-base font-bold text-gray-900">{{ $divName }}</h4>
                                </div>
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-md bg-gray-50 text-gray-600 border border-gray-200">
                                    {{ $members->count() + $koors->count() }} orang
                                </span>
                            </div>
                            <p class="text-xs text-gray-600 leading-relaxed mb-4">{{ $meta['desc'] }}</p>

                            {{-- Koordinator Section --}}
                            @if($koors->count() > 0)
                                <div class="mb-3.5 pt-3 border-t border-gray-100">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 block mb-2">Koordinator Bidang:</span>
                                    <div class="space-y-2">
                                        @foreach($koors as $k)
                                            <div class="flex items-center gap-2.5">
                                                <img src="{{ $k['avatar'] ?? asset('assets/DSC02070.jpg') }}" alt="{{ $k['nama'] }}" class="w-8 h-8 rounded-lg object-cover ring-1 ring-gray-200 shrink-0" />
                                                <div class="flex flex-col min-w-0">
                                                    <span class="text-xs font-bold text-gray-900 truncate">{{ $k['nama'] }}</span>
                                                    <span class="text-[11px] text-gray-500">Kelas {{ $k['kelas'] }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Anggota preview avatars --}}
                        @if($members->count() > 0)
                            <div class="pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                                <span>Anggota Aktif:</span>
                                <div class="flex -space-x-2 overflow-hidden">
                                    @foreach($members->take(5) as $m)
                                        <img 
                                            class="inline-block h-6 w-6 rounded-full ring-2 ring-white object-cover" 
                                            src="{{ $m['avatar'] ?? asset('assets/DSC02070.jpg') }}" 
                                            alt="{{ $m['nama'] }}" 
                                            title="{{ $m['nama'] }} (Kelas {{ $m['kelas'] }})"
                                        />
                                    @endforeach
                                    @if($members->count() > 5)
                                        <div class="h-6 w-6 rounded-full bg-gray-200 ring-2 ring-white flex items-center justify-center text-[10px] font-bold text-gray-700">
                                            +{{ $members->count() - 5 }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
