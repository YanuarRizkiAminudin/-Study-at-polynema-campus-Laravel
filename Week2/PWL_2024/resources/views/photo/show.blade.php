@extends('layouts.app')

$section('title', 'Detail Foto');

@section('content')
<div class="container mt-4">
    <h2>Detail Foto</h2>
    
    <div class="card">
        <div class="card-bod">
            <h4 class="card-title">{{$photo->title}}</h4>
            <p class="card-text">{{ $photo->description}}</p>
        </div>
    </div>

    <a href="{{ route('photo.index')}}" class="btn btn-secondary mt-3"> Kembali</a>
</div>
@endsection