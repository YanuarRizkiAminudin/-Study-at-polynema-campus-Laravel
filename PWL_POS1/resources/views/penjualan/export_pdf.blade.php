<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    @include('layouts.dompdf-css')
</head>

<body>
    <table class="border-bottom-header">
        <tr>
            {{-- <td width="15%" class="text-center"><img src="{{ asset('polinema-bw.png') }}"></td> --}}
            <td width="85%">
                <span class="text-center d-block font-11 font-bold mb-1">KEMENTERIAN
                    PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span>
                <span class="text-center d-block font-13 font-bold mb-1">POLITEKNIK NEGERI
                    MALANG</span>
                <span class="text-center d-block font-10">Jl. Soekarno-Hatta No. 9 Malang
                    65141</span>
                <span class="text-center d-block font-10">Telepon (0341) 404424 Pes. 101-
                    105, 0341-404420, Fax. (0341) 404420</span>
                <span class="text-center d-block font-10">Laman: www.polinema.ac.id</span>
            </td>
        </tr>
    </table>
    <h3 class="text-center">LAPORAN DATA PENJUALAN</h4>
        <table class="border-all">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Kode Penjualan</th>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Barang</th>
                    <th class="text-right">Jumlah</th>
                    <th class="text-right">Harga Jual</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->penjualan_kode }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->penjualan_tanggal)) }}</td>
                        <td>{{ $item->pembeli }}</td>
                        <td>{{ $item->barang_nama }}</td>
                        <td class="text-right">{{ $item->jumlah }}</td>
                        <td class="text-right">{{ number_format($item->harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</body>

</html>