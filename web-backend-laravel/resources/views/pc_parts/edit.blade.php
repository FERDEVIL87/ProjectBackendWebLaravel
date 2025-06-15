@extends('layouts.admin')

@section('title', 'Edit PC Part')

@section('content')
    <h2 class="section-title-bs">Edit Data PC Part</h2>

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

    <form class="admin-card-bs p-4" action="{{ route('pc-parts.update', $pcPart->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Method spoofing untuk request UPDATE --}}

        {{-- Field: Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nama PC Part</label>
            <input name="name" id="name" type="text" class="form-control" value="{{ old('name', $pcPart->name) }}" required>
        </div>

        {{-- Field: Price --}}
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input name="price" id="price" type="number" class="form-control" value="{{ old('price', $pcPart->price) }}" required min="0">
        </div>

        {{-- Field: Brand --}}
        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input name="brand" id="brand" type="text" class="form-control" value="{{ old('brand', $pcPart->brand) }}" required>
        </div>
        
        {{-- Dropdown for Category --}}
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select name="category" id="category" class="form-control" required>
                @php $selectedCategory = old('category', $pcPart->category); @endphp
                <option value="PROCESSOR INTEL" @if($selectedCategory == 'PROCESSOR INTEL') selected @endif>PROCESSOR INTEL</option>
                <option value="PROCESSOR AMD" @if($selectedCategory == 'PROCESSOR AMD') selected @endif>PROCESSOR AMD</option>
                <option value="MAINBOARD" @if($selectedCategory == 'MAINBOARD') selected @endif>MAINBOARD</option>
                <option value="MEMORY" @if($selectedCategory == 'MEMORY') selected @endif>MEMORY</option>
                <option value="VGA" @if($selectedCategory == 'VGA') selected @endif>VGA</option>
                <option value="HDD" @if($selectedCategory == 'HDD') selected @endif>HDD</option>
                <option value="SSD" @if($selectedCategory == 'SSD') selected @endif>SSD</option>
                <option value="PSU" @if($selectedCategory == 'PSU') selected @endif>PSU</option>
                <option value="CASE" @if($selectedCategory == 'CASE') selected @endif>CASE</option>
                <option value="LED MONITOR" @if($selectedCategory == 'LED MONITOR') selected @endif>LED MONITOR</option>
                <option value="MOUSE" @if($selectedCategory == 'MOUSE') selected @endif>MOUSE</option>
                <option value="KEYBOARD" @if($selectedCategory == 'KEYBOARD') selected @endif>KEYBOARD</option>
                <option value="MOUSEPAD" @if($selectedCategory == 'MOUSEPAD') selected @endif>MOUSEPAD</option>
                <option value="WEBCAM" @if($selectedCategory == 'WEBCAM') selected @endif>WEBCAM</option>
                <option value="CABLE" @if($selectedCategory == 'CABLE') selected @endif>CABLE</option>
                <option value="HEADSET" @if($selectedCategory == 'HEADSET') selected @endif>HEADSET</option>
                <option value="SPEAKER" @if($selectedCategory == 'SPEAKER') selected @endif>SPEAKER</option>
                <option value="USB FLASHDISK" @if($selectedCategory == 'USB FLASHDISK') selected @endif>USB FLASHDISK</option>
                <option value="PRINTER" @if($selectedCategory == 'PRINTER') selected @endif>PRINTER</option>
            </select>
        </div>
        
        {{-- Field: Image (URL) --}}
        <div class="mb-3">
            <label for="image" class="form-label">Gambar (URL)</label>
            <input name="image" id="image" type="text" class="form-control" value="{{ old('image', $pcPart->image) }}">
        </div>

        {{-- BLOK SPECS YANG SUDAH DIGANTI --}}
        <div class="mb-3">
            <label for="specs" class="form-label">Spesifikasi (Satu per Baris)</label>
            {{-- Ubah array specs menjadi string dengan join() --}}
            <textarea name="specs" id="specs" class="form-control" rows="4">{{ old('specs', is_array($pcPart->specs) ? implode("\n", $pcPart->specs) : '') }}</textarea>
            <small class="form-text text-muted">Setiap baris akan menjadi satu poin spesifikasi.</small>
        </div>
        
        {{-- Field: Stock --}}
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input name="stock" id="stock" type="number" class="form-control" value="{{ old('stock', $pcPart->stock) }}" required min="0">
        </div>
        
        <button class="login-btn-bs w-100" type="submit">Simpan Perubahan</button>
    </form>
@endsection