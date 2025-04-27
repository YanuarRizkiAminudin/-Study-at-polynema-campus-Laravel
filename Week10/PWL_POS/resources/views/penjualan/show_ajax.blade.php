<div id="modal-master" class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content flex-fill">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Data Penjualan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>ID Penjualan</th>
                    <td>{{ $penjualan->penjualan_id }}</td>
                </tr>
                <tr>
                    <th>ID User</th>
                    <td>{{ $penjualan->user_id }}</td>
                </tr>
                <tr>
                    <th>Pembeli</th>
                    <td>{{ $penjualan->pembeli }}</td>
                </tr>
                <tr>
                    <th>Penjualan Kode</th>
                    <td>{{ $penjualan->penjualan_kode }}</td>
                </tr>
                <tr>
                    <th>Penjualan Tanggal</th>
                    <td>{{ $penjualan->penjualan_tanggal }}</td>
                </tr>
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Barang ID</th>
                            <th>Barang Nama</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($detail as $item)
                            <tr>
                                <td>{{ $item->barang->barang_id }}</td>
                                <td>{{ $item->barang->barang_nama }}</td>
                                <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ number_format($item->jumlah) }}</td>
                                <td>Rp. {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</td>
                            </tr>
                            @php
                                $total += $item->harga * $item->jumlah;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-center">Total</th>
                            <th>Rp. {{ number_format($total, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </table>
        </div>
    </div>
</div>