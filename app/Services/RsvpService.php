<?php

namespace App\Services;

use App\Models\Guest;
use App\Models\Gift;
use Illuminate\Support\Facades\DB;
use Exception;

class RsvpService
{
    /**
     * Procesa la confirmación de asistencia y bloquea el regalo.
     */
    public function confirmAttendanceAndSelectGift(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Buscamos al invitado por su teléfono o lo creamos
            $guest = Guest::firstOrCreate(
                ['phone' => $data['phone']],
                ['name' => $data['name'], 'attendance_status' => true] //
            );

            if (isset($data['gift_id'])) {
                // NUEVA REGLA: Verificar si el espectro ya acaparó un regalo previamente
                if ($guest->gifts()->exists()) {
                    throw new Exception("¡Alegoría fantasmal! Ya has asegurado un regalo con este número de teléfono."); //[cite: 10]
                }

                // Bloqueo de fila para evitar condiciones de carrera[cite: 10]
                $gift = Gift::lockForUpdate()->find($data['gift_id']);

                if (!$gift) {
                    throw new Exception("El regalo seleccionado no existe en nuestra dimensión."); //[cite: 10]
                }

                // NUEVA LÓGICA: Validar contra el stock disponible en lugar de un único guest_id
                $currentReservations = $gift->guests()->count();

                if ($currentReservations >= $gift->stock) {
                    throw new Exception("¡Qué pesadilla! Algún otro espectro acaba de reclamar el último cupo de este regalo.");
                }

                // NUEVA LÓGICA: Vinculamos el regalo al invitado usando la tabla intermedia (attach)
                $guest->gifts()->attach($gift->id);
            }

            return $guest;
        });
    }
}