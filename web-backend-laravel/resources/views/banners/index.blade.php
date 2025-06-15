@extends('layouts.admin')

@section('title', 'Manajemen Banner')

@section('content')
    <h2 class="section-title-bs">Manajemen Banner Halaman Utama</h2>

    @if(session('success'))
        <div class="success" style="margin-bottom: 20px;"><p>{{ session('success') }}</p></div>
    @endif

    <a href="{{ route('banners.create') }}" class="btn" style="margin-bottom: 20px;">Tambah Banner Baru</a>

    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle table-bordered">
            <thead>
                <tr>
                    <th>Urutan</th>
                    <th>Gambar</th>
                    <th>Brand & Nama</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($banners as $banner)
                    <tr>
                        <td>{{ $banner->order_column }}</td>
                        <td>
                            <img src="{{ $banner->imageSrc }}" alt="{{ $banner->name }}" style="max-width: 100px; border-radius: 4px;">
                        </td>
                        <td>
                            <strong>{{ $banner->brand }}</strong><br>
                            {{ $banner->name }}
                        </td>
                        <td>
                            @if($banner->is_active)
                                <span style="color: #28f57a;">Aktif</span>
                            @else
                                <span style="color: #ff4d4d;">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('banners.edit', $banner->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada banner yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection