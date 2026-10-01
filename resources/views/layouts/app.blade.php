<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Aozora Nihongo Club - SMKN 1 Purwokerto</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/ANC_icon.png') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/ANC_icon.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('assets/ANC_icon.png') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&amp;family=Plus+Jakarta+Sans:wght@600;700;800&amp;family=Space+Grotesk:wght@500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
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

            main> :first-child {
                margin-top: 0 !important;
            }

            main> :last-child {
                margin-bottom: 0 !important;
            }
        }

        ::-webkit-scrollbar {
            display: none;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>

<body
    class="bg-surface font-body-md text-body-md text-on-surface antialiased selection:bg-aozora-sky selection:text-indigo-night">
    {{-- Top Livewire Loading Indicator --}}
    <div wire:loading class="wire-loading-indicator"></div>

    <header
        class="fixed top-0 left-0 w-full z-50 bg-white/95 backdrop-blur-md border-b border-gray-200/80 shadow-xs transition-all duration-200">
        <div class="h-20 max-w-[1280px] mx-auto px-4 md:px-8 flex items-center justify-between gap-4">
            {{-- Brand Logo with Official ANC Image --}}
            <a class="flex items-center gap-3 group" href="/#beranda" title="Aozora Nihongo Club Purwokerto">
                <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Logo"
                    class="w-10 h-10 rounded-full object-cover shadow-sm ring-1 ring-black/5 group-hover:scale-105 transition-transform" />
                <div class="flex flex-col leading-tight">
                    <div class="flex items-center gap-1.5">
                        <span class="text-lg font-bold text-gray-900 tracking-tight">Aozora</span>
                        <span
                            class="text-[11px] font-semibold px-2 py-0.5 rounded-full bg-rose-50 text-rose-600 border border-rose-100">日本語部</span>
                    </div>
                    <span class="text-xs text-gray-500 font-medium tracking-wide">SMKN 1 Purwokerto</span>
                </div>
            </a>

            {{-- Desktop Navigation (Simple, clean, consistent) --}}
            <nav class="hidden lg:flex items-center gap-8">
                <a class="nav-anchor text-sm font-medium text-gray-600 hover:text-primary transition-colors cursor-pointer"
                    href="/#beranda">
                    Beranda
                </a>
                <a class="nav-anchor text-sm font-medium text-gray-600 hover:text-primary transition-colors cursor-pointer"
                    href="/#tentang">
                    Tentang Kami
                </a>
                <a class="nav-anchor text-sm font-medium text-gray-600 hover:text-primary transition-colors cursor-pointer"
                    href="/#event">
                    Event &amp; Matsuri
                </a>
                <a class="nav-anchor text-sm font-medium text-gray-600 hover:text-primary transition-colors cursor-pointer"
                    href="/#pengurus">
                    Daftar Pengurus
                </a>
                <a class="nav-anchor text-sm font-medium text-gray-600 hover:text-primary transition-colors cursor-pointer"
                    href="/#kontak">
                    Kontak
                </a>
            </nav>

            {{-- Right Header Actions (Auth / Portal / Mobile Menu) --}}
            <div class="flex items-center gap-3">
                @guest
                    {{-- Tombol Buka Portal Login --}}
                    <button id="btn-open-login-modal" type="button" onclick="openLoginModal()"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary hover:bg-primary/90 text-white font-medium text-sm shadow-sm hover:shadow transition-all cursor-pointer"
                        title="Login Internal Aozora (Admin, Inventaris, Anggota)">
                        <span class="material-symbols-outlined text-base">login</span>
                        <span>Login</span>
                    </button>
                @else
                    {{-- User Authenticated Chip & Dropdown --}}
                    <div class="relative" id="user-menu-container">
                        @php
                            $user = Auth::user();
                            $roleLabel = 'Anggota';
                            $roleBadgeColor = 'bg-emerald-100 text-emerald-800 border-emerald-300';
                            $panelUrl = '/anggota';

                            if ($user->hasRole('super_admin')) {
                                $roleLabel = '👑 Super Admin';
                                $roleBadgeColor = 'bg-rose-100 text-rose-800 border-rose-300';
                                $panelUrl = '/admin';
                            } elseif ($user->hasRole('admin')) {
                                $roleLabel = '⭐ Admin Konten';
                                $roleBadgeColor = 'bg-blue-100 text-blue-800 border-blue-300';
                                $panelUrl = '/admin';
                            } elseif ($user->hasRole('koordinator_inventaris')) {
                                $roleLabel = '📦 Koord. Inventaris';
                                $roleBadgeColor = 'bg-amber-100 text-amber-800 border-amber-300';
                                $panelUrl = '/inventaris';
                            } elseif ($user->hasRole('anggota')) {
                                $roleLabel = '👤 Anggota';
                                $roleBadgeColor = 'bg-emerald-100 text-emerald-800 border-emerald-300';
                                $panelUrl = '/anggota';
                            }
                        @endphp

                        <button type="button" onclick="toggleUserMenu()"
                            class="inline-flex items-center gap-2.5 px-3 py-1.5 rounded-full bg-cloud-white border border-outline-variant/60 shadow-sm hover:shadow hover:border-primary/40 transition-all cursor-pointer"
                            id="btn-user-menu">
                            <div
                                class="w-8 h-8 rounded-full bg-primary text-cloud-white flex items-center justify-center font-bold text-sm shadow-xs">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="hidden sm:flex flex-col text-left">
                                <span
                                    class="font-label-md text-xs font-bold text-indigo-night truncate max-w-[120px]">{{ $user->name }}</span>
                                <span class="text-[10px] text-secondary font-medium">{{ $roleLabel }}</span>
                            </div>
                            <span class="material-symbols-outlined text-sm text-secondary">expand_more</span>
                        </button>

                        {{-- User Dropdown Card --}}
                        <div id="user-dropdown-menu"
                            class="hidden absolute right-0 mt-2 w-64 rounded-2xl bg-cloud-white border border-surface-container-high/80 shadow-2xl p-4 z-50 animate-modal-in">
                            <div class="pb-3 border-b border-surface-container-high/60">
                                <p class="font-bold text-indigo-night text-sm">{{ $user->name }}</p>
                                <p class="text-xs text-secondary truncate">{{ $user->email }}</p>
                                <span
                                    class="inline-block mt-2 px-2.5 py-0.5 rounded-full text-[11px] font-bold border {{ $roleBadgeColor }}">
                                    {{ $roleLabel }}
                                </span>
                            </div>

                            <div class="py-2.5 flex flex-col gap-1">
                                <a href="{{ url($panelUrl) }}"
                                    class="w-full px-3 py-2 rounded-xl bg-primary text-cloud-white text-xs font-bold hover:bg-primary/90 flex items-center justify-between shadow-sm transition-colors">
                                    <span>🚀 Buka Dashboard Panel</span>
                                    <span class="material-symbols-outlined text-sm">open_in_new</span>
                                </a>

                                @if($user->hasRole('super_admin'))
                                    <div class="pt-2 text-[10px] font-bold text-secondary uppercase tracking-wider">Akses Panel
                                        Lain:</div>
                                    <div class="grid grid-cols-2 gap-1.5">
                                        <a href="{{ url('/admin') }}"
                                            class="px-2 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container text-indigo-night text-[11px] font-semibold text-center">
                                            Admin
                                        </a>
                                        <a href="{{ url('/inventaris') }}"
                                            class="px-2 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container text-indigo-night text-[11px] font-semibold text-center">
                                            Inventaris
                                        </a>
                                    </div>
                                    <a href="{{ url('/anggota') }}"
                                        class="px-2 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container text-indigo-night text-[11px] font-semibold text-center">
                                        Panel Anggota
                                    </a>
                                @endif
                            </div>

                            <div class="pt-2 border-t border-surface-container-high/60">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-3 py-1.5 rounded-lg text-xs font-bold text-torii-vermilion hover:bg-torii-vermilion/10 flex items-center justify-center gap-1.5 transition-colors cursor-pointer">
                                        <span class="material-symbols-outlined text-sm">logout</span>
                                        Keluar (Logout)
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest

                {{-- Mobile Menu Hamburger --}}
                <button type="button" onclick="toggleMobileDrawer()"
                    class="lg:hidden w-10 h-10 rounded-xl bg-surface-container-low border border-surface-container-high flex items-center justify-center text-indigo-night hover:text-primary transition-colors focus:outline-none"
                    aria-label="Buka menu navigasi">
                    <span class="material-symbols-outlined text-2xl" id="icon-mobile-menu">menu</span>
                </button>
            </div>
        </div>

        {{-- Mobile Drawer Navigation --}}
        <div id="mobile-drawer"
            class="hidden lg:hidden border-t border-gray-100 bg-white/98 backdrop-blur-xl px-4 py-4 shadow-xl">
            <div class="flex items-center gap-3 px-3 py-2.5 mb-3 rounded-xl bg-gray-50 border border-gray-100">
                <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Logo"
                    class="w-10 h-10 rounded-full object-cover ring-1 ring-black/5" />
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-gray-900">Aozora Nihongo Club</span>
                    <span class="text-xs text-gray-500">SMKN 1 Purwokerto</span>
                </div>
            </div>
            <nav class="flex flex-col gap-1">
                <a class="px-4 py-2.5 rounded-xl font-medium text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2.5 transition-colors"
                    href="/#beranda" onclick="toggleMobileDrawer()">
                    <span class="material-symbols-outlined text-lg">home</span>
                    Beranda
                </a>
                <a class="px-4 py-2.5 rounded-xl font-medium text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2.5 transition-colors"
                    href="/#tentang" onclick="toggleMobileDrawer()">
                    <span class="material-symbols-outlined text-lg">info</span>
                    Tentang Kami
                </a>
                <a class="px-4 py-2.5 rounded-xl font-medium text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2.5 transition-colors"
                    href="/#event" onclick="toggleMobileDrawer()">
                    <span class="material-symbols-outlined text-lg">celebration</span>
                    Event &amp; Matsuri
                </a>
                <a class="px-4 py-2.5 rounded-xl font-medium text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2.5 transition-colors"
                    href="/#pengurus" onclick="toggleMobileDrawer()">
                    <span class="material-symbols-outlined text-lg">groups</span>
                    Daftar Pengurus
                </a>
                <a class="px-4 py-2.5 rounded-xl font-medium text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2.5 transition-colors"
                    href="/#kontak" onclick="toggleMobileDrawer()">
                    <span class="material-symbols-outlined text-lg">call</span>
                    Kontak
                </a>
            </nav>
        </div>
    </header>

    <main class="w-full pt-20 bg-surface min-h-screen">
        @yield('content')
    </main>
    <footer class="w-full bg-indigo-night text-cloud-white pt-space-2xl pb-space-xl relative overflow-hidden">
        <div
            class="absolute -right-16 -top-16 text-[220px] font-headline-lg font-extrabold text-cloud-white/[0.03] select-none pointer-events-none">
            青空
        </div>
        <div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-xl pb-space-2xl">
                <div class="flex flex-col gap-space-md">
                    <div class="flex items-center gap-space-sm">
                        <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Logo"
                            class="w-9 h-9 rounded-full object-cover ring-1 ring-white/20 shrink-0" />
                        <span class="font-headline-sm text-headline-sm tracking-tight text-cloud-white">Aozora Nihongo
                            Club</span>
                    </div>
                    <p class="font-body-sm text-body-sm text-surface-dim leading-relaxed">
                        Ekstrakurikuler Bahasa dan Kebudayaan Jepang di SMKN
                        1 Purwokerto. Ruang eksplorasi bahasa, anime
                        culture, kaiwa, cosplay, kaligrafi shodo, dan
                        matsuri berprestasi.
                    </p>
                    <div
                        class="inline-flex items-center gap-space-xs self-start px-space-sm py-1 rounded-full bg-cloud-white/10 text-aozora-sky font-label-badge text-label-badge">
                        <span class="">🇯🇵 PURWOKERTO JAPANESE CLUB</span>
                    </div>
                </div>
                <div class="flex flex-col gap-space-sm">
                    <span
                        class="font-headline-sm text-headline-sm text-cloud-white flex items-center gap-space-xs"><span
                            class="text-torii-vermilion">⛩️</span> Info
                        Jadwal Rutin</span>
                    <div class="p-space-md rounded-xl bg-cloud-white/5 flex flex-col gap-space-xs">
                        <div class="flex items-center gap-space-xs text-aozora-sky font-label-md text-label-md">
                            <span class="w-2 h-2 rounded-full bg-aozora-sky animate-ping"></span><span
                                class="">PERTEMUAN MINGGUAN</span>
                        </div>
                        <span class="font-headline-sm text-headline-sm text-cloud-white">Setiap Kamis</span><span
                            class="font-body-sm text-body-sm text-surface-dim">16.00 - 17.00 WIB</span>
                        <div class="mt-space-xs pt-space-xs text-surface-dim font-body-sm text-body-sm">
                            <span class="">📍 Ruang Kelas SMKN 1 Purwokerto</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-space-sm">
                    <span class="font-headline-sm text-headline-sm text-cloud-white">Lokasi &amp; Narahubung</span>
                    <div class="flex flex-col gap-space-xs text-surface-dim font-body-sm text-body-sm">
                        <span class="">SMK Negeri 1 Purwokerto</span><span class="">Jl. Dr. Soeparno No. 29,
                            Karangwangkal</span><span class="">Purwokerto Timur, Banyumas 53123</span><span
                            class="text-aozora-sky font-label-md text-label-md mt-space-xs">Email:
                            noreplyaozora@gmail.com</span>
                    </div>
                </div>
                <div class="flex flex-col gap-space-sm">
                    <span class="font-headline-sm text-headline-sm text-cloud-white">Kanal Komunitas</span>
                    <p class="font-body-sm text-body-sm text-surface-dim">
                        Ikuti dokumentasi terkini kegiatan, tutorial
                        kosakata, dan live event matsuri kami.
                    </p>
                    <div class="flex flex-col gap-space-xs font-label-md text-label-md">
                        <a class="inline-flex items-center justify-between px-space-md py-space-sm rounded-lg bg-cloud-white/5 hover:bg-cloud-white/10 text-cloud-white transition-colors"
                            href="#"><span class="">Instagram @aozora.smecon</span><span
                                class="text-aozora-sky font-bold">↗</span></a><a
                            class="inline-flex items-center justify-between px-space-md py-space-sm rounded-lg bg-cloud-white/5 hover:bg-cloud-white/10 text-cloud-white transition-colors"
                            href="#"><span class="">YouTube Aozora Channel</span><span
                                class="text-aozora-sky font-bold">↗</span></a><a
                            class="inline-flex items-center justify-between px-space-md py-space-sm rounded-lg bg-cloud-white/5 hover:bg-cloud-white/10 text-cloud-white transition-colors"
                            href="#"><span class="">Discord Server Aozora Kaiwa</span><span
                                class="text-aozora-sky font-bold">↗</span></a>
                    </div>
                </div>
            </div>
            <div
                class="pt-space-lg flex flex-col md:flex-row items-center justify-between gap-space-md font-body-sm text-body-sm text-surface-dim">
                <div class="flex items-center gap-space-xs">
                    <span class="">© 2025 Aozora Nihongo Club SMKN 1 Purwokerto.</span><span class="">Hak Cipta
                        Dilindungi.</span>
                </div>
                <div class="flex items-center gap-space-md font-label-md text-label-md">
                    <span class="text-cloud-white/70">一期一会 (Ichigo Ichie)</span><span class="">•</span><span
                        class="text-aozora-sky">Aozora Blue Skies Ahead</span>
                </div>
            </div>
        </div>
    </footer>
    @stack('scripts')

    {{-- ===== MODAL LOGIN RESIK & MINIMALIS (Google OAuth + Email) ===== --}}
    <div id="login-modal"
        style="position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;padding:1rem;"
        aria-modal="true" role="dialog" aria-labelledby="login-modal-title">
        {{-- Backdrop --}}
        <div style="position:absolute;inset:0;background:rgba(11,16,33,0.65);backdrop-filter:blur(6px);"
            onclick="closeLoginModal()"></div>

        {{-- Panel Card --}}
        <div
            class="relative w-full max-w-[420px] bg-white rounded-3xl shadow-[0_25px_60px_rgba(0,0,0,0.28)] overflow-hidden border border-gray-100 animate-modal-in z-10 p-6 sm:p-8">
            
            {{-- Close Button --}}
            <button type="button" onclick="closeLoginModal()"
                class="absolute top-4 right-4 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-500 hover:text-gray-800 flex items-center justify-center transition-colors focus:outline-none cursor-pointer"
                aria-label="Tutup popup">
                <span class="material-symbols-outlined text-lg">close</span>
            </button>

            {{-- Top Branding --}}
            <div class="text-center mb-6">
                <div class="w-14 h-14 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center mx-auto mb-3 shadow-inner">
                    <img src="{{ asset('assets/ANC_icon.png') }}" alt="ANC Icon" class="w-11 h-11 rounded-full object-cover" />
                </div>
                <h2 id="login-modal-title" class="text-xl font-bold font-headline-md tracking-tight text-gray-900">
                    Masuk ke Aozora
                </h2>
                <p class="text-gray-500 text-xs mt-1">
                    Masuk untuk ngobrol dengan Sora AI atau kelola kegiatan klub.
                </p>
            </div>

            {{-- Flash Messages --}}
            @if (session('auth_success'))
                <div class="mb-4 bg-emerald-50 text-emerald-800 border border-emerald-200 p-3 rounded-xl text-xs flex items-center gap-2">
                    <span class="material-symbols-outlined text-base text-emerald-600 shrink-0">check_circle</span>
                    <span>{{ session('auth_success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-rose-50 text-rose-800 border border-rose-200 p-3 rounded-xl text-xs flex items-center gap-2">
                    <span class="material-symbols-outlined text-base text-rose-600 shrink-0">error</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-rose-50 text-rose-800 border border-rose-200 p-3 rounded-xl text-xs flex items-start gap-2">
                    <span class="material-symbols-outlined text-base text-rose-600 shrink-0 mt-0.5">error</span>
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Google OAuth Button --}}
            <a href="{{ route('auth.google') }}"
                class="w-full py-2.5 px-4 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl border border-gray-300 shadow-2xs hover:shadow-xs transition-all flex items-center justify-center gap-3 text-sm group cursor-pointer">
                <svg class="w-4 h-4 shrink-0 transition-transform group-hover:scale-105" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.8-2.4 3.65v3.03h3.88c2.27-2.09 3.665-5.17 3.665-9.12z"/>
                    <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.03c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.13C3.27 21.36 7.35 24 12 24z"/>
                    <path fill="#FBBC05" d="M5.28 14.29c-.25-.72-.38-1.49-.38-2.29s.13-1.57.38-2.29V6.58H1.25C.45 8.18 0 9.98 0 12s.45 3.82 1.25 5.42l4.03-3.13z"/>
                    <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.35 0 3.27 2.64 1.25 6.58l4.03 3.13c.95-2.83 3.6-4.96 6.72-4.96z"/>
                </svg>
                <span>Masuk dengan Google</span>
            </a>

            {{-- Divider --}}
            <div class="relative flex items-center justify-center my-4">
                <div class="border-t border-gray-200 w-full"></div>
                <span class="bg-white px-3 text-xs text-gray-400 font-medium">atau gunakan email</span>
            </div>

            {{-- Email Form --}}
            <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-3.5">
                @csrf

                <div class="flex flex-col gap-1">
                    <label for="modal-email" class="text-xs font-semibold text-gray-700">Email Akun</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">mail</span>
                        <input type="email" name="email" id="modal-email" value="{{ old('email') }}" required
                            class="w-full pl-9 pr-3 py-2 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:bg-white text-gray-800 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all placeholder:text-gray-400"
                            placeholder="nama@email.com">
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="modal-password" class="text-xs font-semibold text-gray-700">Kata Sandi</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">lock</span>
                        <input type="password" name="password" id="modal-password" required
                            class="w-full pl-9 pr-10 py-2 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:bg-white text-gray-800 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all placeholder:text-gray-400"
                            placeholder="••••••••">
                        <button type="button" onclick="toggleModalPassword()" id="btn-toggle-password"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary transition-colors focus:outline-none cursor-pointer"
                            aria-label="Toggle tampilkan password" tabindex="-1">
                            <span class="material-symbols-outlined text-lg" id="icon-toggle-password">visibility</span>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="mt-1 w-full py-2.5 px-4 bg-primary hover:bg-[#003099] text-white font-semibold text-sm rounded-xl shadow-xs hover:shadow transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <span>Masuk ke Akun</span>
                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                </button>
            </form>

            <div class="mt-4 pt-3 border-t border-gray-100 text-center">
                <p class="text-[11px] text-gray-400">
                    Masuk dengan Google otomatis terhubung sebagai anggota Aozora 🌸
                </p>
            </div>
        </div>
    </div>

    @livewireScripts

    <script>
        function openLoginModal() {
            var m = document.getElementById('login-modal');
            if (m) {
                m.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        }

        function closeLoginModal() {
            var m = document.getElementById('login-modal');
            if (m) {
                m.style.display = 'none';
                document.body.style.overflow = '';
            }
        }

        function toggleModalPassword() {
            var input = document.getElementById('modal-password');
            var icon = document.getElementById('icon-toggle-password');
            if (input && icon) {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.textContent = 'visibility_off';
                } else {
                    input.type = 'password';
                    icon.textContent = 'visibility';
                }
            }
        }

        function toggleUserMenu() {
            var menu = document.getElementById('user-dropdown-menu');
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }

        function toggleMobileDrawer() {
            var drawer = document.getElementById('mobile-drawer');
            var icon = document.getElementById('icon-mobile-menu');
            if (drawer) {
                drawer.classList.toggle('hidden');
                if (icon) {
                    icon.textContent = drawer.classList.contains('hidden') ? 'menu' : 'close';
                }
            }
        }

        // Close user dropdown when clicking outside
        document.addEventListener('click', function (e) {
            var container = document.getElementById('user-menu-container');
            var menu = document.getElementById('user-dropdown-menu');
            if (container && menu && !container.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });

        // Setup handlers on page ready and Livewire navigation
        function initAppInteractions() {
            var btn = document.getElementById('btn-open-login-modal');
            if (btn) {
                btn.onclick = openLoginModal;
            }

            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('login') === '1' || urlParams.get('login') === 'modal') {
                openLoginModal();
            }

            @if ($errors->any() || session('error'))
                openLoginModal();
            @endif
        }

        document.addEventListener('DOMContentLoaded', initAppInteractions);
        document.addEventListener('livewire:navigated', initAppInteractions);

        // Tutup modal dengan tombol Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeLoginModal();
                var menu = document.getElementById('user-dropdown-menu');
                if (menu) menu.classList.add('hidden');
            }
        });
    </script>

    {{-- Chatbot Sora (AI Assistant) Floating Widget --}}
    <x-chat-widget />
</body>

</html>