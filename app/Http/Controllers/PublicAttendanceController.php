<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;

class PublicAttendanceController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:50'
        ]);

        // Buscamos al invitado por teléfono e incluimos sus regalos asociados
        $guest = Guest::with('gifts')->where('phone', $request->phone)->first();

        if ($guest) {
            // Nota: Cambia 'name' por el campo real que uses en tu tabla gifts (ej. 'title', 'description')
            $giftNames = $guest->gifts->isNotEmpty() 
                ? $guest->gifts->pluck('name')->implode(', ') 
                : 'No seleccionaste un regalo en específico.';

            return back()->with('query_success', [
                'name' => $guest->name,
                'status' => $guest->attendance_status,
                'gifts' => $giftNames
            ]);
        }

        return back()->with('query_error', 'No encontramos ninguna confirmación asociada a este número de teléfono.');
    }
}