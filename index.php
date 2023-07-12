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
                                    <p>Kabupaten Bengkayang adalah salah satu kabupaten di provinsi Kalimantan Barat, Indonesia. Kabupaten ini memiliki luas 5.396,30 km2 dengan jumlah penduduk 289.587 jiwa dan mayoritas penduduknya beretnik Dayak. Kantor Bupati terletak di Jalan Guna Baru Trans Rangkang, Bengkayang, 79282. </p>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 card p-0">
                                <div class="card-header bg-primary text-white">
                                    Data Geografis Kabupaten Bengkayang
                                </div>
                                <div class="card-body">
                                    <div class="w-100" style="height: 512px" id="map"></div>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                    <?php if(isset($_SESSION['login'])):?>
                        <div class="card card-body">
                        <div class="justify-content-center row ">
                            <div class="my-2 mx-4 card card-body col-lg-12">
                                <h5>Selamat Datang Admin</h5>
                            </div>
                            <div class="w-100 row">
                                <div class="mx-4  card card-body col-lg-">
                                    <div class="row justify-content-between">
                                        <h5>Data Ternak</h5>
                                        <a class="btn btn-light" href="#">View</a>
                                    </div>
                                    <h4 class="text-black font-weight-bold ">8</h4>
                                </div>
                                <div class="mx-4  card card-body col-lg-">
                                    <div class="row justify-content-between">
                                        <h5>Data Tahun</h5>
                                        <a class="btn btn-light" href="#">View</a>
                                    </div>
                                    <h4>1000000000000</h4>
                                </div>
                            </div>
                            <div class="w-100 row my-2 justify-content-center">
                                <div class="mx-4  card card-body col-lg-">
                                    <div class="row justify-content-between">
                                        <h5>Data Jumlah Keseluruhan</h5>
                                    </div>
                                    <h4 class="text-black font-weight-bold">8</h4>
                                </div>
                                <div class="card card-body col-lg-">
                                    <div class="row justify-content-between">
                                        <h5>Jumlah Kematian</h5>
                                    </div>
                                    <h4>1000000000000</h4>
                                </div>
                                <div class="mx-4  card card-body col-lg-">
                                    <div class="row justify-content-between">
                                        <h5>Jumlah Penyakit</h5>
                                    </div>
                                    <h4>1000000000000</h4>
                                </div>
                            </div>
                            
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
                // ambil geojson kabupaten bengkayang
                const response = await fetch('kabupaten_bengkayang.geojson')
                const data = await response.json();
                let bengkayangCoordinate = [ 0.820973, 109.477699]
                let map = L.map('map').setView(bengkayangCoordinate, 8);

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);


                data.features[0].geometry.coordinates.forEach(function(coordinate) {
                    /*console.log(coordinate[0])*/
                    let latlong = coordinate[0].map(row=> row.reverse()).reverse();
                    L.polygon(latlong).addTo(map)
                })
            })
        </script>
    </div>
</body>
</html>