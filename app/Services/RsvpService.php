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
                ['name' => $data['name'], 'attendance_status' => true]
            );

            if (isset($data['gift_id'])) {
                // NUEVA REGLA: Verificar si el espectro ya acaparó un regalo previamente
                if ($guest->gifts()->exists()) {
                    throw new Exception("¡Avaricia fantasmal! Ya has asegurado un regalo con este número de teléfono.");
                }

                // Bloqueo de fila para evitar condiciones de carrera
                $gift = Gift::where('id', $data['gift_id'])->lockForUpdate()->first();

                if (!$gift) {
                    throw new Exception("El regalo seleccionado no existe en nuestra dimensión.");
                }

                if ($gift->guest_id !== null) {
                    throw new Exception("¡Qué pesadilla! Algún otro espectro acaba de reclamar este regalo.");
                }

                // Vinculamos el regalo al invitado
                $gift->guest_id = $guest->id;
                $gift->save();
            }

            return $guest;
        });
    }
}