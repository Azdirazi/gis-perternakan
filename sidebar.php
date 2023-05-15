<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div >
                    <i class="fa fa-map" aria-hidden="true"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SIG Peternakan</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <!--<li class="nav-item <?php /*if ((isset($_GET['halaman']) && $_GET['halaman'] == 'dashboard') || isset($_GET['halaman']) == false) :*/?> active <?php /*endif;*/?>">
                <a class="nav-link" href="index.php?halaman=dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>-->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if ((isset($_GET['halaman']) && $_GET['halaman'] == 'beranda') || isset($_GET['halaman']) == false) :?> active <?php endif;?>">
                <a class="nav-link" href="index.php?halaman=beranda">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Beranda</span>
                </a>
            </li>
            
        <?php if(isset($_SESSION['login'])):?>
            <!-- nav untuk non admin -->
            
            <li class="nav-item <?php if ((isset($_GET['halaman']) && $_GET['halaman'] == 'admin') || isset($_GET['halaman']) == false) :?> active <?php endif;?>">
                <a class="nav-link" href="admin.php?halaman=admin">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <span>Admin</span>
                </a>
            </li>

            <li class="nav-item <?php if ((isset($_GET['halaman']) && $_GET['halaman'] == 'jenis') || isset($_GET['halaman']) == false) :?> active <?php endif;?>">
                <a class="nav-link" href="jenis.php?halaman=jenis">
                    <i class="fa-solid fa-cow"></i>
                    <span>Jenis</span>
                </a>
            </li>

            <li class="nav-item <?php if ((isset($_GET['halaman']) && $_GET['halaman'] == 'ternak') || isset($_GET['halaman']) == false) :?> active <?php endif;?>">
                <a class="nav-link" href="ternak.php?halaman=ternak">
                    <i class="fa-solid fa-warehouse"></i>
                    <span>Ternak</span>
                </a>
            </li>

            <li class="nav-item <?php if ((isset($_GET['halaman']) && $_GET['halaman'] == 'tahun') || isset($_GET['halaman']) == false) :?> active <?php endif;?>">
                <a class="nav-link" href="tahun.php?halaman=tahun">
                    <i class="fa fa-calendar" ></i>
                    <span>Tahun</span>
                </a>
            </li>

            <li class="nav-item <?php if ((isset($_GET['halaman']) && $_GET['halaman'] == 'kecamatan') || isset($_GET['halaman']) == false) :?> active <?php endif;?>">
                <a class="nav-link" href="kecamatan.php?halaman=kecamatan">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span>Kecamatan</span>
                </a>
            </li>

            <li class="nav-item <?php if ((isset($_GET['halaman']) && $_GET['halaman'] == 'peternakan') || isset($_GET['halaman']) == false) :?> active <?php endif;?>">
                <a class="nav-link" href="peternakan.php?halaman=peternakan">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Peternakan</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw  text-gray-400"></i>
                     Logout
                </a>
            </li>
        <?php endif;?>
        <?php if(!isset($_SESSION['login'])):?>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa-sharp fa-solid fa-chart-simple"></i>
                    <span>Grafik</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">
                    <i class="fa-solid fa-power-off"></i>
                    <span>Login</span>
                </a>
            </li>
        <?php endif;?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->