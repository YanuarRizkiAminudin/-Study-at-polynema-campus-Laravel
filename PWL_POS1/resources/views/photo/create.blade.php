@extends('layouts.app')

@section('title','Tambah Foto')

@section('content')
<div class="container mt-4">
    <h2> Tambah Foto</h2>

    <form action="{{ route('photo.store')}}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripsi</label>
            <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('photo.index')}}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
