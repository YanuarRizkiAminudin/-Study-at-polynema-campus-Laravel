@extends('layouts.template')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Barang</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/barang/import') }}')" class="btn btn-info">
                <i class="fas fa-file-import"></i> Import Barang
            </button>
            <a href="{{ url('/barang/export_excel') }}" class="btn btn-primary" id="btn-export-excel">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ url('/barang/export_pdf') }}" class="btn btn-warning" id="btn-export-pdf">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            <button onclick="modalAction('{{ url('/barang/create_ajax') }}')" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>
    </div>
    <div class="card-body">
        <!-- Filter section -->
        <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-group-sm row text-sm mb-0">
                        <label for="filter_date" class="col-md-1 col-form-label">Filter</label>
                        <div class="col-md-3">
                            <select name="filter_kategori" class="form-control form-control-sm filter_kategori">
                                <option value="">- Semua -</option>
                                @foreach($kategori as $l)
                                <option value="{{ $l->kategori_id }}">{{ $l->kategori_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Kategori Barang</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped table-hover" id="table-barang">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Kode</th>
                        <th>Nama Barang</th>
                        <th width="10%">Harga Beli</th>
                        <th width="10%">Harga Jual</th>
                        <th width="15%">Kategori</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Main Modal -->
<div id="myModal" class="modal fade" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Content loaded dynamically -->
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
// Initialize DataTable
var tableBarang;

function modalAction(url = '') {
    $('#myModal').load(url, function() {
        $('#myModal').modal('show');
        
        // Initialize validation if this is the import form
        if (url.includes('import')) {
            initImportValidation();
        }
    });
}

function initDataTable() {
    tableBarang = $('#table-barang').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('barang/list') }}",
            type: "POST",
            data: function(d) {
                d.filter_kategori = $('.filter_kategori').val();
                d._token = "{{ csrf_token() }}";
            }
        },
        columns: [
            { 
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false
            },
            { data: "barang_kode" },
            { data: "barang_nama" },
            { 
                data: "harga_beli",
                className: "text-right",
                render: function(data) {
                    return formatRupiah(data);
                }
            },
            { 
                data: "harga_jual",
                className: "text-right",
                render: function(data) {
                    return formatRupiah(data);
                }
            },
            { data: "kategori.kategori_nama" },
            { 
                data: "aksi",
                className: "text-center",
                orderable: false,
                searchable: false
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
}

// Format currency
function formatRupiah(value) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(value);
}

// Initialize import validation
function initImportValidation() {
    $("#form-import").validate({
        rules: {
            file_barang: {
                required: true,
                extension: "xlsx|xls",
                filesize: 1048576 // 1MB
            }
        },
        messages: {
            file_barang: {
                required: "File harus dipilih",
                extension: "Hanya file Excel (.xlsx, .xls) yang diperbolehkan",
                filesize: "Ukuran file maksimal 1MB"
            }
        },
        submitHandler: function(form) {
            submitImportForm(form);
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        }
    });
}

// Submit import form
function submitImportForm(form) {
    const formData = new FormData(form);
    const $btn = $(form).find('button[type="submit"]');
    const originalText = $btn.html();
    
    $btn.prop('disabled', true)
       .html('<i class="fas fa-spinner fa-spin"></i> Memproses...');

    $.ajax({
        url: form.action,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if(response.status) {
                $('#myModal').modal('hide');
                showAlert('success', 'Berhasil', response.message);
                tableBarang.ajax.reload(null, false);
            } else {
                showAlert('error', 'Gagal', response.message);
                if(response.msgField) {
                    showFormErrors(response.msgField);
                }
            }
        },
        error: function(xhr) {
            showAlert('error', 'Error', xhr.responseJSON?.message || 'Terjadi kesalahan');
        },
        complete: function() {
            $btn.prop('disabled', false).html(originalText);
        }
    });
}

// Show alert
function showAlert(icon, title, text) {
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
        timer: 3000
    });
}

// Show form errors
function showFormErrors(errors) {
    $('.error-text').text('');
    $.each(errors, function(prefix, val) {
        $('#error-'+prefix).text(val[0]);
    });
}

// Initialize on page load
$(document).ready(function() {
    initDataTable();
    
    // Filter change event
    $('.filter_kategori').change(function() {
        tableBarang.ajax.reload();
    });
    
    // Add custom validation method for file size
    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    });
});
</script>
@endpush