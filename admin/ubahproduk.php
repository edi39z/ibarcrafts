<h2>Ubah Produk</h2>

<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk'] ?>">
    </div>

    <div class="form-group">
        <label>Harga Rp</label>
        <input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga_produk'] ?>">
    </div>



    <div class="form-group">
        <img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="100">
    </div>

    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <div class="form-group">
        <label>Ubah Download_File (zip)</label>
        <input type="file" name="download_file" class="form-control" accept=".zip">
    </div>


    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <input id="deskripsi" value="Editor content goes here" type="hidden" name="deskripsi">
        <trix-editor input="deskripsi"> <?php echo $pecah['deskripsi_produk']; ?></trix-editor>
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

    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
if (isset($_POST['ubah'])) {
    $namaFoto = $_FILES['foto']['name'];
    $lokasiFoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasiFoto, "../foto_produk/$namaFoto");

    // Upload and store new zip file if provided
    $namaZip = $_FILES['download_file']['name'];
    $lokasiZip = $_FILES['download_file']['tmp_name'];

    $selectedCategories = implode(',', $_POST['kategori']);

    if (!empty($lokasiZip)) {
        move_uploaded_file($lokasiZip, "../ZipFiles/" . $namaZip);
    }

    // Update the database
    $koneksi->query("UPDATE produk SET 
        nama_produk='$_POST[nama]',
        harga_produk='$_POST[harga]', 
       
        foto_produk='$namaFoto',
        download_file='$namaZip',
        kategori='$_POST[kategori]',
        deskripsi_produk='$_POST[deskripsi]'
        WHERE id_produk='$_GET[id]'");

    echo "<script>alert('Data produk telah diubah');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
}
?>