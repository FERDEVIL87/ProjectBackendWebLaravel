@extends('layouts.admin')

@section('title', 'Manajemen Paket Rakitan')

@section('content')
    <h2 class="section-title-bs">Manajemen Paket PC Rakitan</h2>

    @if(session('success'))
        <div class="success" style="margin-bottom: 20px;"><p>{{ session('success') }}</p></div>
    @endif

    <a href="{{ route('pc-rakitans.create') }}" class="btn" style="margin-bottom: 20px;">Tambah Paket Baru</a>

    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle table-bordered">
            <thead>
                <tr>
                    <th>Nama Paket</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Spesifikasi Utama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pakets as $paket)
                    <tr>
                        <td>
                            <img src="{{ $paket->image }}" alt="{{ $paket->name }}" style="max-width: 70px; margin-right: 15px; border-radius: 4px;">
                            {{ $paket->name }}
                        </td>
                        <td>{{ $paket->category }}</td>
                        <td>Rp {{ number_format($paket->price, 0, ',', '.') }}</td>
                        <td>
                            @if(is_array($paket->specs) && !empty($paket->specs))
                                <ul class="list-unstyled mb-0" style="font-size: 0.85rem;">
                                    @foreach(array_slice($paket->specs, 0, 3) as $key => $value)
                                        <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                                    @endforeach
                                    @if(count($paket->specs) > 3)
                                        <li>...</li>
                                    @endif
                                </ul>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('pc-rakitans.edit', $paket->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('pc-rakitans.destroy', $paket->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data paket rakitan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection