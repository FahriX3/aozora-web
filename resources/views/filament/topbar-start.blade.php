@php
    $user = auth()->user();
    $currentPanel = filament()->getId();

    $canAdmin = $user && $user->canAccessPanel(filament()->getPanel('admin'));
    $canInventaris = $user && $user->canAccessPanel(filament()->getPanel('inventaris'));
    $canPdd = $user && $user->canAccessPanel(filament()->getPanel('pdd'));
@endphp

<div class="hidden sm:flex items-center gap-2 ml-3">
    {{-- Dynamic Panel Switcher Bar --}}
    <div class="flex items-center p-0.5 rounded-xl bg-gray-100/90 dark:bg-gray-800/80 border border-gray-200/80 dark:border-gray-700/80 text-xs font-semibold">
        @if($canAdmin)
            <a href="{{ url('/admin') }}"
               title="Masuk ke Admin Central Hub"
               class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg transition-all {{ $currentPanel === 'admin' ? 'bg-white dark:bg-gray-700 text-blue-600 dark:text-blue-400 shadow-xs font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                <span>👑</span>
                <span>Admin Hub</span>
            </a>
        @endif

        @if($canInventaris)
            <a href="{{ url('/inventaris') }}"
               title="Masuk ke Panel Inventaris &amp; Logistik"
               class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg transition-all {{ $currentPanel === 'inventaris' ? 'bg-white dark:bg-gray-700 text-teal-600 dark:text-teal-400 shadow-xs font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                <span>📦</span>
                <span>Inventaris</span>
            </a>
        @endif

        @if($canPdd)
            <a href="{{ url('/pdd') }}"
               title="Masuk ke Panel Publikasi &amp; Dokumentasi (PDD)"
               class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg transition-all {{ $currentPanel === 'pdd' ? 'bg-white dark:bg-gray-700 text-purple-600 dark:text-purple-400 shadow-xs font-bold' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white' }}">
                <span>📸</span>
                <span>PDD Studio</span>
            </a>
        @endif
    </div>

    {{-- Website Utama Link --}}
    <a href="{{ url('/') }}" target="_blank"
       title="Buka Website Utama Aozora di Tab Baru"
       class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-gray-100/90 dark:bg-gray-800/80 hover:bg-gray-200/80 dark:hover:bg-gray-700/80 border border-gray-200/80 dark:border-gray-700/80 text-gray-700 dark:text-gray-300 text-xs font-semibold transition-all">
        <svg class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
        </svg>
        <span>Web Utama</span>
    </a>
</div>
