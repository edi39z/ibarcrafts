<!-- ubahberita.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- (head section - Sesuaikan dengan kebutuhan Anda) -->
    <title>Ubah Berita</title>
</head>

<body>
    <h2>Ubah Berita</h2>

    <?php
    $ambil = $koneksi->query("SELECT * FROM berita WHERE id_berita='$_GET[id]'");
    $pecah = $ambil->fetch_assoc();
    ?>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Judul Berita</label>
            <input type="text" name="judul_berita" class="form-control" value="<?php echo $pecah['judul_berita'] ?>">
        </div>

        <div class="form-group">
            <label>Link Berita</label>
            <input type="text" name="link_berita" class="form-control" value="<?php echo $pecah['link_berita'] ?>">
        </div>

        <div class="form-group">
            <img src="../<?php echo $pecah['foto_berita'] ?>" width="100">
        </div>

        <div class="form-group">
            <label>Ganti Foto</label>
            <input type="file" name="foto_berita" class="form-control">
        </div>

        <button class="btn btn-primary" name="ubah">Ubah</button>
    </form>

    <?php
    if (isset($_POST['ubah'])) {
        $namaFoto = $_FILES['foto_berita']['name'];
        $lokasiFoto = $_FILES['foto_berita']['tmp_name'];
        move_uploaded_file($lokasiFoto, "../foto_berita/$namaFoto");

        // Update the database
        $koneksi->query("UPDATE berita SET 
            judul_berita='$_POST[judul_berita]',
            link_berita='$_POST[link_berita]', 
            foto_berita='$namaFoto'
            WHERE id_berita='$_GET[id]'");

        echo "<script>alert('Data berita telah diubah');</script>";
        echo "<script>location='index.php?halaman=berita';</script>";
    }
    ?>

</body>

</html>
