<!DOCTYPE html>
<html>

<head>
    <title>Item List</title> <!-- Judul halaman untuk daftar item -->
</head>

<body>

    <h1>Items</h1> <!-- Judul utama halaman yang menampilkan daftar item -->

    <!-- Menampilkan pesan sukses jika ada session 'success' -->
    @if(session('success'))
        <p>{{ session('success') }}</p> <!-- Menampilkan pesan sukses yang dikirim setelah operasi berhasil -->
    @endif

    <!-- Tautan untuk menambahkan item baru -->
    <a href="{{ route('items.create') }}">Add Item</a> <!-- Arahkan ke halaman form tambah item -->
    
    <ul>
        <!-- Loop untuk menampilkan semua item yang ada -->
        @foreach ($items as $item)
        <li>
            {{ $item->name }} - <!-- Menampilkan nama item -->
            <!-- Tautan untuk mengedit item yang diklik -->
            <a href="{{ route('items.edit', $item) }}">Edit</a>
            
            <!-- Form untuk menghapus item -->
            <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                @csrf <!-- Token CSRF untuk melindungi dari serangan -->
                @method('DELETE') <!-- Menyatakan bahwa form ini akan menghapus item -->
                <button type="submit">Delete</button> <!-- Tombol untuk menghapus item -->
            </form>
        </li>
        @endforeach
    </ul>

</body>

</html>
