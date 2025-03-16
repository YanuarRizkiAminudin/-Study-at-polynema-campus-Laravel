@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center">
                <h5 class="mb-0">Manage Kategori</h5>
                <a href="{{ url('kategori/create') }}" class="btn btn-primary btn-lg px-4 ml-auto">Add</a>
            </div>
            <div class="card-body p-3">
                {!! $dataTable->table() !!}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush

