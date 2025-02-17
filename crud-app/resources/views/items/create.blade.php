<!DOCTYPE html>
<html>

<head>
    <title>Add Item</title> <!-- Judul halaman yang tampil di browser -->
</head>

<body>

    <h1>Add Item</h1> <!-- Judul utama halaman yang menunjukkan bahwa ini adalah form untuk menambah item -->

    <!-- Form untuk mengirimkan data item baru ke server -->
    <form action="{{ route('items.store') }}" method="POST">
        @csrf <!-- Token CSRF untuk keamanan form, memastikan form ini valid -->
        
        <!-- Input untuk nama item -->
        <label for="name">Name:</label> <!-- Label untuk input nama -->
        <input type="text" name="name" required> <!-- Kolom input untuk nama item, wajib diisi -->
        <br> <!-- Baris baru setelah input nama -->
        
        <!-- Input untuk deskripsi item -->
        <label for="description">Description:</label> <!-- Label untuk input deskripsi -->
        <textarea name="description" required></textarea> <!-- Kolom input untuk deskripsi item, wajib diisi -->
        <br> <!-- Baris baru setelah input deskripsi -->
        
        <!-- Tombol untuk mengirimkan form -->
        <button type="submit">Add Item</button> <!-- Tombol untuk menambah item -->
    </form>

    <!-- Tautan untuk kembali ke daftar item -->
    <a href="{{ route('items.index') }}">Back to List</a> <!-- Tautan kembali ke halaman daftar item -->

</body>

</html>
