<?php
namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
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
            ->brandName('AMFDF')
            ->brandLogo(fn () => view('filament.logo'))
            ->brandLogoHeight('2rem')
            ->colors([
                'primary' => Color::hex('#16348C'),
                'warning' => Color::hex('#D9A521'),
            ])
            ->font('DM Sans')
            ->darkMode(false)
            ->sidebarCollapsibleOnDesktop()

            // Branding login header
            ->renderHook('panels::auth.login.form.before', fn () => view('filament.login-header'))

            // CSS custom FDF injecté directement
            ->renderHook('panels::head.end', fn () => new HtmlString('
                <style>
                    .fi-simple-layout{background:linear-gradient(135deg,#0A1D52 0%,#16348C 50%,#1E3FA0 100%)!important}
                    .fi-simple-layout .fi-simple-main-ctn{background:rgba(255,255,255,.06)!important;backdrop-filter:blur(20px)!important;border:1px solid rgba(255,255,255,.1)!important}
                    .fi-simple-layout label{color:rgba(255,255,255,.7)!important}
                    .fi-simple-layout .fi-input-wrp{background:rgba(255,255,255,.08)!important;border-color:rgba(255,255,255,.15)!important}
                    .fi-simple-layout input{color:#fff!important}
                    .fi-simple-layout input::placeholder{color:rgba(255,255,255,.35)!important}
                    .fi-simple-layout .fi-btn-primary{background:#D9A521!important;color:#0A1D52!important;font-weight:700!important}
                    .fi-simple-layout .fi-btn-primary:hover{background:#F1CE6E!important}
                    .fi-simple-layout h1,.fi-simple-layout p,.fi-simple-layout .fi-simple-header-heading{color:#fff!important}
                    .fi-simple-layout .fi-checkbox-input:checked{background-color:#D9A521!important;border-color:#D9A521!important}
                    .fi-simple-layout .fi-logo{filter:brightness(0) invert(1)}
                    .fi-topbar{position:relative}
                    .fi-topbar::after{content:"";position:absolute;bottom:0;left:0;right:0;height:2px;background:#D9A521}
                    .fi-sidebar-item-active{border-inline-start:3px solid #D9A521!important}
                </style>
            '))

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([Pages\Dashboard::class])
            ->middleware([
                EncryptCookies::class, AddQueuedCookiesToResponse::class,
                StartSession::class, AuthenticateSession::class,
                ShareErrorsFromSession::class, VerifyCsrfToken::class,
                SubstituteBindings::class, DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([Authenticate::class]);
    }
}
