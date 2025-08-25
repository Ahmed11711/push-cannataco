<?php

namespace App\Providers\Filament;

use App\Filament\Resources\AboutResource as ResourcesAboutResource;
use App\Filament\Resources\OrderResource\Widgets\MonthlyOrdersTable;
use App\Filament\Resources\OrderResource\Widgets\MonthlyShipmentsOverview;
use App\Filament\Resources\OrderResource\Widgets\OrdersCalendar;
use App\Filament\Resources\OrderResource\Widgets\OrdersOverview;
use App\Models\About;
use App\Models\Setting;
use App\Filament\Resources\ContactResource\Widgets\ContactStats;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Facades\Filament;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
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
use Filament\Navigation\NavigationItem;
use Illuminate\Support\Facades\Schema;
use App\Filament\Resources\AboutResource;
use App\Filament\Resources\SettingResource;
use App\Models\Order;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()

            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')

            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                ContactStats::class,
                MonthlyShipmentsOverview::class,
                OrdersOverview::class,
                MonthlyOrdersTable::class,
                OrdersCalendar::class,


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
            ->plugins([
                FilamentShieldPlugin::make(),
                FilamentFullCalendarPlugin::make(), // ← هنا


            ])

            ->authMiddleware([
                Authenticate::class,
            ]);
    }
    public function boot(): void
    {
        Filament::serving(function () {
            $navigationItems = [];

            if (Schema::hasTable('abouts') && $about = About::first()) {
                $navigationItems[] = NavigationItem::make('About')
                    ->label(__('about.abouts'))
                    ->url(AboutResource::getUrl('edit', ['record' => $about->id]))
                    ->icon('heroicon-o-exclamation-circle')
                    ->sort(98);
            }

            if (Schema::hasTable('settings') && $setting = Setting::first()) {
                $navigationItems[] = NavigationItem::make('Setting')
                    ->label(__('setting.settings'))
                    ->url(SettingResource::getUrl('edit', ['record' => $setting->id]))
                    ->icon('heroicon-o-cog')
                    ->sort(97);
            }

            Filament::registerNavigationItems($navigationItems);
        });
    }
}
