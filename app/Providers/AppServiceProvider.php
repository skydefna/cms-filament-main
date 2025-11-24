<?php

namespace App\Providers;

use BezhanSalleh\FilamentShield\FilamentShield;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events\MigrationEnded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::setScriptRoute(function ($handle) {
            return Route::get('/vendor/livewire/livewire.js', $handle);
        });
        Model::unguard();
        FilamentShield::prohibitDestructiveCommands(app()->isProduction());
        $isHttps = Str::startsWith(config('app.url'), 'https');
        if ($isHttps || app()->isProduction()) {
            URL::forceHttps($isHttps);
            request()->server->set('HTTPS', request()->header('X-Forwarded-Proto', 'https') === 'https' ? 'on' : 'off');
        }
        if (app()->runningInConsole()) {
            $this->generateShield();
        }
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });
        LogViewer::auth(function (Request $request) {
            return $request->user()->email === 'manusiakemos@gmail.com';
        });

        Request::macro('hasValidSignature', function ($absolute = true) {
            $uploading = strpos(URL::current(), '/livewire/upload-file');
            $previewing = strpos(URL::current(), '/livewire/preview-file');
            if ($uploading || $previewing) {
                return auth()->check();
            }

            return false;
        });
    }

    private function generateShield(): void
    {
        Event::listen(function (MigrationEnded $event) {
            if (Schema::hasTable('permissions')) {
                // runs after each migration
                if (Schema::hasTable('permissions')) {
                    \Illuminate\Support\Facades\Artisan::call('shield:generate', [
                        '--ignore-existing-policies' => true,
                        '--panel' => 'admin',
                        '--all' => true,
                    ]);
                }
                if (Schema::hasTable('settings')) {
                    Log::info('clear setting cache');
                    Artisan::call('settings:clear-cache');
                    Log::info('Migration has ended.');
                }
            }
        });
    }
}
