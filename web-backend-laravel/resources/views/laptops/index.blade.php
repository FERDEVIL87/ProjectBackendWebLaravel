@extends('layouts.admin')

@section('title', 'Manajemen Laptop')

@section('content')
    <h2 class="section-title-bs">Manajemen Data Laptop</h2>

    @if(session('success'))
        <div class="success" style="margin-bottom: 20px;"><p>{{ session('success') }}</p></div>
    @endif

    <a href="{{ route('laptops.create') }}" class="btn" style="margin-bottom: 20px;">Tambah Laptop Baru</a>

    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Brand</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laptops as $index => $laptop)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ $laptop->image }}" alt="{{ $laptop->name }}" style="max-width: 50px; margin-right: 10px; border-radius: 4px;">
                            {{ $laptop->name }}
                        </td>
                        <td>{{ $laptop->brand }}</td>
                        <td>{{ $laptop->category }}</td>
                        <td>Rp {{ number_format($laptop->price, 0, ',', '.') }}</td>
                        <td>{{ $laptop->stock }}</td>
                        <td>
                            <a href="{{ route('laptops.edit', $laptop->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('laptops.destroy', $laptop->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data laptop.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection