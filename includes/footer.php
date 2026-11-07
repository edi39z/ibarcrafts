<?php
// File footer terpusat - include di setiap halaman
// Variabel $rootPath harus di-set sebelum include untuk menyesuaikan path relatif
// Contoh: $rootPath = ''; atau $rootPath = '../';
if (!isset($rootPath)) {
    $rootPath = '';
}
?>
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
                    <a href="<?php echo $rootPath; ?>produk/web.php" class="text-white" style="text-decoration: none;">ThemeWeb</a>
                </p>
                <p>
                    <a href="<?php echo $rootPath; ?>produk/gameasset.php" class="text-white" style="text-decoration: none;">GameAsset</a>
                </p>
                <p>
                    <a href="<?php echo $rootPath; ?>produk/game.php" class="text-white" style="text-decoration: none;">Game</a>
                </p>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact</h5>
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
                <p>Copyright &copy; <?php echo date('Y'); ?> All rights reserved by :
                    <a href="<?php echo $rootPath; ?>index.php" style="text-decoration: none;">
                        <strong class="text-warning">iBarCrafts</strong>
                    </a>
                </p>
            </div>
            <div class="col-md-5 col-lg-4">
                <div class="text-center text-md-right">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="fab fa-github"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
