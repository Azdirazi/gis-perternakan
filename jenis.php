<?php
     session_start();
     include "function.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php"?>

    <title>User</title>

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

            <?php include "navbar.php";?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Data Jenis</h1>
                </div>
                <?php if(get_flash_name('add_success') != ""):?>
                    <div class="alert alert-success" role="alert">
                         <?= get_flash_message('add_success')?>
                    </div>	
                <?php endif;?>

                 <div class="card card-body my-3">
                        <a href="tambah-user.php" class="btn btn-primary col-lg-4 col-12 mb-4">Tambah</a>
                        <h5 class="card-title">Data Jenis</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table-user">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (ambil_data_user() as $users):?>
                                        <tr data-id-users="<?= $users['id']?>">
                                            <td><?= $users['username']?></td>
                                            <td><?php 
                                                    if($users['role']==1){
                                                        echo "Admin";
                                                    }if($users['role']==2){
                                                        echo "Dosen";
                                                    }if($users['role']==3){
                                                        echo "Mahasiswa";
                                                    }
                                                ?>
                                            </td>
                                            <td><a href="ubah-user.php?id=<?=$users['id']?>" class="btn btn-primary">Ubah</a><button data-id="<?=$users['id']?>" class="btn-remove ml-3 btn btn-danger">Hapus</button></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
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

    <!-- Logout Modal-->
    <?php include "logout_modal.php"?>

    <?php include "js.php"?>
    <script>
        $(document).ready(function () {
            let tabeluser = $("#table-user").DataTable();

            $(".btn-remove").click(function () {
                let idUser = $(this).attr('data-id')
                Swal.fire({
                    title: 'question',
                    text: 'Yakin ingin menghapus ?',
                    showCancelButton: true,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'hapus-user.php?id=' + idUser
                    }
                })
            })
        })
    </script>
</div>
</body>

</html>