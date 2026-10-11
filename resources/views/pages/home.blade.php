@extends('layouts.app')

@section('content')

    <div class="flex flex-col w-full overflow-hidden">
        <!-- Top Ambient Anime Glow Elements -->
        <div class="relative w-full">
            <div
                class="absolute top-10 left-1/4 w-96 h-96 bg-aozora-sky/15 rounded-full blur-3xl pointer-events-none -z-10">
            </div>
            <div
                class="absolute top-32 right-10 w-80 h-80 bg-torii-vermilion/10 rounded-full blur-3xl pointer-events-none -z-10">
            </div>
            <div
                class="absolute -top-12 right-1/3 text-[140px] font-headline-lg font-extrabold text-primary-container/[0.03] select-none pointer-events-none -z-10 tracking-widest">
                青空文化
            </div>
            <!-- HERO SECTION -->
            <section id="beranda"
                class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin pt-space-lg md:pt-space-xl pb-space-2xl">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-center">
                    <!-- Left Hero Content (7 cols) -->
                    <div class="lg:col-span-7 flex flex-col gap-space-md z-10">
                        <!-- Japanese Club Top Badge -->
                        <div class="flex flex-wrap items-center gap-space-xs">
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/95 border border-gray-200/80 shadow-xs backdrop-blur-md">
                                <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Logo"
                                    class="w-5 h-5 rounded-full object-cover ring-1 ring-primary/20 shrink-0" />
                                <span class="text-xs tracking-wider text-torii-vermilion font-bold">青空部</span>
                                <span class="text-gray-300 text-xs">•</span>
                                <span class="text-xs text-primary font-bold uppercase tracking-wide">SMKN 1
                                    Purwokerto</span>
                            </div>
                            <span
                                class="px-2.5 py-1 rounded-full bg-sakura-tint text-torii-vermilion font-label-badge text-label-badge font-bold">
                                新入部員募集中
                            </span>
                        </div>
                        <!-- Bold Display Typography -->
                        <h1
                            class="font-display-hero text-display-hero text-indigo-night tracking-tight leading-[1.08] mt-space-xs">
                            Jelajahi Bahasa &amp; Pesona
                            <span class="relative inline-block text-primary">
                                Budaya Jepang
                                <svg class="absolute -bottom-2 left-0 w-full h-3 text-aozora-sky/70" fill="none"
                                    preserveAspectRatio="none" viewBox="0 0 260 12">
                                    <path d="M2 9C50 3 170 1 258 8" stroke="currentColor" stroke-linecap="round"
                                        stroke-width="4"></path>
                                </svg>
                            </span>
                            Bersama Aozora!
                        </h1>
                        <!-- Subtitle -->
                        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mt-space-xs leading-relaxed">
                            Wadah eksplorasi bahasa Jepang, anime &amp;
                            manga, festival matsuri, hingga persiapan
                            sertifikasi JLPT yang seru, interaktif, dan
                            penuh persahabatan bagi siswa-siswi SMKN 1
                            Purwokerto.
                        </p>
                        <!-- Quick Action Buttons -->
                        <div class="flex flex-wrap items-center gap-space-md pt-space-sm">
                            <a class="inline-flex items-center gap-space-sm bg-cloud-white hover:bg-surface-container-low text-primary font-label-lg text-label-lg px-space-lg py-space-md rounded-lg shadow-md hover:shadow-lg transition-all group"
                                href="#event">
                                <span
                                    class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">calendar_month</span>
                                <span class="font-bold">Lihat Agenda Event</span>
                                <span class="text-aozora-sky">✨</span>
                            </a>
                        </div>
                        <!-- Quick Stat Badges Strip -->
                        <div class="grid grid-cols-3 gap-space-sm pt-space-md max-w-lg">
                            <div class="p-space-md rounded-xl bg-cloud-white shadow-sm flex flex-col">
                                <span class="font-headline-md text-headline-md text-primary font-extrabold">50+</span>
                                <span class="font-label-badge text-label-badge text-secondary uppercase">Anggota
                                    Aktif</span>
                            </div>
                            <div class="p-space-md rounded-xl bg-cloud-white shadow-sm flex flex-col">
                                <span
                                    class="font-headline-md text-headline-md text-torii-vermilion font-extrabold">10+</span>
                                <span class="font-label-badge text-label-badge text-secondary uppercase">Event /
                                    Tahun</span>
                            </div>
                            <div class="p-space-md rounded-xl bg-cloud-white shadow-sm flex flex-col">
                                <span
                                    class="font-headline-md text-headline-md text-indigo-night font-extrabold">N5-N4</span>
                                <span class="font-label-badge text-label-badge text-secondary uppercase">JLPT
                                    Coaching</span>
                            </div>
                        </div>
                    </div>
                    <!-- Right Hero: Interactive Anime UI Mascot Showcase (5 cols) -->
                    <div class="lg:col-span-5 relative mt-space-lg lg:mt-0">
                        <!-- Traditional Cloud / Sun Decorative Halo -->
                        <div class="absolute -top-8 -right-8 w-72 h-72 rounded-full bg-torii-vermilion/10 -z-10 blur-xl">
                        </div>
                        <div
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full bg-aozora-sky/20 -z-10 blur-2xl">                        <!-- Main Genshin-inspired Character HUD Card with Gacha System -->
                        <div class="relative rounded-2xl bg-cloud-white/95 backdrop-blur-xl p-space-md md:p-space-lg shadow-xl shadow-primary-container/10 transition-transform duration-300 border border-gray-100"
                            id="mascotCard" style="transform: perspective(1000px) rotateY(0deg) rotateX(0deg);">
                            
                            <!-- Top HUD Bar -->
                            <div class="flex items-center justify-between pb-space-sm gap-2">
                                <div class="flex items-center gap-2 min-w-0">
                                    <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Logo"
                                        class="w-4 h-4 rounded-full object-cover ring-1 ring-primary/20 shrink-0" />
                                    <span class="font-label-badge text-label-badge text-indigo-night uppercase font-bold truncate">AOZORA NIHONGO CLUB</span>
                                </div>
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <!-- Dynamic Rarity Badge -->
                                    <div id="mascotRarityBadge"
                                        class="px-2.5 py-0.5 rounded-full font-label-badge text-[11px] font-bold tracking-wider flex items-center gap-1 transition-all duration-300 bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-xs">
                                        <span id="mascotRarityText">R</span>
                                        <span id="mascotRarityStars" class="text-[9px]">★★★</span>
                                    </div>
                                    <!-- Open Collection Dex Button -->
                                    <button id="openCollectionBtn" type="button"
                                        class="px-2 py-0.5 rounded-full bg-surface-container hover:bg-surface-container-high text-[11px] font-semibold text-secondary hover:text-primary border border-gray-200/60 flex items-center gap-1 transition-all cursor-pointer active:scale-95"
                                        title="Buka Koleksi Maskot">
                                        <span class="material-symbols-outlined text-[13px] text-aozora-sky">auto_stories</span>
                                        <span id="collectionCountBadge">1/5</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Speech Bubble Floating above -->
                            <div class="relative mb-space-sm p-space-sm rounded-xl bg-secondary-container/60 shadow-sm flex items-start gap-space-xs transition-all duration-300"
                                id="mascotSpeechBox">
                                <span class="text-xl" id="mascotSpeechIcon">💬</span>
                                <div class="flex flex-col min-w-0">
                                    <div class="flex items-center gap-1.5 flex-wrap">
                                        <span class="font-label-badge text-label-badge text-primary font-bold" id="mascotNameText">Sora-chan (空ちゃん)</span>
                                        <span class="text-[10px] text-secondary font-medium" id="mascotTitleText">• Original Mascot</span>
                                    </div>
                                    <p class="font-body-sm text-body-sm text-indigo-night leading-tight font-medium mt-0.5"
                                        id="speechBubbleText">
                                        "Konnichiwa! Selamat datang di Aozora Club~ Ikuti petualangan seru kami di SMKN 1!"
                                    </p>
                                </div>
                            </div>

                            <!-- Character Artwork Visual Display -->
                            <div id="mascotImageWrapper"
                                class="relative w-full aspect-square rounded-xl overflow-hidden bg-gradient-to-b from-surface to-secondary-container/40 flex items-center justify-center group shadow-inner border-2 border-sky-300 ring-4 ring-sky-400/20 transition-all duration-500">
                                <img id="mascotImage" alt="Mascot Aozora Nihongo Club"
                                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-all duration-500 select-none"
                                    src="{{ asset('assets/mascots/sora_original.png') }}" />

                                <!-- Gacha Summon Flash / Animation Overlay -->
                                <div id="gachaRollOverlay"
                                    class="absolute inset-0 bg-white/0 pointer-events-none transition-all duration-300 flex flex-col items-center justify-center z-10">
                                    <div id="gachaRollSpinner" class="hidden flex-col items-center gap-2">
                                        <div class="w-12 h-12 rounded-full border-4 border-amber-400 border-t-transparent animate-spin shadow-lg"></div>
                                        <span class="text-xs font-black tracking-wider uppercase text-white bg-indigo-night/90 px-3 py-1 rounded-full shadow backdrop-blur">
                                            Summoning... ✨
                                        </span>
                                    </div>
                                </div>

                                <!-- Floating HUD Attributes -->
                                <div class="absolute top-3 left-3 flex flex-col gap-1.5 pointer-events-none z-10">
                                    <span id="mascotHudTag"
                                        class="px-2.5 py-1 rounded-md bg-indigo-night/85 backdrop-blur-md text-cloud-white font-label-badge text-label-badge transition-all shadow-xs">
                                        Mascot: Sora-chan
                                    </span>
                                    <span id="mascotHudLevel"
                                        class="px-2.5 py-1 rounded-md bg-torii-vermilion/90 backdrop-blur-md text-cloud-white font-label-badge text-label-badge transition-all shadow-xs">
                                        Club Level: S-Tier
                                    </span>
                                </div>

                                <!-- Interactive Voice Audio Pill -->
                                <button
                                    class="absolute bottom-3 right-3 px-3 py-1.5 rounded-full bg-cloud-white/95 hover:bg-white shadow-md backdrop-blur-md text-indigo-night font-label-badge text-label-badge flex items-center gap-1.5 transition-all transform hover:scale-105 active:scale-95 cursor-pointer select-none z-10"
                                    id="voicePlayBtn" type="button" title="Dengarkan suara Ganbatte!">
                                    <span id="voiceIcon"
                                        class="material-symbols-outlined text-torii-vermilion text-base transition-transform"
                                        style="font-variation-settings: 'FILL' 1;">volume_up</span>
                                    <span id="voiceStatusText" class="font-medium">Voice: Ganbatte! 🌸</span>
                                </button>
                            </div>

                            <!-- Interactive Gacha Action Buttons -->
                            <div class="mt-space-sm flex items-center gap-2">
                                <button id="gachaRollBtn" type="button"
                                    class="flex-1 py-2.5 px-4 rounded-xl bg-gradient-to-r from-torii-vermilion via-rose-500 to-amber-500 hover:from-rose-600 hover:to-amber-600 text-white font-bold text-xs shadow-md shadow-rose-500/25 flex items-center justify-center gap-2 transition-all transform active:scale-95 cursor-pointer select-none group">
                                    <span class="material-symbols-outlined text-base group-hover:rotate-180 transition-transform duration-500">casino</span>
                                    <span>Tarik Gacha Maskot! 🎲</span>
                                </button>
                                <button id="gachaDexBtn" type="button"
                                    class="py-2.5 px-3.5 rounded-xl bg-surface-container hover:bg-surface-container-high text-indigo-night border border-gray-200/80 font-semibold text-xs flex items-center gap-1.5 transition-all active:scale-95 cursor-pointer shadow-xs"
                                    title="Buka Koleksi Maskot (Pokedex)">
                                    <span class="material-symbols-outlined text-base text-aozora-sky">collections_bookmark</span>
                                    <span class="hidden sm:inline font-mono text-[11px]">Koleksi</span>
                                </button>
                            </div>

                            <!-- Mascot Footer Attributes / Tags -->
                            <div class="flex flex-wrap items-center justify-between pt-space-xs gap-space-xs font-label-badge text-label-badge">
                                <div class="flex items-center gap-space-xs text-secondary">
                                    <span id="mascotTag1"
                                        class="px-2 py-0.5 rounded bg-surface-container text-on-surface">#NihongoClub</span>
                                    <span id="mascotTag2"
                                        class="px-2 py-0.5 rounded bg-surface-container text-on-surface">#AozoraOriginal</span>
                                </div>
                                <span class="text-aozora-sky font-bold tracking-wide">一期一会 (Ichigo Ichie)</span>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- SECTION 2: TENTANG KAMI & VALUE PILLARS -->
        <section class="w-full bg-surface-container-low/70 py-space-2xl relative" id="tentang">
            <div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin">
                <!-- Section Header -->
                <div class="flex flex-col items-center text-center max-w-2xl mx-auto mb-space-xl">
                    <div
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-gray-200/80 shadow-xs text-xs font-bold uppercase tracking-wider mb-space-xs">
                        <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Logo"
                            class="w-4 h-4 rounded-full object-cover ring-1 ring-rose-200 shrink-0" />
                        <span class="text-torii-vermilion">🌸 KEUNGGULAN KAMI</span>
                        <span class="text-gray-300">•</span>
                        <span class="text-gray-600">私たちについて</span>
                    </div>
                    <h2 class="font-headline-lg text-headline-lg text-indigo-night tracking-tight">
                        Kenapa Belajar &amp; Berkarya di Aozora?
                    </h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-space-xs">
                        Menggabungkan atmosfer santai nan produktif khas
                        pop-culture Jepang dengan penguatan kompetensi
                        akademik dan vokasi.
                    </p>
                </div>
                <!-- 4 Bento Grid Feature Pillars -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-md">
                    <!-- Pillar 1 -->
                    <div
                        class="relative rounded-2xl bg-cloud-white p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between overflow-hidden group">
                        <div
                            class="absolute -right-4 -bottom-4 text-7xl font-bold text-surface-container-high/40 select-none pointer-events-none group-hover:text-aozora-sky/20 transition-colors">
                            学
                        </div>
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-aozora-sky/15 flex items-center justify-center text-primary mb-space-md shadow-sm">
                                <span class="material-symbols-outlined text-2xl" style="
                                                    font-variation-settings: &quot;FILL&quot;
                                                        1;
                                                ">menu_book</span>
                            </div>
                            <div class="flex items-center gap-space-xs mb-space-xs">
                                <span class="font-label-badge text-label-badge text-primary font-bold">PILAR 01</span>
                                <span class="text-secondary text-xs">•</span>
                                <span class="font-label-badge text-label-badge text-secondary">INTERACTIVE</span>
                            </div>
                            <h3 class="font-headline-sm text-headline-sm text-indigo-night mb-space-xs font-bold">
                                Pembelajaran Interaktif
                            </h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                Pelajari Kanji, tata bahasa (bunpou),
                                dan percakapan harian (kaiwa) melalui
                                anime dubbing, flashcards gamifikasi,
                                dan lagu J-Pop.
                            </p>
                        </div>
                        <div
                            class="pt-space-md mt-space-sm flex items-center gap-space-xs text-primary font-label-badge text-label-badge">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            <span class="">Tingkat Pemula s.d N4</span>
                        </div>
                    </div>
                    <!-- Pillar 2 -->
                    <div
                        class="relative rounded-2xl bg-cloud-white p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between overflow-hidden group">
                        <div
                            class="absolute -right-4 -bottom-4 text-7xl font-bold text-surface-container-high/40 select-none pointer-events-none group-hover:text-torii-vermilion/20 transition-colors">
                            祭
                        </div>
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-sakura-tint flex items-center justify-center text-torii-vermilion mb-space-md shadow-sm">
                                <span class="material-symbols-outlined text-2xl" style="
                                                    font-variation-settings: &quot;FILL&quot;
                                                        1;
                                                ">theater_comedy</span>
                            </div>
                            <div class="flex items-center gap-space-xs mb-space-xs">
                                <span class="font-label-badge text-label-badge text-torii-vermilion font-bold">PILAR
                                    02</span>
                                <span class="text-secondary text-xs">•</span>
                                <span class="font-label-badge text-label-badge text-secondary">TRADITION &amp; POP</span>
                            </div>
                            <h3 class="font-headline-sm text-headline-sm text-indigo-night mb-space-xs font-bold">
                                Kebudayaan &amp; Seni
                            </h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                Praktek langsung seni kaligrafi Shodo,
                                melipat Origami rumit, workshop Cosplay
                                costume &amp; makeup, hingga pembuatan
                                kuliner festival.
                            </p>
                        </div>
                        <div
                            class="pt-space-md mt-space-sm flex items-center gap-space-xs text-torii-vermilion font-label-badge text-label-badge">
                            <span class="w-1.5 h-1.5 rounded-full bg-torii-vermilion"></span>
                            <span class="">Bunkasai &amp; Matsuri Show</span>
                        </div>
                    </div>
                    <!-- Pillar 3 -->
                    <div
                        class="relative rounded-2xl bg-cloud-white p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between overflow-hidden group">
                        <div
                            class="absolute -right-4 -bottom-4 text-7xl font-bold text-surface-container-high/40 select-none pointer-events-none group-hover:text-primary/20 transition-colors">
                            友
                        </div>
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-secondary-container/60 flex items-center justify-center text-primary mb-space-md shadow-sm">
                                <span class="material-symbols-outlined text-2xl" style="
                                                    font-variation-settings: &quot;FILL&quot;
                                                        1;
                                                ">groups</span>
                            </div>
                            <div class="flex items-center gap-space-xs mb-space-xs">
                                <span class="font-label-badge text-label-badge text-primary font-bold">PILAR 03</span>
                                <span class="text-secondary text-xs">•</span>
                                <span class="font-label-badge text-label-badge text-secondary">COMMUNITY</span>
                            </div>
                            <h3 class="font-headline-sm text-headline-sm text-indigo-night mb-space-xs font-bold">
                                Sahabat Satu Hobi
                            </h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                Circle suportif untuk nobar anime
                                bulanan, diskusi manga/game, bertukar
                                merchandise, serta mengasah soft-skills
                                kepemimpinan organisasi.
                            </p>
                        </div>
                        <div
                            class="pt-space-md mt-space-sm flex items-center gap-space-xs text-primary font-label-badge text-label-badge">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            <span class="">Keluarga Besar Smecon</span>
                        </div>
                    </div>
                    <!-- Pillar 4 -->
                    <div
                        class="relative rounded-2xl bg-cloud-white p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between overflow-hidden group">
                        <div
                            class="absolute -right-4 -bottom-4 text-7xl font-bold text-surface-container-high/40 select-none pointer-events-none group-hover:text-gold-shrine/20 transition-colors">
                            勝
                        </div>
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-gold-shrine/15 flex items-center justify-center text-gold-shrine mb-space-md shadow-sm">
                                <span class="material-symbols-outlined text-2xl" style="
                                                    font-variation-settings: &quot;FILL&quot;
                                                        1;
                                                ">military_tech</span>
                            </div>
                            <div class="flex items-center gap-space-xs mb-space-xs">
                                <span class="font-label-badge text-label-badge text-gold-shrine font-bold">PILAR 04</span>
                                <span class="text-secondary text-xs">•</span>
                                <span class="font-label-badge text-label-badge text-secondary">PRESTIGE</span>
                            </div>
                            <h3 class="font-headline-sm text-headline-sm text-indigo-night mb-space-xs font-bold">
                                Kompetisi &amp; Prestasi
                            </h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                Bimbingan intensif persiapan lomba
                                Rodoku (baca puisi Jepang), Speech
                                Contest antar-SMK se-Jawa Tengah, dan
                                tryout resmi JLPT.
                            </p>
                        </div>
                        <div
                            class="pt-space-md mt-space-sm flex items-center gap-space-xs text-gold-shrine font-label-badge text-label-badge">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-shrine"></span>
                            <span class="">Juara Tingkat Karesidenan</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- SECTION 3: AGENDA EVENT TERBARU & TIMELINE -->
        <section class="w-full py-space-2xl relative" id="event">
            <div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin">
                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-xl gap-space-md">
                    <div class="flex flex-col">
                        <div
                            class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-gray-200/80 shadow-xs text-xs font-bold uppercase tracking-wider mb-space-xs self-start">
                            <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Logo"
                                class="w-4 h-4 rounded-full object-cover ring-1 ring-primary/20 shrink-0" />
                            <span class="text-primary font-bold">⛩️ JADWAL &amp; DOKUMENTASI</span>
                            <span class="text-gray-300">•</span>
                            <span class="text-gray-600">催し物</span>
                        </div>
                        <h2 class="font-headline-lg text-headline-lg text-indigo-night tracking-tight">
                            Event &amp; Kegiatan Unggulan Aozora
                        </h2>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-space-xs max-w-xl">
                            Keseruan festival akbar tahunan, workshop
                            seni mendalam, dan uji ketangkasan bahasa
                            yang siap kamu ikuti.
                        </p>
                    </div>
                    <!-- Filter / Tab selector Mockup -->
                    <div class="inline-flex p-1 rounded-xl bg-surface-container shadow-inner self-start md:self-auto">
                        <button
                            class="event-filter-btn px-4 py-2 rounded-lg font-label-md text-label-md transition-all text-secondary"
                            data-tab="all">
                            Semua Agenda
                        </button>
                        <button
                            class="event-filter-btn px-4 py-2 rounded-lg hover:text-indigo-night font-label-md text-label-md transition-all text-secondary"
                            data-tab="matsuri">
                            Matsuri
                        </button>
                        <button
                            class="event-filter-btn px-4 py-2 rounded-lg hover:text-indigo-night font-label-md text-label-md transition-all bg-cloud-white text-primary shadow-sm font-bold"
                            data-tab="workshop">
                            Workshop
                        </button>
                    </div>
                </div>
                <!-- Dynamic Event Cards -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-space-lg">
                    @foreach($featuredEvents as $event)
                        <div
                            class="rounded-2xl bg-cloud-white shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                            <div
                                class="absolute top-0 left-0 w-full h-1.5 {{ $event->status === 'completed' ? 'bg-torii-vermilion' : 'bg-gold-shrine' }}">
                            </div>

                            @if($event->poster_path)
                                <div class="w-full h-48 overflow-hidden bg-surface-container-low">
                                    <img src="{{ Storage::url($event->poster_path) }}" alt="{{ $event->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                            @endif

                            <div class="p-space-lg flex-1 flex flex-col">
                                <!-- Header Tags -->
                                <div class="flex items-center justify-between gap-space-xs mb-space-sm">
                                    <span
                                        class="px-2.5 py-1 rounded-full {{ $event->status === 'completed' ? 'bg-sakura-tint text-torii-vermilion' : 'bg-gold-shrine/15 text-gold-shrine' }} font-label-badge text-label-badge font-bold uppercase truncate">
                                        {{ $event->subtitle ?? 'EVENT' }}
                                    </span>
                                    <span class="font-label-badge text-label-badge text-secondary font-medium">
                                        {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                                <!-- Title & Time -->
                                <h3
                                    class="font-headline-sm text-headline-sm text-indigo-night font-bold group-hover:{{ $event->status === 'completed' ? 'text-torii-vermilion' : 'text-gold-shrine' }} transition-colors">
                                    {{ $event->title }}
                                </h3>
                                <div
                                    class="flex items-center gap-space-xs text-on-surface-variant font-body-sm text-body-sm mt-space-xs">
                                    <span
                                        class="material-symbols-outlined text-sm {{ $event->status === 'completed' ? 'text-torii-vermilion' : 'text-gold-shrine' }}">schedule</span>
                                    <span class="">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }} WIB</span>
                                    <span class="text-secondary">•</span>
                                    <span class="material-symbols-outlined text-sm text-primary">location_on</span>
                                    <span class="truncate">{{ $event->location }}</span>
                                </div>
                                <!-- Description -->
                                <p
                                    class="font-body-sm text-body-sm text-on-surface-variant mt-space-sm leading-relaxed line-clamp-3">
                                    {{ $event->description }}
                                </p>

                                @if($event->status === 'completed')
                                    <!-- Documentation indicator -->
                                    <div
                                        class="mt-space-md p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between">
                                        <div class="flex items-center gap-space-xs text-primary font-label-badge text-label-badge">
                                            <span class="material-symbols-outlined text-base">photo_library</span>
                                            <span class="">📸 {{ $event->documentations()->count() }} Dokumentasi</span>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="mt-space-md p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between">
                                        <div class="flex items-center gap-space-xs text-primary font-label-badge text-label-badge">
                                            <span class="material-symbols-outlined text-base">campaign</span>
                                            <span class="">Segera Hadir</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="px-space-lg pb-space-lg">
                                <a href="{{ route('event.detail', $event->slug) }}" wire:navigate.hover
                                    class="w-full py-2.5 rounded-lg {{ $event->status === 'completed' ? 'bg-surface-container hover:bg-torii-vermilion hover:text-cloud-white' : 'bg-surface-container hover:bg-gold-shrine hover:text-indigo-night' }} text-indigo-night font-label-md text-label-md font-bold transition-colors flex items-center justify-center gap-space-xs">
                                    <span
                                        class="">{{ $event->status === 'completed' ? 'Lihat Dokumentasi' : 'Registrasi / Detail' }}</span>
                                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Prominent Call to Action Button for Full Event Archive -->
                <div class="mt-space-xl flex justify-center">
                    <a class="inline-flex items-center gap-space-sm bg-indigo-night hover:bg-primary text-cloud-white font-label-lg text-label-lg px-space-xl py-space-md rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-1 group"
                        href="{{ route('events.index') }}" wire:navigate.hover>
                        <span
                            class="material-symbols-outlined text-aozora-sky group-hover:rotate-45 transition-transform">auto_awesome</span>
                        <span class="">Lihat Semua Event &amp; Arsip Dokumentasi
                            (15+ Event)</span>
                        <span
                            class="text-aozora-sky font-bold text-lg transition-transform group-hover:translate-x-1">→</span>
                    </a>
                </div>
                <!-- DOKUMENTASI MEDIA MOCKUP HIGHLIGHT (Photo & Video Player Box) -->
                <div id="dokumentasi" class="mt-space-2xl p-space-lg rounded-2xl bg-cloud-white shadow-md scroll-mt-24">
                    <div
                        class="flex flex-col md:flex-row items-start md:items-center justify-between pb-space-md gap-space-sm">
                        <div>
                            <span
                                class="font-label-badge text-label-badge text-torii-vermilion uppercase font-bold">SNAPSHOT
                                REKAPITULASI</span>
                            <h4 class="font-headline-md text-headline-md text-indigo-night tracking-tight mt-0.5">
                                Galeri Foto &amp; Aftermovie Matsuri
                            </h4>
                        </div>
                        <div class="flex items-center gap-space-xs font-label-badge text-label-badge">
                            <span class="px-2 py-1 rounded bg-secondary-container/50 text-indigo-night">Total 250+
                                Dokumentasi</span>
                            <span class="px-2 py-1 rounded bg-sakura-tint text-torii-vermilion">Update Terbaru</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-space-md">
                        <!-- Video Mockup Preview (7 cols) -->
                        @if($aftermovieEvent)
                            <div
                                class="md:col-span-7 relative rounded-xl overflow-hidden bg-indigo-night group aspect-video flex items-center justify-center shadow-inner">
                                @if($aftermovieEvent->poster_path)
                                    <img src="{{ Storage::url($aftermovieEvent->poster_path) }}"
                                        class="absolute inset-0 w-full h-full object-cover opacity-60">
                                @endif
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-indigo-night/90 via-indigo-night/30 to-transparent z-10 pointer-events-none">
                                </div>
                                <div class="absolute top-4 left-4 z-20 flex items-center gap-space-xs">
                                    <span class="w-2.5 h-2.5 rounded-full bg-torii-vermilion animate-ping"></span>
                                    <span
                                        class="font-label-badge text-label-badge text-cloud-white bg-indigo-night/60 px-2 py-0.5 rounded backdrop-blur-md uppercase">
                                        AFTERMOVIE {{ $aftermovieEvent->title }}
                                    </span>
                                </div>
                                <iframe src="{{ str_replace('watch?v=', 'embed/', $aftermovieEvent->youtube_link) }}"
                                    class="w-full h-full border-0" allowfullscreen></iframe>
                                <span class="material-symbols-outlined text-3xl ml-1"
                                    style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                </a>
                            </div>
                        @else
                            <div
                                class="md:col-span-7 relative rounded-xl overflow-hidden bg-surface-container-high group aspect-video flex flex-col items-center justify-center shadow-inner text-on-surface-variant">
                                <span class="material-symbols-outlined text-4xl mb-2">videocam_off</span>
                                <span class="font-bold">Belum ada video aftermovie</span>
                            </div>
                        @endif
                        <!-- 2 Gallery Thumbnails (5 cols) -->
                        <div class="md:col-span-5 flex flex-col gap-space-sm justify-between">
                            <div
                                class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors flex items-center gap-space-md cursor-pointer group">
                                <div
                                    class="w-20 h-20 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary overflow-hidden relative shadow-sm">
                                    <span
                                        class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform text-primary">photo_camera</span>
                                    <span
                                        class="absolute bottom-1 right-1 font-label-badge text-[9px] bg-indigo-night/80 text-cloud-white px-1 rounded">24
                                        JPG</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-label-badge text-label-badge text-torii-vermilion font-bold">FOTO
                                        RESMI</span>
                                    <span class="font-headline-sm text-sm font-bold text-indigo-night">Cosplay Showcase
                                        &amp; Maid
                                        Cafe 2025</span>
                                    <span class="font-body-sm text-xs text-secondary mt-1">Dokumentasi Tim Jurnalistik
                                        SMKN 1</span>
                                </div>
                            </div>
                            <div
                                class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors flex items-center gap-space-md cursor-pointer group">
                                <div
                                    class="w-20 h-20 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary overflow-hidden relative shadow-sm">
                                    <span
                                        class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform text-torii-vermilion">history_edu</span>
                                    <span
                                        class="absolute bottom-1 right-1 font-label-badge text-[9px] bg-indigo-night/80 text-cloud-white px-1 rounded">16
                                        JPG</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-label-badge text-label-badge text-primary font-bold">HASIL
                                        KARYA</span>
                                    <span class="font-headline-sm text-sm font-bold text-indigo-night">Pameran Kaligrafi
                                        Shodo Anggota
                                        Baru</span>
                                    <span class="font-body-sm text-xs text-secondary mt-1">Dipajang di Mading
                                        Perpustakaan</span>
                                </div>
                            </div>
                            <div
                                class="p-space-sm rounded-xl bg-secondary-container/40 flex items-center justify-between px-space-md">
                                <span class="font-body-sm text-body-sm text-indigo-night">Punya foto dokumentasi bersama
                                    Aozora?</span>
                                <a class="font-label-badge text-label-badge text-primary font-bold hover:underline"
                                    href="#">Kirim ke Arsip ↗</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- SECTION 4: DAFTAR PENGURUS & ANGGOTA --}}
        @include('pages.partials.pengurus-section')

        <!-- SECTION 5: KONTAK, JADWAL & REGISTRASI CEPAT -->
        <section class="w-full bg-surface-container-low/80 py-space-2xl relative" id="kontak">
            <div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">
                    <!-- Left: Information Cards & Schedule (6 cols) -->
                    <div class="lg:col-span-6 flex flex-col gap-space-md">
                        <div
                            class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-gray-200/80 shadow-xs text-xs font-bold uppercase tracking-wider mb-space-xs self-start">
                            <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Logo"
                                class="w-4 h-4 rounded-full object-cover ring-1 ring-rose-200 shrink-0" />
                            <span class="text-torii-vermilion font-bold">⛩️ JADWAL &amp; SEKRETARIAT</span>
                            <span class="text-gray-300">•</span>
                            <span class="text-gray-600">連絡先</span>
                        </div>
                        <h2 class="font-headline-lg text-headline-lg text-indigo-night tracking-tight">
                            Datang &amp; Kunjungi Sesi Latihan Rutin
                        </h2>
                        <p class="font-body-md text-body-md text-on-surface-variant">
                            Pintu Aozora selalu terbuka untuk seluruh
                            siswa SMKN 1 Purwokerto dari semua jurusan
                            (PPLG, AKL, MPLB, PM, DKV, dsb). Tidak ada
                            syarat kemampuan awal!
                        </p>
                        <!-- Schedule Focus Box -->
                        <div class="p-space-lg rounded-2xl bg-cloud-white shadow-md relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full pointer-events-none">
                            </div>
                            <div class="flex items-center gap-space-sm mb-space-md">
                                <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Logo"
                                    class="w-11 h-11 rounded-full object-cover ring-1 ring-black/10 shrink-0 shadow-xs" />
                                <div class="flex flex-col">
                                    <span class="font-label-badge text-label-badge text-torii-vermilion font-bold">JADWAL
                                        KUMPUL MINGGUAN
                                        (MOKUYOUBI)</span>
                                    <span class="font-headline-sm text-headline-sm text-indigo-night font-bold">Setiap Hari
                                        Kamis Sore</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                                <div class="flex items-start gap-space-xs">
                                    <span class="material-symbols-outlined text-primary text-xl mt-0.5">timer</span>
                                    <div class="flex flex-col">
                                        <span class="font-label-badge text-label-badge text-secondary">WAKTU
                                            PERTEMUAN</span>
                                        <span class="font-headline-sm text-sm font-bold text-indigo-night">16.00 - 17.00
                                            WIB</span>
                                        <span class="font-body-sm text-xs text-on-surface-variant">Setelah jam pelajaran
                                            usai</span>
                                    </div>
                                </div>
                                <div class="flex items-start gap-space-xs">
                                    <span class="material-symbols-outlined text-torii-vermilion text-xl mt-0.5">room</span>
                                    <div class="flex flex-col">
                                        <span class="font-label-badge text-label-badge text-secondary">LOKASI RUANGAN</span>
                                        <span class="font-headline-sm text-sm font-bold text-indigo-night">Lab Bahasa / R.
                                            Eskul</span>
                                        <span class="font-body-sm text-xs text-on-surface-variant">Gedung Tengah Lt. 2 SMKN
                                            1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Official Social & Contacts Mini Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm">
                            <a class="p-space-md rounded-xl bg-cloud-white hover:bg-secondary-container/30 shadow-sm flex items-center gap-space-sm transition-colors group"
                                href="https://instagram.com" target="_blank">
                                <div
                                    class="w-10 h-10 rounded-lg bg-torii-vermilion/10 text-torii-vermilion flex items-center justify-center">
                                    <span class="font-bold text-lg">📸</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-label-badge text-label-badge text-secondary">INSTAGRAM RESMI</span>
                                    <span
                                        class="font-label-lg text-label-lg font-bold text-indigo-night group-hover:text-primary transition-colors">@aozora_nihongo</span>
                                </div>
                            </a>
                            <a class="p-space-md rounded-xl bg-cloud-white hover:bg-secondary-container/30 shadow-sm flex items-center gap-space-sm transition-colors group"
                                href="mailto:noreplyaozora@gmail.com">
                                <div
                                    class="w-10 h-10 rounded-lg bg-aozora-sky/15 text-primary flex items-center justify-center">
                                    <span class="material-symbols-outlined text-xl">mail</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-label-badge text-label-badge text-secondary">EMAIL RESMI</span>
                                    <span
                                        class="font-label-lg text-label-lg font-bold text-indigo-night group-hover:text-primary transition-colors">noreplyaozora@gmail.com</span>
                                </div>
                            </a>
                        </div>
                        <!-- School Address Badge -->
                        <div
                            class="p-space-sm px-space-md rounded-xl bg-cloud-white/70 flex items-center gap-space-sm text-secondary font-body-sm text-xs">
                            <span class="material-symbols-outlined text-sm">school</span>
                            <span class="">SMK Negeri 1 Purwokerto — Jl. Dr.
                                Soeparno No. 29, Karangwangkal,
                                Purwokerto Timur</span>
                        </div>
                    </div>
                    <!-- Right: Registration Form & Quick Interactive Q&A (6 cols) -->
                    <div class="lg:col-span-6 rounded-2xl bg-cloud-white p-space-lg md:p-space-xl shadow-xl relative overflow-hidden flex flex-col justify-between"
                        id="info-rekrutmen">
                        <div
                            class="absolute -top-12 -right-12 w-40 h-40 bg-sakura-tint rounded-full blur-2xl pointer-events-none -z-10">
                        </div>
                        <div>
                            <div class="flex items-center justify-between pb-space-xs">
                                <div
                                    class="inline-flex items-center gap-space-xs px-space-md py-1 rounded-full bg-sakura-tint text-torii-vermilion font-label-badge text-label-badge font-bold">
                                    <span class="">🌸 REKRUTMEN OFFLINE</span><span class="">•</span><span
                                        class="">新入部員募集</span>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-full bg-sakura-tint flex items-center justify-center text-torii-vermilion font-bold text-lg">
                                    桜
                                </div>
                            </div>
                            <h3
                                class="font-headline-md text-headline-md text-indigo-night font-bold mt-space-xs leading-snug">
                                Pendaftaran Resmi Melalui Demo Eskul
                                SMKN 1 Purwokerto
                            </h3>
                            <div class="mt-space-md flex flex-col gap-space-sm">
                                <div class="p-space-md rounded-xl bg-surface-container-low flex items-start gap-space-sm">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-primary text-cloud-white font-label-badge text-label-badge font-bold flex items-center justify-center shrink-0">
                                        01
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-label-lg text-label-lg font-bold text-indigo-night">Kunjungi Booth
                                            Aozora Saat
                                            Demo Eskul</span>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                                            Datangi stan klub kami di
                                            area lapangan/hall utama
                                            sekolah saat gelaran Demo
                                            Ekstrakurikuler berlangsung.
                                        </p>
                                    </div>
                                </div>
                                <div class="p-space-md rounded-xl bg-surface-container-low flex items-start gap-space-sm">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-torii-vermilion text-cloud-white font-label-badge text-label-badge font-bold flex items-center justify-center shrink-0">
                                        02
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-label-lg text-label-lg font-bold text-indigo-night">Coba
                                            Mini-Games &amp; Temu
                                            Maskot Sora-chan</span>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                                            Rasakan keseruan kuis
                                            budaya, kenalan dengan
                                            pengurus klub, serta berfoto
                                            bersama maskot Sora-chan.
                                        </p>
                                    </div>
                                </div>
                                <div class="p-space-md rounded-xl bg-surface-container-low flex items-start gap-space-sm">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-gold-shrine text-indigo-night font-label-badge text-label-badge font-bold flex items-center justify-center shrink-0">
                                        03
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-label-lg text-label-lg font-bold text-indigo-night">Isi Formulir
                                            Fisik &amp;
                                            Masuk Grup Koordinasi</span>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                                            Pengisian berkas fisik
                                            dilakukan langsung di tempat
                                            dan kamu akan segera
                                            dimasukkan ke grup WhatsApp
                                            resmi angkatan baru.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- CANVAS CONFETTI FOR SPECIAL PULLS -->
    <canvas id="gachaConfettiCanvas" class="fixed inset-0 pointer-events-none z-[120] hidden w-full h-full"></canvas>

    <!-- 1% UR EASTER EGG SPECIAL ANNOUNCEMENT MODAL -->
    <div id="easterEggBanner" class="fixed inset-0 z-[110] bg-indigo-night/85 backdrop-blur-md flex items-center justify-center p-4 transition-all duration-300 hidden opacity-0">
        <div class="relative w-full max-w-lg bg-gradient-to-b from-fuchsia-950/95 via-purple-900/90 to-indigo-950/95 rounded-3xl p-6 sm:p-8 text-white shadow-2xl border-2 border-fuchsia-400 ring-8 ring-pink-500/20 overflow-hidden transform scale-95 transition-all duration-300">
            <!-- Shimmer effect -->
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-pink-500/30 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-purple-500/30 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative flex flex-col items-center text-center">
                <!-- Glowing badge -->
                <div class="px-4 py-1.5 rounded-full bg-gradient-to-r from-pink-500 via-rose-500 to-fuchsia-500 text-white font-black text-xs tracking-widest uppercase shadow-lg shadow-pink-500/50 flex items-center gap-1.5 animate-pulse mb-4">
                    <span class="material-symbols-outlined text-sm">auto_awesome</span>
                    <span>1% ULTRA RARE EASTER EGG</span>
                    <span class="material-symbols-outlined text-sm">auto_awesome</span>
                </div>

                <!-- Avatar circle -->
                <div class="relative w-28 h-28 rounded-2xl overflow-hidden border-4 border-fuchsia-400 shadow-2xl shadow-fuchsia-500/50 mb-4 ring-4 ring-pink-400/40">
                    <img src="{{ asset('assets/mascots/sora_yosuga.png') }}" alt="Sora Kasugano" class="w-full h-full object-cover" />
                </div>

                <h3 class="font-headline-sm text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-pink-200 via-white to-fuchsia-200 tracking-tight">
                    Sora Kasugano (春日野 穹)
                </h3>
                <p class="text-xs text-pink-300 font-medium mt-1">
                    • Yosuga no Sora • Kembaran Rahasia Sora-chan
                </p>

                <!-- Voice Quote Bubble -->
                <div class="mt-4 p-3.5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 text-pink-100 text-xs sm:text-sm font-medium leading-relaxed italic">
                    "Onii-chan...? Kenapa kamu menatapku seperti itu? B-Bukan berarti aku senang kamu summon... Baka!"
                </div>

                <p class="text-[11px] text-pink-200/80 mt-3 font-mono">
                    🎉 Peluang gacha 1:100 berhasil didapatkan! Maskot ini telah otomatis diaktifkan di dashboard utamamu.
                </p>

                <!-- Action Button -->
                <button type="button" id="closeEasterEggBtn"
                    class="mt-5 w-full py-3 px-6 rounded-2xl bg-gradient-to-r from-fuchsia-500 via-pink-500 to-rose-500 hover:from-fuchsia-600 hover:to-rose-600 font-bold text-sm tracking-wide text-white shadow-xl shadow-pink-500/40 transform active:scale-95 transition-all cursor-pointer">
                    Keren Banget! Pasang Sekarang 🖤🐰
                </button>
            </div>
        </div>
    </div>

    <!-- MASCOT COLLECTION DEX MODAL (POKEDEX) -->
    <div id="mascotDexModal" class="fixed inset-0 z-[100] bg-indigo-night/80 backdrop-blur-md flex items-center justify-center p-3 sm:p-6 transition-all duration-300 hidden opacity-0">
        <div class="relative w-full max-w-4xl bg-cloud-white/95 rounded-3xl shadow-2xl border border-white/60 overflow-hidden flex flex-col max-h-[92vh] transform scale-95 transition-all duration-300">
            <!-- Modal Header -->
            <div class="p-5 sm:p-6 border-b border-gray-100 bg-white/80 flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-aozora-sky to-blue-600 text-white flex items-center justify-center shadow-md shadow-sky-500/20">
                        <span class="material-symbols-outlined text-xl">collections_bookmark</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-headline-sm text-lg sm:text-xl font-bold text-indigo-night">Aozora Mascot Dex</h3>
                            <span class="text-xs text-secondary font-japanese font-semibold">青空マスコット図鑑</span>
                        </div>
                        <p class="text-xs text-secondary mt-0.5">Kumpulkan 5 karakter maskot eksklusif Aozora Club &amp; dengarkan suara uniknya!</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span id="dexProgressBadge" class="hidden sm:inline-flex px-3 py-1 rounded-full bg-surface-container font-mono text-xs font-bold text-primary border border-gray-200">
                        1/5 Terkumpul
                    </span>
                    <button id="closeDexModalBtn" type="button"
                        class="w-9 h-9 rounded-full bg-surface-container hover:bg-surface-container-high text-secondary hover:text-indigo-night flex items-center justify-center transition-all cursor-pointer">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
            </div>

            <!-- Modal Content (Grid of 5 Mascots) -->
            <div class="p-5 sm:p-6 overflow-y-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4" id="mascotDexGrid">
                    <!-- Rendered dynamically by JavaScript -->
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 sm:p-5 border-t border-gray-100 bg-white/90 flex flex-wrap items-center justify-between gap-3">
                <div class="text-xs text-secondary">
                    <span>💡 Tips: Setiap maskot punya nada suara <em>Ganbatte</em> dan kutipan berbeda!</span>
                </div>
                <div class="flex items-center gap-2">
                    <button id="dexGachaShortcutBtn" type="button"
                        class="py-2 px-4 rounded-xl bg-gradient-to-r from-torii-vermilion to-rose-500 hover:from-rose-600 hover:to-rose-600 text-white text-xs font-bold shadow-md shadow-rose-500/25 flex items-center gap-1.5 transition-all cursor-pointer">
                        <span class="material-symbols-outlined text-sm">casino</span>
                        <span>Tarik Gacha Lagi! 🎲</span>
                    </button>
                    <button id="closeDexModalBtn2" type="button"
                        class="py-2 px-4 rounded-xl bg-surface-container hover:bg-surface-container-high text-indigo-night text-xs font-semibold transition-all cursor-pointer">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- CLIENT INTERACTIVE SCRIPT -->
    <script>
        // MASCOT GACHA & AUDIO SYSTEM
        const MASCOTS = [
            {
                id: "sora",
                name: "Sora-chan (空ちゃん)",
                title: "• Original Mascot",
                rarity: "R",
                stars: "★★★",
                badgeClass: "bg-gradient-to-r from-sky-500 to-blue-600 text-white",
                borderClass: "border-sky-300 ring-sky-400/20",
                quote: "Konnichiwa! Selamat datang di Aozora Club~ Ikuti petualangan seru kami di SMKN 1!",
                image: "{{ asset('assets/mascots/sora_original.png') }}",
                audioPitch: 1.0,
                voiceLabel: "Voice: Ganbatte! 🌸",
                tag1: "#NihongoClub",
                tag2: "#AozoraOriginal",
                hudTag: "Mascot: Sora-chan",
                hudLevel: "Club Level: S-Tier",
                weight: 50,
                dropRate: "50%",
                desc: "Maskot utama Aozora Nihongo Club yang ceria dan selalu menyemangati anggotanya."
            },
            {
                id: "aoi",
                name: "Aoi Senpai (葵先輩)",
                title: "• Kaiwa Specialist",
                rarity: "R",
                stars: "★★★",
                badgeClass: "bg-gradient-to-r from-blue-600 to-indigo-700 text-white",
                borderClass: "border-indigo-400 ring-indigo-500/20",
                quote: "Ayo ngobrol santai pakai bahasa Jepang! Kaiwa itu nggak sesulit yang kamu bayangkan kok~",
                image: "{{ asset('assets/mascots/aoi_kaiwa.png') }}",
                audioPitch: 0.93,
                voiceLabel: "Voice: Ganbatte ne! 📘",
                tag1: "#KaiwaClub",
                tag2: "#AoiSenpai",
                hudTag: "Mascot: Aoi-san",
                hudLevel: "Skill: JLPT N3",
                weight: 30,
                dropRate: "30%",
                desc: "Senpai sabar yang gemar memandu percakapan bahasa Jepang sehari-hari."
            },
            {
                id: "ren",
                name: "Ren (蓮)",
                title: "• Shodo & Kanji Master",
                rarity: "SR",
                stars: "★★★★",
                badgeClass: "bg-gradient-to-r from-purple-600 to-pink-600 text-white",
                borderClass: "border-purple-400 ring-purple-500/20",
                quote: "Fokus dan goreskan kuas kaligrafimu dengan mantap. Setiap kanji punya jiwa dan ceritanya sendiri!",
                image: "{{ asset('assets/mascots/ren_shodo.png') }}",
                audioPitch: 0.78,
                voiceLabel: "Voice: Gambare! 🖌️",
                tag1: "#ShodoClub",
                tag2: "#KanjiMaster",
                hudTag: "Mascot: Ren",
                hudLevel: "Specialty: Calligraphy",
                weight: 14,
                dropRate: "14%",
                desc: "Ahli kaligrafi Shodo dan Kanji yang tenang namun memiliki dedikasi tinggi."
            },
            {
                id: "hana",
                name: "Hana-chan (華ちゃん)",
                title: "• Cosplay & Matsuri Idol",
                rarity: "SSR",
                stars: "★★★★★",
                badgeClass: "bg-gradient-to-r from-amber-500 via-rose-500 to-pink-500 text-white shadow-md shadow-rose-500/30",
                borderClass: "border-amber-400 ring-amber-400/30 shadow-lg shadow-amber-500/20",
                quote: "Yattaa~! Siap-siap tampil all-out di Festival Bunkasai SMKN 1 Purwokerto tahun ini bareng aku!",
                image: "{{ asset('assets/mascots/hana_cosplay.png') }}",
                audioPitch: 1.18,
                voiceLabel: "Voice: Ganbatteee~! 👘✨",
                tag1: "#CosplayMatsuri",
                tag2: "#BunkasaiIdol",
                hudTag: "Mascot: Hana-chan",
                hudLevel: "Status: Matsuri Queen",
                weight: 5,
                dropRate: "5%",
                desc: "Ikon festival budaya dan cosplay yang energik, menyulap suasana Matsuri jadi meriah."
            },
            {
                id: "sora_yosuga",
                name: "Sora Kasugano (春日野 穹)",
                title: "• [SECRET EASTER EGG] Lost Twin",
                rarity: "UR",
                stars: "★★★★★★",
                badgeClass: "bg-gradient-to-r from-fuchsia-600 via-pink-500 to-rose-600 text-white shadow-lg shadow-pink-500/50 animate-pulse",
                borderClass: "border-fuchsia-400 ring-4 ring-pink-500/40 shadow-2xl shadow-fuchsia-500/30",
                quote: "Onii-chan...? Kenapa menatapku seperti itu? B-Bukan berarti aku senang kamu summon... Baka!",
                image: "{{ asset('assets/mascots/sora_yosuga.png') }}",
                audioPitch: 0.86,
                voiceLabel: "Voice: Ganbatte...? 🖤🐰",
                tag1: "#YosugaNoSora",
                tag2: "#1PercentDrop",
                hudTag: "Mascot: Kasugano Sora",
                hudLevel: "Rarity: 1% ULTRA RARE",
                weight: 1,
                dropRate: "1% (EASTER EGG)",
                desc: "Karakter legendaris pembawa boneka kelinci hitam yang tersesat di SMKN 1. Peluang summon cuma 1%!"
            }
        ];

        // Storage keys
        const KEY_DEX = "aozora_mascot_dex_v1";
        const KEY_ACTIVE = "aozora_active_mascot_v1";

        function getUnlockedMascots() {
            try {
                const stored = localStorage.getItem(KEY_DEX);
                if (stored) {
                    const parsed = JSON.parse(stored);
                    if (Array.isArray(parsed) && parsed.length > 0) return parsed;
                }
            } catch (e) {
                console.warn(e);
            }
            return ["sora"];
        }

        function saveUnlockedMascot(id) {
            const list = getUnlockedMascots();
            if (!list.includes(id)) {
                list.push(id);
                try {
                    localStorage.setItem(KEY_DEX, JSON.stringify(list));
                } catch (e) {
                    console.warn(e);
                }
            }
            updateCollectionCounter();
            renderDexGrid();
        }

        function getActiveMascotId() {
            try {
                const active = localStorage.getItem(KEY_ACTIVE);
                if (active && MASCOTS.some(m => m.id === active)) return active;
            } catch (e) {
                console.warn(e);
            }
            return "sora";
        }

        function setActiveMascot(id) {
            const mascot = MASCOTS.find(m => m.id === id) || MASCOTS[0];
            try {
                localStorage.setItem(KEY_ACTIVE, mascot.id);
            } catch (e) {
                console.warn(e);
            }
            applyMascotToCard(mascot, true);
            renderDexGrid();
        }

        // Web Audio API engine for pitch shifting
        let audioCtx = null;
        let audioBuf = null;
        let isAudioLoading = false;

        function loadAudioBuffer() {
            if (audioBuf || isAudioLoading) return;
            const AudioContextClass = window.AudioContext || window.webkitAudioContext;
            if (!AudioContextClass) return;
            if (!audioCtx) audioCtx = new AudioContextClass();
            isAudioLoading = true;
            fetch("{{ asset('audio/gambate.mp3') }}")
                .then(res => res.arrayBuffer())
                .then(buf => audioCtx.decodeAudioData(buf))
                .then(decoded => {
                    audioBuf = decoded;
                    isAudioLoading = false;
                })
                .catch(err => {
                    console.warn("Audio buffer decode error:", err);
                    isAudioLoading = false;
                });
        }

        function playGanbatteVoice(pitch = 1.0) {
            loadAudioBuffer();
            if (audioCtx && audioBuf) {
                if (audioCtx.state === "suspended") {
                    audioCtx.resume();
                }
                const src = audioCtx.createBufferSource();
                src.buffer = audioBuf;
                src.playbackRate.value = pitch;
                src.connect(audioCtx.destination);
                src.start(0);
            } else {
                // Fallback to HTML5 audio with playbackRate
                const fbAudio = new Audio("{{ asset('audio/gambate.mp3') }}");
                fbAudio.playbackRate = pitch;
                fbAudio.play().catch(e => console.warn("Audio play issue:", e));
            }
        }

        // Apply mascot data to homepage HUD card
        function applyMascotToCard(mascot, animate = false) {
            const img = document.getElementById("mascotImage");
            const wrapper = document.getElementById("mascotImageWrapper");
            const rarityBadge = document.getElementById("mascotRarityBadge");
            const rarityText = document.getElementById("mascotRarityText");
            const rarityStars = document.getElementById("mascotRarityStars");
            const nameText = document.getElementById("mascotNameText");
            const titleText = document.getElementById("mascotTitleText");
            const speechText = document.getElementById("speechBubbleText");
            const hudTag = document.getElementById("mascotHudTag");
            const hudLevel = document.getElementById("mascotHudLevel");
            const voiceStatus = document.getElementById("voiceStatusText");
            const tag1 = document.getElementById("mascotTag1");
            const tag2 = document.getElementById("mascotTag2");

            if (rarityText) rarityText.textContent = mascot.rarity;
            if (rarityStars) rarityStars.textContent = mascot.stars;
            if (rarityBadge) {
                rarityBadge.className = `px-2.5 py-0.5 rounded-full font-label-badge text-[11px] font-bold tracking-wider flex items-center gap-1 transition-all duration-300 ${mascot.badgeClass}`;
            }

            if (nameText) nameText.textContent = mascot.name;
            if (titleText) titleText.textContent = mascot.title;
            if (speechText) speechText.textContent = `"${mascot.quote}"`;

            if (hudTag) hudTag.textContent = mascot.hudTag;
            if (hudLevel) hudLevel.textContent = mascot.hudLevel;
            if (voiceStatus) voiceStatus.textContent = mascot.voiceLabel;
            if (tag1) tag1.textContent = mascot.tag1;
            if (tag2) tag2.textContent = mascot.tag2;

            if (wrapper) {
                wrapper.className = `relative w-full aspect-square rounded-xl overflow-hidden bg-gradient-to-b from-surface to-secondary-container/40 flex items-center justify-center group shadow-inner border-2 transition-all duration-500 ${mascot.borderClass}`;
            }

            if (img) {
                if (animate) {
                    img.classList.add("scale-110", "opacity-80");
                    setTimeout(() => {
                        img.src = mascot.image;
                        img.classList.remove("scale-110", "opacity-80");
                    }, 150);
                } else {
                    img.src = mascot.image;
                }
            }
        }

        // Collection Counter update
        function updateCollectionCounter() {
            const unlocked = getUnlockedMascots();
            const countBadge = document.getElementById("collectionCountBadge");
            const dexBadge = document.getElementById("dexProgressBadge");
            const text = `${unlocked.length}/${MASCOTS.length}`;
            if (countBadge) countBadge.textContent = text;
            if (dexBadge) dexBadge.textContent = `${unlocked.length}/${MASCOTS.length} Terkumpul`;
        }

        // Weighted Gacha roll
        function pickRandomMascot() {
            const totalWeight = MASCOTS.reduce((sum, m) => sum + m.weight, 0);
            let rand = Math.random() * totalWeight;
            for (const mascot of MASCOTS) {
                if (rand < mascot.weight) {
                    return mascot;
                }
                rand -= mascot.weight;
            }
            return MASCOTS[0];
        }

        // Gacha Button Trigger
        const gachaBtn = document.getElementById("gachaRollBtn");
        const rollOverlay = document.getElementById("gachaRollOverlay");
        const rollSpinner = document.getElementById("gachaRollSpinner");
        let isRolling = false;

        if (gachaBtn) {
            gachaBtn.addEventListener("click", () => {
                if (isRolling) return;
                isRolling = true;
                initAudioOnGesture();

                // UI roll animation
                gachaBtn.disabled = true;
                gachaBtn.classList.add("opacity-70", "cursor-wait");
                if (rollOverlay) {
                    rollOverlay.classList.remove("bg-white/0", "pointer-events-none");
                    rollOverlay.classList.add("bg-indigo-night/40", "backdrop-blur-xs");
                }
                if (rollSpinner) {
                    rollSpinner.classList.remove("hidden");
                    rollSpinner.classList.add("flex");
                }

                // Random suspense duration 650ms
                setTimeout(() => {
                    const rolledMascot = pickRandomMascot();
                    saveUnlockedMascot(rolledMascot.id);
                    setActiveMascot(rolledMascot.id);

                    // Stop rolling UI
                    if (rollOverlay) {
                        rollOverlay.classList.remove("bg-indigo-night/40", "backdrop-blur-xs");
                        rollOverlay.classList.add("bg-white/0", "pointer-events-none");
                    }
                    if (rollSpinner) {
                        rollSpinner.classList.add("hidden");
                        rollSpinner.classList.remove("flex");
                    }
                    gachaBtn.disabled = false;
                    gachaBtn.classList.remove("opacity-70", "cursor-wait");
                    isRolling = false;

                    // Play specific mascot voice with pitch
                    playGanbatteVoice(rolledMascot.audioPitch);

                    // Check if 1% Easter Egg (Sora Kasugano)
                    if (rolledMascot.id === "sora_yosuga") {
                        triggerConfetti(4000);
                        openEasterEggModal();
                    } else if (rolledMascot.rarity === "SSR") {
                        triggerConfetti(2500);
                    }
                }, 700);
            });
        }

        // Voice Button Click
        const voiceBtn = document.getElementById("voicePlayBtn");
        const voiceIcon = document.getElementById("voiceIcon");
        if (voiceBtn) {
            voiceBtn.addEventListener("click", () => {
                initAudioOnGesture();
                const activeId = getActiveMascotId();
                const mascot = MASCOTS.find(m => m.id === activeId) || MASCOTS[0];
                playGanbatteVoice(mascot.audioPitch);

                // Button bounce animation
                voiceBtn.classList.add("scale-110", "bg-sakura-tint");
                if (voiceIcon) voiceIcon.classList.add("rotate-12");
                setTimeout(() => {
                    voiceBtn.classList.remove("scale-110", "bg-sakura-tint");
                    if (voiceIcon) voiceIcon.classList.remove("rotate-12");
                }, 300);
            });
        }

        // Initialize audio on first user gesture
        function initAudioOnGesture() {
            loadAudioBuffer();
        }
        window.addEventListener("pointerdown", initAudioOnGesture, { once: true });

        // Easter Egg Modal Controls
        const easterEggModal = document.getElementById("easterEggBanner");
        const closeEasterEggBtn = document.getElementById("closeEasterEggBtn");
        function openEasterEggModal() {
            if (!easterEggModal) return;
            easterEggModal.classList.remove("hidden");
            requestAnimationFrame(() => {
                easterEggModal.classList.remove("opacity-0");
                const card = easterEggModal.querySelector("div");
                if (card) card.classList.remove("scale-95");
            });
        }
        function closeEasterEggModal() {
            if (!easterEggModal) return;
            easterEggModal.classList.add("opacity-0");
            const card = easterEggModal.querySelector("div");
            if (card) card.classList.add("scale-95");
            setTimeout(() => {
                easterEggModal.classList.add("hidden");
            }, 300);
        }
        if (closeEasterEggBtn) closeEasterEggBtn.addEventListener("click", closeEasterEggModal);

        // Mascot Dex Modal Controls
        const dexModal = document.getElementById("mascotDexModal");
        const openDexBtn = document.getElementById("openCollectionBtn");
        const openDexBtn2 = document.getElementById("gachaDexBtn");
        const closeDexBtn = document.getElementById("closeDexModalBtn");
        const closeDexBtn2 = document.getElementById("closeDexModalBtn2");
        const dexGachaShortcut = document.getElementById("dexGachaShortcutBtn");

        function openDexModal() {
            if (!dexModal) return;
            renderDexGrid();
            dexModal.classList.remove("hidden");
            requestAnimationFrame(() => {
                dexModal.classList.remove("opacity-0");
                const card = dexModal.querySelector("div");
                if (card) card.classList.remove("scale-95");
            });
        }

        function closeDexModal() {
            if (!dexModal) return;
            dexModal.classList.add("opacity-0");
            const card = dexModal.querySelector("div");
            if (card) card.classList.add("scale-95");
            setTimeout(() => {
                dexModal.classList.add("hidden");
            }, 300);
        }

        if (openDexBtn) openDexBtn.addEventListener("click", openDexModal);
        if (openDexBtn2) openDexBtn2.addEventListener("click", openDexModal);
        if (closeDexBtn) closeDexBtn.addEventListener("click", closeDexModal);
        if (closeDexBtn2) closeDexBtn2.addEventListener("click", closeDexModal);
        if (dexGachaShortcut) {
            dexGachaShortcut.addEventListener("click", () => {
                closeDexModal();
                if (gachaBtn) gachaBtn.click();
            });
        }

        // Render Dex Grid
        function renderDexGrid() {
            const grid = document.getElementById("mascotDexGrid");
            if (!grid) return;
            const unlocked = getUnlockedMascots();
            const activeId = getActiveMascotId();

            grid.innerHTML = MASCOTS.map(m => {
                const isUnlocked = unlocked.includes(m.id);
                const isActive = activeId === m.id;

                if (!isUnlocked) {
                    return `
                        <div class="rounded-2xl border border-gray-200/80 bg-surface-container-low/60 p-4 flex flex-col items-center text-center relative overflow-hidden group">
                            <div class="w-full aspect-square rounded-xl bg-gray-200/80 flex flex-col items-center justify-center text-gray-400 mb-3 border border-dashed border-gray-300">
                                <span class="material-symbols-outlined text-4xl mb-1 text-gray-400">lock</span>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500">Terkunci</span>
                            </div>
                            <div class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-200 text-gray-600 mb-1">
                                Drop Rate: ${m.dropRate}
                            </div>
                            <h4 class="font-bold text-xs text-gray-500 mt-1">???</h4>
                            <p class="text-[10px] text-gray-400 mt-1">Tarik gacha untuk membuka maskot ini!</p>
                            <button disabled class="mt-3 w-full py-1.5 px-3 rounded-lg bg-gray-100 text-gray-400 text-xs font-semibold cursor-not-allowed">
                                Belum Terbuka
                            </button>
                        </div>
                    `;
                }

                return `
                    <div class="rounded-2xl border ${isActive ? 'border-primary ring-2 ring-primary/30' : 'border-gray-200'} bg-white p-4 flex flex-col items-center text-center relative shadow-sm hover:shadow-md transition-all group">
                        ${isActive ? '<span class="absolute top-2 right-2 px-2 py-0.5 rounded-full bg-primary text-white text-[9px] font-bold">AKTIF</span>' : ''}
                        <div class="w-full aspect-square rounded-xl overflow-hidden mb-3 border ${m.borderClass}">
                            <img src="${m.image}" alt="${m.name}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        </div>
                        <div class="px-2 py-0.5 rounded-full text-[10px] font-bold ${m.badgeClass} mb-1">
                            ${m.rarity} ${m.stars}
                        </div>
                        <h4 class="font-bold text-xs text-indigo-night mt-1 truncate w-full" title="${m.name}">${m.name}</h4>
                        <p class="text-[10px] text-secondary line-clamp-2 mt-1 leading-tight">${m.desc}</p>
                        
                        <div class="mt-3 w-full flex flex-col gap-1.5">
                            <button type="button" onclick="window.previewMascotVoice('${m.id}')"
                                class="w-full py-1 px-2 rounded-lg bg-surface-container hover:bg-surface-container-high text-secondary hover:text-primary text-[11px] font-medium flex items-center justify-center gap-1 transition-all cursor-pointer">
                                <span class="material-symbols-outlined text-[13px] text-torii-vermilion">volume_up</span>
                                <span>Tes Suara</span>
                            </button>
                            ${isActive ? `
                                <button disabled class="w-full py-1.5 px-3 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold cursor-default">
                                    ✓ Sedang Aktif
                                </button>
                            ` : `
                                <button type="button" onclick="window.chooseActiveMascot('${m.id}')"
                                    class="w-full py-1.5 px-3 rounded-lg bg-indigo-night hover:bg-primary text-white text-xs font-bold transition-all active:scale-95 cursor-pointer">
                                    Gunakan Maskot
                                </button>
                            `}
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Global functions for inline onclick in modal
        window.chooseActiveMascot = function(id) {
            setActiveMascot(id);
            const mascot = MASCOTS.find(m => m.id === id);
            if (mascot) playGanbatteVoice(mascot.audioPitch);
        };

        window.previewMascotVoice = function(id) {
            initAudioOnGesture();
            const mascot = MASCOTS.find(m => m.id === id);
            if (mascot) playGanbatteVoice(mascot.audioPitch);
        };

        // Confetti Fireworks Engine
        function triggerConfetti(durationMs = 3000) {
            const canvas = document.getElementById("gachaConfettiCanvas");
            if (!canvas) return;
            const ctx = canvas.getContext("2d");
            canvas.classList.remove("hidden");
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const colors = ["#FF69B4", "#FFD700", "#38BDF8", "#A855F7", "#F43F5E", "#10B981"];
            const particles = [];
            const count = 120;

            for (let i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * -canvas.height * 0.5,
                    size: Math.random() * 8 + 4,
                    color: colors[Math.floor(Math.random() * colors.length)],
                    speedX: (Math.random() - 0.5) * 6,
                    speedY: Math.random() * 4 + 3,
                    rotation: Math.random() * 360,
                    rotationSpeed: (Math.random() - 0.5) * 10,
                });
            }

            const startTime = performance.now();
            function draw(now) {
                const elapsed = now - startTime;
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                particles.forEach(p => {
                    p.x += p.speedX;
                    p.y += p.speedY;
                    p.rotation += p.rotationSpeed;

                    ctx.save();
                    ctx.translate(p.x, p.y);
                    ctx.rotate((p.rotation * Math.PI) / 180);
                    ctx.fillStyle = p.color;
                    ctx.fillRect(-p.size / 2, -p.size / 2, p.size, p.size * 0.6);
                    ctx.restore();
                });

                if (elapsed < durationMs) {
                    requestAnimationFrame(draw);
                } else {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    canvas.classList.add("hidden");
                }
            }
            requestAnimationFrame(draw);
        }

        // Initialize state on page load
        document.addEventListener("DOMContentLoaded", () => {
            const activeId = getActiveMascotId();
            const mascot = MASCOTS.find(m => m.id === activeId) || MASCOTS[0];
            applyMascotToCard(mascot, false);
            updateCollectionCounter();
        });

        // 2. Parallax / Subtle Cursor Reaction on Mascot HUD Card
        const mascotCard = document.getElementById("mascotCard");
        if (mascotCard && window.innerWidth > 768) {
            mascotCard.addEventListener("mousemove", (e) => {
                const rect = mascotCard.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                mascotCard.style.transform = `perspective(1000px) rotateY(${x * 0.02}deg) rotateX(${-y * 0.02}deg)`;
            });

            mascotCard.addEventListener("mouseleave", () => {
                mascotCard.style.transform =
                    "perspective(1000px) rotateY(0deg) rotateX(0deg)";
            });
        }

        // 3. Tab Filter Switcher (Visual mockup interaction)
        const filterBtns =
            document.querySelectorAll(".event-filter-btn");
        filterBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                filterBtns.forEach((b) => {
                    b.classList.remove(
                        "bg-cloud-white",
                        "text-primary",
                        "shadow-sm",
                        "font-bold",
                    );
                    b.classList.add("text-secondary");
                });
                btn.classList.add(
                    "bg-cloud-white",
                    "text-primary",
                    "shadow-sm",
                    "font-bold",
                );
                btn.classList.remove("text-secondary");
            });
        });

        // 4. Form Submission Simulation
        function handleFormSubmit() {
            const successBox =
                document.getElementById("formSuccessMessage");
            if (successBox) {
                successBox.classList.remove("hidden");
                const submitBtn = document.querySelector(
                    '#joinClubForm button[type="submit"]',
                );
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add(
                        "opacity-50",
                        "cursor-not-allowed",
                    );
                }
            }
        }
    </script>

@endsection