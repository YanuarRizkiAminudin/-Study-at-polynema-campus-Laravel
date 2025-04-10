@extends('layouts.app')

@section('title', 'Edit Foto')

@section('content')
    <div class="container mt-4">
        <h2> Edit Foto</h2>

        <form action="{{route('photo.update', $photo->id)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $photo->title}}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"
                    required>{{ $photo->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('photo.index')}}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection