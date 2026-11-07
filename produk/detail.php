<?php
session_start();
require_once '../config/koneksi.php';
require_once '../config/helper.php';

if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    $query = "SELECT produk.*, pelanggan.nama_pelanggan AS nama_pelanggan
          FROM produk
          LEFT JOIN pelanggan ON produk.dibuat_oleh = pelanggan.id_pelanggan
          WHERE produk.id_produk=?";


    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $perproduk = $result->fetch_assoc();

        // Ubah kolom 'dibuat_oleh' menjadi 'nama_pelanggan' jika berisi id_pelanggan
        if (!empty($perproduk['dibuat_oleh'])) {
            $perproduk['dibuat_oleh'] = $perproduk['nama_pelanggan'];
        } else {
            // Tampilkan pesan jika tidak ada informasi pelanggan
            $perproduk['dibuat_oleh'] = "Pelanggan tidak ditemukan";
        }

    } else {
        echo "Proyek tidak ditemukan.";
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../foto/logo.png">
    <title>Detail Produk•iBarCrafts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
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
                <a href="../index.php" style="--i:1;" >Home</a>
            </li>

            <li>
                <a href="index.php" style="--i:2;" class="active">Product</a>
            </li>
            <li>
                <a href="../about.php" style="--i:3;">About us </a>
            </li>
            <?php 
               if (isset($_SESSION["pelanggan"])):
              ?>
            <li >
                        <a class="navbar-dark-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="--i:4;">
                        <i class="ph ph-user"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"  href="../profil/index.php">Profil</a></li>
                            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                            
                        </ul>
                    </li>
                    <!-- else -->
                    <?php else: ?>
                    <li >
                        <a  href="../login.php"style="--i:4;">Login</a>
                    </li>
                    <?php endif ?>
        </ul>
    </nav>


    <div class="container mt-5">
        <div class="row row-produk">

            <div id="carouselExampleDark" class="carousel carousel-dark slide col-lg-5">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="../foto_produk/<?php echo e($perproduk['foto_produk']);?> " alt="..." style="object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="../foto_produk/<?php echo e($perproduk['foto_produk']);?> " alt="..." style="object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                    <img src="../foto_produk/<?php echo e($perproduk['foto_produk']);?> " alt="..." style="object-fit: cover;">
                    </div>
                </div>
                <button class="carousel-control-prev " type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="false"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- carusel -->

            <div class="col-lg-7">
                <h3 class="col-lg-6"><?php echo e($perproduk['nama_produk']);?></h3>
                <?php if (!empty($perproduk['dibuat_oleh'])): ?>
        <span class="text-muted fst-italic">Dibuat oleh: <?php echo e($perproduk['dibuat_oleh']); ?></span>
    <?php else: ?>
        <span class="text-muted fst-italic">Dibuat oleh: iBarCrafts</span>
    <?php endif; ?>

                <div class="garis-produk"></div>

                <?php
$harga_produk = $perproduk['harga_produk'];
?>

<!-- Harga: Rp<?php echo number_format($harga_produk); ?> -->
<?php if ($harga_produk != 0) { ?>
    <h5 class="text-muted">Harga: Rp<?php echo number_format($harga_produk); ?></h5>
<?php } else { ?>
    <h5 class="text-success border-1">FREE</h5>
<?php } ?>
                <div class="btn-produk mt-4">
                   <!-- Download button for the zip file -->
                <?php if (!empty($perproduk['Download_File'])) { ?>
                    <a href="../ZipFiles/<?php echo e($perproduk['Download_File']); ?>" class="btn btn-warning" download>Download ZIP</a>
                <?php } else { ?>
                    <p>No downloadable file available for this product.</p>
                <?php } ?>
                </div>


            </div>
   


        </div>

        <!-- review -->
        <div class="row row-produk">
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="deskripsi-tab" data-bs-toggle="tab"
                            data-bs-target="#deskripsi-tab-pane" type="button" role="tab"
                            aria-controls="deskripsi-tab-pane" aria-selected="true">Deskripsi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="komentar-tab" data-bs-toggle="tab"
                            data-bs-target="#komentar-tab-pane" type="button" role="tab"
                            aria-controls="komentar-tab-pane" aria-selected="false">Komentar</button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="deskripsi-tab-pane" role="tabpanel"
                        aria-labelledby="deskripsi-tab" tabindex="0">
                        <p>
                            <strong></strong></strong><?php echo e($perproduk['deskripsi_produk']); ?> </br>

                        </p>
                    </div>
                    <div class="tab-pane fade" id="komentar-tab-pane" role="tabpanel" aria-labelledby="komentar-tab"
                        tabindex="0">

                        <p>Komen (COMING SOON)</p>
                    </div>

                </div>
            </div>
        </div>


    </div>









    

    <?php
    $rootPath = '../';
    include '../includes/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="produk.js"></script>
</body>

</html>
