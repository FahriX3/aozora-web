<!DOCTYPE html>
<html lang="id">
<head>

        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <link rel="icon" type="image/jpeg" href="{{ asset('assets/ANC_icon.jpg') }}" />
        <link
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
            rel="stylesheet"
        />
        <link href="https://fonts.googleapis.com" rel="preconnect" />
        <link
            crossorigin=""
            href="https://fonts.gstatic.com"
            rel="preconnect"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&amp;family=Plus+Jakarta+Sans:wght@600;700;800&amp;family=Space+Grotesk:wght@500;600;700&amp;display=swap"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
            rel="stylesheet"
        />
        <style>
            @layer base {
                html,
                body {
                    margin: 0;
                    padding: 0;
                }
                body {
                    overscroll-behavior: none;
                }
                main > :first-child {
                    margin-top: 0 !important;
                }
                main > :last-child {
                    margin-bottom: 0 !important;
                }
            }
            ::-webkit-scrollbar {
                display: none;
            }
        </style>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface antialiased selection:bg-aozora-sky selection:text-indigo-night">
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
                            <span class="text-torii-vermilion">青</span
                            ><span class="text-aozora-sky">空</span>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-space-xs">
                                <span
                                    class="font-headline-sm text-headline-sm tracking-tight text-indigo-night"
                                    >Aozora</span
                                ><span
                                    class="font-label-badge text-label-badge px-1.5 py-0.5 rounded-full bg-sakura-tint text-torii-vermilion"
                                    >日本語部</span
                                >
                            </div>
                            <span
                                class="font-label-md text-label-md text-secondary tracking-wider uppercase"
                                >SMKN 1 Purwokerto</span
                            >
                        </div></a
                    >
                </div>
                <nav
                    class="hidden lg:flex items-center gap-space-lg"
                    data-active-classes="text-primary font-semibold relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-full after:h-0.5 after:bg-primary"
                >
                    <a
                        class="nav-link transition-colors {{ request()->routeIs('home') ? 'active' : 'text-on-surface-variant hover:text-on-surface' }}"
                        data-target="beranda"
                        href="{{ route('home') }}"
                        >Beranda</a
                    ><a
                        class="nav-link font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors"
                        data-target="tentang"
                        href="{{ route('home') }}#tentang"
                        >Tentang Kami</a
                    ><a
                        class="nav-link font-label-lg text-label-lg transition-colors {{ request()->routeIs('events.*') ? 'active' : 'text-on-surface-variant hover:text-on-surface' }}"
                        data-target="event"
                        href="{{ route('events.index') }}"
                        >Event &amp; Matsuri</a
                    ><a
                        class="nav-link font-label-lg text-label-lg transition-colors {{ request()->routeIs('pengurus') ? 'active' : 'text-on-surface-variant hover:text-on-surface' }}"
                        data-target="pengurus"
                        href="{{ route('pengurus') }}"
                        >Daftar Pengurus</a
                    ><a
                        class="nav-link font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors"
                        data-target="kontak"
                        href="{{ route('home') }}#kontak"
                        >Kontak</a
                    >
                </nav>
                <div class="flex items-center gap-space-md">
                    <button
                        id="btn-open-login-modal"
                        onclick="document.getElementById('login-modal').classList.remove('hidden'); document.getElementById('login-modal').classList.add('flex');"
                        class="w-9 h-9 rounded-full overflow-hidden shadow-[0_2px_8px_rgba(13,89,242,0.20)] hover:scale-110 hover:shadow-[0_4px_16px_rgba(13,89,242,0.30)] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/60 cursor-pointer"
                        title="Login Admin"
                        aria-label="Buka form login admin"
                    >
                        <img
                            alt="ANC Icon"
                            class="w-full h-full object-cover"
                            src="{{ asset('assets/ANC_icon.jpg') }}"
                        />
                    </button>
                </div>
            </div>
        </header>


    <main class="w-full pt-20 bg-surface min-h-screen">
        @yield('content')
    </main>
    <!-- CLIENT INTERACTIVE SCRIPT -->
            <script>
                // 1. ScrollSpy & Active Link Manager
                document.addEventListener("DOMContentLoaded", () => {
                    const navLinks = document.querySelectorAll('.nav-link');
                    const isHomePage = window.location.pathname === '/' || window.location.pathname === '/index.php';
                    
                    // Helper to set active styling
                    const setActiveLink = (targetId) => {
                        navLinks.forEach(link => {
                            if (link.getAttribute('data-target') === 'event' || link.getAttribute('data-target') === 'pengurus') return; // Handled by server routing
                            
                            link.classList.remove('active');
                            link.classList.add('text-on-surface-variant', 'hover:text-on-surface');
                            
                            if (link.getAttribute('data-target') === targetId) {
                                link.classList.remove('text-on-surface-variant', 'hover:text-on-surface');
                                link.classList.add('active');
                            }
                        });
                    };

                    if (isHomePage) {
                        // Handle scroll spy manually to support tall sections
                        const sections = ['beranda-hero', 'tentang', 'kontak'].map(id => document.getElementById(id)).filter(el => el);
                        
                        const onScroll = () => {
                            let current = 'beranda';
                            if (window.scrollY < 200) {
                                current = 'beranda';
                            } else {
                                sections.forEach(sec => {
                                    if (sec && window.scrollY >= (sec.offsetTop - 150)) {
                                        current = sec.id === 'beranda-hero' ? 'beranda' : sec.id;
                                    }
                                });
                            }
                            setActiveLink(current);
                        };

                        window.addEventListener('scroll', onScroll);
                        
                        // Handle initial load and manual clicks
                        const currentHash = window.location.hash.substring(1);
                        if (currentHash) {
                            setActiveLink(currentHash);
                        } else {
                            onScroll();
                        }

                        window.addEventListener('hashchange', () => {
                            setActiveLink(window.location.hash.substring(1));
                        });
                    } else {
                        // Not home page, so highlight Beranda if they came from it? No, if it's not home, and not events, just leave it.
                    }
                });
            </script>
        </main>
        <footer
            class="w-full bg-indigo-night text-cloud-white pt-space-2xl pb-space-xl relative overflow-hidden"
        >
            <div
                class="absolute -right-16 -top-16 text-[220px] font-headline-lg font-extrabold text-cloud-white/[0.03] select-none pointer-events-none"
            >
                青空
            </div>
            <div
                class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin relative z-10"
            >
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-xl pb-space-2xl"
                >
                    <div class="flex flex-col gap-space-md">
                        <div class="flex items-center gap-space-sm">
                            <div
                                class="w-9 h-9 rounded-lg bg-cloud-white/10 flex items-center justify-center font-headline-sm text-headline-sm text-aozora-sky"
                            >
                                青
                            </div>
                            <span
                                class="font-headline-sm text-headline-sm tracking-tight text-cloud-white"
                                >Aozora Nihongo</span
                            >
                        </div>
                        <p
                            class="font-body-sm text-body-sm text-surface-dim leading-relaxed"
                        >
                            Ekstrakurikuler Bahasa dan Kebudayaan Jepang di SMKN
                            1 Purwokerto. Ruang eksplorasi bahasa, anime
                            culture, kaiwa, cosplay, kaligrafi shodo, dan
                            matsuri berprestasi.
                        </p>
                        <div
                            class="inline-flex items-center gap-space-xs self-start px-space-sm py-1 rounded-full bg-cloud-white/10 text-aozora-sky font-label-badge text-label-badge"
                        >
                            <span class="">🇯🇵 PURWOKERTO JAPANESE CLUB</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-space-sm">
                        <span
                            class="font-headline-sm text-headline-sm text-cloud-white flex items-center gap-space-xs"
                            ><span class="text-torii-vermilion">⛩️</span> Info
                            Jadwal Rutin</span
                        >
                        <div
                            class="p-space-md rounded-xl bg-cloud-white/5 flex flex-col gap-space-xs"
                        >
                            <div
                                class="flex items-center gap-space-xs text-aozora-sky font-label-md text-label-md"
                            >
                                <span
                                    class="w-2 h-2 rounded-full bg-aozora-sky animate-ping"
                                ></span
                                ><span class="">PERTEMUAN MINGGUAN</span>
                            </div>
                            <span
                                class="font-headline-sm text-headline-sm text-cloud-white"
                                >Setiap Kamis</span
                            ><span
                                class="font-body-sm text-body-sm text-surface-dim"
                                >16.00 - 17.00 WIB</span
                            >
                            <div
                                class="mt-space-xs pt-space-xs text-surface-dim font-body-sm text-body-sm"
                            >
                                <span class=""
                                    >📍 Ruang Kelas SMKN 1 Purwokerto</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-space-sm">
                        <span
                            class="font-headline-sm text-headline-sm text-cloud-white"
                            >Lokasi &amp; Narahubung</span
                        >
                        <div
                            class="flex flex-col gap-space-xs text-surface-dim font-body-sm text-body-sm"
                        >
                            <span class="">SMK Negeri 1 Purwokerto</span
                            ><span class=""
                                >Jl. Dr. Soeparno No. 29, Karangwangkal</span
                            ><span class=""
                                >Purwokerto Timur, Banyumas 53123</span
                            ><span
                                class="text-aozora-sky font-label-md text-label-md mt-space-xs"
                                >Email: aozora@smkn1purwokerto.sch.id</span
                            >
                        </div>
                    </div>
                    <div class="flex flex-col gap-space-sm">
                        <span
                            class="font-headline-sm text-headline-sm text-cloud-white"
                            >Kanal Komunitas</span
                        >
                        <p class="font-body-sm text-body-sm text-surface-dim">
                            Ikuti dokumentasi terkini kegiatan, tutorial
                            kosakata, dan live event matsuri kami.
                        </p>
                        <div
                            class="flex flex-col gap-space-xs font-label-md text-label-md"
                        >
                            <a
                                class="inline-flex items-center justify-between px-space-md py-space-sm rounded-lg bg-cloud-white/5 hover:bg-cloud-white/10 text-cloud-white transition-colors"
                                href="#"
                                ><span class="">Instagram @aozora.smecon</span
                                ><span class="text-aozora-sky font-bold"
                                    >↗</span
                                ></a
                            ><a
                                class="inline-flex items-center justify-between px-space-md py-space-sm rounded-lg bg-cloud-white/5 hover:bg-cloud-white/10 text-cloud-white transition-colors"
                                href="#"
                                ><span class="">YouTube Aozora Channel</span
                                ><span class="text-aozora-sky font-bold"
                                    >↗</span
                                ></a
                            ><a
                                class="inline-flex items-center justify-between px-space-md py-space-sm rounded-lg bg-cloud-white/5 hover:bg-cloud-white/10 text-cloud-white transition-colors"
                                href="#"
                                ><span class=""
                                    >Discord Server Aozora Kaiwa</span
                                ><span class="text-aozora-sky font-bold"
                                    >↗</span
                                ></a
                            >
                        </div>
                    </div>
                </div>
                <div
                    class="pt-space-lg flex flex-col md:flex-row items-center justify-between gap-space-md font-body-sm text-body-sm text-surface-dim"
                >
                    <div class="flex items-center gap-space-xs">
                        <span class=""
                            >© 2025 Aozora Nihongo Club SMKN 1 Purwokerto.</span
                        ><span class="">Hak Cipta Dilindungi.</span>
                    </div>
                    <div
                        class="flex items-center gap-space-md font-label-md text-label-md"
                    >
                        <span class="text-cloud-white/70"
                            >一期一会 (Ichigo Ichie)</span
                        ><span class="">•</span
                        ><span class="text-aozora-sky"
                            >Aozora Blue Skies Ahead</span
                        >
                    </div>
                </div>
            </div>
        </footer>
    @stack('scripts')

    {{-- ===== MODAL LOGIN (di luar semua stacking context) ===== --}}
    <div
        id="login-modal"
        style="position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:1rem;"
        aria-modal="true"
        role="dialog"
        aria-labelledby="login-modal-title"
    >
        {{-- Backdrop --}}
        <div
            style="position:absolute;inset:0;background:rgba(10,18,41,0.65);backdrop-filter:blur(6px);"
            onclick="closeLoginModal()"
        ></div>

        {{-- Panel --}}
        <div style="position:relative;width:100%;max-width:28rem;background:var(--color-surface-container-lowest,#fff);border-radius:1rem;box-shadow:0 25px 60px rgba(0,0,0,0.3);overflow:hidden;animation:fadeInUp 0.25s ease;">
            {{-- Header panel --}}
            <div class="bg-primary p-6 text-center">
                <img src="{{ asset('assets/ANC_icon.jpg') }}" alt="ANC Icon" class="w-14 h-14 rounded-full mx-auto mb-3 shadow-lg border-2 border-on-primary/20" />
                <h2 id="login-modal-title" class="text-2xl font-bold text-on-primary font-headline-md tracking-tight">Portal Admin Aozora</h2>
                <p class="text-on-primary/80 text-sm mt-1">Masuk untuk mengelola event &amp; dokumentasi.</p>
            </div>

            {{-- Form --}}
            <div class="p-8">
                <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-5">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-error-container text-on-error-container p-3 rounded-lg text-sm">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex flex-col gap-1">
                        <label for="modal-email" class="text-sm font-semibold text-on-surface">Email Administrator</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-xl">mail</span>
                            <input type="email" name="email" id="modal-email" value="{{ old('email') }}" required
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                                placeholder="admin@aozora.local">
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="modal-password" class="text-sm font-semibold text-on-surface">Kata Sandi</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-xl">lock</span>
                            <input type="password" name="password" id="modal-password" required
                                class="w-full pl-10 pr-11 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                                placeholder="••••••••">
                            <button
                                type="button"
                                onclick="toggleModalPassword()"
                                id="btn-toggle-password"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors focus:outline-none"
                                aria-label="Toggle tampilkan password"
                                tabindex="-1"
                            >
                                <span class="material-symbols-outlined text-xl" id="icon-toggle-password">visibility</span>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="mt-2 w-full py-3 px-4 bg-primary hover:bg-primary/90 text-on-primary font-bold rounded-lg transition-colors flex items-center justify-center gap-2">
                        Masuk ke Dashboard
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </button>
                </form>

                <button onclick="closeLoginModal()" class="mt-5 w-full text-center text-sm font-semibold text-secondary hover:text-primary transition-colors">
                    &larr; Tutup
                </button>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            from { opacity:0; transform:translateY(24px) scale(0.97); }
            to   { opacity:1; transform:translateY(0) scale(1); }
        }
    </style>

    <script>
        function openLoginModal()  { var m=document.getElementById('login-modal'); m.style.display='flex'; document.body.style.overflow='hidden'; }
        function closeLoginModal() { var m=document.getElementById('login-modal'); m.style.display='none'; document.body.style.overflow=''; }
        function toggleModalPassword() {
            var input = document.getElementById('modal-password');
            var icon  = document.getElementById('icon-toggle-password');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }

        // Tombol buka modal di navbar
        document.addEventListener('DOMContentLoaded', function () {
            var btn = document.getElementById('btn-open-login-modal');
            if (btn) btn.addEventListener('click', openLoginModal);

            @if ($errors->any())
            openLoginModal();
            @endif
        });

        // Tutup dengan Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLoginModal();
        });
    </script>

</body>
</html>