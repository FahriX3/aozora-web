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
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full bg-aozora-sky/20 -z-10 blur-2xl">
                        </div>

                        <!-- Main Character HUD Card with Gacha System -->
                        <div class="relative rounded-2xl bg-white p-4 md:p-6 shadow-xl transition-all duration-300 border border-slate-200 z-10 hover:-translate-y-1 hover:shadow-2xl"
                            id="mascotCard" style="background: #FFFFFF; border: 1px solid #E2E8F0; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);">
                            
                            <!-- Top HUD Bar -->
                            <div class="flex items-center justify-between pb-3 gap-2">
                                <div class="flex items-center gap-2 min-w-0">
                                    <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Logo"
                                        class="w-4 h-4 rounded-full object-cover shrink-0" style="border: 1px solid rgba(2, 132, 199, 0.3);" />
                                    <span style="font-size: 0.6875rem; font-weight: 800; color: #0F172A; text-transform: uppercase; letter-spacing: 0.05em; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">AOZORA NIHONGO CLUB</span>
                                </div>
                                <div class="flex items-center gap-1.5 shrink-0">
                                    <!-- Dynamic Rarity Badge -->
                                    <div id="mascotRarityBadge"
                                        style="height: 1.625rem; padding: 0 0.65rem; border-radius: 9999px; font-size: 0.6875rem; font-weight: 800; background: linear-gradient(135deg, #0EA5E9, #2563EB); color: #FFFFFF; display: inline-flex; align-items: center; justify-content: center; gap: 0.25rem; box-shadow: 0 2px 8px rgba(14, 165, 233, 0.35); transition: all 0.3s ease;">
                                        <span id="mascotRarityText" style="font-weight: 900; font-size: 0.75rem; letter-spacing: 0.05em;">R</span>
                                        <span id="mascotRarityStars" style="font-size: 0.5625rem; letter-spacing: 0.05em;">★★★</span>
                                    </div>
                                    <!-- Open Collection Dex Button -->
                                    <button id="openCollectionBtn" type="button"
                                        style="height: 1.625rem; padding: 0 0.65rem; border-radius: 9999px; background: #F8FAFC; color: #334155; font-size: 0.6875rem; font-weight: 700; border: 1px solid #CBD5E1; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 0.35rem; transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(0,0,0,0.06);"
                                        title="Buka Koleksi Maskot (Dex)"
                                        onmouseover="this.style.background='#F1F5F9'; this.style.borderColor='#94A3B8';"
                                        onmouseout="this.style.background='#F8FAFC'; this.style.borderColor='#CBD5E1';"
                                        onmousedown="this.style.transform='scale(0.95)'" onmouseup="this.style.transform='scale(1)'">
                                        <span class="material-symbols-outlined" style="font-size: 0.875rem; color: #0284C7; vertical-align: middle;">auto_stories</span>
                                        <span id="collectionCountBadge" style="font-weight: 800; font-size: 0.6875rem; color: #0F172A;">1/5</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Speech Bubble Floating above -->
                            <div class="relative mb-3 flex items-start gap-2.5 transition-all duration-300"
                                id="mascotSpeechBox"
                                style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 0.75rem; padding: 0.625rem 0.875rem;">
                                <span style="font-size: 1.25rem; line-height: 1;" id="mascotSpeechIcon">💬</span>
                                <div style="display: flex; flex-direction: column; min-width: 0;">
                                    <div style="display: flex; align-items: center; gap: 0.375rem; flex-wrap: wrap;">
                                        <span style="font-size: 0.75rem; font-weight: 800; color: #0284C7;" id="mascotNameText">Sora-chan (空ちゃん)</span>
                                        <span style="font-size: 0.625rem; color: #64748B; font-weight: 600;" id="mascotTitleText">• Original Mascot</span>
                                    </div>
                                    <p style="font-size: 0.75rem; color: #1E293B; line-height: 1.35; font-weight: 500; margin: 0.25rem 0 0 0;"
                                        id="speechBubbleText">
                                        "Konnichiwa! Selamat datang di Aozora Club~ Ikuti petualangan seru kami di SMKN 1!"
                                    </p>
                                </div>
                            </div>

                            <!-- Character Artwork Visual Display -->
                            <div id="mascotImageWrapper"
                                class="relative w-full aspect-square rounded-xl overflow-hidden flex items-center justify-center group shadow-inner transition-all duration-500"
                                style="background: linear-gradient(180deg, #F0F9FF 0%, #E0F2FE 100%); border: 2px solid #38BDF8; box-shadow: 0 0 15px rgba(56, 189, 248, 0.25);">
                                <img id="mascotImage" alt="Mascot Aozora Nihongo Club"
                                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-all duration-500 select-none"
                                    src="{{ asset('assets/mascots/sora_original.webp') }}" />

                                <!-- Floating HUD Attributes -->
                                <div class="absolute top-3 left-3 flex flex-col gap-1.5 pointer-events-none z-10">
                                    <span id="mascotHudTag"
                                        style="padding: 0.25rem 0.625rem; border-radius: 0.375rem; background: rgba(15, 23, 42, 0.85); color: #FFFFFF; font-size: 0.6875rem; font-weight: 700; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); box-shadow: 0 2px 4px rgba(0,0,0,0.15);">
                                        Mascot: Sora-chan
                                    </span>
                                    <span id="mascotHudLevel"
                                        style="padding: 0.25rem 0.625rem; border-radius: 0.375rem; background: rgba(232, 58, 48, 0.9); color: #FFFFFF; font-size: 0.6875rem; font-weight: 700; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); box-shadow: 0 2px 4px rgba(0,0,0,0.15);">
                                        Club Level: S-Tier
                                    </span>
                                </div>

                                <!-- Interactive Voice Audio Pill -->
                                <button
                                    style="position: absolute; bottom: 0.75rem; right: 0.75rem; padding: 0.35rem 0.75rem; border-radius: 9999px; background: rgba(255, 255, 255, 0.95); color: #0F172A; font-size: 0.6875rem; font-weight: 700; display: flex; align-items: center; gap: 0.35rem; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border: 1px solid rgba(255,255,255,0.8); cursor: pointer; z-index: 10; transition: transform 0.2s;"
                                    id="voicePlayBtn" type="button" title="Dengarkan suara Ganbatte!"
                                    onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <span id="voiceIcon"
                                        class="material-symbols-outlined"
                                        style="font-size: 1rem; color: #E83A30; font-variation-settings: 'FILL' 1;">volume_up</span>
                                    <span id="voiceStatusText">Voice: Ganbatte! 🌸</span>
                                </button>
                            </div>

                            <!-- Interactive Gacha Action Buttons -->
                            <div class="mt-3 flex items-center gap-2">
                                <button id="gachaRollBtn" type="button"
                                    style="flex: 1; padding: 0.75rem 1rem; border-radius: 0.75rem; background: linear-gradient(135deg, #E83A30 0%, #F43F5E 50%, #F59E0B 100%) !important; color: #FFFFFF !important; font-size: 0.8125rem; font-weight: 800; display: flex; align-items: center; justify-content: center; gap: 0.5rem; border: none; cursor: pointer; box-shadow: 0 4px 15px rgba(232, 58, 48, 0.4); transition: transform 0.15s ease;"
                                    onmousedown="this.style.transform='scale(0.97)'" onmouseup="this.style.transform='scale(1)'">
                                    <span class="material-symbols-outlined" id="gachaBtnIcon" style="font-size: 1.125rem; color: #FFFFFF !important;">casino</span>
                                    <span id="gachaBtnText" style="color: #FFFFFF !important; font-weight: 800; font-size: 0.8125rem; letter-spacing: 0.01em;">Tarik Gacha Maskot! 🎲</span>
                                </button>
                                <button id="gachaDexBtn" type="button"
                                    style="padding: 0.75rem 0.875rem; border-radius: 0.75rem; background: #FFFFFF !important; color: #0F172A !important; border: 1px solid #CBD5E1 !important; font-size: 0.75rem; font-weight: 700; display: flex; align-items: center; gap: 0.35rem; cursor: pointer; box-shadow: 0 2px 6px rgba(0,0,0,0.06); transition: transform 0.15s ease;"
                                    title="Buka Koleksi Maskot (Pokedex)"
                                    onmousedown="this.style.transform='scale(0.97)'" onmouseup="this.style.transform='scale(1)'">
                                    <span class="material-symbols-outlined" style="font-size: 1.125rem; color: #0284C7 !important;">collections_bookmark</span>
                                    <span style="color: #0F172A !important; font-weight: 700;">Koleksi</span>
                                </button>
                            </div>

                            <!-- Mascot Footer Attributes / Tags -->
                            <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; padding-top: 0.5rem; gap: 0.5rem; font-size: 0.6875rem;">
                                <div style="display: flex; align-items: center; gap: 0.35rem;">
                                    <span id="mascotTag1"
                                        style="padding: 0.15rem 0.5rem; border-radius: 0.375rem; background: #F1F5F9; color: #475569; font-weight: 600;">#NihongoClub</span>
                                    <span id="mascotTag2"
                                        style="padding: 0.15rem 0.5rem; border-radius: 0.375rem; background: #F1F5F9; color: #475569; font-weight: 600;">#AozoraOriginal</span>
                                </div>
                                <span style="color: #0284C7; font-weight: 700; letter-spacing: 0.02em;">一期一会 (Ichigo Ichie)</span>
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
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy" decoding="async">
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
    <canvas id="gachaConfettiCanvas" style="position: fixed; inset: 0; pointer-events: none; z-index: 999999; display: none; width: 100vw; height: 100vh;"></canvas>

    <!-- 1% UR EASTER EGG SPECIAL ANNOUNCEMENT MODAL -->
    <div id="easterEggBanner"
        style="position: fixed; inset: 0; z-index: 99999; background: rgba(5, 8, 20, 0.9); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); display: none; opacity: 0; transition: opacity 0.3s ease; align-items: center; justify-content: center; padding: 1rem;">
        <div style="background: linear-gradient(180deg, #1C0A35 0%, #0F051D 100%); border: 2px solid #D946EF; box-shadow: 0 0 50px rgba(217, 70, 239, 0.5), inset 0 0 20px rgba(217, 70, 239, 0.2); border-radius: 1.5rem; max-width: 30rem; width: 100%; padding: 2rem 1.5rem; color: #FFFFFF; position: relative; overflow: hidden; transform: scale(0.95); transition: transform 0.3s ease; text-align: center;">
            
            <!-- Radial glow in background -->
            <div style="position: absolute; top: -4rem; right: -4rem; width: 10rem; height: 10rem; background: rgba(236, 72, 153, 0.3); border-radius: 9999px; filter: blur(35px); pointer-events: none;"></div>
            <div style="position: absolute; bottom: -4rem; left: -4rem; width: 10rem; height: 10rem; background: rgba(168, 85, 247, 0.3); border-radius: 9999px; filter: blur(35px); pointer-events: none;"></div>

            <div style="position: relative; display: flex; flex-direction: column; align-items: center;">
                <!-- Glowing badge -->
                <div style="background: linear-gradient(90deg, #EC4899 0%, #A855F7 100%); color: #FFFFFF; font-weight: 900; font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.35rem 1.25rem; border-radius: 9999px; box-shadow: 0 0 20px rgba(236, 72, 153, 0.6); display: inline-flex; align-items: center; gap: 0.35rem; margin-bottom: 1.25rem;">
                    <span class="material-symbols-outlined" style="font-size: 1rem; color: #FFFFFF;">auto_awesome</span>
                    <span>1% ULTRA RARE EASTER EGG</span>
                    <span class="material-symbols-outlined" style="font-size: 1rem; color: #FFFFFF;">auto_awesome</span>
                </div>

                <!-- Avatar circle with glowing border -->
                <div style="width: 7.5rem; height: 7.5rem; border-radius: 1.25rem; overflow: hidden; border: 3px solid #F472B6; box-shadow: 0 0 30px rgba(244, 114, 182, 0.6); margin-bottom: 1rem;">
                    <img src="{{ asset('assets/mascots/sora_yosuga.webp') }}" alt="Sora Kasugano" style="width: 100%; height: 100%; object-fit: cover; display: block;" />
                </div>

                <h3 style="font-size: 1.5rem; font-weight: 800; color: #FFFFFF; letter-spacing: -0.02em; margin: 0;">
                    Sora Kasugano (春日野 穹)
                </h3>
                <p style="font-size: 0.8125rem; color: #F472B6; font-weight: 600; margin-top: 0.25rem;">
                    • Yosuga no Sora • Kembaran Rahasia Sora-chan
                </p>

                <!-- Voice Quote Bubble -->
                <div style="margin-top: 1rem; padding: 0.875rem 1.25rem; border-radius: 1rem; background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.15); color: #FCE7F3; font-size: 0.875rem; line-height: 1.5; font-style: italic; width: 100%; box-sizing: border-box;">
                    "Onii-chan...? Kenapa kamu menatapku seperti itu? B-Bukan berarti aku senang kamu summon... Baka!"
                </div>

                <p style="font-size: 0.75rem; color: #E9D5FF; margin-top: 0.875rem; font-family: monospace;">
                    🎉 HOKI TINGKAT TINGGI! Peluang gacha rahasia berhasil didapatkan!
                </p>

                <!-- Action Button -->
                <button type="button" id="closeEasterEggBtn"
                    style="margin-top: 1.25rem; width: 100%; padding: 0.875rem 1.5rem; border-radius: 1rem; background: linear-gradient(90deg, #D946EF 0%, #EC4899 50%, #F43F5E 100%); color: #FFFFFF; font-weight: 800; font-size: 0.9375rem; border: none; cursor: pointer; box-shadow: 0 4px 20px rgba(217, 70, 239, 0.5); transition: transform 0.2s;"
                    onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                    Klaim &amp; Pasang Maskot Sora 🖤🐰
                </button>
            </div>
        </div>
    </div>

    <!-- MASCOT COLLECTION DEX MODAL (POKEDEX) -->
    <div id="mascotDexModal"
        style="position: fixed; inset: 0; z-index: 99998; background: rgba(5, 8, 20, 0.8); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); display: none; opacity: 0; transition: opacity 0.3s ease; align-items: center; justify-content: center; padding: 1rem;">
        <div style="background: #FFFFFF; border-radius: 1.5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35); max-width: 56rem; width: 100%; max-height: 90vh; overflow: hidden; display: flex; flex-direction: column; transform: scale(0.95); transition: transform 0.3s ease;">
            <!-- Modal Header -->
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #F1F5F9; display: flex; align-items: center; justify-content: space-between; gap: 1rem; background: #FAFAFA;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 2.5rem; height: 2.5rem; border-radius: 1rem; background: linear-gradient(135deg, #38BDF8 0%, #2563EB 100%); color: #FFFFFF; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);">
                        <span class="material-symbols-outlined" style="font-size: 1.25rem; color: #FFFFFF;">collections_bookmark</span>
                    </div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <h3 style="font-size: 1.125rem; font-weight: 800; color: #0F172A; margin: 0;">Aozora Mascot Dex</h3>
                            <span style="font-size: 0.75rem; color: #64748B; font-weight: 600;">青空マスコット図鑑</span>
                        </div>
                        <p style="font-size: 0.75rem; color: #64748B; margin: 0.125rem 0 0 0;">Kumpulkan 5 karakter maskot eksklusif Aozora Club &amp; dengarkan suara uniknya!</p>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <span id="dexProgressBadge" style="padding: 0.25rem 0.75rem; border-radius: 9999px; background: #F1F5F9; color: #0284C7; font-weight: 700; font-size: 0.75rem; border: 1px solid #E2E8F0; font-family: monospace;">
                        1/5 Terkumpul
                    </span>
                    <button id="closeDexModalBtn" type="button"
                        style="width: 2.25rem; height: 2.25rem; border-radius: 9999px; background: #F1F5F9; color: #475569; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer;">
                        <span class="material-symbols-outlined" style="font-size: 1.25rem;">close</span>
                    </button>
                </div>
            </div>

            <!-- Modal Content (Grid of 5 Mascots) -->
            <div style="padding: 1.25rem 1.5rem; overflow-y: auto;">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4" id="mascotDexGrid">
                    <!-- Rendered dynamically by JavaScript -->
                </div>
            </div>

            <!-- Modal Footer -->
            <div style="padding: 1rem 1.5rem; border-top: 1px solid #F1F5F9; background: #FAFAFA; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 0.75rem;">
                <div style="font-size: 0.75rem; color: #64748B;">
                    <span>💡 Tips: Setiap maskot punya nada suara <em>Ganbatte</em> dan kutipan berbeda!</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <button id="dexGachaShortcutBtn" type="button"
                        style="padding: 0.5rem 1rem; border-radius: 0.75rem; background: linear-gradient(135deg, #E83A30 0%, #F43F5E 100%); color: #FFFFFF; font-size: 0.75rem; font-weight: 700; border: none; cursor: pointer; display: flex; align-items: center; gap: 0.35rem; box-shadow: 0 4px 12px rgba(232, 58, 48, 0.25);">
                        <span class="material-symbols-outlined" style="font-size: 0.875rem; color: #FFFFFF;">casino</span>
                        <span>Tarik Gacha Lagi! 🎲</span>
                    </button>
                    <button id="closeDexModalBtn2" type="button"
                        style="padding: 0.5rem 1rem; border-radius: 0.75rem; background: #F1F5F9; color: #334155; font-size: 0.75rem; font-weight: 600; border: 1px solid #CBD5E1; cursor: pointer;">
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
                badgeStyle: "background: linear-gradient(135deg, #0EA5E9, #2563EB); color: #FFFFFF;",
                borderStyle: "border-color: #38BDF8; box-shadow: 0 0 15px rgba(56, 189, 248, 0.25);",
                quote: "Konnichiwa! Selamat datang di Aozora Club~ Ikuti petualangan seru kami di SMKN 1!",
                image: "{{ asset('assets/mascots/sora_original.webp') }}",
                audioPitch: 1.0,
                voiceLabel: "Voice: Ganbatte! 🌸",
                tag1: "#NihongoClub",
                tag2: "#AozoraOriginal",
                hudTag: "Mascot: Sora-chan",
                hudLevel: "Club Level: S-Tier",
                weight: 35,
                dropRate: "35%",
                desc: "Maskot utama Aozora Nihongo Club yang ceria dan selalu menyemangati anggotanya."
            },
            {
                id: "aoi",
                name: "Aoi Senpai (葵先輩)",
                title: "• Kaiwa Specialist",
                rarity: "R",
                stars: "★★★",
                badgeStyle: "background: linear-gradient(135deg, #2563EB, #4F46E5); color: #FFFFFF;",
                borderStyle: "border-color: #6366F1; box-shadow: 0 0 15px rgba(99, 102, 241, 0.25);",
                quote: "Ayo ngobrol santai pakai bahasa Jepang! Kaiwa itu nggak sesulit yang kamu bayangkan kok~",
                image: "{{ asset('assets/mascots/aoi_kaiwa.webp') }}",
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
                badgeStyle: "background: linear-gradient(135deg, #9333EA, #DB2777); color: #FFFFFF;",
                borderStyle: "border-color: #A855F7; box-shadow: 0 0 15px rgba(168, 85, 247, 0.3);",
                quote: "Fokus dan goreskan kuas kaligrafimu dengan mantap. Setiap kanji punya jiwa dan ceritanya sendiri!",
                image: "{{ asset('assets/mascots/ren_shodo.webp') }}",
                audioPitch: 0.78,
                voiceLabel: "Voice: Gambare! 🖌️",
                tag1: "#ShodoClub",
                tag2: "#KanjiMaster",
                hudTag: "Mascot: Ren",
                hudLevel: "Specialty: Calligraphy",
                weight: 20,
                dropRate: "20%",
                desc: "Ahli kaligrafi Shodo dan Kanji yang tenang namun memiliki dedikasi tinggi."
            },
            {
                id: "hana",
                name: "Hana-chan (華ちゃん)",
                title: "• Cosplay & Matsuri Idol",
                rarity: "SSR",
                stars: "★★★★★",
                badgeStyle: "background: linear-gradient(135deg, #F59E0B, #E11D48); color: #FFFFFF;",
                borderStyle: "border-color: #F59E0B; box-shadow: 0 0 20px rgba(245, 158, 11, 0.35);",
                quote: "Yattaa~! Siap-siap tampil all-out di Festival Bunkasai SMKN 1 Purwokerto tahun ini bareng aku!",
                image: "{{ asset('assets/mascots/hana_cosplay.webp') }}",
                audioPitch: 1.18,
                voiceLabel: "Voice: Ganbatteee~! 👘✨",
                tag1: "#CosplayMatsuri",
                tag2: "#BunkasaiIdol",
                hudTag: "Mascot: Hana-chan",
                hudLevel: "Status: Matsuri Queen",
                weight: 13,
                dropRate: "13%",
                desc: "Ikon festival budaya dan cosplay yang energik, menyulap suasana Matsuri jadi meriah."
            },
            {
                id: "sora_yosuga",
                name: "Sora Kasugano (春日野 穹)",
                title: "• [SECRET EASTER EGG] Lost Twin",
                rarity: "UR",
                stars: "★★★★★★",
                badgeStyle: "background: linear-gradient(135deg, #C026D3, #E11D48); color: #FFFFFF; box-shadow: 0 0 15px rgba(225, 29, 72, 0.6);",
                borderStyle: "border-color: #F43F5E; box-shadow: 0 0 25px rgba(244, 63, 94, 0.5);",
                quote: "Onii-chan...? Kenapa menatapku seperti itu? B-Bukan berarti aku senang kamu summon... Baka!",
                image: "{{ asset('assets/mascots/sora_yosuga.webp') }}",
                audioPitch: 0.86,
                voiceLabel: "Voice: Ganbatte...? 🖤🐰",
                tag1: "#YosugaNoSora",
                tag2: "#SecretDrop",
                hudTag: "Mascot: Kasugano Sora",
                hudLevel: "Rarity: ULTRA RARE",
                weight: 2,
                dropRate: "2% (EASTER EGG)",
                desc: "Karakter legendaris pembawa boneka kelinci hitam yang tersesat di SMKN 1. Peluang summon rahasia!"
            }
        ];

        // Lazy-preload remaining mascot images after initial load to keep page light
        if ("requestIdleCallback" in window) {
            window.requestIdleCallback(() => {
                MASCOTS.forEach(m => {
                    const pre = new Image();
                    pre.src = m.image;
                });
            });
        } else {
            window.addEventListener("load", () => {
                setTimeout(() => {
                    MASCOTS.forEach(m => {
                        const pre = new Image();
                        pre.src = m.image;
                    });
                }, 800);
            });
        }

        // Storage keys
        const KEY_DEX = "aozora_mascot_dex_v2";
        const KEY_ACTIVE = "aozora_active_mascot_v2";

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
                const fbAudio = new Audio("{{ asset('audio/gambate.mp3') }}");
                fbAudio.playbackRate = pitch;
                fbAudio.play().catch(e => console.warn("Audio play issue:", e));
            }
        }

        // Apply mascot data to homepage HUD card
        function applyMascotToCard(mascot, bounce = false) {
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
            if (rarityBadge && mascot.badgeStyle) {
                rarityBadge.style.cssText = `
                    height: 1.625rem;
                    padding: 0 0.65rem;
                    border-radius: 9999px;
                    font-size: 0.6875rem;
                    font-weight: 800;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    gap: 0.25rem;
                    color: #FFFFFF;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
                    transition: all 0.3s ease;
                    ${mascot.badgeStyle}
                `;
            }

            if (nameText) nameText.textContent = mascot.name;
            if (titleText) titleText.textContent = mascot.title;
            if (speechText) speechText.textContent = `"${mascot.quote}"`;

            if (hudTag) hudTag.textContent = mascot.hudTag;
            if (hudLevel) hudLevel.textContent = mascot.hudLevel;
            if (voiceStatus) voiceStatus.textContent = mascot.voiceLabel;
            if (tag1) tag1.textContent = mascot.tag1;
            if (tag2) tag2.textContent = mascot.tag2;

            if (wrapper && mascot.borderStyle) {
                wrapper.style.cssText = `
                    position: relative;
                    width: 100%;
                    aspect-ratio: 1 / 1;
                    border-radius: 0.75rem;
                    overflow: hidden;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: linear-gradient(180deg, #F0F9FF 0%, #E0F2FE 100%);
                    border: 2px solid;
                    transition: all 0.5s ease;
                    ${mascot.borderStyle}
                `;
            }

            if (img) {
                img.src = mascot.image;
                if (bounce) {
                    img.style.transform = "scale(1.08)";
                    setTimeout(() => {
                        img.style.transform = "scale(1)";
                    }, 200);
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

        // Interactive Gacha Button & Roulette Shuffle
        const gachaBtn = document.getElementById("gachaRollBtn");
        let isRolling = false;

        if (gachaBtn) {
            gachaBtn.addEventListener("click", () => {
                if (isRolling) return;
                isRolling = true;
                initAudioOnGesture();

                const btnText = document.getElementById("gachaBtnText");
                const btnIcon = document.getElementById("gachaBtnIcon");
                if (btnText) btnText.textContent = "Mengacak Maskot... 🎲";
                if (btnIcon) btnIcon.classList.add("animate-spin");
                gachaBtn.style.opacity = "0.8";
                gachaBtn.style.pointerEvents = "none";

                // Fast slot-machine roulette animation (swaps images rapidly for 720ms)
                let shuffleIndex = 0;
                const totalShuffles = 8;
                const shuffleTimer = setInterval(() => {
                    const tempMascot = MASCOTS[shuffleIndex % MASCOTS.length];
                    applyMascotToCard(tempMascot, false);
                    shuffleIndex++;

                    if (shuffleIndex >= totalShuffles) {
                        clearInterval(shuffleTimer);

                        // Final chosen mascot
                        const finalMascot = pickRandomMascot();
                        saveUnlockedMascot(finalMascot.id);
                        setActiveMascot(finalMascot.id);

                        // Reset button UI
                        if (btnText) btnText.textContent = "Tarik Gacha Maskot! 🎲";
                        if (btnIcon) btnIcon.classList.remove("animate-spin");
                        gachaBtn.style.opacity = "1";
                        gachaBtn.style.pointerEvents = "auto";
                        isRolling = false;

                        // Play distinct audio
                        playGanbatteVoice(finalMascot.audioPitch);

                        // Check special events
                        if (finalMascot.id === "sora_yosuga") {
                            triggerConfetti(5000);
                            openEasterEggModal();
                        } else if (finalMascot.rarity === "SSR") {
                            triggerConfetti(2500);
                        }
                    }
                }, 85);
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
                voiceBtn.classList.add("scale-110");
                if (voiceIcon) voiceIcon.classList.add("rotate-12");
                setTimeout(() => {
                    voiceBtn.classList.remove("scale-110");
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
            easterEggModal.style.display = "flex";
            requestAnimationFrame(() => {
                easterEggModal.style.opacity = "1";
                const card = easterEggModal.querySelector("div");
                if (card) card.style.transform = "scale(1)";
            });
        }
        function closeEasterEggModal() {
            if (!easterEggModal) return;
            easterEggModal.style.opacity = "0";
            const card = easterEggModal.querySelector("div");
            if (card) card.style.transform = "scale(0.95)";
            setTimeout(() => {
                easterEggModal.style.display = "none";
            }, 300);
        }
        if (closeEasterEggBtn) {
            closeEasterEggBtn.addEventListener("click", () => {
                closeEasterEggModal();
                setActiveMascot("sora_yosuga");
            });
        }
        if (easterEggModal) {
            easterEggModal.addEventListener("click", (e) => {
                if (e.target === easterEggModal) closeEasterEggModal();
            });
        }

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
            dexModal.style.display = "flex";
            requestAnimationFrame(() => {
                dexModal.style.opacity = "1";
                const card = dexModal.querySelector("div");
                if (card) card.style.transform = "scale(1)";
            });
        }

        function closeDexModal() {
            if (!dexModal) return;
            dexModal.style.opacity = "0";
            const card = dexModal.querySelector("div");
            if (card) card.style.transform = "scale(0.95)";
            setTimeout(() => {
                dexModal.style.display = "none";
            }, 300);
        }

        if (openDexBtn) openDexBtn.addEventListener("click", openDexModal);
        if (openDexBtn2) openDexBtn2.addEventListener("click", openDexModal);
        if (closeDexBtn) closeDexBtn.addEventListener("click", closeDexModal);
        if (closeDexBtn2) closeDexBtn2.addEventListener("click", closeDexModal);
        if (dexModal) {
            dexModal.addEventListener("click", (e) => {
                if (e.target === dexModal) closeDexModal();
            });
        }
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
                        <div style="border-radius: 1rem; border: 1px dashed #CBD5E1; background: #F8FAFC; padding: 1rem; display: flex; flex-direction: column; align-items: center; text-align: center; position: relative;">
                            <div style="width: 100%; aspect-ratio: 1/1; border-radius: 0.75rem; background: #E2E8F0; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #94A3B8; margin-bottom: 0.75rem;">
                                <span class="material-symbols-outlined" style="font-size: 2.5rem; color: #94A3B8;">lock</span>
                                <span style="font-size: 0.6875rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #64748B;">Terkunci</span>
                            </div>
                            <div style="padding: 0.125rem 0.5rem; border-radius: 9999px; font-size: 0.625rem; font-weight: 700; background: #E2E8F0; color: #475569; margin-bottom: 0.25rem;">
                                Drop Rate: ${m.dropRate}
                            </div>
                            <h4 style="font-weight: 700; font-size: 0.75rem; color: #64748B; margin: 0.25rem 0 0 0;">???</h4>
                            <p style="font-size: 0.625rem; color: #94A3B8; margin: 0.25rem 0 0 0;">Tarik gacha untuk membuka!</p>
                            <button disabled style="margin-top: 0.75rem; width: 100%; padding: 0.375rem 0.75rem; border-radius: 0.5rem; background: #F1F5F9; color: #94A3B8; font-size: 0.75rem; font-weight: 600; border: none; cursor: not-allowed;">
                                Belum Terbuka
                            </button>
                        </div>
                    `;
                }

                return `
                    <div style="border-radius: 1rem; border: ${isActive ? '2px solid #0284C7' : '1px solid #E2E8F0'}; background: #FFFFFF; padding: 1rem; display: flex; flex-direction: column; align-items: center; text-align: center; position: relative; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                        ${isActive ? '<span style="position: absolute; top: 0.5rem; right: 0.5rem; padding: 0.125rem 0.5rem; border-radius: 9999px; background: #0284C7; color: #FFFFFF; font-size: 0.5625rem; font-weight: 800;">AKTIF</span>' : ''}
                        <div style="width: 100%; aspect-ratio: 1/1; border-radius: 0.75rem; overflow: hidden; margin-bottom: 0.75rem; ${m.borderStyle}">
                            <img src="${m.image}" alt="${m.name}" style="width: 100%; height: 100%; object-fit: cover;" />
                        </div>
                        <div style="padding: 0.125rem 0.5rem; border-radius: 9999px; font-size: 0.625rem; font-weight: 700; margin-bottom: 0.25rem; ${m.badgeStyle}">
                            ${m.rarity} ${m.stars}
                        </div>
                        <h4 style="font-weight: 700; font-size: 0.75rem; color: #0F172A; margin: 0.25rem 0 0 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%;" title="${m.name}">${m.name}</h4>
                        <p style="font-size: 0.625rem; color: #64748B; margin: 0.25rem 0 0 0; line-height: 1.3;">${m.desc}</p>
                        
                        <div style="margin-top: 0.75rem; width: 100%; display: flex; flex-direction: column; gap: 0.35rem;">
                            <button type="button" onclick="window.previewMascotVoice('${m.id}')"
                                style="width: 100%; padding: 0.25rem 0.5rem; border-radius: 0.5rem; background: #F1F5F9; color: #334155; font-size: 0.6875rem; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.25rem; border: none; cursor: pointer;">
                                <span class="material-symbols-outlined" style="font-size: 0.8125rem; color: #E83A30;">volume_up</span>
                                <span>Tes Suara</span>
                            </button>
                            ${isActive ? `
                                <button disabled style="width: 100%; padding: 0.375rem 0.75rem; border-radius: 0.5rem; background: #ECFDF5; color: #047857; border: 1px solid #A7F3D0; font-size: 0.75rem; font-weight: 700; cursor: default;">
                                    ✓ Sedang Aktif
                                </button>
                            ` : `
                                <button type="button" onclick="window.chooseActiveMascot('${m.id}')"
                                    style="width: 100%; padding: 0.375rem 0.75rem; border-radius: 0.5rem; background: #0F172A; color: #FFFFFF; font-size: 0.75rem; font-weight: 700; border: none; cursor: pointer;">
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
            canvas.style.display = "block";
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const colors = ["#FF69B4", "#FFD700", "#38BDF8", "#A855F7", "#F43F5E", "#10B981"];
            const particles = [];
            const count = 100;

            for (let i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * -canvas.height * 0.4,
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
                    canvas.style.display = "none";
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