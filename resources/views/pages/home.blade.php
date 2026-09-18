@extends('layouts.app')

@section('content')

            <div class="flex flex-col w-full overflow-hidden">
                <!-- Top Ambient Anime Glow Elements -->
                <div class="relative w-full">
                    <div
                        class="absolute top-10 left-1/4 w-96 h-96 bg-aozora-sky/15 rounded-full blur-3xl pointer-events-none -z-10"
                    ></div>
                    <div
                        class="absolute top-32 right-10 w-80 h-80 bg-torii-vermilion/10 rounded-full blur-3xl pointer-events-none -z-10"
                    ></div>
                    <div
                        class="absolute -top-12 right-1/3 text-[140px] font-headline-lg font-extrabold text-primary-container/[0.03] select-none pointer-events-none -z-10 tracking-widest"
                    >
                        青空文化
                    </div>
                    <!-- HERO SECTION -->
                    <section
                        class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin pt-space-lg md:pt-space-xl pb-space-2xl"
                    >
                        <div
                            class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-center"
                        >
                            <!-- Left Hero Content (7 cols) -->
                            <div
                                class="lg:col-span-7 flex flex-col gap-space-md z-10"
                            >
                                <!-- Japanese Club Top Badge -->
                                <div
                                    class="flex flex-wrap items-center gap-space-xs"
                                >
                                    <div
                                        class="inline-flex items-center gap-space-xs px-space-md py-1.5 rounded-full bg-primary/10 text-primary shadow-sm backdrop-blur-md"
                                    >
                                        <span
                                            class="w-2 h-2 rounded-full bg-torii-vermilion animate-ping"
                                        ></span>
                                        <span
                                            class="font-label-badge text-label-badge tracking-widest text-torii-vermilion font-bold"
                                            >青空部</span
                                        >
                                        <span class="text-secondary text-xs"
                                            >•</span
                                        >
                                        <span
                                            class="font-label-badge text-label-badge text-primary uppercase"
                                            >SMKN 1 Purwokerto</span
                                        >
                                    </div>
                                    <span
                                        class="px-2.5 py-1 rounded-full bg-sakura-tint text-torii-vermilion font-label-badge text-label-badge font-bold"
                                    >
                                        新入部員募集中
                                    </span>
                                </div>
                                <!-- Bold Display Typography -->
                                <h1
                                    class="font-display-hero text-display-hero text-indigo-night tracking-tight leading-[1.08] mt-space-xs"
                                >
                                    Jelajahi Bahasa &amp; Pesona
                                    <span
                                        class="relative inline-block text-primary"
                                    >
                                        Budaya Jepang
                                        <svg
                                            class="absolute -bottom-2 left-0 w-full h-3 text-aozora-sky/70"
                                            fill="none"
                                            preserveAspectRatio="none"
                                            viewBox="0 0 260 12"
                                        >
                                            <path
                                                d="M2 9C50 3 170 1 258 8"
                                                stroke="currentColor"
                                                stroke-linecap="round"
                                                stroke-width="4"
                                            ></path>
                                        </svg>
                                    </span>
                                    Bersama Aozora!
                                </h1>
                                <!-- Subtitle -->
                                <p
                                    class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mt-space-xs leading-relaxed"
                                >
                                    Wadah eksplorasi bahasa Jepang, anime &amp;
                                    manga, festival matsuri, hingga persiapan
                                    sertifikasi JLPT yang seru, interaktif, dan
                                    penuh persahabatan bagi siswa-siswi SMKN 1
                                    Purwokerto.
                                </p>
                                <!-- Quick Action Buttons -->
                                <div
                                    class="flex flex-wrap items-center gap-space-md pt-space-sm"
                                >
                                    <a
                                        class="inline-flex items-center gap-space-sm bg-cloud-white hover:bg-surface-container-low text-primary font-label-lg text-label-lg px-space-lg py-space-md rounded-lg shadow-md hover:shadow-lg transition-all group"
                                        href="#event"
                                    >
                                        <span
                                            class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform"
                                            >calendar_month</span
                                        >
                                        <span class="font-bold"
                                            >Lihat Agenda Event</span
                                        >
                                        <span class="text-aozora-sky">✨</span>
                                    </a>
                                </div>
                                <!-- Quick Stat Badges Strip -->
                                <div
                                    class="grid grid-cols-3 gap-space-sm pt-space-md max-w-lg"
                                >
                                    <div
                                        class="p-space-md rounded-xl bg-cloud-white shadow-sm flex flex-col"
                                    >
                                        <span
                                            class="font-headline-md text-headline-md text-primary font-extrabold"
                                            >50+</span
                                        >
                                        <span
                                            class="font-label-badge text-label-badge text-secondary uppercase"
                                            >Anggota Aktif</span
                                        >
                                    </div>
                                    <div
                                        class="p-space-md rounded-xl bg-cloud-white shadow-sm flex flex-col"
                                    >
                                        <span
                                            class="font-headline-md text-headline-md text-torii-vermilion font-extrabold"
                                            >10+</span
                                        >
                                        <span
                                            class="font-label-badge text-label-badge text-secondary uppercase"
                                            >Event / Tahun</span
                                        >
                                    </div>
                                    <div
                                        class="p-space-md rounded-xl bg-cloud-white shadow-sm flex flex-col"
                                    >
                                        <span
                                            class="font-headline-md text-headline-md text-indigo-night font-extrabold"
                                            >N5-N4</span
                                        >
                                        <span
                                            class="font-label-badge text-label-badge text-secondary uppercase"
                                            >JLPT Coaching</span
                                        >
                                    </div>
                                </div>
                            </div>
                            <!-- Right Hero: Interactive Anime UI Mascot Showcase (5 cols) -->
                            <div
                                class="lg:col-span-5 relative mt-space-lg lg:mt-0"
                            >
                                <!-- Traditional Cloud / Sun Decorative Halo -->
                                <div
                                    class="absolute -top-8 -right-8 w-72 h-72 rounded-full bg-torii-vermilion/10 -z-10 blur-xl"
                                ></div>
                                <div
                                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full bg-aozora-sky/20 -z-10 blur-2xl"
                                ></div>
                                <!-- Main Genshin-inspired Character HUD Card -->
                                <div
                                    class="relative rounded-2xl bg-cloud-white/95 backdrop-blur-xl p-space-md md:p-space-lg shadow-xl shadow-primary-container/10 transition-transform duration-300"
                                    id="mascotCard"
                                    style="
                                        transform: perspective(1000px)
                                            rotateY(0deg) rotateX(0deg);
                                    "
                                >
                                    <!-- Top HUD Bar -->
                                    <div
                                        class="flex items-center justify-between pb-space-sm"
                                    >
                                        <div
                                            class="flex items-center gap-space-xs"
                                        >
                                            <span
                                                class="w-3 h-3 rounded-full bg-torii-vermilion inline-block"
                                            ></span>
                                            <span
                                                class="w-3 h-3 rounded-full bg-gold-shrine inline-block"
                                            ></span>
                                            <span
                                                class="w-3 h-3 rounded-full bg-aozora-sky inline-block"
                                            ></span>
                                            <span
                                                class="font-label-badge text-label-badge text-indigo-night ml-2 uppercase font-bold"
                                                >CLUB AMBASSADOR</span
                                            >
                                        </div>
                                        <div
                                            class="px-2 py-0.5 rounded bg-primary text-cloud-white font-label-badge text-label-badge"
                                        >
                                            SSR ★★★★★
                                        </div>
                                    </div>
                                    <!-- Speech Bubble Floating above -->
                                    <div
                                        class="relative mb-space-sm p-space-sm rounded-xl bg-secondary-container/60 shadow-sm flex items-start gap-space-xs"
                                    >
                                        <span class="text-xl">💬</span>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-label-badge text-label-badge text-primary font-bold"
                                                >Sora-chan (空ちゃん)</span
                                            >
                                            <p
                                                class="font-body-sm text-body-sm text-indigo-night leading-tight font-medium"
                                                id="speechBubbleText"
                                            >
                                                "Konnichiwa! Selamat datang di
                                                Aozora Club~ Ikuti petualangan
                                                seru kami di SMKN 1!"
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Character Artwork Visual Display -->
                                    <div
                                        class="relative w-full aspect-square rounded-xl overflow-hidden bg-gradient-to-b from-surface to-secondary-container/40 flex items-center justify-center group shadow-inner"
                                    >
                                        <img
                                            alt="Mascot Sora-chan Aozora Nihongo Club"
                                            class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDe_57QRBxcPOxYpvoRkSSUOgH3K1ldKLCAAaYxfqzhuBIlPdMwKPITA2FIlP0xftYt--7X0loUMNwZ3T9pulWmnG7VAMJ8nmf0Mp3aTJ6os01vkE0OvrX_iO1kRs0RDhqlXwPpl4Ml0xCGRXfQS7jdEdDo9TB2Dllwrv5QjGy2VIHvbP1RYVt0cM680j6nLbITW4yZn8WUyuEtBYx5aysZQlq8S0jg7y_N6BRIYSJYRFAStambE6vz"
                                        />
                                        <!-- Floating HUD Attributes -->
                                        <div
                                            class="absolute top-3 left-3 flex flex-col gap-1.5"
                                        >
                                            <span
                                                class="px-2.5 py-1 rounded-md bg-indigo-night/80 backdrop-blur-md text-cloud-white font-label-badge text-label-badge"
                                            >
                                                Mascot: Sora-chan
                                            </span>
                                            <span
                                                class="px-2.5 py-1 rounded-md bg-torii-vermilion/90 backdrop-blur-md text-cloud-white font-label-badge text-label-badge"
                                            >
                                                Club Level: S-Tier
                                            </span>
                                        </div>
                                        <!-- Interactive Voice Audio Pill -->
                                        <button
                                            class="absolute bottom-3 right-3 px-3 py-1.5 rounded-full bg-cloud-white/90 hover:bg-cloud-white shadow-md backdrop-blur-md text-indigo-night font-label-badge text-label-badge flex items-center gap-1.5 transition-all transform hover:scale-105 active:scale-95"
                                            id="voicePlayBtn"
                                        >
                                            <span
                                                class="material-symbols-outlined text-torii-vermilion text-base"
                                                style="
                                                    font-variation-settings: &quot;FILL&quot;
                                                        1;
                                                "
                                                >volume_up</span
                                            >
                                            <span id="voiceStatusText" class=""
                                                >Voice: Ganbatte! 🌸</span
                                            >
                                        </button>
                                    </div>
                                    <!-- Mascot Footer Attributes / Tags -->
                                    <div
                                        class="flex flex-wrap items-center justify-between pt-space-sm gap-space-xs font-label-badge text-label-badge"
                                    >
                                        <div
                                            class="flex items-center gap-space-xs text-secondary"
                                        >
                                            <span
                                                class="px-2 py-0.5 rounded bg-surface-container text-on-surface"
                                                >#NihongoClub</span
                                            >
                                            <span
                                                class="px-2 py-0.5 rounded bg-surface-container text-on-surface"
                                                >#SmeconPurwokerto</span
                                            >
                                        </div>
                                        <span
                                            class="text-aozora-sky font-bold tracking-wide"
                                            >一期一会 (Ichigo Ichie)</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- SECTION 2: TENTANG KAMI & VALUE PILLARS -->
                <section
                    class="w-full bg-surface-container-low/70 py-space-2xl relative"
                    id="tentang"
                >
                    <div
                        class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin"
                    >
                        <!-- Section Header -->
                        <div
                            class="flex flex-col items-center text-center max-w-2xl mx-auto mb-space-xl"
                        >
                            <div
                                class="inline-flex items-center gap-space-xs px-space-md py-1 rounded-full bg-sakura-tint text-torii-vermilion font-label-badge text-label-badge mb-space-xs font-bold"
                            >
                                <span class="">🌸 KEUNGGULAN KAMI</span>
                                <span class="">•</span>
                                <span class="">私たちについて</span>
                            </div>
                            <h2
                                class="font-headline-lg text-headline-lg text-indigo-night tracking-tight"
                            >
                                Kenapa Belajar &amp; Berkarya di Aozora?
                            </h2>
                            <p
                                class="font-body-md text-body-md text-on-surface-variant mt-space-xs"
                            >
                                Menggabungkan atmosfer santai nan produktif khas
                                pop-culture Jepang dengan penguatan kompetensi
                                akademik dan vokasi.
                            </p>
                        </div>
                        <!-- 4 Bento Grid Feature Pillars -->
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-md"
                        >
                            <!-- Pillar 1 -->
                            <div
                                class="relative rounded-2xl bg-cloud-white p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between overflow-hidden group"
                            >
                                <div
                                    class="absolute -right-4 -bottom-4 text-7xl font-bold text-surface-container-high/40 select-none pointer-events-none group-hover:text-aozora-sky/20 transition-colors"
                                >
                                    学
                                </div>
                                <div>
                                    <div
                                        class="w-12 h-12 rounded-xl bg-aozora-sky/15 flex items-center justify-center text-primary mb-space-md shadow-sm"
                                    >
                                        <span
                                            class="material-symbols-outlined text-2xl"
                                            style="
                                                font-variation-settings: &quot;FILL&quot;
                                                    1;
                                            "
                                            >menu_book</span
                                        >
                                    </div>
                                    <div
                                        class="flex items-center gap-space-xs mb-space-xs"
                                    >
                                        <span
                                            class="font-label-badge text-label-badge text-primary font-bold"
                                            >PILAR 01</span
                                        >
                                        <span class="text-secondary text-xs"
                                            >•</span
                                        >
                                        <span
                                            class="font-label-badge text-label-badge text-secondary"
                                            >INTERACTIVE</span
                                        >
                                    </div>
                                    <h3
                                        class="font-headline-sm text-headline-sm text-indigo-night mb-space-xs font-bold"
                                    >
                                        Pembelajaran Interaktif
                                    </h3>
                                    <p
                                        class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed"
                                    >
                                        Pelajari Kanji, tata bahasa (bunpou),
                                        dan percakapan harian (kaiwa) melalui
                                        anime dubbing, flashcards gamifikasi,
                                        dan lagu J-Pop.
                                    </p>
                                </div>
                                <div
                                    class="pt-space-md mt-space-sm flex items-center gap-space-xs text-primary font-label-badge text-label-badge"
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-primary"
                                    ></span>
                                    <span class="">Tingkat Pemula s.d N4</span>
                                </div>
                            </div>
                            <!-- Pillar 2 -->
                            <div
                                class="relative rounded-2xl bg-cloud-white p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between overflow-hidden group"
                            >
                                <div
                                    class="absolute -right-4 -bottom-4 text-7xl font-bold text-surface-container-high/40 select-none pointer-events-none group-hover:text-torii-vermilion/20 transition-colors"
                                >
                                    祭
                                </div>
                                <div>
                                    <div
                                        class="w-12 h-12 rounded-xl bg-sakura-tint flex items-center justify-center text-torii-vermilion mb-space-md shadow-sm"
                                    >
                                        <span
                                            class="material-symbols-outlined text-2xl"
                                            style="
                                                font-variation-settings: &quot;FILL&quot;
                                                    1;
                                            "
                                            >theater_comedy</span
                                        >
                                    </div>
                                    <div
                                        class="flex items-center gap-space-xs mb-space-xs"
                                    >
                                        <span
                                            class="font-label-badge text-label-badge text-torii-vermilion font-bold"
                                            >PILAR 02</span
                                        >
                                        <span class="text-secondary text-xs"
                                            >•</span
                                        >
                                        <span
                                            class="font-label-badge text-label-badge text-secondary"
                                            >TRADITION &amp; POP</span
                                        >
                                    </div>
                                    <h3
                                        class="font-headline-sm text-headline-sm text-indigo-night mb-space-xs font-bold"
                                    >
                                        Kebudayaan &amp; Seni
                                    </h3>
                                    <p
                                        class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed"
                                    >
                                        Praktek langsung seni kaligrafi Shodo,
                                        melipat Origami rumit, workshop Cosplay
                                        costume &amp; makeup, hingga pembuatan
                                        kuliner festival.
                                    </p>
                                </div>
                                <div
                                    class="pt-space-md mt-space-sm flex items-center gap-space-xs text-torii-vermilion font-label-badge text-label-badge"
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-torii-vermilion"
                                    ></span>
                                    <span class=""
                                        >Bunkasai &amp; Matsuri Show</span
                                    >
                                </div>
                            </div>
                            <!-- Pillar 3 -->
                            <div
                                class="relative rounded-2xl bg-cloud-white p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between overflow-hidden group"
                            >
                                <div
                                    class="absolute -right-4 -bottom-4 text-7xl font-bold text-surface-container-high/40 select-none pointer-events-none group-hover:text-primary/20 transition-colors"
                                >
                                    友
                                </div>
                                <div>
                                    <div
                                        class="w-12 h-12 rounded-xl bg-secondary-container/60 flex items-center justify-center text-primary mb-space-md shadow-sm"
                                    >
                                        <span
                                            class="material-symbols-outlined text-2xl"
                                            style="
                                                font-variation-settings: &quot;FILL&quot;
                                                    1;
                                            "
                                            >groups</span
                                        >
                                    </div>
                                    <div
                                        class="flex items-center gap-space-xs mb-space-xs"
                                    >
                                        <span
                                            class="font-label-badge text-label-badge text-primary font-bold"
                                            >PILAR 03</span
                                        >
                                        <span class="text-secondary text-xs"
                                            >•</span
                                        >
                                        <span
                                            class="font-label-badge text-label-badge text-secondary"
                                            >COMMUNITY</span
                                        >
                                    </div>
                                    <h3
                                        class="font-headline-sm text-headline-sm text-indigo-night mb-space-xs font-bold"
                                    >
                                        Sahabat Satu Hobi
                                    </h3>
                                    <p
                                        class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed"
                                    >
                                        Circle suportif untuk nobar anime
                                        bulanan, diskusi manga/game, bertukar
                                        merchandise, serta mengasah soft-skills
                                        kepemimpinan organisasi.
                                    </p>
                                </div>
                                <div
                                    class="pt-space-md mt-space-sm flex items-center gap-space-xs text-primary font-label-badge text-label-badge"
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-primary"
                                    ></span>
                                    <span class="">Keluarga Besar Smecon</span>
                                </div>
                            </div>
                            <!-- Pillar 4 -->
                            <div
                                class="relative rounded-2xl bg-cloud-white p-space-lg shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between overflow-hidden group"
                            >
                                <div
                                    class="absolute -right-4 -bottom-4 text-7xl font-bold text-surface-container-high/40 select-none pointer-events-none group-hover:text-gold-shrine/20 transition-colors"
                                >
                                    勝
                                </div>
                                <div>
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gold-shrine/15 flex items-center justify-center text-gold-shrine mb-space-md shadow-sm"
                                    >
                                        <span
                                            class="material-symbols-outlined text-2xl"
                                            style="
                                                font-variation-settings: &quot;FILL&quot;
                                                    1;
                                            "
                                            >military_tech</span
                                        >
                                    </div>
                                    <div
                                        class="flex items-center gap-space-xs mb-space-xs"
                                    >
                                        <span
                                            class="font-label-badge text-label-badge text-gold-shrine font-bold"
                                            >PILAR 04</span
                                        >
                                        <span class="text-secondary text-xs"
                                            >•</span
                                        >
                                        <span
                                            class="font-label-badge text-label-badge text-secondary"
                                            >PRESTIGE</span
                                        >
                                    </div>
                                    <h3
                                        class="font-headline-sm text-headline-sm text-indigo-night mb-space-xs font-bold"
                                    >
                                        Kompetisi &amp; Prestasi
                                    </h3>
                                    <p
                                        class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed"
                                    >
                                        Bimbingan intensif persiapan lomba
                                        Rodoku (baca puisi Jepang), Speech
                                        Contest antar-SMK se-Jawa Tengah, dan
                                        tryout resmi JLPT.
                                    </p>
                                </div>
                                <div
                                    class="pt-space-md mt-space-sm flex items-center gap-space-xs text-gold-shrine font-label-badge text-label-badge"
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-gold-shrine"
                                    ></span>
                                    <span class=""
                                        >Juara Tingkat Karesidenan</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- SECTION 3: AGENDA EVENT TERBARU & TIMELINE -->
                <section class="w-full py-space-2xl relative" id="event">
                    <div
                        class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin"
                    >
                        <!-- Section Header -->
                        <div
                            class="flex flex-col md:flex-row md:items-end justify-between mb-space-xl gap-space-md"
                        >
                            <div class="flex flex-col">
                                <div
                                    class="inline-flex items-center gap-space-xs px-space-md py-1 rounded-full bg-primary/10 text-primary font-label-badge text-label-badge mb-space-xs font-bold self-start"
                                >
                                    <span class=""
                                        >⛩️ JADWAL &amp; DOKUMENTASI</span
                                    >
                                    <span class="">•</span>
                                    <span class="">催し物</span>
                                </div>
                                <h2
                                    class="font-headline-lg text-headline-lg text-indigo-night tracking-tight"
                                >
                                    Event &amp; Kegiatan Unggulan Aozora
                                </h2>
                                <p
                                    class="font-body-md text-body-md text-on-surface-variant mt-space-xs max-w-xl"
                                >
                                    Keseruan festival akbar tahunan, workshop
                                    seni mendalam, dan uji ketangkasan bahasa
                                    yang siap kamu ikuti.
                                </p>
                            </div>
                            <!-- Filter / Tab selector Mockup -->
                            <div
                                class="inline-flex p-1 rounded-xl bg-surface-container shadow-inner self-start md:self-auto"
                            >
                                <button
                                    class="event-filter-btn px-4 py-2 rounded-lg font-label-md text-label-md transition-all text-secondary"
                                    data-tab="all"
                                >
                                    Semua Agenda
                                </button>
                                <button
                                    class="event-filter-btn px-4 py-2 rounded-lg hover:text-indigo-night font-label-md text-label-md transition-all text-secondary"
                                    data-tab="matsuri"
                                >
                                    Matsuri
                                </button>
                                <button
                                    class="event-filter-btn px-4 py-2 rounded-lg hover:text-indigo-night font-label-md text-label-md transition-all bg-cloud-white text-primary shadow-sm font-bold"
                                    data-tab="workshop"
                                >
                                    Workshop
                                </button>
                            </div>
                        </div>
                        <!-- Dynamic Event Cards -->
                        <div
                            class="grid grid-cols-1 lg:grid-cols-3 gap-space-lg"
                        >
                            @foreach($featuredEvents as $event)
                            <div class="rounded-2xl bg-cloud-white shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-full h-1.5 {{ $event->status === 'completed' ? 'bg-torii-vermilion' : 'bg-gold-shrine' }}"></div>
                                
                                @if($event->poster_path)
                                <div class="w-full h-48 overflow-hidden bg-surface-container-low">
                                    <img src="{{ Storage::url($event->poster_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                @endif

                                <div class="p-space-lg flex-1 flex flex-col">
                                    <!-- Header Tags -->
                                    <div class="flex items-center justify-between gap-space-xs mb-space-sm">
                                        <span class="px-2.5 py-1 rounded-full {{ $event->status === 'completed' ? 'bg-sakura-tint text-torii-vermilion' : 'bg-gold-shrine/15 text-gold-shrine' }} font-label-badge text-label-badge font-bold uppercase truncate">
                                            {{ $event->subtitle ?? 'EVENT' }}
                                        </span>
                                        <span class="font-label-badge text-label-badge text-secondary font-medium">
                                            {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                    <!-- Title & Time -->
                                    <h3 class="font-headline-sm text-headline-sm text-indigo-night font-bold group-hover:{{ $event->status === 'completed' ? 'text-torii-vermilion' : 'text-gold-shrine' }} transition-colors">
                                        {{ $event->title }}
                                    </h3>
                                    <div class="flex items-center gap-space-xs text-on-surface-variant font-body-sm text-body-sm mt-space-xs">
                                        <span class="material-symbols-outlined text-sm {{ $event->status === 'completed' ? 'text-torii-vermilion' : 'text-gold-shrine' }}">schedule</span>
                                        <span class="">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }} WIB</span>
                                        <span class="text-secondary">•</span>
                                        <span class="material-symbols-outlined text-sm text-primary">location_on</span>
                                        <span class="truncate">{{ $event->location }}</span>
                                    </div>
                                    <!-- Description -->
                                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-space-sm leading-relaxed line-clamp-3">
                                        {{ $event->description }}
                                    </p>
                                    
                                    @if($event->status === 'completed')
                                    <!-- Documentation indicator -->
                                    <div class="mt-space-md p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between">
                                        <div class="flex items-center gap-space-xs text-primary font-label-badge text-label-badge">
                                            <span class="material-symbols-outlined text-base">photo_library</span>
                                            <span class="">📸 {{ $event->documentations()->count() }} Dokumentasi</span>
                                        </div>
                                    </div>
                                    @else
                                    <div class="mt-space-md p-space-sm rounded-xl bg-surface-container-low flex items-center justify-between">
                                        <div class="flex items-center gap-space-xs text-primary font-label-badge text-label-badge">
                                            <span class="material-symbols-outlined text-base">campaign</span>
                                            <span class="">Segera Hadir</span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="px-space-lg pb-space-lg">
                                    <a href="{{ route('event.detail', $event->slug) }}" class="w-full py-2.5 rounded-lg {{ $event->status === 'completed' ? 'bg-surface-container hover:bg-torii-vermilion hover:text-cloud-white' : 'bg-surface-container hover:bg-gold-shrine hover:text-indigo-night' }} text-indigo-night font-label-md text-label-md font-bold transition-colors flex items-center justify-center gap-space-xs">
                                        <span class="">{{ $event->status === 'completed' ? 'Lihat Dokumentasi' : 'Registrasi / Detail' }}</span>
                                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Prominent Call to Action Button for Full Event Archive -->
                        <div class="mt-space-xl flex justify-center">
                            <a
                                class="inline-flex items-center gap-space-sm bg-indigo-night hover:bg-primary text-cloud-white font-label-lg text-label-lg px-space-xl py-space-md rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-1 group"
                                href="{{ route('events.index') }}"
                            >
                                <span
                                    class="material-symbols-outlined text-aozora-sky group-hover:rotate-45 transition-transform"
                                    >auto_awesome</span
                                >
                                <span class=""
                                    >Lihat Semua Event &amp; Arsip Dokumentasi
                                    (15+ Event)</span
                                >
                                <span
                                    class="text-aozora-sky font-bold text-lg transition-transform group-hover:translate-x-1"
                                    >→</span
                                >
                            </a>
                        </div>
                        <!-- DOKUMENTASI MEDIA MOCKUP HIGHLIGHT (Photo & Video Player Box) -->
                        <div
                            id="dokumentasi"
                            class="mt-space-2xl p-space-lg rounded-2xl bg-cloud-white shadow-md scroll-mt-24"
                        >
                            <div
                                class="flex flex-col md:flex-row items-start md:items-center justify-between pb-space-md gap-space-sm"
                            >
                                <div>
                                    <span
                                        class="font-label-badge text-label-badge text-torii-vermilion uppercase font-bold"
                                        >SNAPSHOT REKAPITULASI</span
                                    >
                                    <h4
                                        class="font-headline-md text-headline-md text-indigo-night tracking-tight mt-0.5"
                                    >
                                        Galeri Foto &amp; Aftermovie Matsuri
                                    </h4>
                                </div>
                                <div
                                    class="flex items-center gap-space-xs font-label-badge text-label-badge"
                                >
                                    <span
                                        class="px-2 py-1 rounded bg-secondary-container/50 text-indigo-night"
                                        >Total 250+ Dokumentasi</span
                                    >
                                    <span
                                        class="px-2 py-1 rounded bg-sakura-tint text-torii-vermilion"
                                        >Update Terbaru</span
                                    >
                                </div>
                            </div>
                            <div
                                class="grid grid-cols-1 md:grid-cols-12 gap-space-md"
                            >
                                <!-- Video Mockup Preview (7 cols) -->
                                @if($aftermovieEvent)
                                <div class="md:col-span-7 relative rounded-xl overflow-hidden bg-indigo-night group aspect-video flex items-center justify-center shadow-inner">
                                    @if($aftermovieEvent->poster_path)
                                        <img src="{{ Storage::url($aftermovieEvent->poster_path) }}" class="absolute inset-0 w-full h-full object-cover opacity-60">
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-indigo-night/90 via-indigo-night/30 to-transparent z-10 pointer-events-none"></div>
                                    <div class="absolute top-4 left-4 z-20 flex items-center gap-space-xs">
                                        <span class="w-2.5 h-2.5 rounded-full bg-torii-vermilion animate-ping"></span>
                                        <span class="font-label-badge text-label-badge text-cloud-white bg-indigo-night/60 px-2 py-0.5 rounded backdrop-blur-md uppercase">
                                            AFTERMOVIE {{ $aftermovieEvent->title }}
                                        </span>
                                    </div>
                                    <a href="{{ $aftermovieEvent->youtube_link }}" target="_blank" class="relative z-20 w-16 h-16 rounded-full bg-cloud-white/90 hover:bg-torii-vermilion text-indigo-night hover:text-cloud-white flex items-center justify-center shadow-2xl transition-all transform group-hover:scale-110">
                                        <span class="material-symbols-outlined text-3xl ml-1" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                    </a>
                                </div>
                                @else
                                <div class="md:col-span-7 relative rounded-xl overflow-hidden bg-surface-container-high group aspect-video flex flex-col items-center justify-center shadow-inner text-on-surface-variant">
                                    <span class="material-symbols-outlined text-4xl mb-2">videocam_off</span>
                                    <span class="font-bold">Belum ada video aftermovie</span>
                                </div>
                                @endif
                                <!-- 2 Gallery Thumbnails (5 cols) -->
                                <div
                                    class="md:col-span-5 flex flex-col gap-space-sm justify-between"
                                >
                                    <div
                                        class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors flex items-center gap-space-md cursor-pointer group"
                                    >
                                        <div
                                            class="w-20 h-20 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary overflow-hidden relative shadow-sm"
                                        >
                                            <span
                                                class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform text-primary"
                                                >photo_camera</span
                                            >
                                            <span
                                                class="absolute bottom-1 right-1 font-label-badge text-[9px] bg-indigo-night/80 text-cloud-white px-1 rounded"
                                                >24 JPG</span
                                            >
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-label-badge text-label-badge text-torii-vermilion font-bold"
                                                >FOTO RESMI</span
                                            >
                                            <span
                                                class="font-headline-sm text-sm font-bold text-indigo-night"
                                                >Cosplay Showcase &amp; Maid
                                                Cafe 2025</span
                                            >
                                            <span
                                                class="font-body-sm text-xs text-secondary mt-1"
                                                >Dokumentasi Tim Jurnalistik
                                                SMKN 1</span
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="p-space-md rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors flex items-center gap-space-md cursor-pointer group"
                                    >
                                        <div
                                            class="w-20 h-20 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary overflow-hidden relative shadow-sm"
                                        >
                                            <span
                                                class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform text-torii-vermilion"
                                                >history_edu</span
                                            >
                                            <span
                                                class="absolute bottom-1 right-1 font-label-badge text-[9px] bg-indigo-night/80 text-cloud-white px-1 rounded"
                                                >16 JPG</span
                                            >
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-label-badge text-label-badge text-primary font-bold"
                                                >HASIL KARYA</span
                                            >
                                            <span
                                                class="font-headline-sm text-sm font-bold text-indigo-night"
                                                >Pameran Kaligrafi Shodo Anggota
                                                Baru</span
                                            >
                                            <span
                                                class="font-body-sm text-xs text-secondary mt-1"
                                                >Dipajang di Mading
                                                Perpustakaan</span
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="p-space-sm rounded-xl bg-secondary-container/40 flex items-center justify-between px-space-md"
                                    >
                                        <span
                                            class="font-body-sm text-body-sm text-indigo-night"
                                            >Punya foto dokumentasi bersama
                                            Aozora?</span
                                        >
                                        <a
                                            class="font-label-badge text-label-badge text-primary font-bold hover:underline"
                                            href="#"
                                            >Kirim ke Arsip ↗</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- SECTION 4: KONTAK, JADWAL & REGISTRASI CEPAT -->
                <section
                    class="w-full bg-surface-container-low/80 py-space-2xl relative"
                    id="kontak"
                >
                    <div
                        class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin"
                    >
                        <div
                            class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start"
                        >
                            <!-- Left: Information Cards & Schedule (6 cols) -->
                            <div
                                class="lg:col-span-6 flex flex-col gap-space-md"
                            >
                                <div
                                    class="inline-flex items-center gap-space-xs px-space-md py-1 rounded-full bg-torii-vermilion/10 text-torii-vermilion font-label-badge text-label-badge self-start font-bold"
                                >
                                    <span class=""
                                        >⛩️ JADWAL &amp; SEKRETARIAT</span
                                    >
                                    <span class="">•</span>
                                    <span class="">連絡先</span>
                                </div>
                                <h2
                                    class="font-headline-lg text-headline-lg text-indigo-night tracking-tight"
                                >
                                    Datang &amp; Kunjungi Sesi Latihan Rutin
                                </h2>
                                <p
                                    class="font-body-md text-body-md text-on-surface-variant"
                                >
                                    Pintu Aozora selalu terbuka untuk seluruh
                                    siswa SMKN 1 Purwokerto dari semua jurusan
                                    (PPLG, AKL, MPLB, PM, DKV, dsb). Tidak ada
                                    syarat kemampuan awal!
                                </p>
                                <!-- Schedule Focus Box -->
                                <div
                                    class="p-space-lg rounded-2xl bg-cloud-white shadow-md relative overflow-hidden"
                                >
                                    <div
                                        class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full pointer-events-none"
                                    ></div>
                                    <div
                                        class="flex items-center gap-space-sm mb-space-md"
                                    >
                                        <div
                                            class="w-10 h-10 rounded-lg bg-torii-vermilion text-on-primary flex items-center justify-center font-headline-sm"
                                        >
                                            木
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-label-badge text-label-badge text-torii-vermilion font-bold"
                                                >JADWAL KUMPUL MINGGUAN
                                                (MOKUYOUBI)</span
                                            >
                                            <span
                                                class="font-headline-sm text-headline-sm text-indigo-night font-bold"
                                                >Setiap Hari Kamis Sore</span
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="grid grid-cols-1 sm:grid-cols-2 gap-space-md"
                                    >
                                        <div
                                            class="flex items-start gap-space-xs"
                                        >
                                            <span
                                                class="material-symbols-outlined text-primary text-xl mt-0.5"
                                                >timer</span
                                            >
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-badge text-label-badge text-secondary"
                                                    >WAKTU PERTEMUAN</span
                                                >
                                                <span
                                                    class="font-headline-sm text-sm font-bold text-indigo-night"
                                                    >16.00 - 17.00 WIB</span
                                                >
                                                <span
                                                    class="font-body-sm text-xs text-on-surface-variant"
                                                    >Setelah jam pelajaran
                                                    usai</span
                                                >
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-start gap-space-xs"
                                        >
                                            <span
                                                class="material-symbols-outlined text-torii-vermilion text-xl mt-0.5"
                                                >room</span
                                            >
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-badge text-label-badge text-secondary"
                                                    >LOKASI RUANGAN</span
                                                >
                                                <span
                                                    class="font-headline-sm text-sm font-bold text-indigo-night"
                                                    >Lab Bahasa / R. Eskul</span
                                                >
                                                <span
                                                    class="font-body-sm text-xs text-on-surface-variant"
                                                    >Gedung Tengah Lt. 2 SMKN
                                                    1</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Official Social & Contacts Mini Grid -->
                                <div
                                    class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm"
                                >
                                    <a
                                        class="p-space-md rounded-xl bg-cloud-white hover:bg-secondary-container/30 shadow-sm flex items-center gap-space-sm transition-colors group"
                                        href="https://instagram.com"
                                        target="_blank"
                                    >
                                        <div
                                            class="w-10 h-10 rounded-lg bg-torii-vermilion/10 text-torii-vermilion flex items-center justify-center"
                                        >
                                            <span class="font-bold text-lg"
                                                >📸</span
                                            >
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-label-badge text-label-badge text-secondary"
                                                >INSTAGRAM RESMI</span
                                            >
                                            <span
                                                class="font-label-lg text-label-lg font-bold text-indigo-night group-hover:text-primary transition-colors"
                                                >@aozora_nihongo</span
                                            >
                                        </div>
                                    </a>
                                    <a
                                        class="p-space-md rounded-xl bg-cloud-white hover:bg-secondary-container/30 shadow-sm flex items-center gap-space-sm transition-colors group"
                                        href="mailto:aozora@smkn1purwokerto.sch.id"
                                    >
                                        <div
                                            class="w-10 h-10 rounded-lg bg-aozora-sky/15 text-primary flex items-center justify-center"
                                        >
                                            <span
                                                class="material-symbols-outlined text-xl"
                                                >mail</span
                                            >
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-label-badge text-label-badge text-secondary"
                                                >EMAIL HOTLINE</span
                                            >
                                            <span
                                                class="font-label-lg text-label-lg font-bold text-indigo-night group-hover:text-primary transition-colors"
                                                >aozora@smkn1...</span
                                            >
                                        </div>
                                    </a>
                                </div>
                                <!-- School Address Badge -->
                                <div
                                    class="p-space-sm px-space-md rounded-xl bg-cloud-white/70 flex items-center gap-space-sm text-secondary font-body-sm text-xs"
                                >
                                    <span
                                        class="material-symbols-outlined text-sm"
                                        >school</span
                                    >
                                    <span class=""
                                        >SMK Negeri 1 Purwokerto — Jl. Dr.
                                        Soeparno No. 29, Karangwangkal,
                                        Purwokerto Timur</span
                                    >
                                </div>
                            </div>
                            <!-- Right: Registration Form & Quick Interactive Q&A (6 cols) -->
                            <div
                                class="lg:col-span-6 rounded-2xl bg-cloud-white p-space-lg md:p-space-xl shadow-xl relative overflow-hidden flex flex-col justify-between"
                                id="info-rekrutmen"
                            >
                                <div
                                    class="absolute -top-12 -right-12 w-40 h-40 bg-sakura-tint rounded-full blur-2xl pointer-events-none -z-10"
                                ></div>
                                <div>
                                    <div
                                        class="flex items-center justify-between pb-space-xs"
                                    >
                                        <div
                                            class="inline-flex items-center gap-space-xs px-space-md py-1 rounded-full bg-sakura-tint text-torii-vermilion font-label-badge text-label-badge font-bold"
                                        >
                                            <span class=""
                                                >🌸 REKRUTMEN OFFLINE</span
                                            ><span class="">•</span
                                            ><span class="">新入部員募集</span>
                                        </div>
                                        <div
                                            class="w-10 h-10 rounded-full bg-sakura-tint flex items-center justify-center text-torii-vermilion font-bold text-lg"
                                        >
                                            桜
                                        </div>
                                    </div>
                                    <h3
                                        class="font-headline-md text-headline-md text-indigo-night font-bold mt-space-xs leading-snug"
                                    >
                                        Pendaftaran Resmi Melalui Demo Eskul
                                        SMKN 1 Purwokerto
                                    </h3>
                                    <div
                                        class="mt-space-md flex flex-col gap-space-sm"
                                    >
                                        <div
                                            class="p-space-md rounded-xl bg-surface-container-low flex items-start gap-space-sm"
                                        >
                                            <div
                                                class="w-8 h-8 rounded-lg bg-primary text-cloud-white font-label-badge text-label-badge font-bold flex items-center justify-center shrink-0"
                                            >
                                                01
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-lg text-label-lg font-bold text-indigo-night"
                                                    >Kunjungi Booth Aozora Saat
                                                    Demo Eskul</span
                                                >
                                                <p
                                                    class="font-body-sm text-body-sm text-on-surface-variant mt-0.5"
                                                >
                                                    Datangi stan klub kami di
                                                    area lapangan/hall utama
                                                    sekolah saat gelaran Demo
                                                    Ekstrakurikuler berlangsung.
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="p-space-md rounded-xl bg-surface-container-low flex items-start gap-space-sm"
                                        >
                                            <div
                                                class="w-8 h-8 rounded-lg bg-torii-vermilion text-cloud-white font-label-badge text-label-badge font-bold flex items-center justify-center shrink-0"
                                            >
                                                02
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-lg text-label-lg font-bold text-indigo-night"
                                                    >Coba Mini-Games &amp; Temu
                                                    Maskot Sora-chan</span
                                                >
                                                <p
                                                    class="font-body-sm text-body-sm text-on-surface-variant mt-0.5"
                                                >
                                                    Rasakan keseruan kuis
                                                    budaya, kenalan dengan
                                                    pengurus klub, serta berfoto
                                                    bersama maskot Sora-chan.
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="p-space-md rounded-xl bg-surface-container-low flex items-start gap-space-sm"
                                        >
                                            <div
                                                class="w-8 h-8 rounded-lg bg-gold-shrine text-indigo-night font-label-badge text-label-badge font-bold flex items-center justify-center shrink-0"
                                            >
                                                03
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-lg text-label-lg font-bold text-indigo-night"
                                                    >Isi Formulir Fisik &amp;
                                                    Masuk Grup Koordinasi</span
                                                >
                                                <p
                                                    class="font-body-sm text-body-sm text-on-surface-variant mt-0.5"
                                                >
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
            <!-- CLIENT INTERACTIVE SCRIPT -->
            <script>
                // 1. Interactive Voice Clip on Mascot
                const voiceBtn = document.getElementById("voicePlayBtn");
                const voiceText = document.getElementById("voiceStatusText");
                const speechBubble =
                    document.getElementById("speechBubbleText");

                const voiceQuotes = [
                    {
                        voice: "Voice: Oyasumi~ ✨",
                        quote: "Jangan lupa istirahat ya! Sampai ketemu di ruang bahasa Kamis sore nanti!",
                    },
                    {
                        voice: "Voice: Ganbatte! 🌸",
                        quote: "Konnichiwa! Belajar bahasa Jepang itu mudah asalkan dinikmati bersama teman satu frekuensi!",
                    },
                    {
                        voice: "Voice: Sugoi ne! ⭐",
                        quote: "Wah, antusiasmemu keren sekali! Siap tampil di Bunkasai Matsuri tahun ini?",
                    },
                    {
                        voice: "Voice: Ikuzo! 🚀",
                        quote: "Ayo asah skill Kaiwa-mu! Petualangan di Aozora baru saja dimulai!",
                    },
                ];

                let currentQuoteIndex = 0;
                if (voiceBtn) {
                    voiceBtn.addEventListener("click", () => {
                        currentQuoteIndex =
                            (currentQuoteIndex + 1) % voiceQuotes.length;
                        const target = voiceQuotes[currentQuoteIndex];
                        voiceText.textContent = target.voice;
                        speechBubble.textContent = `"${target.quote}"`;

                        // Temporary animation punch
                        voiceBtn.classList.add(
                            "bg-sakura-tint",
                            "text-torii-vermilion",
                        );
                        setTimeout(() => {
                            voiceBtn.classList.remove(
                                "bg-sakura-tint",
                                "text-torii-vermilion",
                            );
                        }, 400);
                    });
                }

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