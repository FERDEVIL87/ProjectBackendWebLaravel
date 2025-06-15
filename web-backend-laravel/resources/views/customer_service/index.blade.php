@extends('layouts.admin')

@section('title', 'Pesan Customer Service')

@section('content')
    <h2 class="section-title-bs">Pesan Masuk dari Customer</h2>

    {{-- ... --}}
            <table class="table table-dark table-striped align-middle table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Kirim</th>
                        <th>Nama</th>   {{-- <-- TETAP SAMA --}}
                        <th>Email</th>  {{-- <-- TETAP SAMA --}}
                        <th>Pesan</th>  {{-- <-- TETAP SAMA --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $index => $message)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $message->created_at->format('d M Y, H:i') }}</td>
                            <td>{{ $message->nama }}</td>   {{-- <-- DIUBAH DARI customer_name --}}
                            <td>{{ $message->email }}</td>  {{-- <-- DIUBAH DARI customer_email --}}
                            <td style="white-space: pre-wrap;">{{ $message->pesan }}</td> {{-- <-- DIUBAH DARI message --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
    {{-- ... --}}
@endsection