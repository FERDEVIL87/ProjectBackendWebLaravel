{{-- /resources/views/tech_news/create.blade.php --}}
@extends('layouts.admin')
@section('title', 'Tambah Berita Baru')
@section('content')
    <h2 class="section-title-bs">Tambah Berita Baru</h2>

    <!-- ========================================================== -->
    <!-- TAMBAHKAN BLOK INI UNTUK MENAMPILKAN ERROR -->
    <!-- ========================================================== -->
    @if ($errors->any())
        <div class="errors" style="margin-bottom: 20px; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 1rem; border-radius: 8px;">
            <strong style="color: #721c24;">Whoops! Ada beberapa masalah dengan input Anda.</strong>
            <ul style="color: #721c24; margin-top: 0.5rem; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- ========================================================== -->

    <form class="admin-card-bs p-4" action="{{ route('tech-news.store') }}" method="POST">
        @csrf
        {{-- ... sisa form Anda ... --}}
        <div class="mb-3"><label class="form-label">Judul</label><input type="text" name="title" class="form-control" value="{{ old('title') }}" required></div>
        <div class="mb-3"><label class="form-label">Kutipan (Excerpt)</label><textarea name="excerpt" class="form-control" rows="3" required>{{ old('excerpt') }}</textarea></div>
        <div class="mb-3"><label class="form-label">Tanggal</label><input type="date" name="date" class="form-control" value="{{ old('date') }}" required></div>
        <div class="mb-3"><label class="form-label">Sumber</label><input type="text" name="source" class="form-control" value="{{ old('source') }}" required></div>
        <div class="mb-3"><label class="form-label">URL Gambar</label><input type="text" name="imageUrl" class="form-control" value="{{ old('imageUrl') }}"></div>
        <div class="mb-3"><label class="form-label">URL Baca Selengkapnya</label><input type="text" name="readMoreUrl" class="form-control" value="{{ old('readMoreUrl') }}"></div>
        <button type="submit" class="login-btn-bs w-100">Simpan</button>
    </form>
@endsection