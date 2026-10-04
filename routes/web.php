<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\GuestController;
use Illuminate\Support\Facades\Route;

// Rutas Públicas (Las conectaremos en el Frontend)
Route::get('/', function () {
    return view('welcome'); // Cambiaremos esto por nuestra landing temática pronto
})->name('home');

Route::post('/rsvp', function () {
    // Aquí inyectaremos el RsvpService más adelante
})->name('rsvp.confirm');

// Rutas de Administración Protegidas
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard principal del administrador
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD de Regalos
    Route::resource('gifts', GiftController::class);
    
    // Listado de Invitados confirmados
    Route::get('guests', [GuestController::class, 'index'])->name('guests.index');
});

// Rutas de Perfil generadas por Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';