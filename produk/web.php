<?php
session_start();
require_once '../config/koneksi.php';
require_once '../config/helper.php';
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='../login.php';</script>";
    exit(); 
  }
?>


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
                    <img src="../foto_produk/<?php echo e($perproduk['foto_produk']);?> " alt="..." style="object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($perproduk['nama_produk']);?></h5>
                        
                        <a href="detail.php?id=<?php echo e($perproduk['id_produk']); ?>" class="btn btn-warning d-grid">Detail</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>


    
    <?php
    $rootPath = '../';
    include '../includes/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script src="produk.js"></script>
</body>

</html>