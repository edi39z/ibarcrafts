<?php
$ambil = $koneksi->query("SELECT * FROM berita WHERE id_berita='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotoberita = $pecah['foto_berita'];

// Check if the file exists before attempting to delete it
if (file_exists("../foto_berita/$fotoberita")) {
    unlink("../foto_produk/$fotoberita");
}

$koneksi->query("DELETE FROM berita WHERE id_berita='$_GET[id]'");

echo "<script>alert('berita terhapus');</script>";
echo "<script>location='index.php?halaman=berita';</script>";
?>