<div class="container">
  <h2>Tambah Pelanggan</h2>

  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control" id="nama" name="nama">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
      <label for="telepon">Telepon</label>
      <input type="number" class="form-control" id="telepon" name="telepon">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-group">
        <label>Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    
    <button type="submit" class="btn btn-primary" name="save">Simpan</button>
  </form>
</div>

<?php


if (isset($_POST['save'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $password = $_POST['password'];

     // Upload and store photo in "foto_produk" folder
     $namaFoto = $_FILES['foto']['name'];
     $lokasiFoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasiFoto, "../foto_pelanggan/" . $namaFoto);


    $koneksi->query("INSERT INTO pelanggan (nama_pelanggan, email_pelanggan, telepon_pelanggan,password_pelanggan,foto_pelanggan) 
                     VALUES ('$nama', '$email', '$telepon','$password','$namaFoto')");

    echo "<div class='alert alert-info'>Data tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
}
?>
