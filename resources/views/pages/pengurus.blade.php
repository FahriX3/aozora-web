<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/ANC_icon.png') }}">
    <title>Struktur Pengurus Organisasi - Aozora Nihongo Club</title>

    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">

    <!-- Stylesheets & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind Config & CDN Fallback for complete visual fidelity -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface": "#f6f9fe",
                        "surface-container-low": "#f1f4f9",
                        "surface-container": "#ebeef3",
                        "surface-container-high": "#e5e8ed",
                        "cloud-white": "#FFFFFF",
                        "indigo-night": "#0B1021",
                        "aozora-sky": "#38BDF8",
                        "torii-vermilion": "#E83A30",
                        "sakura-tint": "#FDE8E8",
                        "gold-shrine": "#F59E0B",
                        "primary": "#0043c0",
                        "primary-container": "#0d59f2",
                        "secondary": "#595d74",
                        "secondary-container": "#dde1fc",
                        "on-surface": "#181c20",
                        "on-surface-variant": "#434655"
                    },
                    fontFamily: {
                        "display-hero": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-md": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-sm": ["Plus Jakarta Sans", "sans-serif"],
                        "body-lg": ["Be Vietnam Pro", "sans-serif"],
                        "body-md": ["Be Vietnam Pro", "sans-serif"],
                        "body-sm": ["Be Vietnam Pro", "sans-serif"],
                        "label-lg": ["Space Grotesk", "sans-serif"],
                        "label-md": ["Space Grotesk", "sans-serif"],
                        "label-badge": ["Space Grotesk", "sans-serif"]
                    },
                    spacing: {
                        "margin-mobile": "1.25rem",
                        "space-xs": "0.25rem",
                        "space-xl": "2.5rem",
                        "space-2xl": "4rem",
                        "space-lg": "1.5rem",
                        "margin": "3rem",
                        "gutter-mobile": "0.875rem",
                        "space-sm": "0.5rem",
                        "gutter": "1.5rem",
                        "space-md": "1rem"
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js CDN fallback in case Vite server isn't running -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        @layer base {
            html, body {
                margin: 0;
                padding: 0;
            }
            body {
                overscroll-behavior: none;
            }
        }
        [x-cloak] { display: none !important; }
        .nav-link.active {
            color: #0043c0;
            font-weight: 600;
            position: relative;
        }
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #0043c0;
        }
    </style>
