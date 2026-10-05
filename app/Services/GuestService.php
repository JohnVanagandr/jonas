<?php

namespace App\Services;

use App\Models\Guest; // Ajusta al modelo que estés usando

class GuestService
{
    /**
     * Busca la confirmación de un invitado por su correo o teléfono.
     */
    public function findGuestStatus(string $identifier)
    {
        return Guest::where('email', $identifier)
                    ->orWhere('phone', $identifier)
                    ->first();
    }
}