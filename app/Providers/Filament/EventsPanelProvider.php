<?php

namespace App\Providers\Filament;

use App\Filament\Resources\Documentations\EventDocumentationResource;
use App\Filament\Resources\Events\EventResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class EventsPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('events')
            ->path('events-hub')
            ->login()
            ->colors([
                'primary' => Color::hex('#6366F1'), // Indigo / Vibrant Event
                'danger' => Color::hex('#D32F2F'),
                'gray' => Color::Slate,
                'info' => Color::hex('#0284C7'),
                'success' => Color::hex('#10B981'),
                'warning' => Color::hex('#F59E0B'),
            ])
            ->font('Be Vietnam Pro')
            ->favicon(asset('assets/ANC_icon.png'))
            ->brandLogo(fn () => view('filament.logo-events'))
            ->brandLogoHeight('3rem')
            ->userMenuItems([
                'home' => MenuItem::make()
                    ->label('Buka Website Utama')
                    ->url('/')
                    ->icon('heroicon-o-arrow-top-right-on-square'),
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn () => view('filament.custom-styles')
            )
            ->renderHook(
                PanelsRenderHook::SIDEBAR_NAV_END,
                fn () => view('filament.sidebar-footer')
            )
            ->renderHook(
                PanelsRenderHook::TOPBAR_LOGO_AFTER,
                fn () => view('filament.topbar-start')
            )
            ->resources([
                EventResource::class,
                EventDocumentationResource::class,
            ])
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Pdd/Widgets'), for: 'App\Filament\Pdd\Widgets')
            ->widgets([
                \App\Filament\Pdd\Widgets\PddStatsOverview::class,
                \App\Filament\Pdd\Widgets\PddEventsChart::class,
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