</head>
<body class="bg-white font-body-md text-body-md text-gray-900 dark:bg-gray-900 dark:text-white antialiased selection:bg-aozora-sky selection:text-indigo-night min-h-screen flex flex-col"
      x-data="{
          isModalOpen: false,
          isDivisiModalOpen: false,
          selectedMember: null,
          selectedDivisi: null,
          selectedDivisiMembers: [],
          activeTab: 'Semua',
          searchQuery: '',
          divisiAllMembers: {{ Js::from(
              collect(['Pemateri','Kegiatan','Budaya Bahasa','PDD','Mediakom','Perkap'])->mapWithKeys(function($d) use ($pengurusInti, $anggotaDivisi) {
                  $koors = collect($pengurusInti['koordinator'] ?? [])->where('divisi', $d)->values()->map(fn($k) => array_merge($k, ['role_badge' => 'Koordinator '.$d, 'badge_bg' => 'bg-sky-600', 'kategori' => 'koordinator', 'sub_jabatan' => 'Koordinator Bidang', 'divisi' => 'Divisi '.$d]))->toArray();
                  $members = collect($anggotaDivisi[$d] ?? [])->map(fn($m) => array_merge($m, ['role_badge' => 'Anggota '.$d, 'badge_bg' => 'bg-gray-700', 'kategori' => 'anggota', 'sub_jabatan' => 'Anggota Aktif', 'divisi' => 'Divisi '.$d]))->toArray();
                  return [$d => array_merge($koors, $members)];
              })->toArray()
          ) }},
          openModal(data) {
              this.selectedMember = data;
              this.isModalOpen = true;
              document.body.classList.add('overflow-hidden');
          },
          openDivisiModal(divisiName) {
              this.selectedDivisi = divisiName;
              this.selectedDivisiMembers = this.divisiAllMembers[divisiName] || [];
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
          },
          allMembers: {{ Js::from($allMembers) }},
          get filteredMembers() {
              const q = this.searchQuery.trim().toLowerCase();
              return this.allMembers.filter(m => {
                  const matchTab = (this.activeTab === 'Semua') 
                      || (m.divisi.toLowerCase() === this.activeTab.toLowerCase())
                      || (this.activeTab === 'Pengurus Inti' && (m.divisi.toLowerCase() === 'pembina' || m.divisi.toLowerCase() === 'pelatih'));
                  
                  const matchSearch = !q 
                      || m.nama.toLowerCase().includes(q) 
                      || m.kelas.toLowerCase().includes(q) 
                      || m.jabatan.toLowerCase().includes(q) 
                      || m.divisi.toLowerCase().includes(q)
                      || (m.sub_jabatan && m.sub_jabatan.toLowerCase().includes(q));
                  
                  return matchTab && matchSearch;
              });
          },
          countByTab(tabName) {
              if (tabName === 'Semua') return this.allMembers.length;
              if (tabName === 'Pengurus Inti') {
                  return this.allMembers.filter(m => m.divisi.toLowerCase() === 'pengurus inti' || m.divisi.toLowerCase() === 'pembina' || m.divisi.toLowerCase() === 'pelatih').length;
              }
              return this.allMembers.filter(m => m.divisi.toLowerCase() === tabName.toLowerCase()).length;
          },
          resetFilters() {
              this.activeTab = 'Semua';
              this.searchQuery = '';
          }
      }"
      @open-modal.window="openModal($event.detail)"
      @keydown.escape.window="closeAll()">

    <!-- HEADER & NAVBAR -->
    <header
        class="fixed top-0 left-0 w-full z-50 bg-cloud-white/90 backdrop-blur-xl shadow-[0_4px_20px_-2px_rgba(13,89,242,0.06)]"
    >
        <div
            class="h-20 max-w-[1280px] mx-auto px-margin-mobile md:px-margin flex items-center justify-between gap-space-md"
        >
            <div class="flex items-center gap-space-md">
                <a
                    class="flex items-center gap-space-sm group"
                    data-path="beranda"
                    href="{{ route('home') }}"
                ><div
                    class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary font-headline-md text-headline-md shadow-[0_2px_10px_rgba(13,89,242,0.12)] group-hover:scale-105 transition-transform"
                >
                    <span class="text-torii-vermilion">青</span><span class="text-aozora-sky">空</span>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-space-xs">
                        <span
                            class="font-headline-sm text-headline-sm tracking-tight text-indigo-night"
                        >Aozora</span><span
                            class="font-label-badge text-label-badge px-1.5 py-0.5 rounded-full bg-sakura-tint text-torii-vermilion"
                        >日本語部</span>
                    </div>
                    <span
                        class="font-label-md text-label-md text-secondary tracking-wider uppercase"
                    >SMKN 1 Purwokerto</span>
                </div></a>
            </div>
            <nav
                class="hidden lg:flex items-center gap-space-lg"
                data-active-classes="text-primary font-semibold relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-full after:h-0.5 after:bg-primary"
            >
                <a
                    class="nav-link font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors"
                    data-target="beranda"
                    href="{{ route('home') }}"
                >Beranda</a><a
                    class="nav-link font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors"
                    data-target="tentang"
                    href="{{ route('home') }}#tentang"
                >Tentang Kami</a><a
                    class="nav-link font-label-lg text-label-lg transition-colors text-on-surface-variant hover:text-on-surface"
                    data-target="event"
                    href="{{ route('events.index') }}"
                >Event &amp; Matsuri</a><a
                    class="nav-link font-label-lg text-label-lg transition-colors active"
                    data-target="pengurus"
                    href="{{ route('pengurus') }}"
                >Daftar Pengurus</a><a
                    class="nav-link font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors"
                    data-target="kontak"
                    href="{{ route('home') }}#kontak"
                >Kontak</a>
            </nav>
            <div class="flex items-center gap-space-md">
                <img
                    alt="Profile"
                    class="w-8 h-8 rounded-full object-cover shadow-[0_2px_8px_rgba(13,89,242,0.15)]"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDe_57QRBxcPOxYpvoRkSSUOgH3K1ldKLCAAaYxfqzhuBIlPdMwKPITA2FIlP0xftYt--7X0loUMNwZ3T9pulWmnG7VAMJ8nmf0Mp3aTJ6os01vkE0OvrX_iO1kRs0RDhqlXwPpl4Ml0xCGRXfQS7jdEdDo9TB2Dllwrv5QjGy2VIHvbP1RYVt0cM680j6nLbITW4yZn8WUyuEtBYx5aysZQlq8S0jg7y_N6BRIYSJYRFAStambE6vz"
                />
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="w-full pt-20 flex-1 bg-white dark:bg-gray-900">
        <!-- Hero Container (Clean Pure White Background) -->
        <div class="w-full bg-white dark:bg-gray-900">
            <!-- HERO HEADER CONTAINER -->
            <section class="max-w-[1280px] mx-auto px-4 md:px-8 pt-10 pb-8">
                <!-- Breadcrumbs & Badge -->
                <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                    <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                        <a href="/" class="hover:text-primary transition-colors">Beranda</a>
                        <span>/</span>
                        <span class="text-gray-900 dark:text-white font-semibold">Struktur Pengurus Organisasi</span>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-300 font-bold text-xs tracking-wider uppercase border border-blue-200 dark:border-blue-800">
                        <span class="w-2 h-2 rounded-full bg-torii-vermilion animate-ping"></span>
                        <span>Periode Aktif 2026 / 2027</span>
                    </div>
                </div>

                <!-- Title Banner Card -->
                <div class="relative rounded-2xl bg-white dark:bg-gray-800 p-6 md:p-8 shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
                        <div class="max-w-3xl">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-sakura-tint text-torii-vermilion text-xs font-bold mb-3">
                                <span> STRUKTUR KEPENGURUSAN</span>
                                <span></span>
                                <span>組織体制</span>
                            </div>
                            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight leading-tight">
                                Pengurus &amp; Anggota <span class="text-primary">Aozora Nihongo Club</span>
                            </h1>
                            <p class="text-gray-600 dark:text-gray-300 text-sm md:text-base mt-2 leading-relaxed">
                                Sinergi dedikasi siswa-siswi SMKN 1 Purwokerto dalam memajukan eksplorasi bahasa Jepang, festival matsuri, seni pop-culture, dan kebersamaan komunitas.
                            </p>
                        </div>

                        <!-- Stat Pills Strip -->
                        <div class="flex items-center gap-3 self-stretch md:self-auto shrink-0">
                            <div class="flex-1 md:flex-none p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 text-center border border-gray-200 dark:border-gray-600">
                                <span class="block text-2xl font-extrabold text-primary dark:text-aozora-sky">{{ $totalPengurus }}</span>
                                <span class="text-[11px] uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">Total Pengurus</span>
                            </div>
                            <div class="flex-1 md:flex-none p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 text-center border border-gray-200 dark:border-gray-600">
                                <span class="block text-2xl font-extrabold text-torii-vermilion">{{ $totalInti }}</span>
                                <span class="text-[11px] uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">Pengurus Inti</span>
                            </div>
                            <div class="flex-1 md:flex-none p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 text-center border border-gray-200 dark:border-gray-600">
                                <span class="block text-2xl font-extrabold text-gray-900 dark:text-white">6</span>
                                <span class="text-[11px] uppercase tracking-wider font-semibold text-gray-500 dark:text-gray-400">Divisi Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- ========================================================= -->
        <!-- FILTER & SEARCH TOOLBAR (GLOBAL FOR ALL 52 MEMBERS)       -->
        <!-- ========================================================= -->
        <section class="max-w-[1280px] mx-auto px-4 md:px-8 -mt-2 mb-6">
            <div class="rounded-2xl bg-white dark:bg-gray-800 p-5 md:p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <!-- Row 1: Heading & Live Search Input -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-5 border-b border-gray-100 dark:border-gray-700/60">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-600 animate-pulse"></span>
                            <h3 class="text-base md:text-lg font-bold text-gray-900 dark:text-white">
                                Filter &amp; Pencarian Pengurus
                            </h3>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                            Cari dan saring 52 pengurus (Pengurus Inti &amp; seluruh Anggota Divisi) secara instan
                        </p>
                    </div>

                    <!-- Search Input Box -->
                    <div class="w-full md:w-80 relative">
                        <input type="text"
                               x-model="searchQuery"
                               placeholder="Cari nama, kelas, jabatan, atau divisi..."
                               class="w-full pl-10 pr-9 py-2.5 rounded-xl text-xs bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white dark:focus:bg-gray-800 shadow-xs transition-all">
                        <span class="material-symbols-outlined text-gray-400 absolute left-3 top-2.5 text-lg">
                            search
                        </span>
                        <button x-show="searchQuery.length > 0"
                                @click="searchQuery = ''"
                                class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-xs cursor-pointer"
                                title="Hapus pencarian">
                            ✕
                        </button>
                    </div>
                </div>

                <!-- Row 2: Category Filter Tabs -->
                <div class="pt-5">
                    <div class="flex flex-wrap items-center gap-2">
                        <!-- Tab: Semua -->
                        <button @click="activeTab = 'Semua'"
                                :class="activeTab === 'Semua' 
                                    ? 'bg-blue-600 text-white shadow-md font-bold ring-2 ring-blue-600/30' 
                                    : 'bg-gray-100 dark:bg-gray-700/70 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 font-medium'"
                                class="px-3.5 py-2 rounded-xl text-xs transition-all duration-200 flex items-center gap-2 cursor-pointer">
                            <span>Semua Pengurus</span>
                            <span class="px-1.5 py-0.5 rounded-full text-[10px]"
                                  :class="activeTab === 'Semua' ? 'bg-white/20 text-white' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 shadow-2xs'"
                                  x-text="countByTab('Semua')">
                                52
                            </span>
                        </button>

                        <!-- Tab: Pengurus Inti -->
                        <button @click="activeTab = 'Pengurus Inti'"
                                :class="activeTab === 'Pengurus Inti' 
                                    ? 'bg-blue-600 text-white shadow-md font-bold ring-2 ring-blue-600/30' 
                                    : 'bg-gray-100 dark:bg-gray-700/70 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 font-medium'"
                                class="px-3.5 py-2 rounded-xl text-xs transition-all duration-200 flex items-center gap-2 cursor-pointer">
                            <span>Pengurus Inti (BPH)</span>
                            <span class="px-1.5 py-0.5 rounded-full text-[10px]"
                                  :class="activeTab === 'Pengurus Inti' ? 'bg-white/20 text-white' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 shadow-2xs'"
                                  x-text="countByTab('Pengurus Inti')">
                                8
                            </span>
                        </button>

                        <!-- Tabs: 6 Divisi -->
                        @foreach(['Pemateri', 'Kegiatan', 'Budaya Bahasa', 'PDD', 'Mediakom', 'Perkap'] as $divisiName)
                        <button @click="activeTab = '{{ $divisiName }}'"
                                :class="activeTab === '{{ $divisiName }}' 
                                    ? 'bg-blue-600 text-white shadow-md font-bold ring-2 ring-blue-600/30' 
                                    : 'bg-gray-100 dark:bg-gray-700/70 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 font-medium'"
                                class="px-3.5 py-2 rounded-xl text-xs transition-all duration-200 flex items-center gap-2 cursor-pointer">
                            <span>{{ $divisiName }}</span>
                            <span class="px-1.5 py-0.5 rounded-full text-[10px]"
                                  :class="activeTab === '{{ $divisiName }}' ? 'bg-white/20 text-white' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 shadow-2xs'"
                                  x-text="countByTab('{{ $divisiName }}')">
                            </span>
                        </button>
                        @endforeach
                    </div>
                </div>

                <!-- Row 3: Active Filter Status Strip -->
                <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700/60 flex flex-wrap items-center justify-between gap-3 text-xs text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm text-blue-600">tune</span>
                        <span>
                            Menampilkan <strong class="text-gray-900 dark:text-white" x-text="filteredMembers.length"></strong> dari 52 pengurus
                            <span x-show="activeTab !== 'Semua'">pada divisi/kategori <strong class="text-blue-600 dark:text-sky-400" x-text="activeTab"></strong></span>
                            <span x-show="searchQuery">dengan kata kunci "<strong class="text-blue-600 dark:text-sky-400" x-text="searchQuery"></strong>"</span>
                        </span>
                    </div>

                    <!-- Reset button when filter is active -->
                    <button x-show="activeTab !== 'Semua' || searchQuery.length > 0"
                            @click="resetFilters()"
                            class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-sky-400 hover:underline font-semibold cursor-pointer">
                        <span class="material-symbols-outlined text-sm">restart_alt</span>
                        <span>Reset Filter (Tampilkan Semua)</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- WRAPPER TAMPILAN LENGKAP DEFAULT (HANYA AKTIF SAAT BELUM DIFILTER) -->
        <div x-show="activeTab === 'Semua' && searchQuery.trim().length === 0">
            <!-- ========================================================= -->
            <!-- BAGIAN 1: PENGURUS INTI (HIERARKI ORGANISASI) -->
            <!-- ========================================================= -->
            <section class="max-w-[1280px] mx-auto px-4 md:px-8 py-10 bg-white dark:bg-gray-900">
                <!-- Section Header -->
                <div class="flex flex-col items-center text-center max-w-xl mx-auto mb-10">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-950 dark:text-blue-300 mb-2">
                        Bagan Hierarki
                    </span>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white tracking-tight">
                    Pengurus Inti &amp; Koordinator
                </h2>
                <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Jajaran kepemimpinan organisasi, pengarah kebijakan, dan koordinator bidang
                </p>
                <div class="w-16 h-1 bg-gradient-to-r from-primary to-aozora-sky rounded-full mt-3"></div>
            </div>

            <div class="flex flex-col items-center gap-10">
                
                <!-- ---------------------------------------------------- -->
                <!-- BARIS 0: PEMBINA & PELATIH EKSTRAKURIKULER -->
                <!-- ---------------------------------------------------- -->
                @if(!empty($pengurusInti['pembina']) || !empty($pengurusInti['pelatih']))
                <div class="w-full flex flex-wrap justify-center gap-6 max-w-3xl">
                    @if(!empty($pengurusInti['pembina']))
                    <div @click="$dispatch('open-modal', {
                            nama: '{{ addslashes($pengurusInti['pembina']['nama']) }}',
                            jabatan: '{{ $pengurusInti['pembina']['jabatan'] }}',
                            sub_jabatan: '{{ $pengurusInti['pembina']['sub_jabatan'] }}',
                            divisi: 'Pembina Organisasi',
                            kelas: '{{ $pengurusInti['pembina']['kelas'] }}',
                            avatar: '{{ $pengurusInti['pembina']['avatar'] }}',
                            role_badge: 'Pembina Ekstrakurikuler',
                            badge_bg: 'bg-emerald-600',
                            badge_style: 'background-color: #059669; color: #ffffff;'
                         })"
                         class="group relative w-full sm:w-[calc(50%-0.75rem)] max-w-sm rounded-2xl bg-white dark:bg-gray-800 pt-7 pb-6 px-6 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 border-2 border-emerald-600 dark:border-emerald-500 text-center cursor-pointer">
                        <!-- Top Floating Badge Pembina -->
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full text-xs font-extrabold tracking-wider uppercase shadow-lg flex items-center gap-1.5 z-30 whitespace-nowrap"
                             style="background-color: #059669; color: #ffffff !important; box-shadow: 0 4px 14px rgba(5, 150, 105, 0.45);">
                            <span style="color: #ffffff !important;">PEMBINA EKSTRAKURIKULER</span>
                        </div>

                        <!-- Profile Avatar -->
                        <div class="relative w-24 h-24 mx-auto mt-1 mb-4">
                            <img src="{{ $pengurusInti['pembina']['avatar'] }}" alt="{{ $pengurusInti['pembina']['nama'] }}"
                                 class="w-full h-full rounded-full object-cover ring-4 ring-emerald-500/30 group-hover:ring-emerald-600 transition-all shadow-md">
                        </div>

                        <!-- Member Info -->
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 transition-colors">
                            {{ $pengurusInti['pembina']['nama'] }}
                        </h3>
                        <div class="mt-1 mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 dark:bg-emerald-950 dark:text-emerald-300 dark:border-emerald-800">
                                {{ $pengurusInti['pembina']['jabatan'] }} &bull; {{ $pengurusInti['pembina']['sub_jabatan'] }}
                            </span>
                        </div>
                        <div class="inline-block mt-1 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs font-medium">
                            <span class="font-bold text-gray-900 dark:text-white">{{ $pengurusInti['pembina']['kelas'] }}</span>
                        </div>
                    </div>
                    @endif

                    @if(!empty($pengurusInti['pelatih']))
                    <div @click="$dispatch('open-modal', {
                            nama: '{{ addslashes($pengurusInti['pelatih']['nama']) }}',
                            jabatan: '{{ $pengurusInti['pelatih']['jabatan'] }}',
                            sub_jabatan: '{{ $pengurusInti['pelatih']['sub_jabatan'] }}',
                            divisi: 'Bidang Kepelatihan',
                            kelas: '{{ $pengurusInti['pelatih']['kelas'] }}',
                            avatar: '{{ $pengurusInti['pelatih']['avatar'] }}',
                            role_badge: 'Pelatih Ekstrakurikuler',
                            badge_bg: 'bg-emerald-600',
                            badge_style: 'background-color: #059669; color: #ffffff;'
                         })"
                         class="group relative w-full sm:w-[calc(50%-0.75rem)] max-w-sm rounded-2xl bg-white dark:bg-gray-800 pt-7 pb-6 px-6 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 border-2 border-emerald-600 dark:border-emerald-500 text-center cursor-pointer">
                        <!-- Top Floating Badge Pelatih -->
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full text-xs font-extrabold tracking-wider uppercase shadow-lg flex items-center gap-1.5 z-30 whitespace-nowrap"
                             style="background-color: #059669; color: #ffffff !important; box-shadow: 0 4px 14px rgba(5, 150, 105, 0.45);">
                            <span style="color: #ffffff !important;">PELATIH EKSTRAKURIKULER</span>
                        </div>

                        <!-- Profile Avatar -->
                        <div class="relative w-24 h-24 mx-auto mt-1 mb-4">
                            <img src="{{ $pengurusInti['pelatih']['avatar'] }}" alt="{{ $pengurusInti['pelatih']['nama'] }}"
                                 class="w-full h-full rounded-full object-cover ring-4 ring-emerald-500/30 group-hover:ring-emerald-600 transition-all shadow-md">
                        </div>

                        <!-- Member Info -->
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 transition-colors">
                            {{ $pengurusInti['pelatih']['nama'] }}
                        </h3>
                        <div class="mt-1 mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 dark:bg-emerald-950 dark:text-emerald-300 dark:border-emerald-800">
                                {{ $pengurusInti['pelatih']['jabatan'] }} &bull; {{ $pengurusInti['pelatih']['sub_jabatan'] }}
                            </span>
                        </div>
                        <div class="inline-block mt-1 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs font-medium">
                            <span class="font-bold text-gray-900 dark:text-white">{{ $pengurusInti['pelatih']['kelas'] }}</span>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Connecting Line Visual -->
                <div class="w-0.5 h-6 bg-gray-200 dark:bg-gray-700 -my-4"></div>
                @endif

                <!-- ---------------------------------------------------- -->
                <!-- BARIS 1: KETUA (CENTER) -->
                <!-- ---------------------------------------------------- -->
                <div class="w-full flex justify-center">
                    <div @click="$dispatch('open-modal', {
                            nama: '{{ addslashes($pengurusInti['ketua']['nama']) }}',
                            jabatan: '{{ $pengurusInti['ketua']['jabatan'] }}',
                            sub_jabatan: '{{ $pengurusInti['ketua']['sub_jabatan'] }}',
                            divisi: 'Pengurus Inti (BPH)',
                            kelas: '{{ $pengurusInti['ketua']['kelas'] }}',
                            avatar: '{{ $pengurusInti['ketua']['avatar'] }}',
                            role_badge: 'Ketua Umum',
                            badge_bg: 'bg-blue-600',
                            badge_style: 'background-color: #2563eb; color: #ffffff;'
                         })"
                         class="group relative w-full max-w-sm rounded-2xl bg-white dark:bg-gray-800 pt-7 pb-6 px-6 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 border-2 border-blue-600 dark:border-blue-500 text-center cursor-pointer">
                        <!-- Top Floating Badge Ketua -->
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-5 py-1 rounded-full text-xs font-extrabold tracking-wider uppercase shadow-lg flex items-center gap-1.5 z-30"
                             style="background-color: #0043c0; color: #ffffff !important; box-shadow: 0 4px 14px rgba(0, 67, 192, 0.45);">
                            <span style="color: #ffffff !important;">KETUA UMUM</span>
                        </div>

                        <!-- Profile Avatar -->
                        <div class="relative w-24 h-24 mx-auto mt-1 mb-4">
                            <img src="{{ $pengurusInti['ketua']['avatar'] }}" alt="{{ $pengurusInti['ketua']['nama'] }}"
                                 class="w-full h-full rounded-full object-cover ring-4 ring-blue-500/30 group-hover:ring-blue-600 transition-all shadow-md">
                        </div>

                        <!-- Member Info -->
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-blue-600 transition-colors">
                            {{ $pengurusInti['ketua']['nama'] }}
                        </h3>
                        <div class="mt-1 mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold text-blue-700 bg-blue-50 border border-blue-200 dark:bg-blue-950 dark:text-blue-300 dark:border-blue-800">
                                Ketua Umum &bull; 会長
                            </span>
                        </div>
                        <div class="inline-block mt-1 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs font-medium">
                            Kelas: <span class="font-bold text-gray-900 dark:text-white">{{ $pengurusInti['ketua']['kelas'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Connecting Line Visual -->
                <div class="w-0.5 h-6 bg-gray-200 dark:bg-gray-700 -my-4"></div>

                <!-- ---------------------------------------------------- -->
                <!-- BARIS 2: WAKIL KETUA (CENTER) -->
                <!-- ---------------------------------------------------- -->
                <div class="w-full flex justify-center">
                    <div @click="$dispatch('open-modal', {
                            nama: '{{ addslashes($pengurusInti['wakil']['nama']) }}',
                            jabatan: '{{ $pengurusInti['wakil']['jabatan'] }}',
                            sub_jabatan: '{{ $pengurusInti['wakil']['sub_jabatan'] }}',
                            divisi: 'Pengurus Inti (BPH)',
                            kelas: '{{ $pengurusInti['wakil']['kelas'] }}',
                            avatar: '{{ $pengurusInti['wakil']['avatar'] }}',
                            role_badge: 'Wakil Ketua',
                            badge_bg: 'bg-sky-600',
                            badge_style: 'background-color: #0284c7; color: #ffffff;'
                         })"
                         class="group relative w-full max-w-sm rounded-2xl bg-white dark:bg-gray-800 pt-7 pb-6 px-6 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 border-2 border-sky-500 dark:border-sky-400 text-center cursor-pointer">
                        <!-- Top Floating Badge Wakil -->
                        <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-5 py-1 rounded-full text-xs font-extrabold tracking-wider uppercase shadow-lg flex items-center gap-1.5 z-30"
                             style="background-color: #0284c7; color: #ffffff !important; box-shadow: 0 4px 14px rgba(2, 132, 199, 0.45);">
                            <span style="color: #ffffff !important;">WAKIL KETUA</span>
                        </div>

                        <!-- Profile Avatar -->
                        <div class="relative w-20 h-20 mx-auto mt-1 mb-4">
                            <img src="{{ $pengurusInti['wakil']['avatar'] }}" alt="{{ $pengurusInti['wakil']['nama'] }}"
                                 class="w-full h-full rounded-full object-cover ring-4 ring-sky-400/30 group-hover:ring-sky-500 transition-all shadow-md">
                        </div>

                        <!-- Member Info -->
                        <h3 class="text-base font-bold text-gray-900 dark:text-white group-hover:text-sky-600 transition-colors">
                            {{ $pengurusInti['wakil']['nama'] }}
                        </h3>
                        <div class="mt-1 mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold text-sky-700 bg-sky-50 border border-sky-200 dark:bg-sky-950 dark:text-sky-300 dark:border-sky-800">
                                Wakil Ketua &bull; 副部長
                            </span>
                        </div>
                        <div class="inline-block mt-1 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs font-medium">
                            Kelas: <span class="font-bold text-gray-900 dark:text-white">{{ $pengurusInti['wakil']['kelas'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Connecting Line Visual -->
                <div class="w-0.5 h-6 bg-gray-200 dark:bg-gray-700 -my-4"></div>

                <!-- ---------------------------------------------------- -->
                <!-- BARIS 3: BENDAHARA & SEKRETARIS (GRID 2/4 KOLOM) -->
                <!-- ---------------------------------------------------- -->
                <div class="w-full max-w-5xl">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Sub-grup Sekretaris -->
                        <div class="rounded-2xl bg-gray-50 dark:bg-gray-800/40 p-5 border border-gray-200 dark:border-gray-700/60">
                            <div class="flex items-center justify-center gap-2 mb-4">
                                <span class="material-symbols-outlined text-sm text-primary">edit_note</span>
                                <span class="text-xs font-bold uppercase tracking-wider text-gray-900 dark:text-white">Sekretaris</span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($pengurusInti['sekretaris'] as $sekretaris)
                                <div @click="$dispatch('open-modal', {
                                        nama: '{{ addslashes($sekretaris['nama']) }}',
                                        jabatan: '{{ $sekretaris['jabatan'] }}',
                                        sub_jabatan: 'Pengurus Inti',
                                        divisi: 'Sekretaris (BPH)',
                                        kelas: '{{ $sekretaris['kelas'] }}',
                                        avatar: '{{ $sekretaris['avatar'] }}',
                                        role_badge: '{{ $sekretaris['jabatan'] }}',
                                        badge_bg: 'bg-indigo-600'
                                     })"
                                     class="group rounded-xl bg-white dark:bg-gray-800 p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-gray-200 dark:border-gray-700 text-center flex flex-col items-center cursor-pointer">
                                    <img src="{{ $sekretaris['avatar'] }}" alt="{{ $sekretaris['nama'] }}"
                                         class="w-16 h-16 rounded-full object-cover ring-2 ring-indigo-200 dark:ring-indigo-800 group-hover:ring-primary transition-all shadow-sm mb-3">
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors line-clamp-1">
                                        {{ $sekretaris['nama'] }}
                                    </h4>
                                    <span class="inline-block mt-1 text-[11px] font-semibold text-primary dark:text-aozora-sky bg-blue-50 dark:bg-blue-950 px-2 py-0.5 rounded-full border border-blue-100 dark:border-blue-900">
                                        {{ $sekretaris['jabatan'] }}
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $sekretaris['kelas'] }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Sub-grup Bendahara -->
                        <div class="rounded-2xl bg-gray-50 dark:bg-gray-800/40 p-5 border border-gray-200 dark:border-gray-700/60">
                            <div class="flex items-center justify-center gap-2 mb-4">
                                <span class="material-symbols-outlined text-sm text-emerald-600">payments</span>
                                <span class="text-xs font-bold uppercase tracking-wider text-gray-900 dark:text-white">Bendahara</span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($pengurusInti['bendahara'] as $bendahara)
                                <div @click="$dispatch('open-modal', {
                                        nama: '{{ addslashes($bendahara['nama']) }}',
                                        jabatan: '{{ $bendahara['jabatan'] }}',
                                        sub_jabatan: 'Pengurus Inti',
                                        divisi: 'Bendahara (BPH)',
                                        kelas: '{{ $bendahara['kelas'] }}',
                                        avatar: '{{ $bendahara['avatar'] }}',
                                        role_badge: '{{ $bendahara['jabatan'] }}',
                                        badge_bg: 'bg-emerald-600'
                                     })"
                                     class="group rounded-xl bg-white dark:bg-gray-800 p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-gray-200 dark:border-gray-700 text-center flex flex-col items-center cursor-pointer">
                                    <img src="{{ $bendahara['avatar'] }}" alt="{{ $bendahara['nama'] }}"
                                         class="w-16 h-16 rounded-full object-cover ring-2 ring-emerald-200 dark:ring-emerald-800 group-hover:ring-emerald-500 transition-all shadow-sm mb-3">
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors line-clamp-1">
                                        {{ $bendahara['nama'] }}
                                    </h4>
                                    <span class="inline-block mt-1 text-[11px] font-semibold text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 px-2 py-0.5 rounded-full border border-emerald-100 dark:border-emerald-900">
                                        {{ $bendahara['jabatan'] }}
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $bendahara['kelas'] }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Connecting Line Visual -->
                <div class="w-0.5 h-6 bg-gray-200 dark:bg-gray-700 -my-4"></div>

                <!-- ---------------------------------------------------- -->
                <!-- BARIS 4: HUMAS (CENTER / 2 KARTU) -->
                <!-- ---------------------------------------------------- -->
                <div class="w-full max-w-2xl">
                    <div class="rounded-2xl bg-gray-50 dark:bg-gray-800/40 p-5 border border-gray-200 dark:border-gray-700/60">
                        <div class="flex items-center justify-center gap-2 mb-4">
                            <span class="text-sm"></span>
                            <span class="text-xs font-bold uppercase tracking-wider text-gray-900 dark:text-white">Hubungan Masyarakat (Humas)</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($pengurusInti['humas'] as $humas)
                            <div @click="$dispatch('open-modal', {
                                    nama: '{{ addslashes($humas['nama']) }}',
                                    jabatan: '{{ $humas['jabatan'] }}',
                                    sub_jabatan: 'Pengurus Inti',
                                    divisi: 'Humas (Hubungan Masyarakat)',
                                    kelas: '{{ $humas['kelas'] }}',
                                    avatar: '{{ $humas['avatar'] }}',
                                    role_badge: '{{ $humas['jabatan'] }}',
                                    badge_bg: 'bg-amber-600'
                                 })"
                                 class="group rounded-xl bg-white dark:bg-gray-800 p-4 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-gray-200 dark:border-gray-700 text-center flex flex-col items-center cursor-pointer">
                                <img src="{{ $humas['avatar'] }}" alt="{{ $humas['nama'] }}"
                                     class="w-16 h-16 rounded-full object-cover ring-2 ring-amber-200 dark:ring-amber-800 group-hover:ring-amber-500 transition-all shadow-sm mb-3">
                                <h4 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors line-clamp-1">
                                    {{ $humas['nama'] }}
                                </h4>
                                <span class="inline-block mt-1 text-[11px] font-semibold text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/60 px-2 py-0.5 rounded-full border border-amber-100 dark:border-amber-900">
                                    {{ $humas['jabatan'] }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $humas['kelas'] }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Connecting Line Visual -->
                <div class="w-0.5 h-6 bg-gray-200 dark:bg-gray-700 -my-4"></div>

                <!-- ---------------------------------------------------- -->
                <!-- BARIS 5: SELURUH KOORDINATOR DIVISI (GRID 4-6 KOLOM) -->
                <!-- ---------------------------------------------------- -->
                <div class="w-full">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-torii-vermilion"></span>
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">
                                Koordinator Divisi (12 Orang)
                            </h3>
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">
                            6 Divisi  Masing-masing 2 Koordinator
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                        @foreach($pengurusInti['koordinator'] as $koor)
                        <div @click="$dispatch('open-modal', {
                                nama: '{{ addslashes($koor['nama']) }}',
                                jabatan: '{{ $koor['jabatan'] }}',
                                sub_jabatan: 'Koordinator Bidang',
                                divisi: 'Divisi {{ $koor['divisi'] }}',
                                kelas: '{{ $koor['kelas'] }}',
                                avatar: '{{ $koor['avatar'] }}',
                                role_badge: 'Koordinator {{ $koor['divisi'] }}',
                                badge_bg: 'bg-blue-600'
                             })"
                             class="group rounded-xl bg-white dark:bg-gray-800 p-4 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 border border-gray-200 dark:border-gray-700 flex flex-col justify-between text-center relative overflow-hidden cursor-pointer">
                            <!-- Top Decorative Color Strip based on Division -->
                            <div class="w-full h-1 absolute top-0 left-0 bg-primary group-hover:h-1.5 transition-all"></div>

                            <div>
                                <div class="relative w-16 h-16 mx-auto mb-3">
                                    <img src="{{ $koor['avatar'] }}" alt="{{ $koor['nama'] }}"
                                         class="w-full h-full rounded-full object-cover ring-2 ring-gray-100 dark:ring-gray-700 group-hover:ring-primary transition-all shadow-sm">
                                    <span class="absolute -bottom-1 -right-1 px-1.5 py-0.2 rounded-full bg-gray-900 text-white text-[9px] font-bold">
                                        Koor
                                    </span>
                                </div>

                                <h4 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors line-clamp-1" title="{{ $koor['nama'] }}">
                                    {{ $koor['nama'] }}
                                </h4>
                                <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[10px] font-bold {{ $koor['tag_color'] }}">
                                    {{ $koor['divisi'] }}
                                </span>
                            </div>

                            <div class="mt-3 pt-2 border-t border-gray-100 dark:border-gray-700/60 flex items-center justify-between text-[11px] text-gray-500 dark:text-gray-400">
                                <span>Kelas:</span>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $koor['kelas'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </section>

        <!-- ========================================================= -->
        <!-- BAGIAN 2: DAFTAR ANGGOTA DIVISI (CARDS PER DIVISI)        -->
        <!-- ========================================================= -->
        <section class="w-full bg-white dark:bg-gray-900 py-14 border-t border-gray-100 dark:border-gray-800">
            <div class="max-w-[1280px] mx-auto px-4 md:px-8">
                <!-- Section Header -->
                <div class="flex flex-col items-center text-center max-w-xl mx-auto mb-10">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-950 dark:text-blue-300 mb-2">
                        Anggota Divisi
                    </span>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white tracking-tight">
                        6 Divisi Kegiatan ANC
                    </h2>
                    <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400 mt-1">
                        {{ $totalAnggota }} anggota aktif — klik kartu divisi untuk lihat seluruh anggotanya
                    </p>
                    <div class="w-16 h-1 bg-gradient-to-r from-primary to-aozora-sky rounded-full mt-3"></div>
                </div>

                <!-- DIVISI CARDS GRID -->
                @php
                    $divisiMeta2 = [
                        'Pemateri'     => ['icon' => 'menu_book',   'desc' => 'Kaiwa, bunpou, kanji & persiapan JLPT.',              'grad' => 'from-indigo-600 to-blue-500'],
                        'Kegiatan'     => ['icon' => 'celebration', 'desc' => 'Agenda rutin, matsuri & perayaan bunkasai.',          'grad' => 'from-emerald-600 to-teal-500'],
                        'Budaya Bahasa'=> ['icon' => 'palette',     'desc' => 'Shodo, origami, tari tradisional & budaya Jepang.',  'grad' => 'from-rose-600 to-pink-500'],
                        'PDD'          => ['icon' => 'photo_camera','desc' => 'Dokumentasi, fotografi kegiatan & arsip event.',     'grad' => 'from-amber-600 to-yellow-500'],
                        'Mediakom'     => ['icon' => 'campaign',    'desc' => 'Media sosial, konten kreatif & narahubung.',          'grad' => 'from-purple-600 to-violet-500'],
                        'Perkap'       => ['icon' => 'inventory_2', 'desc' => 'Inventaris properti cosplay, yukata & perlengkapan.','grad' => 'from-cyan-600 to-sky-500'],
                    ];
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach(['Pemateri','Kegiatan','Budaya Bahasa','PDD','Mediakom','Perkap'] as $divName)
                        @php
                            $dm = $divisiMeta2[$divName] ?? ['icon'=>'groups','desc'=>'','grad'=>'from-blue-600 to-sky-500'];
                            $koors2 = collect($pengurusInti['koordinator'] ?? [])->where('divisi', $divName)->values();
                            $mems2  = collect($anggotaDivisi[$divName] ?? []);
                            $total2 = $koors2->count() + $mems2->count();
                        @endphp
                        <div @click="openDivisiModal('{{ $divName }}')"
                             class="group relative bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden cursor-pointer">
                            <!-- Color accent top bar -->
                            <div class="h-1.5 w-full bg-gradient-to-r {{ $dm['grad'] }} group-hover:h-2 transition-all"></div>

                            <div class="p-5">
                                <!-- Header -->
                                <div class="flex items-start justify-between gap-3 mb-3">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br {{ $dm['grad'] }} flex items-center justify-center shadow-sm">
                                            <span class="material-symbols-outlined text-white text-base">{{ $dm['icon'] }}</span>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-black text-gray-900 dark:text-white group-hover:text-primary transition-colors">{{ $divName }}</h4>
                                            <span class="text-[10px] text-gray-500 dark:text-gray-400">Divisi Peminatan</span>
                                        </div>
                                    </div>
                                    <span class="shrink-0 text-xs font-bold px-2.5 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                        {{ $total2 }} orang
                                    </span>
                                </div>

                                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed mb-4">{{ $dm['desc'] }}</p>

                                <!-- Koordinator preview -->
                                @if($koors2->count() > 0)
                                <div class="mb-3 pb-3 border-b border-gray-100 dark:border-gray-700/60">
                                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider block mb-1.5">Koordinator:</span>
                                    <div class="flex items-center gap-1.5">
                                        @foreach($koors2 as $k2)
                                        <div class="flex items-center gap-1.5">
                                            <img src="{{ $k2['avatar'] }}" alt="{{ $k2['nama'] }}" class="w-6 h-6 rounded-full object-cover ring-1 ring-gray-200">
                                            <span class="text-[11px] font-semibold text-gray-700 dark:text-gray-300 truncate max-w-[100px]">{{ $k2['nama'] }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <!-- Member avatars stack + CTA -->
                                <div class="flex items-center justify-between">
                                    <div class="flex -space-x-2">
                                        @foreach($mems2->take(6) as $m2)
                                        <img class="w-7 h-7 rounded-full ring-2 ring-white dark:ring-gray-800 object-cover"
                                             src="{{ $m2['avatar'] }}" alt="{{ $m2['nama'] }}" title="{{ $m2['nama'] }}">
                                        @endforeach
                                        @if($mems2->count() > 6)
                                        <div class="w-7 h-7 rounded-full bg-gray-200 dark:bg-gray-600 ring-2 ring-white dark:ring-gray-800 flex items-center justify-center text-[9px] font-black text-gray-700 dark:text-gray-300">
                                            +{{ $mems2->count() - 6 }}
                                        </div>
                                        @endif
                                    </div>
                                    <span class="text-[11px] text-primary dark:text-aozora-sky font-bold group-hover:underline">Lihat semua →</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <!-- END WRAPPER DEFAULT VIEW -->

    <!-- ========================================================= -->
    <!-- BAGIAN 3: HASIL FILTER & PENCARIAN (GLOBAL DARI 52 ORANG) -->
    <!-- ========================================================= -->
    <section x-show="activeTab !== 'Semua' || searchQuery.trim().length > 0"
             x-cloak
             class="max-w-[1280px] mx-auto px-4 md:px-8 py-10 min-h-[850px]">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 pb-4 border-b border-gray-200 dark:border-gray-800">
            <div>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-300 font-bold text-xs mb-1 border border-blue-200 dark:border-blue-800">
                    <span>🔍 HASIL FILTER &amp; PENCARIAN</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white tracking-tight">
                    <span x-text="activeTab !== 'Semua' ? (activeTab === 'Pengurus Inti' ? 'Pengurus Inti (BPH)' : 'Divisi ' + activeTab) : 'Hasil Pencarian Pengurus'"></span>
                </h2>
                <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Menemukan <strong class="text-blue-600 dark:text-sky-400" x-text="filteredMembers.length"></strong> pengurus
                    <span x-show="activeTab !== 'Semua'">pada kategori <strong class="text-gray-900 dark:text-white" x-text="activeTab"></strong></span>
                    <span x-show="searchQuery">dengan kata kunci "<strong class="text-gray-900 dark:text-white" x-text="searchQuery"></strong>"</span>
                </p>
            </div>

            <button @click="resetFilters()"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors cursor-pointer self-start sm:self-auto shadow-2xs">
                <span class="material-symbols-outlined text-sm">restart_alt</span>
                <span>Reset Filter (Kembali ke Struktur Penuh)</span>
            </button>
        </div>

        <!-- GRID KARTU PENGURUS TERFILTER -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            <template x-for="(member, index) in filteredMembers" :key="member.nama + index">
                <div @click="openModal(member)"
                     class="group rounded-2xl bg-white dark:bg-gray-800 p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-200 dark:border-gray-700 flex flex-col justify-between relative overflow-hidden cursor-pointer">
                    
                    <!-- Top line accent color based on role -->
                    <div class="w-full h-1.5 absolute top-0 left-0"
                         :class="member.kategori === 'inti' 
                             ? 'bg-blue-600' 
                             : (member.kategori === 'koordinator' ? 'bg-sky-500' : 'bg-gray-300 dark:bg-gray-600')">
                    </div>

                    <div>
                        <div class="flex items-start gap-3.5">
                            <!-- Avatar -->
                            <div class="relative shrink-0">
                                <img :src="member.avatar" :alt="member.nama"
                                     class="w-14 h-14 rounded-full object-cover ring-2 ring-gray-100 dark:ring-gray-700 group-hover:ring-blue-600 transition-all shadow-sm">
                                <span x-show="member.kategori === 'inti'"
                                      class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-blue-600 text-white flex items-center justify-center text-[10px] shadow" title="Pengurus Inti">
                                    ★
                                </span>
                                <span x-show="member.kategori === 'koordinator'"
                                      class="absolute -bottom-1 -right-1 px-1 py-0.2 rounded-full bg-sky-600 text-white text-[9px] font-black shadow" title="Koordinator">
                                    Koor
                                </span>
                            </div>

                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-blue-600 transition-colors truncate"
                                    :title="member.nama"
                                    x-text="member.nama">
                                </h4>
                                <span class="inline-block mt-0.5 text-xs font-semibold text-gray-500 dark:text-gray-400"
                                      x-text="member.kelas">
                                </span>
                                <div class="mt-1.5">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold"
                                          :class="member.kategori === 'inti' 
                                              ? 'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-950 dark:text-blue-300 dark:border-blue-800' 
                                              : (member.kategori === 'koordinator' 
                                                  ? 'bg-sky-50 text-sky-700 border border-sky-200 dark:bg-sky-950 dark:text-sky-300 dark:border-sky-800' 
                                                  : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300')"
                                          x-text="member.role_badge">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700/60 flex items-center justify-between text-xs">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300"
                              x-text="member.divisi">
                        </span>
                        <span class="text-[11px] text-blue-600 dark:text-sky-400 font-medium group-hover:underline">
                            Lihat Biodata →
                        </span>
                    </div>
                </div>
            </template>
        </div>

        <!-- EMPTY STATE WHEN NO SEARCH RESULTS -->
        <div x-show="filteredMembers.length === 0" class="py-24 text-center">
            <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 mx-auto flex items-center justify-center text-gray-400 mb-3">
                <span class="material-symbols-outlined text-2xl">person_search</span>
            </div>
            <h3 class="text-base font-bold text-gray-900 dark:text-white">Tidak Ada Pengurus Ditemukan</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 max-w-sm mx-auto">
                Tidak ditemukan pengurus dengan kata kunci atau filter yang dipilih. Silakan coba kata kunci lain.
            </p>
            <button @click="resetFilters()"
                    class="mt-4 px-4 py-2 rounded-xl bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 transition-colors cursor-pointer">
                Reset Filter
            </button>
        </div>
    </section>
    </main>

    <!-- FOOTER (MATCHING SITE THEME) -->
    <footer class="w-full bg-indigo-night text-cloud-white pt-12 pb-8 relative overflow-hidden border-t border-indigo-900/40">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 pb-10">
                <!-- Col 1 -->
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-cloud-white/10 flex items-center justify-center font-bold text-aozora-sky">青</div>
                        <span class="font-bold text-lg tracking-tight text-cloud-white">Aozora Nihongo</span>
                    </div>
                    <p class="text-xs text-surface-dim leading-relaxed">
                        Ekstrakurikuler Bahasa dan Kebudayaan Jepang di SMKN 1 Purwokerto. Ruang eksplorasi bahasa, anime culture, kaiwa, cosplay, dan matsuri berprestasi.
                    </p>
                    <div class="inline-flex items-center gap-1.5 self-start px-3 py-1 rounded-full bg-cloud-white/10 text-aozora-sky text-[11px] font-bold">
                        <span>PURWOKERTO JAPANESE CLUB</span>
                    </div>
                </div>

                <!-- Col 2 -->
                <div class="flex flex-col gap-2">
                    <span class="font-bold text-sm text-cloud-white flex items-center gap-1.5">
                        <span></span> Pertemuan Rutin
                    </span>
                    <div class="p-3.5 rounded-xl bg-cloud-white/5 flex flex-col gap-1 text-xs">
                        <span class="text-aozora-sky font-bold">Setiap Kamis  16.00 - 17.00 WIB</span>
                        <span class="text-surface-dim">Ruang Kelas SMKN 1 Purwokerto</span>
                    </div>
                </div>

                <!-- Col 3 -->
                <div class="flex flex-col gap-2 text-xs">
                    <span class="font-bold text-sm text-cloud-white">Sekretariat</span>
                    <span class="text-surface-dim">SMK Negeri 1 Purwokerto</span>
                    <span class="text-surface-dim">Jl. Dr. Soeparno No. 29, Karangwangkal</span>
                    <span class="text-surface-dim">Purwokerto Timur, Banyumas 53123</span>
                </div>

                <!-- Col 4 -->
                <div class="flex flex-col gap-2">
                    <span class="font-bold text-sm text-cloud-white">Navigasi Halaman</span>
                    <div class="flex flex-col gap-1.5 text-xs text-surface-dim">
                        <a href="/" class="hover:text-aozora-sky transition-colors">Beranda</a>
                        <a href="{{ route('pengurus') }}" class="text-aozora-sky font-semibold">Struktur Pengurus Organisasi</a>
                        <a href="/#event" class="hover:text-aozora-sky transition-colors">Event &amp; Matsuri</a>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-surface-dim">
                <span>© {{ date('Y') }} Aozora Nihongo Club SMKN 1 Purwokerto. All rights reserved.</span>
            </div>
        </div>
    </footer>

    <!-- ========================================================= -->
    <!-- DIVISI MEMBER LIST MODAL                                  -->
    <!-- ========================================================= -->
    <template x-teleport="body">
        <div x-show="isDivisiModalOpen"
             x-cloak
             style="position: fixed; inset: 0; z-index: 9999;"
             class="fixed inset-0 flex items-end sm:items-center justify-center p-0 sm:p-4 overflow-hidden"
             role="dialog"
             aria-modal="true"
             @click.self="closeDivisiModal()"
             @keydown.escape.window="closeDivisiModal()">

            <!-- Backdrop -->
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

            <!-- Modal Card -->
            <div x-show="isDivisiModalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
                 @click.stop
                 class="relative w-full max-w-lg sm:max-w-xl bg-white dark:bg-gray-800 rounded-t-3xl sm:rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden z-10 max-h-[85vh] sm:max-h-[80vh] flex flex-col cursor-default">

                <!-- Header -->
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

                <!-- Count strip -->
                <div class="px-5 py-2.5 bg-gray-50 dark:bg-gray-900/60 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between shrink-0">
                    <span class="text-xs text-gray-600 dark:text-gray-400 font-medium">
                        <span class="font-bold text-gray-900 dark:text-white" x-text="selectedDivisiMembers.length"></span> anggota — klik kartu untuk detail lengkap
                    </span>
                    <span class="text-[10px] text-gray-400">Scroll untuk lihat semua</span>
                </div>

                <!-- Scrollable member grid: 2 columns so top row contains the 2 koordinator -->
                <div class="overflow-y-auto flex-1 p-5">
                    <div class="grid grid-cols-2 gap-3.5">
                        <template x-for="(m, i) in selectedDivisiMembers" :key="i">
                            <div @click="closeDivisiModal(); $nextTick(() => openModal(m))"
                                 class="group rounded-xl p-4 border transition-all cursor-pointer flex flex-col items-center text-center"
                                 :class="m.kategori === 'koordinator'
                                     ? 'bg-sky-50/50 dark:bg-sky-950/25 border-sky-300 dark:border-sky-600 shadow-xs hover:border-sky-400 hover:shadow-md'
                                     : 'bg-white dark:bg-gray-700 border-gray-200 dark:border-gray-600 hover:border-blue-400 hover:shadow-md'">
                                <img :src="m.avatar" :alt="m.nama"
                                     class="w-14 h-14 rounded-full object-cover ring-2 transition-all shadow-sm mb-2"
                                     :class="m.kategori === 'koordinator' ? 'ring-sky-400 dark:ring-sky-500 group-hover:ring-sky-500' : 'ring-gray-100 dark:ring-gray-600 group-hover:ring-blue-400'">
                                <span class="text-xs font-bold text-gray-900 dark:text-white group-hover:text-primary dark:group-hover:text-aozora-sky transition-colors line-clamp-2 leading-tight" x-text="m.nama"></span>
                                <span class="text-[10px] text-gray-500 dark:text-gray-400 mt-0.5" x-text="m.kelas"></span>
                                <span class="mt-2 px-2.5 py-0.5 rounded-full text-[10px] font-bold"
                                      :class="m.kategori === 'koordinator' ? 'bg-sky-100 text-sky-800 border border-sky-300 dark:bg-sky-900/60 dark:text-sky-300 dark:border-sky-700' : 'bg-gray-100 text-gray-600 dark:bg-gray-600 dark:text-gray-300'"
                                      x-text="m.kategori === 'koordinator' ? 'Koordinator' : 'Anggota'">
                                </span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- ========================================================= -->
    <!-- MODAL POPUP BIODATA PENGURUS                              -->
    <!-- ========================================================= -->
    <template x-teleport="body">
        <div x-show="isModalOpen"
             x-cloak
             style="position: fixed; inset: 0; z-index: 9999;"
             class="fixed inset-0 flex items-center justify-center p-4 sm:p-6 overflow-y-auto"
             role="dialog"
             aria-modal="true"
             @click.self="closeModal()"
             @keydown.escape.window="closeModal()">

            <!-- 1. BACKDROP OVERLAY WITH BLUR (CLICK MANA SAJA TO CLOSE) -->
            <div x-show="isModalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="closeModal()"
                 class="fixed inset-0 bg-slate-950/70 backdrop-blur-md cursor-pointer"
                 aria-hidden="true">
            </div>

            <!-- 2. MODAL CARD CONTAINER (@click.stop prevents closing when clicking inside) -->
            <div x-show="isModalOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 @click.stop
                 class="relative w-full max-w-lg bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden z-10 my-8 cursor-default">

                <!-- Decorative Top Gradient Accent Header -->
                <div class="h-28 bg-gradient-to-r from-blue-700 via-indigo-600 to-sky-500 relative flex items-start justify-between p-4">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/25 backdrop-blur-sm text-white text-[11px] font-bold tracking-wider uppercase">
                        <span>Biodata Pengurus Aozora</span>
                    </div>

                    <!-- Tombol Silang (Close Button) -->
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
                        <!-- Photo Avatar (Overlapping Header) -->
                        <div class="flex justify-center -mt-16 mb-4">
                            <div class="relative">
                                <img :src="selectedMember.avatar"
                                     :alt="selectedMember.nama"
                                     class="w-28 h-28 sm:w-32 sm:h-32 rounded-full object-cover ring-4 ring-white dark:ring-gray-800 shadow-xl bg-white dark:bg-gray-700">
                                <div class="absolute bottom-1 right-1 w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs shadow-md border-2 border-white dark:border-gray-800 font-bold">
                                    <span class="material-symbols-outlined text-sm">person</span>
                                </div>
                            </div>
                        </div>

                        <!-- Member Name & Badges -->
                        <div class="text-center mb-6">
                            <h3 class="text-xl sm:text-2xl font-black text-gray-900 dark:text-white tracking-tight leading-snug"
                                x-text="selectedMember.nama">
                            </h3>
                            <div class="flex flex-wrap items-center justify-center gap-2 mt-2">
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold text-white shadow-sm"
                                      :class="selectedMember.badge_bg || 'bg-blue-600'"
                                      :style="selectedMember.badge_style || ''"
                                      x-text="selectedMember.role_badge">
                                </span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300"
                                      x-text="selectedMember.sub_jabatan || 'Pengurus'">
                                </span>
                            </div>
                        </div>

                        <!-- Biodata Grid Information -->
                        <div class="bg-gray-50 dark:bg-gray-900/60 rounded-2xl p-4 sm:p-5 border border-gray-100 dark:border-gray-700/60 space-y-3">
                            <div class="text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500 pb-2 border-b border-gray-200 dark:border-gray-800 flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm text-blue-600">badge</span>
                                <span>Informasi Biodata Pengurus</span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                <!-- Nama Lengkap -->
                                <div class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-100 dark:border-gray-700/80 shadow-2xs">
                                    <span class="text-gray-500 dark:text-gray-400 block text-[11px] mb-0.5">Nama Lengkap</span>
                                    <span class="font-bold text-gray-900 dark:text-white text-sm" x-text="selectedMember.nama"></span>
                                </div>

                                <!-- Jabatan Organisasi -->
                                <div class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-100 dark:border-gray-700/80 shadow-2xs">
                                    <span class="text-gray-500 dark:text-gray-400 block text-[11px] mb-0.5">Jabatan / Role</span>
                                    <span class="font-bold text-blue-600 dark:text-sky-400 text-sm" x-text="selectedMember.jabatan"></span>
                                </div>

                                <!-- Divisi / Bidang -->
                                <div class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-100 dark:border-gray-700/80 shadow-2xs">
                                    <span class="text-gray-500 dark:text-gray-400 block text-[11px] mb-0.5">Divisi / Bidang</span>
                                    <span class="font-bold text-gray-900 dark:text-white" x-text="selectedMember.divisi"></span>
                                </div>

                                <!-- Kelas / Jurusan -->
                                <div class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-100 dark:border-gray-700/80 shadow-2xs">
                                    <span class="text-gray-500 dark:text-gray-400 block text-[11px] mb-0.5"
                                          x-text="(selectedMember.kategori === 'pembina' || selectedMember.kategori === 'pelatih' || selectedMember.divisi === 'Pembina' || selectedMember.divisi === 'Pelatih' || selectedMember.divisi === 'Pembina Organisasi' || selectedMember.divisi === 'Bidang Kepelatihan') ? 'Status Keanggotaan' : 'Kelas / Jurusan'">
                                        Kelas / Jurusan
                                    </span>
                                    <span class="font-bold text-gray-900 dark:text-white" x-text="selectedMember.kelas"></span>
                                </div>

                                <!-- Organisasi -->
                                <div class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-100 dark:border-gray-700/80 shadow-2xs"
                                     :class="(selectedMember.kategori === 'pembina' || selectedMember.kategori === 'pelatih' || selectedMember.divisi === 'Pembina' || selectedMember.divisi === 'Pelatih' || selectedMember.divisi === 'Pembina Organisasi' || selectedMember.divisi === 'Bidang Kepelatihan' || selectedMember.sub_jabatan === '顧問' || selectedMember.sub_jabatan === '指導員') ? 'sm:col-span-2' : ''">
                                    <span class="text-gray-500 dark:text-gray-400 block text-[11px] mb-0.5">Organisasi</span>
                                    <span class="font-bold text-gray-900 dark:text-white">Aozora Nihongo Club</span>
                                </div>

                                <!-- Periode / Status -->
                                <template x-if="!(selectedMember.kategori === 'pembina' || selectedMember.kategori === 'pelatih' || selectedMember.divisi === 'Pembina' || selectedMember.divisi === 'Pelatih' || selectedMember.divisi === 'Pembina Organisasi' || selectedMember.divisi === 'Bidang Kepelatihan' || selectedMember.sub_jabatan === '顧問' || selectedMember.sub_jabatan === '指導員')">
                                    <div class="bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-100 dark:border-gray-700/80 shadow-2xs">
                                        <span class="text-gray-500 dark:text-gray-400 block text-[11px] mb-0.5">Masa Bakti</span>
                                        <span class="font-bold text-emerald-600 dark:text-emerald-400">Periode 2026 / 2027</span>
                                    </div>
                                </template>
                            </div>

                            <div class="pt-2 text-[11px] text-gray-500 dark:text-gray-400 flex items-center justify-between border-t border-gray-200/60 dark:border-gray-800">
                                <span>SMK Negeri 1 Purwokerto</span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </template>

</body>
</html>
