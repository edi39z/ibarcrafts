<?php
session_start();
$koneksi = new mysqli("localhost", "id21641788_ibar", "BARNIbar39z@", "id21641788_ibarcrafts");

if (!isset( $_SESSION['admin']))
{
    echo "<script>alert('anda harus login terlebih dahulu');</script>";
    echo "<script>location='../login.php';</script>";
    header('location:../login.php');
    exit();
}
    

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iBarCrafts</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">iBar admin</a> 
            </div>
  
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <!-- bagian dari tutorial -->
                    <li>
                        <a href="index.php"><i class="fa fa-home fa-3x"></i> Home</a>
                    </li>

                    <li>
                        <a href="index.php?halaman=produk"><i class="fa fa-dashboard fa-3x"></i> Produk</a>
                    </li>

                    <li>
                        <a href="index.php?halaman=pembelian"><i class="fa fa-dashboard fa-3x"></i> Pembelian</a>
                    </li>

                    <li>
                        <a href="index.php?halaman=pelanggan"><i class="fa fa-dashboard fa-3x"></i> Pelanggan</a>
                    </li>
                    <li>
                        <a href="index.php?halaman=berita"><i class="fa fa-dashboard fa-3x"></i> Berita</a>
                    </li>

                    <li>
                        <a href="index.php?halaman=logout"><i class="fa fa-logout fa-3x"></i> Logout</a>
                    </li>
                    
                    <!-- bagian dari tutorial -->


                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <?php
            if(isset($_GET['halaman'])) {
                if($_GET['halaman']=="produk"){
                    include 'produk.php';
                }

                else if($_GET['halaman']=="pembelian"){
                    include 'pembelian.php';
                }

                else if($_GET['halaman']=="pelanggan"){
                    include 'pelanggan.php';
                }
                else if($_GET['halaman']=="logout"){
                    include '../logout.php';
                }
                else if($_GET['halaman']=="detail"){
                    include 'detail.php';
                }
                else if($_GET['halaman']=="tambahproduk"){
                    include 'tambahproduk.php';
                }
                else if($_GET['halaman']=="tambahberita"){
                    include 'tambahberita.php';
                }
                else if($_GET['halaman']=="tambahpelanggan"){
                    include 'tambahpelanggan.php';
                }
                else if($_GET['halaman']=="hapusproduk"){
                    include 'hapusproduk.php';
                }
                else if($_GET['halaman']=="hapuspelanggan"){
                    include 'hapuspelanggan.php';
                }
                else if($_GET['halaman']=="hapusberita"){
                    include 'hapusberita.php';
                }
                else if($_GET['halaman']=="ubahproduk"){
                    include 'ubahproduk.php';
                }
                else if($_GET['halaman']=="ubahberita"){
                    include 'ubahberita.php';
                }
                
                else if($_GET['halaman']=="logout"){
                    include '../logout.php';
                }
                else if($_GET['halaman']=="detailproduk"){
                    include 'detailproduk.php';
                }
                else if($_GET['halaman']=="berita"){
                    include 'berita.php';
                }
            }         
            else{
                include 'home.php';
            }
            ?>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
