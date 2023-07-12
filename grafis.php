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
                                    <button type="submit" name="generate-data" class="btn btn-primary mr-2">Cari</button>
                                </div>
                            </form>
                        </div>
                        <div class="card card-body">
                            <?php if (isset($_GET['tahun']) && isset($_GET['jenis'])):?>
                                <?php if (cari_data($_GET['tahun'], $_GET['jenis']) == null):?>
                                    <div class="alert alert-danger" role="alert">
                                        Data Tidak Ada
                                    </div>
                                <?php else:?>
                                    <?php $hasil_perhitungan = hitung_k_means($_GET['tahun'], $_GET['jenis']);?>
                                    <?php $kesimpulan = cari_data($_GET['tahun'], $_GET['jenis'])?>
                                    <div class="card-body mb-3 ">
                                        <div class="w-100" style="height: 512px" id="map"></div>
                                    </div>
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

                                                    <?php if ($i == 0):?>
                                                        <td><?= $kesimpulan['c1']?></td>
                                                    <?php endif;?>
                                                    <?php if ($i == 1):?>
                                                        <td><?= $kesimpulan['c2']?></td>
                                                    <?php endif;?>
                                                    <?php if ($i == 2):?>
                                                        <td><?= $kesimpulan['c3']?></td>
                                                    <?php endif;?>
                                                </tr>
                                                <?php $i++;?>
                                            <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif;?>
                            <?php endif;?>
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
        <script>
            $(document).ready(async function () {
                let bengkayangCoordinate = [ 0.820973, 109.477699]
                let map = L.map('map').setView(bengkayangCoordinate, 8);

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                let tahun = $("[name=tahun]").val();
                let jenis = $("[name=jenis]").val();

                if (tahun > 0 && jenis > 0) {
                    $.ajax({
                        url: 'ambil-data-grafis.php?tahun=' + tahun + '&jenis=' + jenis,
                        method: 'GET',
                        success: function(data) {
                            let result = JSON.parse(data);
                            result.forEach(data => {
                                let coordinate = JSON.parse(data.polygon);
                                let warna = data.warna;
                                if (coordinate !== 0) {
                                    coordinate.forEach(function(coordinate) {
                                        let latlong = coordinate.map(row=> row.reverse()).reverse();
                                        latlong.forEach(row=> row.shift());
                                        L.polygon(latlong, {
                                            fillColor: warna,
                                            color: warna,
                                            fillOpacity: 0.7
                                        }).addTo(map).bindPopup(data.nama)
                                    })
                                }
                            })
                        }
                    })
                }

            })
        </script>
    </div>
</body>
</html>