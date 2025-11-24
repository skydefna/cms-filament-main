<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Auth\RequestPasswordReset;
use App\Http\Middleware\ForcePasswordChange;
use App\Settings\GeneralSetting;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @throws \Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->brandName('Portal Layanan E-Gov')
            ->favicon($this->getFavicon())
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->databaseTransactions()
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->passwordReset(RequestPasswordReset::class)
            ->pages([])
            ->widgets([])
            ->routes(function () {
                Route::match(['get', 'post'], 'login', Login::class)->name('auth.login');
            })
            ->maxContentWidth(MaxWidth::Full)
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
            ->font('Quicksand')
            ->colors([
                'danger' => Color::Neutral,
                'gray' => Color::Neutral,
                'info' => Color::Amber,
                'primary' => Color::Neutral,
                'success' => Color::Lime,
                'warning' => Color::Amber,
            ])
            ->sidebarWidth('18rem')
            ->navigationGroups([
                'Layanan E-Government',
                'Kategori dan Fitur Portal',
                'Lainnya',
                'Pengaturan',
            ])
            ->plugins([
                FilamentShieldPlugin::make()
                    ->gridColumns([
                        'default' => 1,
                        'lg' => 2,
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 4,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
            ])
            ->authMiddleware([
                Authenticate::class,
                ForcePasswordChange::class,
            ]);
    }

    private function getFavicon(): string
    {
        try {
            if (! Schema::hasTable('settings')) {
                return '';
            }
            $pengaturan = new GeneralSetting;

            if (! $pengaturan->favicon) {
                return '';
            }

            return Storage::disk('public')->url($pengaturan->favicon) ?? '';
        } catch (\Exception $exception) {
            return '';
        }
    }
}
