@extends('layouts.app')
{{-- Customize layout sections --}}
@section('subtitle', 'Penjualan')
@section('content_header_title', 'Penjualan')
@section('content_header_subtitle', 'Create')
{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Penjualan Baru</h3>
            </div>
            <form method="post" action="../penjualan">
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="penjualan_kode">Penjualan Kode</label>
                            <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode"
                                   placeholder="Masukan Penjualan Kode" required>
                        </div>
                        <div class="form-group">
                            <label for="pembeli">Pembeli</label>
                            <input type="text" class="form-control" id="pembeli" name="pembeli"
                                   placeholder="Masukan Nama Pembeli" required>
                        </div>
                        <div class="form-group">
                            <label for="user_id">Nama User</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="" disabled selected>Pilih User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->user_id }}">
                                        {{ $user->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="penjualan_tanggal">Penjualan Tanggal</label>
                            <input type="date" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal"
                                   value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="card-header">
                            <h3 class="card-title">Pembelian</h3>
                        </div>                        <div class="form-group">
                            <label for="barang_id">Barang</label>
                            <select class="form-control" id="barang_id" name="barang_id">
                                <option value="" disabled selected>Pilih Barang</option>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->barang_id }}" data-harga="{{ $barang->harga_jual }}">
                                        {{ $barang->barang_nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukan Harga">
                        </div>
                        <button type="button" class="btn btn-secondary" id="add-barang">Tambah Barang</button>
                        <table class="table table-bordered mt-3" id="barang-table">
                            <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('barang_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var harga = selectedOption.getAttribute('data-harga');
            document.getElementById('harga').value = harga;
        });

        document.getElementById('add-barang').addEventListener('click', function() {
            var barangSelect = document.getElementById('barang_id');
            var barangText = barangSelect.options[barangSelect.selectedIndex].text;
            var barangId = barangSelect.value;
            var jumlah = document.getElementById('jumlah').value;
            var harga = document.getElementById('harga').value;

            if (barangId && jumlah && harga) {
                var table = document.getElementById('barang-table').getElementsByTagName('tbody')[0];
                var newRow = table.insertRow();

                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);
                var cell4 = newRow.insertCell(3);

                cell1.innerHTML = '<input type="hidden" name="barang_id[]" value="' + barangId + '">' + barangText;
                cell2.innerHTML = '<input type="hidden" name="jumlah[]" value="' + jumlah + '">' + jumlah;
                cell3.innerHTML = '<input type="hidden" name="harga[]" value="' + harga + '">' + harga;
                cell4.innerHTML = '<button type="button" class="btn btn-danger btn-sm remove-barang">Hapus</button>';

                document.getElementById('barang_id').value = '';
                document.getElementById('jumlah').value = '';
                document.getElementById('harga').value = '';
            }
        });

        document.getElementById('barang-table').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-barang')) {
                var row = e.target.closest('tr');
                row.parentNode.removeChild(row);
            }
        });
    </script>
@endsection
