<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
    {{-- <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
            text-align: center;
        }
    </style> --}}
</head>
<body>
    <h1>Data User</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Nama</td>
            <td>ID Level Pengguna</td>
            <td>Kode Level</td>
            <td>Nama Level</td>
            <td>Aksi</td>
            {{-- <th>Jumlah Pengguna</th> --}}
        </tr>
        @foreach ($data as $d) 
        <tr>
            <td>{{ $d->user_id }}</td>
            <td>{{ $d->username }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->level_id }}</td>
            <td>{{ $d->level->level_kode }}</td>
            <td>{{ $d->level->level_nama }}</td>
            {{-- <td>{{$jumlah}}</td> --}}
            <td><a href="/user/ubah/{{ $d->user_id }}">Ubah</a> 
            | <a href="/user/hapus/{{$d->user_id}}">Hapus</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html>
