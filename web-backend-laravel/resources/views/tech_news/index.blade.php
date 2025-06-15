@extends('layouts.admin')
@section('title', 'Manajemen Berita Teknologi')
@section('content')
    <h2 class="section-title-bs">Manajemen Berita Teknologi</h2>
    <a href="{{ route('tech-news.create') }}" class="btn" style="margin-bottom: 20px;">Tambah Berita Baru</a>
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr><th>Tanggal</th><th>Judul</th><th>Sumber</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse ($newsItems as $news)
                    <tr>
                        <td>{{ $news->date->format('d M Y') }}</td>
                        <td>{{ $news->title }}</td>
                        <td>{{ $news->source }}</td>
                        <td>
                            <a href="{{ route('tech-news.edit', $news->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('tech-news.destroy', $news->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">Belum ada berita.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection