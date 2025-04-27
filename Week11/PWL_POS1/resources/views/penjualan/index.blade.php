@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            @if (!isset($self))
                <div class="card-tools">
                    <!-- <a class="btn btn-sm btn-primary" href="{{ url('penjualan/create') }}">Tambah</a> -->
                    <button onclick="modalAction('{{ url('/penjualan/create_ajax') }}')" class="btn btn-sm btn-success">
                        Tambah Ajax
                    </button>
                    <button onclick="modalAction('{{ url('/penjualan/import') }}')" class="btn btn-sm btn-info">
                        Import Data
                    </button>
                    <a href="{{ url('penjualan/export_excel') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-file-excel"></i>
                        Export Excel
                    </a>
                    <a href="{{ url('penjualan/export_pdf') }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-file-pdf"></i>
                        Export PDF
                    </a>
                </div>
            @endif
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id User</th>
                        <th>Pembeli</th>
                        <th>Penjualan Kode</th>
                        <th>Penjualan Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
    <style>
        @media (min-width: 992px) {

            .modal-lg,
            .modal-xl {
                max-width: 1000px;
            }
        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 1000px;
                margin: 1.75rem auto;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var dataUser;
        $(document).ready(function() {
            dataUser = $('#table_penjualan').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('penjualan/list') }}",
                    @if (isset($self))
                        "data": {
                            "self": true
                        },
                    @endif
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "user_id",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "pembeli",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "penjualan_kode",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "penjualan_tanggal",
                        className: "",
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: "aksi",
                        className: "text-center",
                        @if (isset($self))
                            width: "75px",
                        @else
                            width: "195px",
                        @endif
                        orderable: false,
                        searchable: false
                    }
                ],
                autoWidth: false,
            });
        });
    </script>
@endpush