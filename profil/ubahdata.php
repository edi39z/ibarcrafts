<?php
session_start();
$koneksi = new mysqli("localhost", "id21641788_ibar", "BARNIbar39z@", "id21641788_ibarcrafts");

if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='../login.php';</script>";
    exit();
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$query_pelanggan = "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
$result_pelanggan = $koneksi->query($query_pelanggan);

if ($result_pelanggan) {
    $pelanggan = $result_pelanggan->fetch_assoc();
} else {
    echo "Error: " . $koneksi->error;
    exit();
}

// Logika pemrosesan formulir
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updateProfile'])) {
        $namaPelanggan = $_POST['namaPelanggan'];
        $teleponPelanggan = $_POST['teleponPelanggan'];

        // Update nama dan nomor telepon di database
        $query_update_profile = "UPDATE pelanggan SET nama_pelanggan='$namaPelanggan', telepon_pelanggan='$teleponPelanggan' WHERE id_pelanggan='$id_pelanggan'";
        $koneksi->query($query_update_profile);

        // Perbarui foto jika ada file yang diunggah
        if (!empty($_FILES['foto']['name'])) {
            $foto_name = uniqid('foto_pelanggan_') . '.jpg';
            $foto_path = '../foto_pelanggan/' . $foto_name;
            
            // Pindahkan file yang diunggah ke direktori tujuan
            move_uploaded_file($_FILES['foto']['tmp_name'], $foto_path);

            // Update nama file foto di database
            $query_update_foto = "UPDATE pelanggan SET foto_pelanggan='$foto_name' WHERE id_pelanggan='$id_pelanggan'";
            $koneksi->query($query_update_foto);
        }

        // Redirect atau tampilkan pesan sukses
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../foto/logo.png">
    <title>Profil • iBarCrafts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row row-produk">
            <div class="col-lg-5">
            <div class="col-lg-5">
    <img src="../foto_pelanggan/<?php echo $pelanggan['foto_pelanggan'];?>" alt="" class="img-fluid">
</div>
                <div class="form-group">
                    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" class="form-control"> 
    </div>
                        <div class="form-group">
                            <label for="namaPelanggan">Nama</label>
                            <input type="text" class="form-control" name="namaPelanggan" id="namaPelanggan" value="<?php echo $pelanggan['nama_pelanggan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="teleponPelanggan">Nomor Telepon</label>
                            <input type="text" class="form-control" name="teleponPelanggan" id="teleponPelanggan" value="<?php echo $pelanggan['telepon_pelanggan']; ?>">
                        </div>
                        <button type="submit" class="btn btn-warning" name="updateProfile">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7">
                <!-- Informasi profil yang tidak diubah -->
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
