<?php
session_start();
require_once '../config/koneksi.php';
require_once '../config/helper.php';

if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='../login.php';</script>";
    exit();
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

// Gunakan prepared statement untuk mencegah SQL injection
$stmt = $koneksi->prepare("SELECT * FROM pelanggan WHERE id_pelanggan = ?");
$stmt->bind_param("i", $id_pelanggan);
$stmt->execute();
$result_pelanggan = $stmt->get_result();

if ($result_pelanggan) {
    $pelanggan = $result_pelanggan->fetch_assoc();
} else {
    echo "Error: " . $koneksi->error;
    exit();
}
$stmt->close();

// Logika pemrosesan formulir
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updateProfile'])) {
        $namaPelanggan = $_POST['namaPelanggan'];
        $teleponPelanggan = $_POST['teleponPelanggan'];

        // Update nama dan nomor telepon dengan prepared statement
        $stmt_update = $koneksi->prepare("UPDATE pelanggan SET nama_pelanggan = ?, telepon_pelanggan = ? WHERE id_pelanggan = ?");
        $stmt_update->bind_param("ssi", $namaPelanggan, $teleponPelanggan, $id_pelanggan);
        $stmt_update->execute();
        $stmt_update->close();

        // Perbarui foto jika ada file yang diunggah
        if (!empty($_FILES['foto']['name'])) {
            $foto_name = uniqid('foto_pelanggan_') . '.jpg';
            $foto_path = '../foto_pelanggan/' . $foto_name;
            
            // Pindahkan file yang diunggah ke direktori tujuan
            move_uploaded_file($_FILES['foto']['tmp_name'], $foto_path);

            // Update nama file foto dengan prepared statement
            $stmt_foto = $koneksi->prepare("UPDATE pelanggan SET foto_pelanggan = ? WHERE id_pelanggan = ?");
            $stmt_foto->bind_param("si", $foto_name, $id_pelanggan);
            $stmt_foto->execute();
            $stmt_foto->close();
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
    <img src="../foto_pelanggan/<?php echo e($pelanggan['foto_pelanggan']);?>" alt="" class="img-fluid">
</div>
                <div class="form-group">
                    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" class="form-control"> 
    </div>
                        <div class="form-group">
                            <label for="namaPelanggan">Nama</label>
                            <input type="text" class="form-control" name="namaPelanggan" id="namaPelanggan" value="<?php echo e($pelanggan['nama_pelanggan']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="teleponPelanggan">Nomor Telepon</label>
                            <input type="text" class="form-control" name="teleponPelanggan" id="teleponPelanggan" value="<?php echo e($pelanggan['telepon_pelanggan']); ?>">
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
