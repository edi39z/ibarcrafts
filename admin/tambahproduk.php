<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" class="form-control" name="harga">
    </div>
    
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <input id="deskripsi" value="Editor content goes here" type="hidden" name="deskripsi">
        <trix-editor input="deskripsi"></trix-editor>
    </div>
    <div class="form-group">
        <label>Foto</label>
        <input type="file" class="form-control" name="foto">
        
    </div>
    <div class="form-group">
        <label>Download_File (zip)</label>
        <input type="file" class="form-control" name="download_file" accept=".zip">
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

    <button class="btn btn-primary" name="save">Simpan</button>
</form>

<?php

$koneksi = new mysqli("localhost", "id21641788_ibar", "BARNIbar39z@", "id21641788_ibarcrafts");

if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='../login.php';</script>";
    exit();
}

if (isset($_POST['save'])) {
    // Unggah dan simpan foto di folder "foto_produk"
    $namaFoto = $_FILES['foto']['name'];
    $lokasiFoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasiFoto, "../foto_produk/" . $namaFoto);

    // Unggah dan simpan file zip di folder "ZipFiles"
    $namaZip = $_FILES['download_file']['name'];
    $lokasiZip = $_FILES['download_file']['tmp_name'];
    move_uploaded_file($lokasiZip, "../ZipFiles/" . $namaZip);

    // Gabungkan kategori yang dipilih menjadi string yang dipisahkan koma
    $selectedCategories = implode(',', $_POST['kategori']);

    // Dapatkan nama admin dari sesi
    $namaAdmin = $_SESSION['pelanggan']['nama_pelanggan'];

    // Masukkan produk baru dan setel kolom 'dibuat_oleh' dengan nama admin
    $query = "INSERT INTO produk
              (nama_produk, harga_produk, foto_produk, download_file, deskripsi_produk, kategori, dibuat_oleh) VALUES 
              (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sisssss", $_POST['nama'], $_POST['harga'], $namaFoto, $namaZip, $_POST['deskripsi'], $selectedCategories, $namaAdmin);
    $stmt->execute();

    if (!empty($_POST['kategori'])) {
        echo "<div class='alert alert-info'>Data tersimpan</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
    } else {
        echo "<div class='alert alert-danger'>Pilih minimal satu kategori.</div>";
    }
}
?>

