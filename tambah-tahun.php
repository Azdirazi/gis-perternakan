<?php
session_start();
include "function.php";

if (isset($_POST['tambah-data'])) {
    tambah_data_tahun($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include "head.php"?>

    <title>Tambah Tahun</title>

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
                            <label for="tahun" class="form-label">Tahun <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="tahun" placeholder="input tahun" id="tahun" required>
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