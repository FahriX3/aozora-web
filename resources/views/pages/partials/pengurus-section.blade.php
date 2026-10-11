{{-- SECTION: DAFTAR PENGURUS ORGANISASI AOZORA NIHONGO CLUB --}}
<section class="w-full py-16 md:py-24 bg-transparent border-t border-gray-200/80 relative overflow-hidden" id="pengurus"
    x-data="{
        isModalOpen: false,
        isDivisiModalOpen: false,
        selectedMember: null,
        selectedDivisi: null,
        selectedDivisiMembers: [],
        divisiData: {{ Js::from(array_merge(
            collect($pengurusInti['koordinator'] ?? [])->groupBy('divisi')->map(fn($items) => $items->values()->toArray())->toArray(),
            collect($anggotaDivisi ?? [])->map(fn($items) => $items)->toArray()
        )) }},
        divisiAllMembers: {{ Js::from(
            collect(['Pemateri','Kegiatan','Budaya Bahasa','PDD','Mediakom','Perkap'])->mapWithKeys(function($d) use ($pengurusInti, $anggotaDivisi) {
                $koors = collect($pengurusInti['koordinator'] ?? [])->where('divisi', $d)->values()->map(fn($k) => array_merge($k, ['role_badge' => 'Koordinator', 'kategori' => 'koordinator', 'badge_bg' => 'bg-sky-600', 'badge_style' => 'background-color: #0284c7; color: #ffffff;']))->toArray();
                $members = collect($anggotaDivisi[$d] ?? [])->map(fn($m) => array_merge($m, ['role_badge' => 'Anggota', 'kategori' => 'anggota', 'badge_bg' => 'bg-slate-600', 'badge_style' => 'background-color: #475569; color: #ffffff;']))->toArray();
                return [$d => array_merge($koors, $members)];
            })->toArray()
        ) }},
        openMemberModal(data) {
            this.selectedMember = data;
            this.isModalOpen = true;
            document.body.classList.add('overflow-hidden');
        },
        openDivisiModal(divisiName, members) {
            this.selectedDivisi = divisiName;
            this.selectedDivisiMembers = members;
            this.isDivisiModalOpen = true;
            document.body.classList.add('overflow-hidden');
        },
        closeModal() {
            this.isModalOpen = false;
            this.selectedMember = null;
            if (!this.isDivisiModalOpen) document.body.classList.remove('overflow-hidden');
        },
        closeDivisiModal() {
            this.isDivisiModalOpen = false;
            this.selectedDivisi = null;
            this.selectedDivisiMembers = [];
            if (!this.isModalOpen) document.body.classList.remove('overflow-hidden');
        },
        closeAll() {
            this.isModalOpen = false;
            this.isDivisiModalOpen = false;
            this.selectedMember = null;
            this.selectedDivisi = null;
            this.selectedDivisiMembers = [];
            document.body.classList.remove('overflow-hidden');
        }
    }"
    @keydown.escape.window="closeAll()">

    <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="flex flex-col items-center text-center max-w-3xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-rose-100 shadow-xs text-xs font-bold uppercase tracking-wider mb-3">
                <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Logo" class="w-4 h-4 rounded-full object-cover ring-1 ring-rose-200" />
                <span class="text-rose-600">STRUKTUR ORGANISASI ANC</span>
                <span class="text-gray-300"></span>
                <span class="text-gray-500">2026/2027</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-extrabold text-indigo-night tracking-tight font-headline-lg">
                Pengurus &amp; Anggota <span class="text-primary">Aozora Nihongo Club</span>
            </h2>
            <p class="text-on-surface-variant text-sm md:text-base mt-2.5 leading-relaxed max-w-2xl">
                Siswa-siswi SMKN 1 Purwokerto yang mengelola kegiatan pembelajaran, festival, dan komunitas bahasa Jepang.
            </p>
            
            {{-- Quick Summary Stats --}}
            <div class="flex flex-wrap items-center justify-center gap-3 mt-6">
                <div class="px-4 py-2 rounded-xl bg-white border border-gray-200 shadow-xs flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-primary"></span>
                    <span class="text-xs font-bold text-gray-900">{{ $totalPengurus ?? 36 }} Pengurus Aktif</span>
                </div>
                <div class="px-4 py-2 rounded-xl bg-white border border-gray-200 shadow-xs flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    <span class="text-xs font-bold text-gray-900">6 Divisi</span>
                </div>
                <div class="px-4 py-2 rounded-xl bg-white border border-gray-200 shadow-xs flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                    <span class="text-xs font-bold text-gray-900">SMKN 1 Purwokerto</span>
                </div>
            </div>
        </div>

        {{-- PEMBINA & PELATIH EKSTRAKURIKULER --}}
        @if(!empty($pengurusInti['pembina']) || !empty($pengurusInti['pelatih']))
            @php 
                $pembina = $pengurusInti['pembina'] ?? null;
                $pelatih = $pengurusInti['pelatih'] ?? null;
            @endphp
            <div class="mb-10">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <span class="w-1.5 h-5 rounded-full bg-emerald-600"></span>
                    <h3 class="text-lg font-bold text-gray-900 font-headline-sm tracking-tight">Pembina & Pelatih</h3>
                    <span class="text-xs text-gray-500 font-medium">顧問・指導員</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                    @if($pembina)
                    <div @click="openMemberModal({
                            nama: '{{ addslashes($pembina['nama']) }}',
                            jabatan: '{{ $pembina['jabatan'] }}',
                            sub_jabatan: '{{ $pembina['sub_jabatan'] }}',
                            divisi: 'Pembina Organisasi',
                            kelas: '{{ $pembina['kelas'] }}',
                            avatar: '{{ $pembina['avatar'] }}',
                            role_badge: 'Pembina Ekstrakurikuler',
                            badge_bg: 'bg-emerald-600',
                            badge_style: 'background-color: #059669; color: #ffffff;'
                         })"
                         class="bg-white rounded-2xl p-6 border border-emerald-200/90 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-center gap-5 cursor-pointer group">
                        <div class="relative shrink-0">
                            <img 
                                src="{{ $pembina['avatar'] ?? asset('assets/kepengurusan/kikie_sensei.jpg') }}" 
                                alt="{{ $pembina['nama'] }}" 
                                class="w-20 h-20 rounded-2xl object-cover ring-2 ring-emerald-500/30 shadow-sm group-hover:ring-emerald-500 transition-all"
                            />
                            <span class="absolute -bottom-1.5 -right-1 px-2 py-0.5 rounded-full bg-emerald-600 text-white text-[10px] font-bold shadow-xs">顧問</span>
                        </div>
                        <div class="flex flex-col">
                            <div class="inline-flex items-center gap-1.5 self-start px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[11px] font-bold mb-1">
                                <span>{{ $pembina['jabatan'] }}</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 font-headline-sm leading-snug group-hover:text-emerald-700 transition-colors">{{ $pembina['nama'] }}</h4>
                            <span class="text-xs text-gray-500 mt-0.5">{{ $pembina['kelas'] }} &bull; {{ $pembina['sub_jabatan'] }}</span>
                            <span class="text-[10px] text-emerald-600 font-semibold mt-1.5">Klik untuk detail &rarr;</span>
                        </div>
                    </div>
                    @endif

                    @if($pelatih)
                    <div @click="openMemberModal({
                            nama: '{{ addslashes($pelatih['nama']) }}',
                            jabatan: '{{ $pelatih['jabatan'] }}',
                            sub_jabatan: '{{ $pelatih['sub_jabatan'] }}',
                            divisi: 'Bidang Kepelatihan',
                            kelas: '{{ $pelatih['kelas'] }}',
                            avatar: '{{ $pelatih['avatar'] }}',
                            role_badge: 'Pelatih Ekstrakurikuler',
                            badge_bg: 'bg-emerald-600',
                            badge_style: 'background-color: #059669; color: #ffffff;'
                         })"
                         class="bg-white rounded-2xl p-6 border border-emerald-200/90 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-center gap-5 cursor-pointer group">
                        <div class="relative shrink-0">
                            <img 
                                src="{{ $pelatih['avatar'] ?? asset('assets/kepengurusan/mba_ayu.jpg') }}" 
                                alt="{{ $pelatih['nama'] }}" 
                                class="w-20 h-20 rounded-2xl object-cover ring-2 ring-emerald-500/30 shadow-sm group-hover:ring-emerald-500 transition-all"
                            />
                            <span class="absolute -bottom-1.5 -right-1 px-2 py-0.5 rounded-full bg-emerald-600 text-white text-[10px] font-bold shadow-xs">指導員</span>
                        </div>
                        <div class="flex flex-col">
                            <div class="inline-flex items-center gap-1.5 self-start px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[11px] font-bold mb-1">
                                <span>{{ $pelatih['jabatan'] }}</span>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 font-headline-sm leading-snug group-hover:text-emerald-700 transition-colors">{{ $pelatih['nama'] }}</h4>
                            <span class="text-xs text-gray-500 mt-0.5">{{ $pelatih['kelas'] }} &bull; {{ $pelatih['sub_jabatan'] }}</span>
                            <span class="text-[10px] text-emerald-600 font-semibold mt-1.5">Klik untuk detail &rarr;</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        @endif

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
                <div @click="openMemberModal({
                        nama: '{{ addslashes($ketua['nama'] ?? '') }}',
                        jabatan: '{{ $ketua['jabatan'] ?? 'Ketua Umum' }}',
                        sub_jabatan: '{{ $ketua['sub_jabatan'] ?? '会長' }}',
                        divisi: 'Pengurus Inti (BPH)',
                        kelas: '{{ $ketua['kelas'] ?? '-' }}',
                        avatar: '{{ $ketua['avatar'] ?? '' }}',
                        role_badge: 'Ketua Umum',
                        badge_bg: 'bg-blue-600',
                        badge_style: 'background-color: #2563eb; color: #ffffff;'
                     })"
                     class="bg-white rounded-2xl p-6 border border-gray-200/90 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-center gap-5 cursor-pointer group">
                    <div class="relative shrink-0">
                        <img 
                            src="{{ $ketua['avatar'] ?? asset('assets/kepengurusan/pengurus_dummy.jpg') }}" 
                            alt="{{ $ketua['nama'] ?? 'Ketua Umum' }}" 
                            class="w-20 h-20 rounded-2xl object-cover ring-2 ring-primary/20 shadow-sm group-hover:ring-primary transition-all"
                        />
                        <span class="absolute -bottom-1.5 -right-1 px-2 py-0.5 rounded-full bg-primary text-white text-[10px] font-bold shadow-xs">会長</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="inline-flex items-center gap-1.5 self-start px-2.5 py-0.5 rounded-md bg-blue-50 text-primary text-[11px] font-bold mb-1">
                            <span>{{ $ketua['jabatan'] ?? 'Ketua Umum' }}</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 font-headline-sm leading-snug group-hover:text-primary transition-colors">{{ $ketua['nama'] ?? '-' }}</h4>
                        <span class="text-xs text-gray-500 mt-0.5">Kelas {{ $ketua['kelas'] ?? '-' }} &bull; {{ $ketua['sub_jabatan'] ?? '会長' }}</span>
                        <span class="text-[10px] text-primary font-semibold mt-1.5">Klik untuk detail →</span>
                    </div>
                </div>

                {{-- Wakil Ketua Card --}}
                <div @click="openMemberModal({
                        nama: '{{ addslashes($wakil['nama'] ?? '') }}',
                        jabatan: '{{ $wakil['jabatan'] ?? 'Wakil Ketua' }}',
                        sub_jabatan: '{{ $wakil['sub_jabatan'] ?? '副部長' }}',
                        divisi: 'Pengurus Inti (BPH)',
                        kelas: '{{ $wakil['kelas'] ?? '-' }}',
                        avatar: '{{ $wakil['avatar'] ?? '' }}',
                        role_badge: 'Wakil Ketua',
                        badge_bg: 'bg-sky-600',
                        badge_style: 'background-color: #0284c7; color: #ffffff;'
                     })"
                     class="bg-white rounded-2xl p-6 border border-gray-200/90 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-center gap-5 cursor-pointer group">
                    <div class="relative shrink-0">
                        <img 
                            src="{{ $wakil['avatar'] ?? asset('assets/kepengurusan/pengurus_dummy.jpg') }}" 
                            alt="{{ $wakil['nama'] ?? 'Wakil Ketua' }}" 
                            class="w-20 h-20 rounded-2xl object-cover ring-2 ring-sky-400/20 shadow-sm group-hover:ring-sky-500 transition-all"
                        />
                        <span class="absolute -bottom-1.5 -right-1 px-2 py-0.5 rounded-full bg-sky-600 text-white text-[10px] font-bold shadow-xs">副部長</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="inline-flex items-center gap-1.5 self-start px-2.5 py-0.5 rounded-md bg-sky-50 text-sky-700 text-[11px] font-bold mb-1">
                            <span>{{ $wakil['jabatan'] ?? 'Wakil Ketua' }}</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 font-headline-sm leading-snug group-hover:text-sky-600 transition-colors">{{ $wakil['nama'] ?? '-' }}</h4>
                        <span class="text-xs text-gray-500 mt-0.5">Kelas {{ $wakil['kelas'] ?? '-' }} &bull; {{ $wakil['sub_jabatan'] ?? '副部長' }}</span>
                        <span class="text-[10px] text-sky-600 font-semibold mt-1.5">Klik untuk detail →</span>
                    </div>
                </div>
            </div>

            {{-- Sekretaris, Bendahara, Humas Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Sekretaris --}}
                @foreach(($pengurusInti['sekretaris'] ?? []) as $sek)
                    <div @click="openMemberModal({
                            nama: '{{ addslashes($sek['nama']) }}',
                            jabatan: '{{ $sek['jabatan'] }}',
                            sub_jabatan: 'Pengurus Inti',
                            divisi: 'Sekretaris (BPH)',
                            kelas: '{{ $sek['kelas'] }}',
                            avatar: '{{ $sek['avatar'] }}',
                            role_badge: '{{ $sek['jabatan'] }}',
                            badge_bg: 'bg-indigo-600',
                            badge_style: 'background-color: #4f46e5; color: #ffffff;'
                         })"
                         class="bg-white rounded-xl p-4 border border-gray-200 flex items-center gap-3.5 hover:border-indigo-200 hover:shadow-md transition-all cursor-pointer group">
                        <img src="{{ $sek['avatar'] ?? asset('assets/kepengurusan/pengurus_dummy.jpg') }}" alt="{{ $sek['nama'] }}" class="w-12 h-12 rounded-xl object-cover ring-1 ring-gray-200 shrink-0 group-hover:ring-indigo-300 transition-all" />
                        <div class="flex flex-col min-w-0">
                            <span class="text-[11px] font-bold text-indigo-600 uppercase tracking-wider">{{ $sek['jabatan'] }}</span>
                            <span class="text-sm font-bold text-gray-900 truncate">{{ $sek['nama'] }}</span>
                            <span class="text-xs text-gray-500">Kelas {{ $sek['kelas'] }}</span>
                        </div>
                    </div>
                @endforeach

                {{-- Bendahara --}}
                @foreach(($pengurusInti['bendahara'] ?? []) as $ben)
                    <div @click="openMemberModal({
                            nama: '{{ addslashes($ben['nama']) }}',
                            jabatan: '{{ $ben['jabatan'] }}',
                            sub_jabatan: 'Pengurus Inti',
                            divisi: 'Bendahara (BPH)',
                            kelas: '{{ $ben['kelas'] }}',
                            avatar: '{{ $ben['avatar'] }}',
                            role_badge: '{{ $ben['jabatan'] }}',
                            badge_bg: 'bg-emerald-600',
                            badge_style: 'background-color: #059669; color: #ffffff;'
                         })"
                         class="bg-white rounded-xl p-4 border border-gray-200 flex items-center gap-3.5 hover:border-emerald-200 hover:shadow-md transition-all cursor-pointer group">
                        <img src="{{ $ben['avatar'] ?? asset('assets/kepengurusan/pengurus_dummy.jpg') }}" alt="{{ $ben['nama'] }}" class="w-12 h-12 rounded-xl object-cover ring-1 ring-gray-200 shrink-0 group-hover:ring-emerald-300 transition-all" />
                        <div class="flex flex-col min-w-0">
                            <span class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">{{ $ben['jabatan'] }}</span>
                            <span class="text-sm font-bold text-gray-900 truncate">{{ $ben['nama'] }}</span>
                            <span class="text-xs text-gray-500">Kelas {{ $ben['kelas'] }}</span>
                        </div>
                    </div>
                @endforeach

                {{-- Humas --}}
                @foreach(($pengurusInti['humas'] ?? []) as $hum)
                    <div @click="openMemberModal({
                            nama: '{{ addslashes($hum['nama']) }}',
                            jabatan: '{{ $hum['jabatan'] }}',
                            sub_jabatan: 'Pengurus Inti',
                            divisi: 'Humas (Hubungan Masyarakat)',
                            kelas: '{{ $hum['kelas'] }}',
                            avatar: '{{ $hum['avatar'] }}',
                            role_badge: '{{ $hum['jabatan'] }}',
                            badge_bg: 'bg-amber-600',
                            badge_style: 'background-color: #d97706; color: #ffffff;'
                         })"
                         class="bg-white rounded-xl p-4 border border-gray-200 flex items-center gap-3.5 hover:border-amber-200 hover:shadow-md transition-all cursor-pointer group">
                        <img src="{{ $hum['avatar'] ?? asset('assets/kepengurusan/pengurus_dummy.jpg') }}" alt="{{ $hum['nama'] }}" class="w-12 h-12 rounded-xl object-cover ring-1 ring-gray-200 shrink-0 group-hover:ring-amber-300 transition-all" />
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
                        $allDivMembers = $koors->map(fn($k) => array_merge($k, ['role_badge' => 'Koordinator', 'badge_bg' => 'bg-sky-600', 'kategori' => 'koordinator']))
                            ->concat($members->map(fn($m) => array_merge($m, ['role_badge' => 'Anggota '.$divName, 'badge_bg' => 'bg-gray-700', 'kategori' => 'anggota'])))
                            ->values()->toArray();
                    @endphp
                    <div @click="openDivisiModal('{{ $divName }}', {{ Js::from($allDivMembers) }})"
                         class="bg-white rounded-2xl p-5 border border-gray-200/90 shadow-xs flex flex-col justify-between hover:border-gray-300 hover:shadow-md hover:-translate-y-0.5 transition-all cursor-pointer group">
                        <div>
                            {{-- Divisi Header --}}
                            <div class="flex items-start justify-between gap-3 mb-3">
                                <div>
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-gray-100 text-gray-800 text-[11px] font-bold mb-1">
                                        <span class="material-symbols-outlined text-xs">{{ $meta['icon'] }}</span>
                                        <span>Divisi {{ $divName }}</span>
                                    </div>
                                    <h4 class="text-base font-bold text-gray-900 group-hover:text-primary transition-colors">{{ $divName }}</h4>
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
                                                <img src="{{ $k['avatar'] ?? asset('assets/kepengurusan/pengurus_dummy.jpg') }}" alt="{{ $k['nama'] }}" class="w-8 h-8 rounded-lg object-cover ring-1 ring-gray-200 shrink-0" />
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

                        {{-- Anggota preview avatars + CTA --}}
                        <div class="pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                            <div class="flex -space-x-2 overflow-hidden">
                                @foreach($members->take(5) as $m)
                                    <img 
                                        class="inline-block h-6 w-6 rounded-full ring-2 ring-white object-cover" 
                                        src="{{ $m['avatar'] ?? asset('assets/kepengurusan/pengurus_dummy.jpg') }}" 
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
                            <span class="text-[10px] text-primary font-semibold group-hover:underline">Lihat anggota →</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ===== DIVISI MEMBER LIST MODAL ===== --}}
    <template x-teleport="body">
        <div x-show="isDivisiModalOpen"
             x-cloak
             style="position: fixed; inset: 0; z-index: 9999;"
             class="fixed inset-0 flex items-end sm:items-center justify-center p-0 sm:p-4 overflow-hidden"
             role="dialog"
             aria-modal="true"
             @click.self="closeDivisiModal()"
             @keydown.escape.window="closeDivisiModal()">

            {{-- Backdrop --}}
            <div x-show="isDivisiModalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="closeDivisiModal()"
                 class="fixed inset-0 bg-slate-950/70 backdrop-blur-md cursor-pointer"
                 aria-hidden="true"></div>

            {{-- Modal Card --}}
            <div x-show="isDivisiModalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
                 @click.stop
                 class="relative w-full max-w-lg sm:max-w-xl bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl border border-gray-200 overflow-hidden z-10 max-h-[85vh] sm:max-h-[80vh] flex flex-col cursor-default">

                {{-- Modal Header --}}
                <div class="h-20 bg-gradient-to-r from-blue-700 via-indigo-600 to-sky-500 relative flex items-center justify-between px-5 shrink-0">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/25 backdrop-blur-sm text-white text-[11px] font-bold tracking-wider uppercase mb-0.5">
                            <span>Anggota Divisi</span>
                        </div>
                        <h3 class="text-white text-lg font-black tracking-tight" x-text="'Divisi ' + selectedDivisi"></h3>
                    </div>
                    <button @click="closeDivisiModal()"
                            type="button"
                            class="w-9 h-9 rounded-full bg-black/30 hover:bg-black/50 text-white flex items-center justify-center transition-all focus:outline-none focus:ring-2 focus:ring-white/50 cursor-pointer shrink-0"
                            aria-label="Tutup daftar anggota divisi"
                            title="Tutup (Esc)">
                        <span class="text-xl font-bold leading-none">✕</span>
                    </button>
                </div>

                {{-- Member Count Strip --}}
                <div class="px-5 py-2.5 bg-gray-50 border-b border-gray-200 flex items-center justify-between shrink-0">
                    <span class="text-xs text-gray-600 font-medium">
                        <span class="font-bold text-gray-900" x-text="selectedDivisiMembers.length"></span> anggota (2 Koordinator teratas)
                    </span>
                    <span class="text-[10px] text-gray-400">Scroll untuk lihat semua</span>
                </div>

                {{-- Scrollable Member Grid: 2 columns so top row contains the 2 koordinator --}}
                <div class="overflow-y-auto flex-1 p-5">
                    <div class="grid grid-cols-2 gap-3.5">
                        <template x-for="(m, i) in selectedDivisiMembers" :key="i">
                            <div @click="closeDivisiModal(); $nextTick(() => openMemberModal(m))"
                                 class="group rounded-xl p-4 border transition-all cursor-pointer flex flex-col items-center text-center"
                                 :class="m.kategori === 'koordinator'
                                     ? 'bg-sky-50/50 border-sky-300 shadow-xs hover:border-sky-400 hover:shadow-md'
                                     : 'bg-white border-gray-200 hover:border-blue-400 hover:shadow-md'">
                                <img :src="m.avatar" :alt="m.nama"
                                     class="w-14 h-14 rounded-full object-cover ring-2 transition-all shadow-sm mb-2"
                                     :class="m.kategori === 'koordinator' ? 'ring-sky-400 group-hover:ring-sky-500' : 'ring-gray-100 group-hover:ring-blue-400'">
                                <span class="text-xs font-bold text-gray-900 group-hover:text-primary transition-colors line-clamp-2 leading-tight" x-text="m.nama"></span>
                                <span class="text-[10px] text-gray-500 mt-0.5" x-text="m.kelas"></span>
                                <span class="mt-2 px-2.5 py-0.5 rounded-full text-[10px] font-bold"
                                      :class="m.kategori === 'koordinator' ? 'bg-sky-100 text-sky-800 border border-sky-300' : 'bg-gray-100 text-gray-600'"
                                      x-text="m.kategori === 'koordinator' ? 'Koordinator' : 'Anggota'">
                                </span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </template>

    {{-- ===== INDIVIDUAL MEMBER MODAL ===== --}}
    <template x-teleport="body">
        <div x-show="isModalOpen"
             x-cloak
             style="position: fixed; inset: 0; z-index: 9999;"
             class="fixed inset-0 flex items-center justify-center p-4 sm:p-6 overflow-y-auto"
             role="dialog"
             aria-modal="true"
             @click.self="closeModal()"
             @keydown.escape.window="closeModal()">

            {{-- Backdrop --}}
            <div x-show="isModalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="closeModal()"
                 class="fixed inset-0 bg-slate-950/70 backdrop-blur-md cursor-pointer"
                 aria-hidden="true"></div>

            {{-- Modal Card --}}
            <div x-show="isModalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 @click.stop
                 class="relative w-full max-w-lg bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden z-10 my-8 cursor-default">

                {{-- Decorative Top Gradient --}}
                <div class="h-28 bg-gradient-to-r from-blue-700 via-indigo-600 to-sky-500 relative flex items-start justify-between p-4">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/25 backdrop-blur-sm text-white text-[11px] font-bold tracking-wider uppercase">
                        <span>Biodata Pengurus Aozora</span>
                    </div>
                    <button @click="closeModal()"
                            type="button"
                            class="w-9 h-9 rounded-full bg-black/30 hover:bg-black/50 text-white flex items-center justify-center transition-all focus:outline-none focus:ring-2 focus:ring-white/50 cursor-pointer"
                            aria-label="Tutup popup biodata"
                            title="Tutup (Esc)">
                        <span class="text-xl font-bold leading-none">✕</span>
                    </button>
                </div>

                <template x-if="selectedMember">
                    <div class="px-6 pb-6 pt-0 relative">
                        {{-- Avatar overlapping header --}}
                        <div class="flex justify-center -mt-16 mb-4">
                            <div class="relative">
                                <img :src="selectedMember.avatar"
                                     :alt="selectedMember.nama"
                                     class="w-28 h-28 sm:w-32 sm:h-32 rounded-full object-cover ring-4 ring-white shadow-xl bg-white">
                                <div class="absolute bottom-1 right-1 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs shadow-md border-2 border-white font-bold">
                                    <span class="material-symbols-outlined text-sm">person</span>
                                </div>
                            </div>
                        </div>

                        {{-- Name & Badges --}}
                        <div class="text-center mb-6">
                            <h3 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight leading-snug" x-text="selectedMember.nama"></h3>
                            <div class="flex flex-wrap items-center justify-center gap-2 mt-2">
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold text-white shadow-sm"
                                      :class="selectedMember.badge_bg || 'bg-blue-600'"
                                      :style="selectedMember.badge_style || ''"
                                      x-text="selectedMember.role_badge">
                                </span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700"
                                      x-text="selectedMember.sub_jabatan || 'Pengurus'">
                                </span>
                            </div>
                        </div>

                        {{-- Biodata Grid --}}
                        <div class="bg-gray-50 rounded-2xl p-4 sm:p-5 border border-gray-100 space-y-3">
                            <div class="text-xs font-bold uppercase tracking-wider text-gray-400 pb-2 border-b border-gray-200 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm text-blue-600">badge</span>
                                <span>Informasi Biodata Pengurus</span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-2xs">
                                    <span class="text-gray-500 block text-[11px] mb-0.5">Nama Lengkap</span>
                                    <span class="font-bold text-gray-900 text-sm" x-text="selectedMember.nama"></span>
                                </div>
                                <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-2xs">
                                    <span class="text-gray-500 block text-[11px] mb-0.5">Jabatan / Role</span>
                                    <span class="font-bold text-blue-600 text-sm" x-text="selectedMember.jabatan"></span>
                                </div>
                                <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-2xs">
                                    <span class="text-gray-500 block text-[11px] mb-0.5">Divisi / Bidang</span>
                                    <span class="font-bold text-gray-900" x-text="selectedMember.divisi"></span>
                                </div>
                                <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-2xs">
                                    <span class="text-gray-500 block text-[11px] mb-0.5" x-text="(selectedMember.kategori === 'pembina' || selectedMember.kategori === 'pelatih' || selectedMember.divisi === 'Pembina' || selectedMember.divisi === 'Pelatih' || selectedMember.divisi === 'Pembina Organisasi' || selectedMember.divisi === 'Bidang Kepelatihan') ? 'Status Keanggotaan' : 'Kelas / Jurusan'">Kelas / Jurusan</span>
                                    <span class="font-bold text-gray-900" x-text="selectedMember.kelas"></span>
                                </div>
                                <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-2xs"
                                     :class="(selectedMember.kategori === 'pembina' || selectedMember.kategori === 'pelatih' || selectedMember.divisi === 'Pembina' || selectedMember.divisi === 'Pelatih' || selectedMember.divisi === 'Pembina Organisasi' || selectedMember.divisi === 'Bidang Kepelatihan' || selectedMember.sub_jabatan === '顧問' || selectedMember.sub_jabatan === '指導員') ? 'sm:col-span-2' : ''">
                                    <span class="text-gray-500 block text-[11px] mb-0.5">Organisasi</span>
                                    <span class="font-bold text-gray-900">Aozora Nihongo Club</span>
                                </div>
                                <template x-if="!(selectedMember.kategori === 'pembina' || selectedMember.kategori === 'pelatih' || selectedMember.divisi === 'Pembina' || selectedMember.divisi === 'Pelatih' || selectedMember.divisi === 'Pembina Organisasi' || selectedMember.divisi === 'Bidang Kepelatihan' || selectedMember.sub_jabatan === '顧問' || selectedMember.sub_jabatan === '指導員')">
                                    <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-2xs">
                                        <span class="text-gray-500 block text-[11px] mb-0.5">Masa Bakti</span>
                                        <span class="font-bold text-emerald-600">Periode 2026 / 2027</span>
                                    </div>
                                </template>
                            </div>

                            <div class="pt-2 text-[11px] text-gray-500 flex items-center justify-between border-t border-gray-200/60">
                                <span>SMK Negeri 1 Purwokerto</span>
                                <span class="text-gray-400">Aozora Nihongo Club</span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </template>

</section>
