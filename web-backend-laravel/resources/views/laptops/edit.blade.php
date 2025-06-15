@extends('layouts.admin')

@section('title', 'Edit Laptop')

@section('content')
    <h2 class="section-title-bs">Edit Data: {{ $laptop->name }}</h2>

    {{-- Tampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div class="errors" style="margin-bottom: 20px;">
            <strong>Whoops! Ada beberapa masalah dengan input Anda.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="admin-card-bs p-4" action="{{ route('laptops.update', $laptop->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Penting untuk memberitahu Laravel ini adalah request UPDATE --}}

        {{-- Field Nama --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nama Laptop</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $laptop->name) }}" required>
        </div>

        {{-- Field Brand --}}
        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" name="brand" id="brand" class="form-control" value="{{ old('brand', $laptop->brand) }}" required>
        </div>
        
        {{-- Field Kategori dengan Dropdown --}}
        @php $selectedCategory = old('category', $laptop->category); @endphp
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select name="category" id="category" class="form-control" required>
                <option value="" disabled @if($selectedCategory == '') selected @endif>-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" @if($selectedCategory == $category) selected @endif>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>
        
        {{-- Field Harga --}}
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $laptop->price) }}" required min="0">
        </div>

        {{-- Field Stok --}}
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $laptop->stock) }}" required min="0">
        </div>

        {{-- Field Gambar (URL) --}}
        <div class="mb-3">
            <label for="image" class="form-label">Gambar (URL)</label>
            <input type="text" name="image" id="image" class="form-control" value="{{ old('image', $laptop->image) }}">
        </div>

        {{-- Field Deskripsi --}}
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi / Spesifikasi</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $laptop->description) }}</textarea>
        </div>

        <button type="submit" class="login-btn-bs w-100">Simpan Perubahan</button>
    </form>
@endsection