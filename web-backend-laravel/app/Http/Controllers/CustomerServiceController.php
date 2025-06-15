<?php
namespace App\Http\Controllers;
use App\Models\CustomerService;
use Illuminate\Http\Request;

class CustomerServiceController extends Controller
{
    public function store(Request $request)
    {
        // Validasi dari frontend 'name', 'email', 'message' sudah benar
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Ubah cara menyimpan ke database agar cocok dengan kolom baru
        CustomerService::create([
            'nama' => $validated['name'],       // <-- DIUBAH: field 'name' dari request disimpan ke kolom 'nama'
            'email' => $validated['email'],     // <-- TETAP SAMA
            'pesan' => $validated['message'],   // <-- DIUBAH: field 'message' dari request disimpan ke kolom 'pesan'
        ]);

        return response()->json(['message' => 'Pesan Anda telah berhasil terkirim!'], 201);
    }
    
    // Ubah juga metode index untuk halaman admin
    public function index()
    {
        $messages = CustomerService::latest()->get();
        return view('customer_service.index', compact('messages'));
    }
}