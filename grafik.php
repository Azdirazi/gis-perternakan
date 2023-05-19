<?php
session_start();

include "function.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include "head.php"?>

    <title>Beranda</title>

    <?php include "css.php"?>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include "sidebar.php";?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h5 mb-0 text-gray-800 text-center w-100 mt-4">Sistem  Informasi Geografis dan Monitoring Ternak <br> Kabpuaten Bengkayang</h1>
                    </div>
                    <?php if(!isset($_SESSION['login'])):?>
                        <div class="row justify-content-start">
                            <div class="col-lg-12 col-12 card p-0">
                                <div class="card-header bg-primary text-white">
                                    Sistem Informasi Geografis dan Monitoring Ternak Kabupaten Bengkayang
                                </div>
                                <div class="card-body">
                                    <p>Lorem Ipsum</p>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 card p-0">
                                <div class="card-header bg-primary text-white">
                                    Data Geografis Kabupaten Bengkayang
                                </div>
                             </div>
                    <?php endif;?>
                    
               </div>


            </div>
            <!-- End of Content Wrapper -->
            <?php include "footer.php"?>
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <?php include "logout_modal.php"?>

        <?php include "js.php"?>
    </div>
</body>
</html>