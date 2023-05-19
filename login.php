<?php 
	session_start();
	include "function.php";

	if(isset($_POST) && count($_POST) > 0) {
		login($_POST);
	}

	if(isset($_SESSION['login'])){
		redirect('index.php?halaman=beranda');
	}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "head.php"?>

	<title>Login</title>

    <?php include "css.php"?>
</head>
<body class="bg-success bg-opacity-75 d-flex justify-content-center align-items-center vh-100">
	<div class="mx-5 py-5 card rounded login w-25 ">
		<div class="card-body">
               <?php if(get_flash_name('register_success') != ""):?>
                    <div class="alert alert-danger" role="alert">
                         <?= get_flash_message('register_success')?>
                    </div>	
               <?php endif;?>
               <h4 class="text-center text-dark">Sistem Informasi Geografis dan Monitoring Ternak Kabupaten Bengkayang</h4>
			<form class="" method="POST" action="">
				<div class="d-flex flex-row justify-content-center">
					<div class="d-flex flex-column">
					<div class="mb-3" >
						<label class="form-label" for="username">Username</label>
						<input type="text" id="username" name="username" class="form-control">

					</div>
					<div class="mb-3" >
						<label class="form-label" for="password">Password</label>
						<input class="form-control" type="password" id="password" name="password">
					</div>
					<a href="registrasi.php" class="mb-2"> Belum Punya Akun ? Register Di Sini</a>
					<button class="btn btn-primary" type="submit">Login</button>
					</div>
				</div>
			</form>
		</div>
	</div>
    <?php include "js.php"?>
</body>
</html>