<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;

class GuestController extends Controller
{
    public function index()
    {
        // Cargamos los invitados y los regalos que hayan seleccionado
        $guests = Guest::with('gifts')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.guests.index', compact('guests'));
    }
}