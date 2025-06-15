@extends('layouts.admin')
@section('title', 'Tambah Konsol & Handheld')
@section('content')
    <h2 class="section-title-bs">Tambah Data Konsol & Handheld</h2>
    <form class="admin-card-bs p-4" action="{{ route('console-and-handhelds.store') }}" method="POST">
        @csrf
        {{-- Nama --}}
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
        {{-- Harga --}}
        <div class="mb-3"><label class="form-label">Harga</label><input type="number" name="price" class="form-control" value="{{ old('price') }}" required></div>
        {{-- Brand --}}
        <div class="mb-3"><label class="form-label">Brand</label><input type="text" name="brand" class="form-control" value="{{ old('brand') }}" required></div>
        {{-- Kategori --}}
        <div class="mb-3">
        <label for="category" class="form-label">Kategori</label>
    <select name="category" id="category" class="form-control" required>
        <option value="" disabled selected>-- Pilih Kategori --</option>
        @foreach($categories as $category)
        <option value="{{ $category }}" @if(old('category') == $category) selected @endif>
        {{ $category }}
        </option>
        @endforeach
    </select>
</div>
        {{-- Gambar --}}
        <div class="mb-3"><label class="form-label">Gambar (Path/URL)</label><input type="text" name="image" class="form-control" value="{{ old('image') }}"></div>
        {{-- Specs --}}
        <div class="mb-3">
            <label class="form-label">Spesifikasi (Satu per Baris)</label>
            <textarea name="specs" class="form-control" rows="3" required>{{ old('specs') }}</textarea>
        </div>
        {{-- Stok --}}
        <div class="mb-3"><label class="form-label">Stok</label><input type="text" name="stock" class="form-control" value="{{ old('stock') }}" required></div>
        <button type="submit" class="login-btn-bs w-100">Simpan</button>
    </form>
@endsection