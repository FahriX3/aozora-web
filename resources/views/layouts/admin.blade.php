<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'Admin Portal') - Aozora Nihongo Club</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; font-family: 'Be Vietnam Pro', sans-serif;}
            h1,h2,h3,h4,h5,h6 { font-family: 'Plus Jakarta Sans', sans-serif;}
        }
        ::-webkit-scrollbar { display: none; }
    </style>
    @stack('styles')
</head>
<body class="bg-surface-container-low font-body-md text-body-md text-on-surface antialiased selection:bg-primary selection:text-on-primary">
    
    <aside class="hidden lg:flex fixed left-0 top-0 h-full w-72 bg-surface-container-lowest z-50 flex-col justify-between shadow-[0_4px_24px_-4px_rgba(13,89,242,0.08)]">
        <div class="flex flex-col">
            <div class="h-20 px-space-lg flex items-center justify-between bg-surface-container-low/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center shadow-[0_4px_14px_rgba(13,89,242,0.3)]">
                        <span class="material-symbols-outlined text-on-primary text-[22px]">cyclone</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-1.5">
                            <span class="font-headline-sm text-headline-sm font-bold tracking-tight text-on-surface">青空</span>
                            <span class="font-headline-sm text-headline-sm font-bold tracking-tight text-primary">AOZORA</span>
                        </div>
                        <span class="font-label-badge text-label-badge text-outline uppercase">SMKN 1 Purwokerto</span>
                    </div>
                </div>
                <span class="font-label-badge text-label-badge bg-sakura-tint text-torii-vermilion px-2 py-0.5 rounded-full font-bold">部活</span>
            </div>
            
            <div class="px-space-lg pt-space-md pb-space-xs">
                <span class="font-label-badge text-label-badge text-outline uppercase tracking-wider">Navigasi Portal</span>
            </div>
            
            <nav class="flex flex-col gap-1.5 px-space-md">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-space-md py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-on-primary font-bold shadow-[0_8px_20px_-4px_rgba(13,89,242,0.35)]' : 'text-on-surface-variant font-label-lg hover:bg-surface-container hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">space_dashboard</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 px-space-md py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.events.*') ? 'bg-primary text-on-primary font-bold shadow-[0_8px_20px_-4px_rgba(13,89,242,0.35)]' : 'text-on-surface-variant font-label-lg hover:bg-surface-container hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">celebration</span>
                    <span>Manajemen Event</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-space-md py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-primary text-on-primary font-bold shadow-[0_8px_20px_-4px_rgba(13,89,242,0.35)]' : 'text-on-surface-variant font-label-lg hover:bg-surface-container hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">how_to_reg</span>
                    <span>Manajemen Pengguna</span>
                </a>
                <a href="{{ route('admin.featured-event.index') }}" class="flex items-center gap-3 px-space-md py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.featured-event.*') ? 'bg-primary text-on-primary font-bold shadow-[0_8px_20px_-4px_rgba(13,89,242,0.35)]' : 'text-on-surface-variant font-label-lg hover:bg-surface-container hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">smart_display</span>
                    <span>Event Unggulan</span>
                </a>
            </nav>
        </div>
        
        <div class="p-space-md">
            <div class="p-space-md rounded-xl bg-surface-container-low flex flex-col gap-2 relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <span class="font-label-badge text-label-badge text-primary uppercase font-bold">Status Server</span>
                    <span class="flex h-2 w-2 rounded-full bg-aozora-sky animate-pulse"></span>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Sistem aktif</p>
                
                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full py-1.5 flex justify-center items-center gap-2 bg-error-container text-on-error-container rounded hover:bg-error hover:text-on-error transition text-sm font-semibold">
                        <span class="material-symbols-outlined text-sm">logout</span> Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div class="lg:pl-72">
        <header class="fixed top-0 left-0 lg:left-72 right-0 h-20 bg-surface-container-lowest/90 backdrop-blur-xl z-40 flex items-center justify-between px-space-md lg:px-space-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 bg-surface-container-low px-3 py-1.5 rounded-full">
                    <span class="material-symbols-outlined text-[18px] text-aozora-sky">school</span>
                    <span class="font-label-md text-label-md text-on-surface font-semibold">SMKN 1 Purwokerto</span>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="h-8 w-[1px] bg-surface-container-high"></div>
                <div class="flex items-center gap-3 pl-1">
                    <div class="flex flex-col text-right">
                        <span class="font-label-lg text-label-lg text-on-surface font-bold">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <span class="font-label-badge text-label-badge text-torii-vermilion uppercase font-semibold">Administrator</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
                    </div>
                </div>
            </div>
        </header>

        <main class="relative pt-20 w-full min-h-screen bg-surface-container-low">
            <div class="p-space-md lg:p-space-xl flex flex-col gap-space-lg lg:gap-space-xl">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Mobile Navigation Bottom Bar -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-surface-container-lowest border-t border-outline-variant flex justify-around items-center h-16 z-50">
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined text-[24px]">space_dashboard</span>
            <span class="text-[10px] font-bold mt-1">Dashboard</span>
        </a>
        <a href="{{ route('admin.events.index') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.events.*') ? 'text-primary' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined text-[24px]">celebration</span>
            <span class="text-[10px] font-bold mt-1">Event</span>
        </a>
        <a href="{{ route('admin.users.index') ?? '#' }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.users.*') ? 'text-primary' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined text-[24px]">how_to_reg</span>
            <span class="text-[10px] font-bold mt-1">Pengguna</span>
        </a>
        <a href="{{ route('admin.featured-event.index') }}" class="flex flex-col items-center justify-center w-full h-full {{ request()->routeIs('admin.featured-event.*') ? 'text-primary' : 'text-on-surface-variant' }}">
            <span class="material-symbols-outlined text-[24px]">smart_display</span>
            <span class="text-[10px] font-bold mt-1">Unggulan</span>
        </a>
    </nav>

    @stack('scripts')
</body>
</html>