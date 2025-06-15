<?php
namespace App\Http\Controllers;
use App\Models\TechNews;
use Illuminate\Http\Request;

class TechNewsController extends Controller {
    public function index() {
        $newsItems = TechNews::latest('date')->get();
        return view('tech_news.index', compact('newsItems'));
    }

    public function create() {
        return view('tech_news.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'date' => 'required|date',
            'source' => 'required|string|max:255',
            'imageUrl' => 'nullable|url',
            'readMoreUrl' => 'nullable|url',
        ]);
        TechNews::create($validated);
        return redirect()->route('tech-news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(TechNews $techNews) {
        return view('tech_news.edit', compact('techNews'));
    }

    public function update(Request $request, TechNews $techNews) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'date' => 'required|date',
            'source' => 'required|string|max:255',
            'imageUrl' => 'nullable|url',
            'readMoreUrl' => 'nullable|url',
        ]);
        $techNews->update($validated);
        return redirect()->route('tech-news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(TechNews $techNews) {
        $techNews->delete();
        return redirect()->route('tech-news.index')->with('success', 'Berita berhasil dihapus.');
    }
}