<?php
namespace App\Http\Controllers;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller {
    public function index() {
        $banners = Banner::orderBy('order_column')->get();
        return view('banners.index', compact('banners'));
    }

    public function create() {
        return view('banners.create');
    }

public function store(Request $request) {
    $validated = $request->validate([
        'brand' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'slogan' => 'required|string',
        
        // ==========================================================
        // PERUBAIKAN VALIDASI DI SINI
        // ==========================================================
        'imageSrc' => 'required|url', // Ubah dari 'string' menjadi 'url'
        // ==========================================================
        
        'features' => 'required|string',
        'order_column' => 'required|integer',
        'is_active' => 'sometimes|boolean',
    ], [
        // Tambahkan pesan error kustom agar lebih jelas
        'imageSrc.url' => 'Kolom URL Gambar harus berisi URL yang valid (contoh: http://example.com/gambar.jpg).'
    ]);

    // ... sisa logika store ...
    $validated['features'] = array_filter(array_map('trim', explode("\n", $validated['features'])));
    $validated['is_active'] = $request->has('is_active');

    Banner::create($validated);
    return redirect()->route('banners.index')->with('success', 'Banner berhasil ditambahkan.');
}

    public function edit(Banner $banner) {
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner) {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'slogan' => 'required|string',
            'imageSrc' => 'required|string',
            'features' => 'required|string',
            'order_column' => 'required|integer',
            'is_active' => 'sometimes|boolean',
        ]);

        $validated['features'] = array_filter(array_map('trim', explode("\n", $validated['features'])));
        $validated['is_active'] = $request->has('is_active');
        
        $banner->update($validated);
        return redirect()->route('banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner) {
        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Banner berhasil dihapus.');
    }
}