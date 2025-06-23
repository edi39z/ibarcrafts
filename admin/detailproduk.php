<?php
$id_produk = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM produk  WHERE id_produk='$id_produk'");
$detailproduk = $ambil->fetch_assoc();

$fotoproduk = array();
$ambilfoto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");
while($tiap =$ambilfoto->fetch_assoc())
{
    $fotoproduk[] = $tiap;
}

echo "<pre>";
print_r ($detailproduk);
print_r ($fotoproduk);

echo "</pre>";

?>