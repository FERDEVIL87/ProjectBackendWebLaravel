<?php

namespace App\Http\Controllers;

use App\Models\PcPart;
use Illuminate\Http\Request;

class PcPartController extends Controller
{
    /**
     * Menampilkan daftar semua PC Parts. (Halaman utama PC Parts)
     */
    public function index()
    {
        // Ganti latest() dengan orderBy('id', 'desc') untuk menghindari error 'created_at' not found
        $pcParts = PcPart::orderBy('id', 'desc')->get();

        // Kirim data ke view 'pc_parts.index'
        return view('pc_parts.index', compact('pcParts'));
    }

    /**
     * Menampilkan form untuk membuat PC Part baru.
     */
    public function create()
    {
        // Cukup tampilkan view form
        return view('pc_parts.create');
    }

    /**
     * Menyimpan PC Part baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'brand' => 'required|string|max:100',
            'category' => 'required|string',
            'image' => 'nullable|url', // Diubah menjadi nullable agar tidak wajib
            'specs' => 'nullable|string', // Diubah menjadi nullable agar tidak wajib
            'stock' => 'required|integer|min:0',
        ]);

        // Simpan ke database menggunakan Model
        PcPart::create([
            'name' => $request->name,
            'price' => $request->price,
            'brand' => $request->brand,
            'category' => $request->category,
            'image' => $request->image,
            'specs' => $request->specs, // PERUBAHAN: Langsung simpan sebagai teks biasa
            'stock' => $request->stock,
        ]);

        // Arahkan kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('pc-parts.index')->with('success', 'Data PC Part berhasil ditambahkan!');
    }


    /**
     * Menampilkan form untuk mengedit PC Part.
     */
    public function edit(PcPart $pcPart) // Laravel akan otomatis mencari PcPart berdasarkan ID
    {
        return view('pc_parts.edit', compact('pcPart'));
    }

    /**
     * Memperbarui data PC Part di database.
     */
    public function update(Request $request, PcPart $pcPart)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'brand' => 'required|string|max:100',
            'category' => 'required|string',
            'image' => 'nullable|url', // Diubah menjadi nullable agar tidak wajib
            'specs' => 'nullable|string', // Diubah menjadi nullable agar tidak wajib
            'stock' => 'required|integer|min:0',
        ]);

        // Update data pada model yang ditemukan
        $pcPart->update([
            'name' => $request->name,
            'price' => $request->price,
            'brand' => $request->brand,
            'category' => $request->category,
            'image' => $request->image,
            'specs' => $request->specs, // PERUBAHAN: Langsung simpan sebagai teks biasa
            'stock' => $request->stock,
        ]);

        // Arahkan kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('pc-parts.index')->with('success', 'Data PC Part berhasil diperbarui!');
    }

    /**
     * Menghapus PC Part dari database.
     */
    public function destroy(PcPart $pcPart)
    {
        // Hapus data
        $pcPart->delete();

        // Arahkan kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('pc-parts.index')->with('success', 'Data PC Part berhasil dihapus!');
    }
}