<h2>Edit Pelanggan</h2>

<?php
$id_pelanggan = $_GET['id']; // Get the customer ID from the URL

// Fetch customer data based on the ID
$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$pecah = $ambil->fetch_assoc();
?>

<form method="post">
    <div class="form-group">
        <label>Nama Pelanggan</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label>Email Pelanggan</label>
        <input type="email" name="email" class="form-control" value="<?php echo $pecah['email_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label>No. Telepon</label>
        <input type="text" name="telepon" class="form-control" value="<?php echo $pecah['telepon_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" value="<?php echo $pecah['password_pelanggan']; ?>">
    </div>

    <div class="form-group">
        <img src="../foto_pelanggan/<?php echo $pecah['foto_pelanggan']?>" width="100">
    </div>

    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" class="form-control"> 
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
if (isset($_POST['ubah'])) {

    $namaFoto = $_FILES['foto']['name'];
    $lokasiFoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasiFoto, "../foto_pelanggan/$namaFoto");
    // Update the customer data in the database
    $koneksi->query("UPDATE pelanggan SET 
        nama_pelanggan = '$_POST[nama]',
        email_pelanggan = '$_POST[email]',
        telepon_pelanggan = '$_POST[telepon]',
        password_pelanggan = '$_POST[password]'
        foto_pelanggan='$namaFoto',
        WHERE id_pelanggan='$id_pelanggan'");

    echo "<script>alert('Data pelanggan telah diubah');</script>";
    echo "<script>location='index.php?halaman=pelanggan';</script>";
}
?>
