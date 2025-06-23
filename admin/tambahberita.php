<!-- tambahberita.php -->
<h2>Tambah Berita Baru</h2>

<form action="" method="post" enctype="multipart/form-data">
    <label for="judul_berita">Judul Berita:</label>
    <input type="text" name="judul_berita" required>

    <label for="link_berita">Link Berita:</label>
    <input type="text" name="link_berita" required>

    <label for="foto_berita">Foto Berita:</label>
    <input type="file" name="foto_berita" accept="image/*" required>

    <button type="submit">Tambah Berita</button>
</form>


<?php
$koneksi = new mysqli("localhost", "id21641788_ibar", "BARNIbar39z@", "id21641788_ibarcrafts");

if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_berita = $_POST["judul_berita"];
    $link_berita = $_POST["link_berita"];

    // Proses upload foto
    $foto_berita = $_FILES["foto_berita"]["name"];
    $temp_file = $_FILES["foto_berita"]["tmp_name"];
    
    // Sesuaikan dengan direktori tempat menyimpan foto berita (ganti dengan folder yang sesuai)
    $target_dir = "../foto_berita/";
    $target_file = $target_dir . basename($foto_berita);

    move_uploaded_file($temp_file, $target_file);

    // Simpan data berita ke database
    $sql = "INSERT INTO berita (judul_berita, link_berita, foto_berita) VALUES ('$judul_berita', '$link_berita', '$target_file')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Berita berhasil ditambahkan.";
        echo '<br><a href="tambahberita.php">Tambah Berita Lainnya</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>
