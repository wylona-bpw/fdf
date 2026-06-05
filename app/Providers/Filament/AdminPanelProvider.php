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
use Filament\View\PanelsRenderHook;
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
            ->login()

            // ---- Identité visuelle ----
            ->brandName('AMFDF')
            ->brandLogo(fn () => view('filament.logo'))
            ->brandLogoHeight('2.25rem')
            ->favicon(asset('favicon.ico'))

            // ---- Couleurs FDF ----
            ->colors([
                'primary' => [
                    50  => '#EEF2FB',
                    100 => '#D5DFF4',
                    200 => '#A8BBE6',
                    300 => '#7A98D7',
                    400 => '#4D74C9',
                    500 => '#2E55B0',
                    600 => '#16348C',  // Bleu FDF principal
                    700 => '#112970',
                    800 => '#0C1F54',
                    900 => '#081538',
                    950 => '#040A1C',
                ],
                'warning' => [
                    50  => '#FDF8EC',
                    100 => '#FBEFD0',
                    200 => '#F6DFA1',
                    300 => '#F0CD72',
                    400 => '#E7B743',
                    500 => '#D9A521',  // Or FDF accent
                    600 => '#B0851A',
                    700 => '#876514',
                    800 => '#5E460E',
                    900 => '#352707',
                ],
                'gray'    => Color::Slate,
                'success' => Color::Emerald,
                'danger'  => Color::Rose,
                'info'    => Color::Sky,
            ])

            // ---- Typo ----
            ->font('DM Sans')
            ->darkMode(false)

            // ---- Layout ----
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full')
            ->topNavigation(false)
            ->breadcrumbs(true)
            ->navigationGroups([
                NavigationGroup::make('Contenu')
                    ->icon('heroicon-o-document-text')
                    ->collapsible(false),
                NavigationGroup::make('Galerie')
                    ->icon('heroicon-o-photo')
                    ->collapsible(false),
                NavigationGroup::make('Demandes')
                    ->icon('heroicon-o-inbox')
                    ->collapsible(false),
                NavigationGroup::make('Réglages')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsible(true),
            ])

            // ---- Render hooks : injection du thème + login side panel ----
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn () => view('filament.theme-styles')
            )
            ->renderHook(
                PanelsRenderHook::BODY_START,
                fn () => view('filament.login-side')
            )
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
                fn () => view('filament.auth.login-header')
            )

            // ---- Discovery ----
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
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
