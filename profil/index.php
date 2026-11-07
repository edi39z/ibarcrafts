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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../foto/logo.png">
    <title>Profil•iBarCrafts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="c.css">
</head>

<body>
    <nav>
        <div class="logo">
            <a href="index.php">iBarCrafts.</a>
        </div>
        <div id="menu-icon" class="menu-icon">
            <i class="ph-fill ph-list"></i>
        </div>
        <ul id="menu-list" class="hidden">
            <li>
                <a href="../index.php" style="--i:1;">Home</a>
            </li>

            <li>
                <a href="../produk/index.php" style="--i:2;">Product</a>
            </li>
            <li>
                <a href="../about.php" style="--i:3;">About us </a>
            </li>
            <?php 
               if (isset($_SESSION["pelanggan"])):
              ?>
            <li>
                <a class="navbar-dark-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"  style="--i:4;" >
                    <i class="ph ph-user" ></i></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item  active text-bg-warning" href="index.php"  class="active">Profil</a></li>
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>

                </ul>
            </li>

            <!-- else -->
            <?php else: ?>
            <li>
                <a href="../login.php" style="--i:4;">Login</a>
            </li>
            <?php endif ?>

        </ul>
    </nav>


    <div class="container mt-5">
        <div class="row row-produk">
        <div class="col-lg-5">
    <img src="../foto_pelanggan/<?php echo e($pelanggan['foto_pelanggan']);?>" alt="" class="img-fluid">
</div>
            <div class="col-lg-7">
                <h3 class="col-lg-6">
                    <p>Profil Akun</p>
                </h3>
                <p><strong>Nama:</strong> <?php echo e($pelanggan['nama_pelanggan']); ?></p>
                <p><strong>Email:</strong> <?php echo e($pelanggan['email_pelanggan']); ?></p>
                <p><strong>Nomor telepon:</strong> <?php echo e($pelanggan['telepon_pelanggan']); ?></p>
                <a href="upload.php" class="btn btn-warning">Upload Produk</a>
                <a href="ubahdata.php" class="btn btn-info">Ubah Data</a>
            </div>
        </div>
    </div>






    <?php
    $rootPath = '../';
    include '../includes/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>