<?php
session_start();
include "function.php";

if (isset($_POST['tambah-data'])) {
    tambah_data_keterangan($_POST, $_GET['tahun'], $_GET['jenis']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include "head.php"?>

    <title>Tambah Keterangan </title>

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
                    <h1 class="h5 mb-0 text-gray-800 text-center w-100 mt-4">Tambah Keterangan</h1>
                </div>

                <div class="row justify-content-start">
                    <div class="col-lg-12 col-sm-12">
                        <div class="card card-body mb-3">
                            <form action="" method="get">
                                <div class="form-group">
                                    <label for="tahun" class="form-label">Tahunn</label>
                                    <select name="tahun" id="tahun" class="form-control" required>
                                        <option value="" <?php if (isset($_GET['tahun']) && isset($_GET['jenis'])):?>selected <?php endif;?>>--- Pilih Tahun ---</option>
                                        <?php foreach (ambiL_data_tahun() as $tahun):?>
                                            <option value="<?= $tahun['id']?>" <?php if (((isset($_GET['tahun']) && isset($_GET['jenis'])) == true) && ($_GET['tahun'] == $tahun['id'])):?>selected <?php endif;?>><?= $tahun['tahun']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jenis" class="form-label">Jenis</label>
                                    <select name="jenis" id="jenis" class="form-control" required>
                                        <option value="" <?php if (isset($_GET['tahun']) && isset($_GET['jenis'])):?>selected <?php endif;?>>--- Pilih Jenis ---</option>
                                        <?php foreach (ambil_data_jenis() as $jenis):?>
                                            <option value="<?= $jenis['id']?>" <?php if (((isset($_GET['tahun']) && isset($_GET['jenis'])) == true) && ($_GET['jenis'] == $jenis['id'])):?>selected <?php endif;?>><?= $jenis['jenis']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="btn-group">
                                    <button type="submit" name="generate-data" class="btn btn-primary mr-2">Ok</button>
                                </div>
                            </form>
                        </div>
                        <div class="card card-body border">
                            <form action="" method="POST">
                                <?php if (isset($_GET['tahun']) && isset($_GET['jenis'])):?>
                                    <?php $hasil_perhitungan = hitung_k_means($_GET['tahun'], $_GET['jenis']);?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>Kelompok</th>
                                                <th>Keterangan</th>
                                                <th>Kesimpulan</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i= 0;?>
                                            <?php foreach ($hasil_perhitungan[1] as $perhitungan):?>
                                                <tr class="align-middle">
                                                    <?php if ($i == 0):?>
                                                        <td><span class="badge badge-pill badge-danger">Cluster 1</span></td>
                                                    <?php endif;?>
                                                    <?php if ($i == 1):?>
                                                        <td><span class="badge badge-pill badge-success">Cluster 2</span></td>
                                                    <?php endif;?>
                                                    <?php if ($i == 2):?>
                                                        <td><span class="badge badge-pill badge-primary">Cluster 3</span></td>
                                                    <?php endif;?>

                                                    <td class="small">
                                                        <?php foreach ($perhitungan as $keterangan):?>
                                                            <?= $keterangan['nama_ternak']?> [<?= $keterangan['nilai_normalisasi']?>]
                                                            <br>
                                                        <?php endforeach;?>
                                                    </td>

                                                    <td>
                                                        <select name="cluster-<?= $i?>"  class="form-control" required>
                                                            <option value="" selected>----- Pilih Keputusan -----</option>
                                                            <option value="Kelompok Tinggi">Kelompok Tinggi</option>
                                                            <option value="Kelompok Rendah">Kelompok Rendah</option>
                                                            <option value="Kelompok Sedang">Kelompok Sedang</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <?php $i++;?>
                                            <?php endforeach;?>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-primary" name="tambah-data">Tambah</button>
                                    </div>
                                <?php endif;?>
                            </form>
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

</div>
</body>
</html>