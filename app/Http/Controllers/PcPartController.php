<?php

namespace App\Http\Controllers;

use App\Models\PcPart;
use Illuminate\Http\Request;

class PcPartController extends Controller
{
    // ...existing methods...

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'brand' => 'required|string|max:100',
            'category' => 'required|string',
            'image' => 'nullable|url',
            'specs' => 'nullable|string', // Validasi sebagai string biasa
            'stock' => 'required|integer|min:0',
        ]);

        PcPart::create([
            'name' => $request->name,
            'price' => $request->price,
            'brand' => $request->brand,
            'category' => $request->category,
            'image' => $request->image,
            'specs' => $request->specs, // Simpan langsung sebagai string
            'stock' => $request->stock,
        ]);

        return redirect()->route('pc-parts.index')->with('success', 'Data PC Part berhasil ditambahkan!');
    }
}