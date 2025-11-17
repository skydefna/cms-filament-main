    <?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\WebController::class)
    ->middleware(\App\Http\Middleware\IncrementVisit::class)
    ->group(function () {
        Route::get('/', 'welcome')->name('welcome');
        Route::get('/katalog', 'getKatalog')->name('katalog');       
        Route::get('/dokumen', 'getDokumen')->name('dokumen');                      
    });
