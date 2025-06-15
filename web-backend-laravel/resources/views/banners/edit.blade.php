@extends('layouts.admin')

@section('title', 'Edit Banner')

@section('content')
    <h2 class="section-title-bs">Edit Banner: {{ $banner->name }}</h2>

    @if ($errors->any())
        <div class="errors" style="margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="admin-card-bs p-4" action="{{ route('banners.update', $banner->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3"><label class="form-label">Brand</label><input type="text" name="brand" class="form-control" value="{{ old('brand', $banner->brand) }}" required></div>
        <div class="mb-3"><label class="form-label">Nama Produk</label><input type="text" name="name" class="form-control" value="{{ old('name', $banner->name) }}" required></div>
        <div class="mb-3"><label class="form-label">Slogan</label><input type="text" name="slogan" class="form-control" value="{{ old('slogan', $banner->slogan) }}" required></div>
        <div class="mb-3"><label class="form-label">URL Gambar</label><input type="text" name="imageSrc" class="form-control" value="{{ old('imageSrc', $banner->imageSrc) }}" required></div>
        <div class="mb-3">
            <label class="form-label">Fitur Unggulan (Satu per Baris)</label>
            {{-- Ubah array features menjadi string dengan join() --}}
            <textarea name="features" class="form-control" rows="3" required>{{ old('features', implode("\n", $banner->features ?? [])) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Urutan Tampil</label>
            <input type="number" name="order_column" class="form-control" value="{{ old('order_column', $banner->order_column) }}" required>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" @if(old('is_active', $banner->is_active)) checked @endif>
            <label class="form-check-label" for="is_active">
                Aktifkan Banner ini
            </label>
        </div>

        <button type="submit" class="login-btn-bs w-100">Simpan Perubahan</button>
    </form>
@endsection