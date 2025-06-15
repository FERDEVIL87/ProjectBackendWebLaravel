<?php

namespace App\Http\Controllers;

use App\Models\ConsoleAndHandheld;
use Illuminate\Http\Request;

class ConsoleAndHandheldController extends Controller
{
    /**
     * Daftar kategori yang tersedia.
     */
    private $categories = [
        "PlayStation Powerhouse",
        "Xbox Universe",
        "Nintendo Magic",
        "Handheld PC Heroes",
        "Explore More Consoles",
    ];

    public function index()
    {
        $consoles = ConsoleAndHandheld::latest()->get();
        return view('console_and_handhelds.index', compact('consoles'));
    }

    public function create()
    {
        // Kirim daftar kategori ke view
        return view('console_and_handhelds.create', ['categories' => $this->categories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'brand' => 'required|string|max:255',
            'category' => 'required|string',
            'image' => 'nullable|string', // URL atau path
            'specs' => 'required|string', // Terima sebagai string dari textarea
            'stock' => 'required|string',
        ]);
        
        // Ubah string specs per baris menjadi array
        $validated['specs'] = array_filter(array_map('trim', explode("\n", $validated['specs'])));

        ConsoleAndHandheld::create($validated);

        return redirect()->route('console-and-handhelds.index')->with('success', 'Data konsol berhasil ditambahkan.');
    }

    public function edit(ConsoleAndHandheld $consoleAndHandheld)
    {
        $console = $consoleAndHandheld;
        // Kirim daftar kategori dan data konsol ke view
        return view('console_and_handhelds.edit', [
            'console' => $console, 
            'categories' => $this->categories
        ]);
    }
    
    public function update(Request $request, ConsoleAndHandheld $consoleAndHandheld)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'brand' => 'required|string|max:255',
            'category' => 'required|string',
            'image' => 'nullable|string',
            'specs' => 'required|string',
            'stock' => 'required|string',
        ]);

        $validated['specs'] = array_filter(array_map('trim', explode("\n", $validated['specs'])));

        $consoleAndHandheld->update($validated);
        
        return redirect()->route('console-and-handhelds.index')->with('success', 'Data konsol berhasil diperbarui.');
    }

    public function destroy(ConsoleAndHandheld $consoleAndHandheld)
    {
        $consoleAndHandheld->delete();
        return redirect()->route('console-and-handhelds.index')->with('success', 'Data konsol berhasil dihapus.');
    }
}