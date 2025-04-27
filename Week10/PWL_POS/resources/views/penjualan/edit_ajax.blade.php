@empty($penjualan)
    <div id="modal-master" class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content flex-fill">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/penjualan') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content flex-fill">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('penjualan/' . $penjualan->penjualan_id . '/update_ajax') }}"
                class="form-horizontal" id="form-edit">
                @csrf
                {!! method_field('PUT') !!}
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Pembeli</label>
                        <div class="col-11">
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">Pembeli</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->user_id }}"
                                        {{ $item->user_id == $penjualan->user_id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Penjualan kode</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode"
                                value="{{ old('penjualan_kode', $penjualan->penjualan_kode) }}" required>
                            @error('penjualan_kode')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tanggal Penjualan</label>
                        <div class="col-11">
                            <input type="date" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal"
                                value="{{ old('penjualan_tanggal', $penjualan->penjualan_tanggal ? date('Y-m-d', strtotime($penjualan->penjualan_tanggal)) : '') }}"
                                required>
                            @error('penjualan_tanggal')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row" style="flex-wrap: nowrap">
                        <label class="col-1 control-label col-form-label">Item Barang</label>
                        <div id="barang_list" class="w-100">
                            @foreach ($penjualanDetail as $index => $item)
                                <div class="row mt-2">
                                    <div class="col-5">
                                        <label class="control-label col-form-label">Nama Barang</label>
                                        <select class="form-control" id="barang_nama_{{ $index }}"
                                            name="barang_nama[]" required>
                                            <option value="">Pilih Barang</option>
                                            @foreach ($barang as $barang_item)
                                                <option value="{{ $barang_item->barang_nama }}"
                                                    @if ($barang_item->barang_nama == $item->barang->barang_nama) selected @endif>
                                                    {{ $barang_item->barang_nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('barang_nama')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label class="control-label col-form-label">Jumlah</label>
                                        <input type="number" class="form-control" id="jumlah_{{ $index }}"
                                            name="jumlah[]" value="{{ old('jumlah.' . $index, $item->jumlah) }}" required>
                                        @error('jumlah[]')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-sm btn-danger" onclick="removeBarang(this)">-</button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row mt-2">
                                <div class="col-1">
                                    <button type="button" class="btn btn-sm btn-success" onclick="addBarang()">+</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addBarang() {
            var count = $('#barang_list .row').length;
            var html = `
            <div class="row mt-2">
                <div class="col-5">
                    <select class="form-control" id="barang_nama_${count}" name="barang_nama[]" required>
                        <option value="">Pilih Barang</option>
                        @foreach ($barang as $item)
                            <option value="{{ $item->barang_nama }}">{{ $item->barang_nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <input type="number" class="form-control" id="jumlah_${count}" name="jumlah[]" required>
                </div>
                <div class="col-1">
                    <button class="btn btn-sm btn-danger" onclick="removeBarang(this)">-</button>
                </div>
            </div>
        `;
            $('#barang_list').append(html);
        }

        function removeBarang(obj) {
            $(obj).parent().parent().remove();
        }

        $(document).ready(function() {
            $("#form-edit").validate({
                rules: {
                    user_id: {
                        required: true
                    },
                    penjualan_jumlah: {
                        required: true,
                        number: true
                    },
                    penjualan_tanggal: {
                        required: true,
                        date: true
                    },
                    // "jumlah[]": {
                    //     required: true,
                    //     number: true
                    // },
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataUser.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty