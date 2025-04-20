@extends('layouts.template')

@section('content')
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-
backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('level/create') }}"> Tambah </a>
                <!-- <button type="button" class="btn btn-sm btn-primary mt-1" data-toggle="modal" data-target="#modal-lg">Tambah</button> -->
                <button onclick="modalAction('{{ url('/level/create_ajax') }}')" class="btn btn-sm btn-primary mt-1">Tambah Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_level">
                <thead>
                    <tr>
                        <th>Level ID</th>
                        <th>Level Kode</th>
                        <th>Level Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>



    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@endsection

@push('css')
@endpush

@push('js')

    <script>
        function modalAction(url = ''){
            $('#myModal').load(url,function(){
                $('#myModal').modal('show');
            });
        }

        var dataLevel;
        $(document).ready(function() {
            var dataLevel = $('#table_level').DataTable({
                // serverSide : true , jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('level/list') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [
                    {
                        // nomor urut dari laravel datatable addIndexColumn ()
                        data: "DT_RowIndex",
                                      className: "text-center",
                                      orderable: false,
                                      searchable: false
                                  }, {
                                      data: "level_kode",
                                      className: "",
                                      // orderable : true , jika ingin kolom ini bisa diurutkan
                                      orderable: true,
                                      // searchable : true , jika ingin kolom ini bisa dicari
                                      searchable: true
                                  }, {
                                      data: "level_nama",
                                      className: "",
                                      orderable: true,
                                      searchable: true
                                  }, 
                                   {
                                      data: "aksi",
                                      className: "",
                                      orderable: false,
                                      searchable: false
                                  }
                              ]
                          });
                      });
    </script>
@endpush