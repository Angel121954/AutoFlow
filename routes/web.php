<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\AutomationController;
use Illuminate\Support\Facades\Route;

// Ruta raiz
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Logueo con redes sociales
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])
    ->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
    ->name('social.callback');

// Usuario autentificado
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // RUTAS DE AUTOMATIZACIONES
    Route::resource('automations', AutomationController::class);
    Route::patch('automations/{automation}/toggle', [AutomationController::class, 'toggle'])
        ->name('automations.toggle');
    Route::post(
        'automations/run/{id}',
        [AutomationController::class, 'run']
    )->name('automations.run');
});

require __DIR__ . '/auth.php';
