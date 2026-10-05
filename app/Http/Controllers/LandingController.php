<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Services\RsvpService;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $gifts = Gift::whereNull('guest_id')->get();
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
            return redirect()->route('home')->with('success', '¡Asistencia confirmada! Has asegurado tu regalo.');
        } catch (\Exception $e) {
            // Captura los errores (ej. si el regalo fue tomado milisegundos antes)
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }
}