<?php
session_start();
include "function.php";

if (isset($_POST['tambah-data'])) {
    tambah_data_peternakan($_POST, $_GET['tahun'], $_GET['jenis']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include "head.php"?>

    <title>Tambah Peternakan</title>

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
                <div class="card card-body w-100 mt-5">
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
                    <?php if (isset($_GET['tahun']) && isset($_GET['jenis'])):?>
                        <div class="table-responsive mt-5">
                            <form action="" method="POST">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Nama Kecamatan</th>
                                        <?php foreach (ambil_data_ternak() as $ternak):?>
                                            <th>
                                                <b><?= $ternak['nama']?></b>
                                                <input type="hidden" value="<?= $ternak['id']?>" name="id-ternak[]">
                                            </th>
                                        <?php endforeach;?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0;?>
                                    <?php foreach (ambil_data_kecamatan() as $kecamatan):?>
                                        <tr>
                                            <td>
                                                <?= $kecamatan['nama']?>
                                                <input type="hidden" name="id-kecamatan[]" value="<?= $kecamatan['id']?>">
                                            </td>
                                            <?php foreach (ambil_data_ternak() as $ternak):?>
                                                <td><input type="text" name="jumlah-ke-<?=$i?>[]" class="form-control" required></td>
                                            <?php endforeach;?>
                                        </tr>
                                        <?php $i++?>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                                <div class="btn-group">
                                    <button type="submit" name="tambah-data" class="btn btn-primary mr-2">Ok</button>
                                    <button type="reset" class="btn btn-light border border-1 ">Batal</button>
                                </div>
                            </form>
                        </div>
                    <?php endif;?>
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

    </script>
</div>
</body>
</html>