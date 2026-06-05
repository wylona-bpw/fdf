<?php
namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
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
            ->login(\App\Filament\Pages\Auth\Login::class)

            // ---- Branding FDF ----
            ->brandName('AMFDF')
            ->brandLogo(fn () => view('filament.logo'))
            ->brandLogoHeight('2.2rem')
            ->favicon(asset('favicon.ico'))

            // ---- Couleurs FDF ----
            ->colors([
                'primary' => Color::hex('#16348C'),
                'gray'    => Color::Slate,
                'danger'  => Color::Rose,
                'info'    => Color::Sky,
                'success' => Color::Emerald,
                'warning' => Color::hex('#D9A521'),
            ])

            // ---- Typographie ----
            ->font('DM Sans')

            // ---- UX ----
            ->darkMode(false)
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('16rem')
            ->maxContentWidth('full')
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->databaseNotifications()

            // ---- Navigation ----
            ->navigationGroups([
                NavigationGroup::make('Contenu')->icon('heroicon-o-document-text'),
                NavigationGroup::make('Média')->icon('heroicon-o-photo'),
                NavigationGroup::make('Communauté')->icon('heroicon-o-users'),
                NavigationGroup::make('Paramètres')->icon('heroicon-o-cog-6-tooth')->collapsed(),
            ])

            // ---- Pages & Widgets ----
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\RecentVolunteers::class,
                \App\Filament\Widgets\RecentContacts::class,
            ])

            // ---- Middleware ----
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
