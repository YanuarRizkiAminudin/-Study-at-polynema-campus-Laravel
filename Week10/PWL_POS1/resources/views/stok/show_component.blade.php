<table class="table table-bordered table-striped table-hover table-sm">
    <tr>
        <th>ID Stok</th>
        <td>{{ $stok->stok_id }}</td>
    </tr>
    <tr>
        <th>ID Barang</th>
        <td>{{ $stok->barang_id }}</td>
    </tr>
    <tr>
        <th>Nama Barang</th>
        <td>{{ $stok->barang->barang_nama }}</td>
    </tr>
    <tr>
        <th>ID Supplier</th>
        <td>{{ $stok->supplier_id }}</td>
    </tr>
    <tr>
        <th>Nama Supplier</th>
        <td>{{ $stok->supplier->supplier_nama }}</td>
    </tr>
    <tr>
        <th>Stok Tanggal</th>
        <td>{{ $stok->stok_tanggal }}</td>
    </tr>
    <tr>
        <th>Stok Jumlah</th>
        <td>{{ $stok->stok_jumlah }}</td>
    </tr>
</table>