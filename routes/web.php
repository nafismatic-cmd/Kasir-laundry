
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaundryCrudController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::prefix('data')->name('data.')->controller(LaundryCrudController::class)->group(function () {

    Route::get('/{module}', 'index')->name('index');

    Route::get('/{module}/create', 'create')->name('create');

    Route::post('/{module}', 'store')->name('store');

    Route::get('/{module}/{id}/edit', 'edit')->name('edit');

    Route::put('/{module}/{id}', 'update')->name('update');

    Route::delete('/{module}/{id}', 'destroy')->name('destroy');

});
