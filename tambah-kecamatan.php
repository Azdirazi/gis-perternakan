<?php
session_start();
include "function.php";

if (isset($_POST['tambah-data'])) {
    tambah_data_kecamatan($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include "head.php"?>

    <title>Tambah Kecamatan</title>

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
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama Kecamatan <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="nama" placeholder="input nama kecamatan" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="form-label">Deskripsi <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="deskripsi" placeholder="input deskripsi" id="deskripsi" required>
                        </div>
                        <div class="form-group">
                            <label for="polygon" class="form-label">Polygon Kecamatan <sup class="text-danger">*</sup></label>
                            <textarea name="polygon" id="polygon" cols="30" rows="10" class="form-control" required></textarea>
                        </div>
                        <div class="btn-group">
                            <button type="submit" name="tambah-data" class="btn btn-primary mr-2">Simpan</button>
                            <button type="reset" class="btn btn-light border border-1 ">Batal</button>
                        </div>
                    </form>
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