<!DOCTYPE html>
<html>

<head>
    <title>Edit Item</title> <!-- Judul halaman untuk mengedit item -->
</head>

<body>

    <h1>Edit Item</h1> <!-- Judul utama halaman yang menunjukkan form untuk mengedit item -->

    <!-- Form untuk mengirimkan data item yang sudah diubah ke server -->
    <form action="{{ route('items.update', $item) }}" method="POST">
        @csrf <!-- Token CSRF untuk melindungi form dari serangan -->
        @method('PUT') <!-- Menyatakan bahwa ini adalah permintaan UPDATE, meskipun menggunakan form POST -->

        <!-- Input untuk nama item yang sudah ada -->
        <label for="name">Name:</label> <!-- Label untuk input nama -->
        <input type="text" name="name" value="{{ $item->name }}" required> <!-- Kolom input untuk nama item, nilai defaultnya adalah nama yang sudah ada -->
        <br> <!-- Baris baru setelah input nama -->

        <!-- Input untuk deskripsi item yang sudah ada -->
        <label for="description">Description:</label> <!-- Label untuk input deskripsi -->
        <textarea name="description" required>{{ $item->description }}</textarea> <!-- Kolom input untuk deskripsi item, nilai defaultnya adalah deskripsi yang sudah ada -->
        <br> <!-- Baris baru setelah input deskripsi -->

        <!-- Tombol untuk mengirimkan form dan memperbarui item -->
        <button type="submit">Update Item</button> <!-- Tombol untuk mengupdate item -->
    </form>

    <!-- Tautan untuk kembali ke daftar item -->
    <a href="{{ route('items.index') }}">Back to List</a> <!-- Tautan untuk kembali ke halaman daftar item -->

</body>

</html>
