<?php
session_start();
$koneksi = new mysqli("localhost", "id21641788_ibar", "BARNIbar39z@", "id21641788_ibarcrafts");

if (isset($_SESSION['pelanggan'])) {
    $nama_pelanggan = $_SESSION['pelanggan']['nama_pelanggan'];

    if (isset($_POST['save'])) {
        // Upload foto
        $namaFoto = $_FILES['foto']['name'];
        $lokasiFoto = $_FILES['foto']['tmp_name'];
        move_uploaded_file($lokasiFoto, "../foto_produk/" . $namaFoto);

        // Upload zip
        $namaZip = $_FILES['download_file']['name'];
        $lokasiZip = $_FILES['download_file']['tmp_name'];
        move_uploaded_file($lokasiZip, "../ZipFiles/" . $namaZip);

        // Kategori
        $selectedCategories = implode(',', $_POST['kategori']);

        // Insert data into database
       // Insert data into database
$query = "INSERT INTO produk (nama_produk, foto_produk, download_file, deskripsi_produk, kategori, dibuat_oleh)
VALUES ('$_POST[nama]', '$namaFoto', '$namaZip', '$_POST[deskripsi]', '$selectedCategories', '{$_SESSION['pelanggan']['id_pelanggan']}')";


        if ($koneksi->query($query)) {
            echo "<div class='alert alert-info'>Data tersimpan</div>";

            // Periksa kategori yang dipilih
            if (in_array('web', $_POST['kategori'])) {
                echo "<script>window.location.href = '../produk/index.php?halaman=produk';</script>";
            } elseif (in_array('game', $_POST['kategori'])) {
                echo "<script>window.location.href = '../produk/game.php';</script>";
            } elseif (in_array('gameasset', $_POST['kategori'])) {
                echo "<script>window.location.href = '../produk/gameasset.php';</script>";
            }
        } else {
            echo "<div class='alert alert-danger'>Gagal menyimpan data: " . $koneksi->error . "</div>";
        }
    }
} else {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='../login.php';</script>";
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload•iBarCrafts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="upload.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
  </head>

  <body>



  <div class="container">
    <h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <!-- <div class="form-group">
        <label>Harga (Rp) <p class="text-muted">(0=FREE)</p></label>
        <input type="number" class="form-control" name="harga">
    </div>
     -->
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <input id="deskripsi" value="Editor content goes here" type="hidden" name="deskripsi">
        <trix-editor input="deskripsi"></trix-editor>
    </div>

    <div class="form-group">
            <label>Foto</label>
            <div class="file-upload-area" onclick="document.getElementById('uploadPhoto').click()">
                Drag and drop a photo here or click to select
                <input type="file" class="form-control" name="foto" id="uploadPhoto" accept="image/*">
            </div>
        </div>

        <div class="form-group">
            <label>Download_File (zip)</label>
            <div class="file-upload-area" onclick="document.getElementById('uploadZip').click()">
                Drag and drop a zip file here or click to select
                <input type="file" class="form-control" name="download_file" id="uploadZip" accept=".zip">
            </div>
        </div>

        <div class="form-group">
        <label>Kategori</label>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="kategori[]" value="web">
            <label class="form-check-label">Web</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="kategori[]" value="gameasset">
            <label class="form-check-label">Game Asset</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="kategori[]" value="game">
            <label class="form-check-label">Game</label>
        </div>
    </div>

    <button class="btn btn-primary mt-2" name="save">Simpan</button>
</form>



</div>
  










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>