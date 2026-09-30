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
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->colors([
                'primary' => Color::hex('#0D59F2'),
                'danger' => Color::hex('#D32F2F'),
                'gray' => Color::Slate,
                'info' => Color::hex('#0284C7'),
                'success' => Color::hex('#10B981'),
                'warning' => Color::hex('#F59E0B'),
            ])
            ->font('Be Vietnam Pro')
            ->favicon(asset('assets/ANC_icon.png'))
            ->brandLogo(fn () => view('filament.logo'))
            ->brandLogoHeight('3rem')
            ->userMenuItems([
                'home' => \Filament\Navigation\MenuItem::make()
                    ->label('Buka Website Utama')
                    ->url('/')
                    ->icon('heroicon-o-arrow-top-right-on-square'),
            ])
            ->renderHook(
                \Filament\View\PanelsRenderHook::SIDEBAR_NAV_END,
                fn () => view('filament.sidebar-footer')
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::TOPBAR_LOGO_AFTER,
                fn () => view('filament.topbar-start')
            )
            ->resources([
                \App\Filament\Inventaris\Resources\InventarisItems\InventarisItemResource::class,
                \App\Filament\Inventaris\Resources\Loans\LoanResource::class,
                \App\Filament\Inventaris\Resources\ReturnResource::class,
                \App\Filament\Inventaris\Resources\LaporanKerusakan\LaporanKerusakanResource::class,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\AdminActivityChart::class,
                \App\Filament\Widgets\LatestEventsWidget::class,
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
