<?php
session_start();
include "function.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include "head.php"?>

    <title>Peternakan</title>

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
                    <h1 class="h5 mb-0 text-gray-800 text-center w-100 mt-4">Peternakan</h1>
                </div>

                <div class="row justify-content-start">
                    <div class="col-lg-12 col-sm-12 card card-body">
                        <a href="tambah-peternakan.php?halaman=peternakan" class=" w-25 btn btn-primary">Tambah</a>

                        <?php if (get_flash_name('add_success') != ""):?>
                            <div class="alert alert-success my-3">
                                <?= get_flash_message('add_success')?>
                            </div>
                        <?php endif;?>
                        <?php if (get_flash_name('add_failed') != ""):?>
                            <div class="alert alert-danger my-3">
                                <?= get_flash_message('add_failed')?>
                            </div>
                        <?php endif;?>

                        <!-- table of data -->
                        <div class="table-responsive mt-5">
                            <table class="table table-striped table-hover table-bordered" id="table-jenis">
                            <h5 class="card-title">Data Peternakan</h5>
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>jenis</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1?>
                                <?php foreach (ambil_data_peternakan() as $data):?>
                                    <tr>
                                        <td><?= $i++?></td>
                                        <th><?= $data['tahun']?></th>
                                        <td><?= $data['jenis']?></td>
                                        <td>
                                            <a href="update-peternakan.php?halaman=peternakan&jenis=<?= $data['id_jenis']?>&tahun=<?= $data['id_tahun']?>" class="btn btn-warning">Edit</a>
                                            ||
                                            <a href="hapus-peternakan.php?id_jenis=<?= $data['id_jenis']?>&id_tahun=<?= $data['id_tahun']?>" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
    <script>
        $(document).ready(function () {
            $("#table-jenis").DataTable()
        })
    </script>
</div>
</body>
</html>