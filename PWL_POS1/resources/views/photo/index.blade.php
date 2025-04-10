<!-- resources/views/photo/index.blade.php -->

@extends('layouts.app') {{-- Ganti dengan layout kamu, kalau ada --}}

@section('title', 'Daftar Foto')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">📸 Daftar Foto</h1>

        {{-- Tombol tambah data --}}
        <a href="{{ route('photo.create') }}" class="btn btn-primary mb-3">Tambah Foto</a>

        {{-- Tabel Foto --}}
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($photos as $photo)
                    <tr>
                        <td>{{ $photo->id }}</td>
                        <td>{{ $photo->title }}</td>
                        <td>{{ $photo->description }}</td>
                        <td>
                            <a href="{{ route('photo.show', $photo->id) }}" class="btn btn-sm btn-info">Lihat</a>
                            <a href="{{ route('photo.edit', $photo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('photo.destroy', $photo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada foto.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
