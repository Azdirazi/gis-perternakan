<?php
session_start();
include "function.php";

if (isset($_POST['tambah-data'])) {
    update_data_admin($_POST);
}

$data = ambil_admin_by_id($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include "head.php"?>

    <title>Tambah Admin</title>

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
                        <input type="hidden" value="<?= $data['id']?>" name="id">
                        <div class="form-group">
                            <label for="username" class="form-label">Username <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="username" placeholder="input username" id="username" required value="<?= $data['username']?>">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password <sup class="text-danger">*</sup></label>
                            <input type="password" class="form-control" name="password" placeholder="input password" id="password">
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