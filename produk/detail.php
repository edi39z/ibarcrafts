<?php
session_start();
$koneksi = new mysqli("localhost", "id21641788_ibar", "BARNIbar39z@", "id21641788_ibarcrafts");

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
                    <img src="../foto_produk/<?php echo $perproduk['foto_produk'];?> " alt="..." style="object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="../foto_produk/<?php echo $perproduk['foto_produk'];?> " alt="..." style="object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                    <img src="../foto_produk/<?php echo $perproduk['foto_produk'];?> " alt="..." style="object-fit: cover;">
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
                <h3 class="col-lg-6"><?php echo $perproduk['nama_produk'];?></h3>
                <?php if (!empty($perproduk['dibuat_oleh'])): ?>
        <span class="text-muted fst-italic">Dibuat oleh: <?php echo $perproduk['dibuat_oleh']; ?></span>
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
                    <a href="../ZipFiles/<?php echo $perproduk['Download_File']; ?>" class="btn btn-warning" download>Download ZIP</a>
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
                            <strong></strong></strong><?php echo $perproduk['deskripsi_produk']; ?> </br>

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









    

    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container text-center text-md-left">
            <div class="row text-center text-md-left">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-upper mb-4 font-weight-bold text-warning ">iBarCrafts</h5>
                    <p>"Innovate Your World, Find Solutions at the Craft of Design."</p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Products</h5>
                    <p>
                        <a href="web.php" class="text-white" style="text-decoration: none;">ThemeWeb</a>
                    </p>
                    <p>
                        <a href="gameasset.php" class="text-white" style="text-decoration: none;">GameAsset</a>
                    </p>

                    <p>
                        <a href="game.php" class="text-white" style="text-decoration: none;">Game</a>
                    </p>

                </div>
                <!-- <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-upper mb-4 font-weight-bold text-warning">Sosial Media
                    </h5>
                    <p>
                        <a href="" class="text-white" style="text-decoration: none;">IG</a>
                    </p>
                    <p>
                        <a href="" class="text-white" style="text-decoration: none;">WA</a>
                    </p>

                    <p>
                        <a href="" class="text-white" style="text-decoration: none;">GIHUB</a>
                    </p>

                </div> -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">

                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact
                    </h5>
                    <p>
                        <i class="fas fa-home mx-3"></i>Medan,USU
                    </p>
                    <p>
                        <i class="fas fa-envelope mx-3"></i>iBarCrafts@gmail.com
                    </p>
                    <p>
                        <i class="fas fa-phone mx-3"></i>+62 877-638-032-71
                    </p>

                </div>
            </div>

            <hr class="mb-4">
            <div class="row align-items-center">

                <div class="col-md-7 col-lg-8">
                    <p>Copyright ©2023 All rights reseved by :
                        <a href="#" style="text-decoration : none;">
                            <strong class="text-warning">iBarCrafts</strong>
                        </a>
                    </p>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="text-center text-md-right">
                        <ul class="list-unstyled list-inline">
                            <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white"
                                    style="font-size: 23px;"><i class="fab fa-facebook"></i></a>
                            <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white"
                                    style="font-size: 23px;"><i class="fab fa-twitter"></i></a>

                            </li>
                            <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white"
                                    style="font-size: 23px;"><i class="fab fa-instagram"></i></a>

                            </li>
                            <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white"
                                    style="font-size: 23px;"><i class="fab fa-github"></i></a>

                            </li>

                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="produk.js"></script>
</body>

</html>
