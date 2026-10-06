<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\PublicAttendanceController;
use Illuminate\Support\Facades\Route;
use App\Models\Guest;
use App\Models\Gift;

// Rutas Públicas (Las conectaremos en el Frontend)
Route::get('/', [LandingController::class, 'index'])->name('home'); 

Route::post('/rsvp', [LandingController::class, 'confirmAttendance'])->name('rsvp.confirm'); 

Route::post('/consultar-asistencia', [PublicAttendanceController::class, 'check'])->name('attendance.check'); 

// Rutas de Administración Protegidas
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () { 
    
    // Dashboard principal del administrador con métricas
    Route::get('/dashboard', function () { 
        $totalGuests = Guest::count(); 
        
        // AHORA: Cuenta los regalos que tienen al menos un invitado asignado en la tabla pivote
        $claimedGifts = Gift::has('guests')->count(); 
        
        $totalGifts = Gift::count(); 

        return view('dashboard', compact('totalGuests', 'claimedGifts', 'totalGifts')); 
    })->name('dashboard'); 

    // CRUD de Regalos
    Route::resource('gifts', GiftController::class); 
    
    // Listado de Invitados confirmados
    Route::get('guests', [GuestController::class, 'index'])->name('guests.index'); 
});

// Rutas de Perfil generadas por Breeze
Route::middleware('auth')->group(function () { 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); //
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); //
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); //
});

require __DIR__.'/auth.php'; //