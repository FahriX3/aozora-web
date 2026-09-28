<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class InventarisPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('inventaris')
            ->path('inventaris')
            ->login()
            ->colors([
                'primary' => Color::hex('#0F766E'), // Teal
                'danger' => Color::hex('#D32F2F'),  // Vermilion
                'gray' => Color::Slate,
                'info' => Color::hex('#0284C7'),
                'success' => Color::hex('#10B981'),
                'warning' => Color::hex('#F59E0B'),
            ])
            ->font('Be Vietnam Pro')
            ->favicon(asset('assets/ANC_icon.jpg'))
            ->brandLogo(fn () => view('filament.logo-inventaris'))
            ->brandLogoHeight('3rem')
            ->renderHook(
                \Filament\View\PanelsRenderHook::SIDEBAR_NAV_END,
                fn () => view('filament.sidebar-footer')
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::TOPBAR_LOGO_AFTER,
                fn () => view('filament.topbar-start')
            )
            ->discoverResources(in: app_path('Filament/Inventaris/Resources'), for: 'App\Filament\Inventaris\Resources')
            ->discoverPages(in: app_path('Filament/Inventaris/Pages'), for: 'App\Filament\Inventaris\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Inventaris/Widgets'), for: 'App\Filament\Inventaris\Widgets')
            ->widgets([
                \App\Filament\Inventaris\Widgets\InventarisStatsOverview::class,
                \App\Filament\Inventaris\Widgets\RecentTransaksiWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
