<?php


use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\UserController;


// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('dashboard', [DashboardController::class, 'index'],)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/search', [VehicleController::class, 'search']);

//Route::redirect('/', '/home');
//Route::redirect('/dashboard', '/home');
//Route::get('/home', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::resource('users', UserController::class)->names('users');

Route::middleware(['auth'])->controller(DealerController::class)->group(function () {
    Route::get('/dealers', 'index')->name('dealers.index');
    Route::get('/dealers/create', 'create')->name('dealers.create');
    Route::post('/dealers', 'store')->name('dealers.store');
    Route::get('/dealers/{dealer}/edit', 'edit')->name('dealers.edit');
    Route::put('/dealers/{dealer}', 'update')->name('dealers.update');
});

Route::middleware(['auth'])->controller(VehicleController::class)->group(function () {
    Route::get('/vehicles', 'index')->name('vehicles.index');
    Route::get('/vehicles/create', 'create')->name('vehicles.create');
    Route::post('/vehicles', 'store')->name('vehicles.store');
    Route::get('/vehicles/{vehicle}/edit', 'edit')->name('vehicles.edit');
    Route::put('/vehicles/{vehicle}', 'update')->name('vehicles.update');
    Route::get('/vehicles/{vehicle}', 'show')->name('vehicles.show');
});

Route::middleware(['auth'])->controller(DatasetController::class)->group(function () {
    Route::get('/datasets', 'index')->name('datasets.index');
    Route::get('/datasets/create', 'create')->name('datasets.create');
    Route::post('/datasets', 'store')->name('datasets.store');
    //Route::get('/partsCatalogs/{partsCatalog}/edit', 'edit')->name('partsCatalogs.edit');
    //Route::put('/partsCatalogs/{partsCatalog}', 'update')->name('partsCatalogs.update');
    //Route::get('storage/parts/{file_path}');
});

Route::get('storage/hidden/{file_path}', FilesController::class)->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

});

require __DIR__.'/auth.php';
