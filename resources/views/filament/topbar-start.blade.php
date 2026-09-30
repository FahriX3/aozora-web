@php
    $user = auth()->user();
    $currentPanel = filament()->getId();

    $canAdmin = $user && $user->canAccessPanel(filament()->getPanel('admin'));
    $canInventaris = $user && $user->canAccessPanel(filament()->getPanel('inventaris'));
    $canEvents = $user && $user->canAccessPanel(filament()->getPanel('events'));
@endphp

<div class="anc-topbar-wrapper" style="display: flex; align-items: center; gap: 8px; margin-left: 8px;">
    {{-- Dynamic Panel Switcher Bar --}}
    <div class="anc-panel-switcher" style="display: inline-flex; align-items: center; padding: 3px; border-radius: 10px; gap: 3px;">
        @if($canAdmin)
            <a href="{{ url('/admin') }}"
               title="Masuk ke Admin Central Hub"
               class="anc-nav-pill {{ $currentPanel === 'admin' ? 'active-admin' : '' }}">
                <span style="font-size: 13px; line-height: 1;">👑</span>
                <span>Admin Hub</span>
            </a>
        @endif

        @if($canInventaris)
            <a href="{{ url('/inventaris') }}"
               title="Masuk ke Panel Inventaris &amp; Logistik"
               class="anc-nav-pill {{ $currentPanel === 'inventaris' ? 'active-inventaris' : '' }}">
                <span style="font-size: 13px; line-height: 1;">📦</span>
                <span>Inventaris</span>
            </a>
        @endif

        @if($canEvents)
            <a href="{{ url('/events') }}"
               title="Masuk ke Panel Event &amp; Dokumentasi"
               class="anc-nav-pill {{ $currentPanel === 'events' ? 'active-events' : '' }}">
                <span style="font-size: 13px; line-height: 1;">🎪</span>
                <span>Events</span>
            </a>
        @endif
    </div>

    {{-- Website Utama Link --}}
    <a href="{{ url('/') }}" target="_blank"
       title="Buka Website Utama Aozora di Tab Baru"
       class="anc-web-link">
        <svg width="14" height="14" style="width: 14px; height: 14px; min-width: 14px; max-width: 14px; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
        </svg>
        <span>Web Utama</span>
    </a>
</div>
