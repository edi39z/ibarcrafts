<!-- <?php
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost", "id21641788_ibar", "BARNIbar39z@", "id21641788_ibarcrafts");
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='../login.php';</script>";
    exit(); 
  }
?> -->


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../foto/logo.png">
    <title>Our Products•iBarCrafts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="produk.css">
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




    <div class="container">
        <div id="carouselExample" class="carousel slide mt-5">
            <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
                    <img src="../foto/game.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="../foto/web.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="../foto/ga.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="../foto/Premium.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="../foto/ibar.png" class="d-block w-100" alt="...">
                </div>
                
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- kategori -->
    <div class="container mt-5">
        <div class="judul" style="background-color: white; padding:5px 10px">
            <h4 class="text-center" style="margin-top: 5px;">KATEGORI</h4>
        </div>
        <div class="row text-center row-container mt-2">
            <div class="col-lg-4 col-md-3 col-sm-4 col-6">
                <div class="menu-kategori">
                    <a href="game.php"><img src="foto_produk/game.png" class="img-kate mt-3" alt=""></a>
                    <p class="mt-2">Games</p>

                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-4 col-6">
                <div class="menu-kategori">
                    <a href="web.php"><img src="foto_produk/web.jpg" class="img-kate mt-3" alt=""></a>
                    <p class="mt-2">Web Theme</p>

                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-4 col-6">
                <div class="menu-kategori">
                    <a href="gameasset.php"><img src="foto_produk/game.png" class="img-kate mt-3" alt=""></a>
                    <p class="mt-2">Games Assets</p>

                </div>
            </div>
        </div>
    </div>

    <!-- produk -->
    <div class="container mt-5">
        <div class="judul" style="background-color: white; padding:5px 10px">
            <h4 class="text-center" style="margin-top: 5px;">Theme Webs</h4>
        </div>
        <div class="row">
       
        <?php
            // Assuming you want to display only products with the category 'gs'
            $selectedCategory = 'web';
            $ambil = $koneksi->query("SELECT * FROM produk WHERE kategori = '$selectedCategory'");
            ?>

            <?php while ($perproduk = $ambil->fetch_assoc()) { ?>
            <div class="col-lg-4 col-md-2 col-sm-4 col-6 mt-2">
                <div class="card text-center">
                    <img src="../foto_produk/<?php echo $perproduk['foto_produk'];?> " alt="..." style="object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $perproduk['nama_produk'];?></h5>
                        
                        <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-warning d-grid">Detail</a>
                    </div>
                </div>
            </div>
            <?php } ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script src="produk.js"></script>
</body>

</html>