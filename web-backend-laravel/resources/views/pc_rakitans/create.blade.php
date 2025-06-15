@extends('layouts.admin')

@section('title', 'Tambah Paket Rakitan Baru')

@section('content')
    <h2 class="section-title-bs">Tambah Paket Rakitan Baru</h2>

    @if ($errors->any())
        <div class="errors" style="margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="admin-card-bs p-4" action="{{ route('pc-rakitans.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Nama Paket</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

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
        
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required min="0">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar (Path atau URL)</label>
            <input type="text" name="image" id="image" class="form-control" value="{{ old('image') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Singkat</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="specs" class="form-label">Spesifikasi (Format JSON)</label>
            <textarea name="specs" id="specs" class="form-control" rows="6" required>{{ old('specs', "{\n  \"CPU\": \"\",\n  \"GPU\": \"\",\n  \"RAM\": \"\",\n  \"Storage\": \"\",\n  \"PSU\": \"\",\n  \"Casing\": \"\"\n}") }}</textarea>
            <small class="form-text text-muted">Gunakan format JSON key-value. Contoh: {"CPU": "Intel i5", "GPU": "RTX 3060"}</small>
        </div>
        
        <button type="submit" class="login-btn-bs w-100">Simpan Paket</button>
    </form>
@endsection