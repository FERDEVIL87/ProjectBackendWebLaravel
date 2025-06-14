@extends('layouts.admin')

@section('title', 'Daftar PC Parts')

@section('content')
    <h2 class="section-title-bs">Daftar PC Part</h2>

    @if(session('success'))
        <div class="success"><p>{{ session('success') }}</p></div>
    @endif

    <a href="{{ route('pc-parts.create') }}" class="btn" style="margin-bottom: 20px;">Tambah PC Part Baru</a>

    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Brand</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pcParts as $index => $part)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $part->name }}</td>
                        <td>Rp {{ number_format($part->price, 0, ',', '.') }}</td>
                        <td>{{ $part->brand }}</td>
                        <td>{{ $part->category }}</td>
                        <td><img src="{{ $part->image }}" alt="{{ $part->name }}" style="max-width:80px;"></td>
                        <td>{{ $part->stock }}</td>
                        <td>
                            <a href="{{ route('pc-parts.edit', $part->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('pc-parts.destroy', $part->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data PC Part.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection