@extends('layouts.app')

@section('subtitle', 'Detail Penjualan')
@section('content_header_title', 'Detail Penjualan')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Detail Penjualan
            </div>
            <div class="card-body">
                <input type="hidden" name="penjualan_id" value="{{ $penjualan->penjualan_id }}">
                <div class="form-group">
                    <label for="penjualan_kode">Penjualan Kode</label>
                    <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode"
                           placeholder="Masukan Penjualan Kode" required value="{{ $penjualan->penjualan_kode }}" disabled>
                </div>
                <div class="form-group">
                    <label for="pembeli">Pembeli</label>
                    <input type="text" class="form-control" id="pembeli" name="pembeli"
                           placeholder="Masukan Nama Pembeli" required value="{{ $penjualan->pembeli }}" disabled>
                </div>
                <div class="form-group">
                    <label for="user">User</label>
                    <input type="text" class="form-control" id="user" name="user"
                           placeholder="Masukan Nama Pembeli" required value="{{ $penjualan->user->nama }}" disabled>
                </div>
                <div class="form-group">
                    <label for="penjualan_tanggal">Penjualan Tanggal</label>
                    <input type="date" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal"
                           required value="{{ date("Y-m-d", strtotime($penjualan->penjualan_tanggal)) }}" disabled>
                </div>
                <div class="card-header">
                    Detail Pembelian
                </div>
                <table class="table border">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($penjualan->penjualanDetail as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->barang->barang_nama }}</td>
                            <td>{{ $detail->harga }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>{{ $detail->harga * $detail->jumlah }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
