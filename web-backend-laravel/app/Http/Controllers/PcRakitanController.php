<?php

namespace App\Http\Controllers;

use App\Models\PcRakitan;
use Illuminate\Http\Request;

class PcRakitanController extends Controller
{
    /**
     * Daftar kategori paket rakitan yang tersedia.
     */
    private $categories = [
        "Gaming",
        "Office",
        "Editing",
        "Streaming",
        "Mining",
        "Warnet",
    ];

    public function index()
    {
        $pakets = PcRakitan::latest()->get();
        return view('pc_rakitans.index', compact('pakets'));
    }

    public function create()
    {
        // Kirim daftar kategori ke view create
        return view('pc_rakitans.create', ['categories' => $this->categories]);
    }

    public function store(Request $request)
    {
        // Perbarui validasi untuk kategori
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:'.implode(',', $this->categories),
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'specs' => 'required|string',
        ]);

        $validated['specs'] = json_decode($validated['specs'], true) ?? [];
        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withErrors(['specs' => 'Format JSON untuk spesifikasi tidak valid.'])->withInput();
        }

        PcRakitan::create($validated);
        return redirect()->route('pc-rakitans.index')->with('success', 'Paket Rakitan berhasil ditambahkan.');
    }

    public function edit(PcRakitan $pcRakitan)
    {
        // Kirim data paket dan daftar kategori ke view edit
        return view('pc_rakitans.edit', [
            'pcRakitan' => $pcRakitan,
            'categories' => $this->categories,
        ]);
    }

    public function update(Request $request, PcRakitan $pcRakitan)
    {
        // Perbarui validasi untuk kategori
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:'.implode(',', $this->categories),
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'specs' => 'required|string',
        ]);

        $validated['specs'] = json_decode($validated['specs'], true) ?? [];
        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withErrors(['specs' => 'Format JSON untuk spesifikasi tidak valid.'])->withInput();
        }

        $pcRakitan->update($validated);
        return redirect()->route('pc-rakitans.index')->with('success', 'Paket Rakitan berhasil diperbarui.');
    }

    public function destroy(PcRakitan $pcRakitan)
    {
        $pcRakitan->delete();
        return redirect()->route('pc-rakitans.index')->with('success', 'Paket Rakitan berhasil dihapus.');
    }
}