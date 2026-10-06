<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index()
    {
        // Cargamos los regalos junto con el invitado que lo reservó (si existe)
        $gifts = Gift::with('guests')->orderBy('created_at', 'desc')->paginate(10);
    
        return view('admin.gifts.index', compact('gifts'));
    }

    public function create()
    {
        return view('admin.gifts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url|max:255',
            'stock' => 'required|integer|min:1',
        ]);

        Gift::create($validated);

        return redirect()->route('admin.gifts.index')->with('success', 'Regalo materializado con éxito.');
    }

    public function edit(Gift $gift)
    {
        return view('admin.gifts.edit', compact('gift'));
    }

    public function update(Request $request, Gift $gift)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url|max:255',
            'stock' => 'required|integer|min:1',
        ]);

        $gift->update($validated);

        return redirect()->route('admin.gifts.index')->with('success', 'Regalo actualizado con éxito.');
    }

    public function destroy(Gift $gift)
    {
        $gift->delete();
        return redirect()->route('admin.gifts.index')->with('success', 'Regalo desvanecido en la oscuridad.');
    }
}