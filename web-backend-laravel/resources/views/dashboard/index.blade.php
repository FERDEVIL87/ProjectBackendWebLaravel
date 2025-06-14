@extends('layouts.admin') {{-- Use the layout that already includes the navigation menu --}}

@section('content')
    <h1>Manajemen Backend Toko Komputer</h1>
    <p>Halo, {{ auth()->user()->username }} ({{ auth()->user()->role }}) | <a href="{{ route('home') }}">Halaman Utama</a> | 
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" style="background:none;border:none;color:#00d4ff;cursor:pointer;padding:0;font-size:inherit;">Logout</button>
    </form>
    </p>

    {{-- Tampilkan daftar user --}}
    <p><a href="#" class="btn">Tambah User Baru</a></p>
    @if($users->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <a href="#" class="btn-edit">Edit</a>
                            @if(auth()->id() !== $user->id)
                                <a href="#" class="btn-delete" onclick="return confirm('Yakin hapus?');">Hapus</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada user terdaftar.</p>
    @endif
@endsection