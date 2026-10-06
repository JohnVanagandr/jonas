<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Services\RsvpService;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // 1. Cargamos todos los regalos y contamos cuántos invitados lo han reservado
        // 2. Filtramos (desaparecemos) aquellos donde las reservas ya alcanzaron o superaron el stock
        $gifts = Gift::withCount('guests')
            ->get()
            ->filter(function ($gift) {
                return $gift->guests_count < $gift->stock;
            });

        return view('welcome', compact('gifts'));
    }

    public function confirmAttendance(Request $request, RsvpService $rsvpService)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'gift_id' => 'required|exists:gifts,id',
        ]);

        try {
            $rsvpService->confirmAttendanceAndSelectGift($validated);
            return redirect()->route('home')->with('success', '¡Tu obsequio ha quedado registrado!');
        } catch (\Exception $e) {
            // Captura los errores (ej. si el regalo fue tomado milisegundos antes)
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }
}