<?php
session_start();
$koneksi = new mysqli("localhost", "id21641788_ibar", "BARNIbar39z@", "id21641788_ibarcrafts");


if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    exit(); 
  }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About•iBarCrafts</title>
    <link rel="icon" href="foto/logo.png">
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                <a href="index.php" style="--i:1;" >Home</a>
            </li>

            <li>
                <a href="produk/index.php" style="--i:2;">Product</a>
            </li>
            <li>
                <a href="about.php" style="--i:3;"class="active">About us </a>
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

    <div class="heading">
        <h1>About Us</h1>
        <p>"Innovate Your World, Find Solutions at the Craft of Design."</p>
    </div>
    <div class="box">
        <section class="about">
            <div class="about-image">
                <img src="foto/logob.png" alt="">
            </div>
            <div class="about-content">
                <h2><strong>iBarCrafts</strong></h2>
                <p> <strong>iBarCrafts</strong> adalah platform atau situs web yang menyediakan sumber daya, inspirasi,
                    dan solusi
                    praktis untuk para desainer, pengembang, dan individu yang tertarik dalam dunia desain. Dengan fokus
                    pada inovasi, "iBarCrafts" menjadi tempat di mana pengguna dapat mengeksplorasi ide-ide baru,
                    menemukan solusi konkret untuk proyek-proyek desain mereka, dan mengembangkan keterampilan serta
                    keahlian dalam menciptakan desain yang personal dan kreatif. Melalui kombinasi teknologi dan seni,
                    "iBarCrafts" berupaya menjadi sumber daya yang memadukan aspek-aspek kreatif dan praktis dalam dunia
                    desain, menginspirasi serta memudahkan pengguna untuk mencapai hasil desain yang unik dan bermakna.
                </p>
                <p> <strong>• i</strong> : Menyiratkan unsur teknologi dan inovasi
                    (dapat diartikan sebagai "I" dari"innovation").
                <p> <strong>• Bar</strong> : tempat dimana orang menemukan dan mencari solusi atapun mengurangi dari
                    masalah</p>
                <p> <strong>• Crafts</strong>: Merujuk pada keterampilan dan kerajinan, menunjukkan bahwa produk atau
                    inspirasi
                    yang disediakan melibatkan sentuhan kreatif dan keahlian dalam dunia desain.</p>
                <br>


            </div>
        </section>
    </div>
    <!-- team -->
    <div class="team-container">
        <div class="team-header">
            <h1>Our Team</h1>
        </div>
        <div class="sub-container">
            <div class="teams">
                <img src="foto/logo.png" alt="">
                <div class="name">Edi Suranta Ginting</div>
                <div class="desig">Full Stack Developer</div>
                <div class="about-team">

                </div>
                <div class="sosial-medias">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/barnibar_production/"><i class="fab fa-instagram"></i></a>
                    <a href="https://github.com/edi39z"><i class="fab fa-github"></i></a>
                </div>
            </div>
            <!-- brian -->
            <div class="teams">
                <img src="foto/logo.png" alt="">
                <div class="name">Brian Abednego </div>
                <div class="desig">Back End Developer</div>
                <div class="about-team"></div>
                <div class="sosial-medias">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                </div>
            </div>
            <!-- daniel -->
            <div class="teams">
                <img src="foto/logo.png" alt="">
                <div class="name">Cristofer Daniel Sinaga</div>
                <div class="desig">Font End Developer</div>
                <div class="about-team"></div>
                <div class="sosial-medias">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="js/about.js"></script>
</body>

</html>