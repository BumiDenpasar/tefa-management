<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Register;
use App\Filament\Tefa\Resources\SchoolResource\Pages\EditSchool;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\IsNotAdmin;
use Illuminate\Support\Facades\Auth;

class TefaPanelProvider extends PanelProvider
{


    
    public function panel(Panel $panel): Panel
    {

        return $panel
            ->id('tefa')
            ->path('tefa')
            ->login()
            ->registration(Register::class)
            ->profile()
            // ->userMenuItems([
            //     MenuItem::make()
            //         ->label('Profile Sekolah')
            //         ->url(url(fn () => './tefa/schools/' . Auth::user()->id_sekolah . '/view'))
            //         ->icon('heroicon-o-building-office-2')
            //         ->visible(fn () => Auth::check() && Auth::user()->id_sekolah !== null),
            // ])
            ->colors([
                'danger' => Color::Red,
                'gray' => Color::Zinc,
                'info' => Color::Blue,
                'primary' => Color::Purple,
                'background' => Color::Gray,
                'success' => Color::Green,
                'warning' => Color::Amber,
            ])
            ->defaultThemeMode(ThemeMode::Light)
            ->font('Jakarta Sans')
            ->favicon('images/icon.png')
            ->discoverResources(in: app_path('Filament/Tefa/Resources'), for: 'App\\Filament\\Tefa\\Resources')
            ->discoverPages(in: app_path('Filament/Tefa/Pages'), for: 'App\\Filament\\Tefa\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->discoverWidgets(in: app_path('Filament/Tefa/Widgets'), for: 'App\\Filament\\Tefa\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
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
                IsNotAdmin::class,
            ])
            ;
            
    }
    
}
