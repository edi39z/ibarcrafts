<?php
session_start();
$koneksi = new mysqli("localhost", "id21641788_ibar", "BARNIbar39z@", "id21641788_ibarcrafts");


// if (!isset($_SESSION['pelanggan'])) {
//     echo "<script>alert('Anda harus login');</script>";
//     echo "<script>location='login.php';</script>";
//     exit(); 
//   }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iBarCrafts</title>
    <link rel="icon" href="foto/logo.png">
    <link rel="stylesheet" href="home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                <a href="index.php" style="--i:1;" class="active">Home</a>
            </li>

            <li>
                <a href="produk/index.php" style="--i:2;">Product</a>
            </li>
            <li>
                <a href="about.php" style="--i:3;">About us </a>
            </li>
            <?php 
               if (isset($_SESSION["pelanggan"])):
              ?>
                    

                    <li >
                        <a class="navbar-dark-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="--i:4;">
                        <i class="ph ph-user"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"  href="profil/index.php">Profil</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                           
                            
                        </ul>
                    </li>

                    <!-- else -->
                    <?php else: ?>
                    <li >
                        <a  href="login.php" style="--i:4;">Login</a>
                    </li>
                    <?php endif ?>
        </ul>
    </nav>


    <section class="home">
        <div class="home-content">
            <h1 class="font-weight-bold ">iBarCrafts</h1>
            <h3>"Innovate Your World, Find Solutions at the Craft of Design."</h3>

            <a class="btn btn-warning "href="about.php" role="button">Details</a>
            <a class="btn btn-warning" href="produk/index.php" role="button">Let's Go</a>
        </div>
        <div class="img-home">
            <div class="rhombus">
                <img src="foto/gbr1.jpeg" alt="">
            </div>

        </div>



    </section>
    <section class="features">
        <h1 class="font-weight-bold ">Why Choose Us</h1>
        <p>By choosing us, you can enjoy some of our unique features.</p>
        <div class="container m-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 pb-3">
                    <div class="icon-box d-flex">
                        <div class="icon-box-icon mx-5 pb-3">
                            <i class="ph ph-clock-clockwise"></i>
                        </div>
                        <div class="icon-box-content">
                            <h3 class="card-title text-uppercase text-dark">Fast Respon</h3>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-3">
                    <div class="icon-box d-flex">
                        <div class="icon-box-icon pe-3 pb-3">
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="icon-box-content">
                            <h3 class="card-title text-uppercase text-dark">Quality guarantee</h3>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 pb-3">
                    <div class="icon-box d-flex">
                        <div class="icon-box-icon pe-3 pb-3">
                            <i class="ph ph-shield-check"></i>
                        </div>
                        <div class="icon-box-content">
                            <h3 class="card-title text-uppercase text-dark">100% secure payment</h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id="blog">
    <div class="container">
        <div class="container text-center">
            <div class="row mt-3">
                <div class="col">
                    <h1 class="fw-bold mb-5 text-dark">Hot News</h1>
                </div>
            </div>
            <div class="row">

                <?php
                // Ambil data berita dari tabel 'berita'
                $sql = "SELECT id_berita, judul_berita, link_berita, foto_berita FROM berita";
                $result = $koneksi->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Tampilkan setiap berita dalam card HTML
                        echo '<div class="col-sm-4 mb-3 mb-sm-0 g-2">';
                        echo '<div class="card" style="height: 100%;">';
                        echo '<div class="card-body">';
                        echo '<img src="foto_berita/' . $row["foto_berita"] . '" class="card-img-top" alt="..." style="object-fit: cover; height: 300px;">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row["judul_berita"] . '</h5>';
                        echo '<button type="button" class="btn btn-danger"><a href="' . $row["link_berita"] . '" class="text-decoration-none text-light">See</a></button>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "Tidak ada berita yang ditemukan.";
                }
                ?>

            </div>
        </div>
    </div>
</section>







    
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
                        <a href="produk/web.php" class="text-white" style="text-decoration: none;">ThemeWeb</a>
                    </p>
                    <p>
                        <a href="produk/gameasset.php" class="text-white" style="text-decoration: none;">GameAsset</a>
                    </p>

                    <p>
                        <a href="produk/game.php" class="text-white" style="text-decoration: none;">Game</a>
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
                    <p>Copyright © 2023 All rights reseved by :
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




    <script src="js/home.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>