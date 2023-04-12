<?php 
	session_start();
	include "function.php";

	if(isset($_POST) && count($_POST) > 0) {
		create_user($_POST);
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
		<?php if(get_flash_name('password_error') != ""):?>
			<div class="alert alert-danger" role="alert">
				<?= get_flash_message('password_error')?>
			</div>	
		<?php endif;?>
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
                    <div class="mb-3" >
						<label class="form-label" for="confirm_password">Confirm Password</label>
						<input class="form-control" type="password" name="confirm_password">
					</div>
                    <a href="login.php" class="mb-2"> Sudah Punya Akun ? Login Di Sini</a>
					<button class="btn btn-primary" type="submit">Register</button>
					</div>
				</div>
			</form>
		</div>
	</div>
    <?php include "js.php"?>
</body>
</html>