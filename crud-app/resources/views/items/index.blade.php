<!DOCTYPE html>
<html>

<head>
    <title>Item List</title> <!-- Judul halaman yang akan tampil di browser -->
</head>

<body>

    <h1>Items</h1> <!-- Judul utama yang muncul di halaman untuk menunjukkan daftar item -->
    
    <!-- Menampilkan pesan sukses jika ada session('success') -->
    @if(session('success'))
    <p>{{ session('success') }}</p> <!-- Menampilkan pesan sukses jika ada -->
    @endif

    <!-- Tautan untuk menuju halaman form pembuatan item baru -->
    <a href="{{ route('items.create') }}">Add Item</a>
    
    <ul> <!-- Daftar item yang ada -->
        @foreach ($items as $item) <!-- Perulangan untuk setiap item dalam array $items -->
        <li>
            {{ $item->name }} <!-- Menampilkan nama item -->
            
            <!-- Tautan untuk mengedit item ini -->
            <a href="{{ route('items.edit', $item) }}">Edit</a>
            
            <!-- Form untuk menghapus item -->
            <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                @csrf <!-- Menambahkan token CSRF untuk keamanan -->
                @method('DELETE') <!-- Menggunakan metode DELETE untuk menghapus data -->
                <button type="submit">Delete</button> <!-- Tombol untuk menghapus item -->
            </form>
        </li>
        @endforeach
    </ul>

</body>

</html>
