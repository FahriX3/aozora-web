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

class AnggotaPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('anggota')
            ->path('anggota')
            ->login()
            ->colors([
                'primary' => Color::hex('#E11D48'), // Rose / Sakura
                'danger' => Color::hex('#D32F2F'),
                'gray' => Color::Slate,
                'info' => Color::hex('#0284C7'),
                'success' => Color::hex('#10B981'),
                'warning' => Color::hex('#F59E0B'),
            ])
            ->font('Be Vietnam Pro')
            ->favicon(asset('assets/ANC_icon.png'))
            ->brandLogo(fn () => view('filament.logo-anggota'))
            ->brandLogoHeight('3rem')
            ->userMenuItems([
                'home' => \Filament\Navigation\MenuItem::make()
                    ->label('Buka Website Utama')
                    ->url('/')
                    ->icon('heroicon-o-arrow-top-right-on-square'),
            ])
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn () => view('filament.custom-styles')
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::SIDEBAR_NAV_END,
                fn () => view('filament.sidebar-footer')
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::TOPBAR_LOGO_AFTER,
                fn () => view('filament.topbar-start')
            )
            ->discoverResources(in: app_path('Filament/Anggota/Resources'), for: 'App\Filament\Anggota\Resources')
            ->discoverPages(in: app_path('Filament/Anggota/Pages'), for: 'App\Filament\Anggota\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Anggota/Widgets'), for: 'App\Filament\Anggota\Widgets')
            ->widgets([
                \App\Filament\Anggota\Widgets\AnggotaOverviewWidget::class,
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
