@extends('layouts.admin')
@section('title', 'Edit Konsol & Handheld')
@section('content')
    <h2 class="section-title-bs">Edit Data: {{ $console->name }}</h2>
    <form class="admin-card-bs p-4" action="{{ route('console-and-handhelds.update', $console->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- Nama --}}
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" class="form-control" value="{{ old('name', $console->name) }}" required></div>
        {{-- Harga --}}
        <div class="mb-3"><label class="form-label">Harga</label><input type="number" name="price" class="form-control" value="{{ old('price', $console->price) }}" required></div>
        {{-- Brand --}}
        <div class="mb-3"><label class="form-label">Brand</label><input type="text" name="brand" class="form-control" value="{{ old('brand', $console->brand) }}" required></div>
        {{-- Kategori --}}
        <div class="mb-3"><label class="form-label">Kategori</label><input type="text" name="category" class="form-control" value="{{ old('category', $console->category) }}" required></div>
        {{-- Gambar --}}
        <div class="mb-3"><label class="form-label">Gambar (Path/URL)</label><input type="text" name="image" class="form-control" value="{{ old('image', $console->image) }}"></div>
        {{-- Specs --}}
        <div class="mb-3">
            <label class="form-label">Spesifikasi (Satu per Baris)</label>
            <textarea name="specs" class="form-control" rows="3" required>{{ old('specs', implode("\n", $console->specs)) }}</textarea>
        </div>
        {{-- Stok --}}
        <div class="mb-3"><label class="form-label">Stok</label><input type="text" name="stock" class="form-control" value="{{ old('stock', $console->stock) }}" required></div>
        <button type="submit" class="login-btn-bs w-100">Simpan Perubahan</button>
    </form>
@endsection