<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    /**
     * Daftar kategori laptop yang tersedia.
     */
    private $categories = [
        "Low-End",
        "Mid-Range",
        "High-End",
    ];

    /**
     * Menampilkan daftar semua laptop di admin panel.
     */
    public function index()
    {
        $laptops = Laptop::latest()->get();
        return view('laptops.index', compact('laptops'));
    }

    /**
     * Menampilkan form untuk membuat data laptop baru.
     */
    public function create()
    {
        // Kirim daftar kategori ke view create
        return view('laptops.create', ['categories' => $this->categories]);
    }

    /**
     * Menyimpan data laptop baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi, pastikan kategori ada di dalam daftar yang kita buat
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:'.implode(',', $this->categories),
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'brand' => 'required|string|max:255',
        ]);

        Laptop::create($validated);
        return redirect()->route('laptops.index')->with('success', 'Data laptop berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data laptop.
     */
    public function edit(Laptop $laptop)
    {
        // Kirim data laptop dan daftar kategori ke view edit
        return view('laptops.edit', [
            'laptop' => $laptop,
            'categories' => $this->categories,
        ]);
    }

    /**
     * Memperbarui data laptop di database.
     */
    public function update(Request $request, Laptop $laptop)
    {
        // Validasi, pastikan kategori ada di dalam daftar yang kita buat
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:'.implode(',', $this->categories),
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'brand' => 'required|string|max:255',
        ]);

        $laptop->update($validated);
        return redirect()->route('laptops.index')->with('success', 'Data laptop berhasil diperbarui.');
    }

    /**
     * Menghapus data laptop dari database.
     */
    public function destroy(Laptop $laptop)
    {
        $laptop->delete();
        return redirect()->route('laptops.index')->with('success', 'Data laptop berhasil dihapus.');
    }
}