@extends('layouts.admin')
@section('title', 'Daftar Konsol & Handheld')
@section('content')
    <h2 class="section-title-bs">Daftar Konsol & Handheld</h2>
    @if(session('success'))
        <div class="success"><p>{{ session('success') }}</p></div>
    @endif
    <a href="{{ route('console-and-handhelds.create') }}" class="btn" style="margin-bottom: 20px;">Tambah Data Baru</a>
    <div class="table-responsive">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Brand</th>
                    <th>Kategori</th>
                    <th>Spesifikasi</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($consoles as $console)
                    <tr>
                        <td>{{ $console->name }}</td>
                        <td>{{ $console->brand }}</td>
                        <td>{{ $console->category }}</td>
                        <td>
                            <ul>
                                @foreach($console->specs as $spec)
                                    <li>{{ $spec }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $console->stock }}</td>
                        <td>
                            <a href="{{ route('console-and-handhelds.edit', $console->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('console-and-handhelds.destroy', $console->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection