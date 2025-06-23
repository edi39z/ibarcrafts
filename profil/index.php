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
    <img src="../foto_pelanggan/<?php echo $pelanggan['foto_pelanggan'];?>" alt="" class="img-fluid">
</div>
            <div class="col-lg-7">
                <h3 class="col-lg-6">
                    <p>Profil Akun</p>
                </h3>
                <p><strong>Nama:</strong> <?php echo $pelanggan['nama_pelanggan']; ?></p>
                <p><strong>Email:</strong> <?php echo $pelanggan['email_pelanggan']; ?></p>
                <p><strong>Nomor telepon:</strong> <?php echo $pelanggan['telepon_pelanggan']; ?></p>
                <a href="upload.php" class="btn btn-warning">Upload Produk</a>
                <a href="ubahdata.php" class="btn btn-info">Ubah Data</a>
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
                        <a href="../web.php" class="text-white" style="text-decoration: none;">ThemeWeb</a>
                    </p>
                    <p>
                        <a href="../gameasset.php" class="text-white" style="text-decoration: none;">GameAsset</a>
                    </p>

                    <p>
                        <a href="../game.php" class="text-white" style="text-decoration: none;">Game</a>
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
                        <a href="../index.php" style="text-decoration : none;">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>