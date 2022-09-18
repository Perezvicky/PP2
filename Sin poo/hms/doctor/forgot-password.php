<?php
session_start();
error_reporting(0);
include("include/config.php");
//Checking Details for reset password
if (isset($_POST['submit'])) {
	$contactno = $_POST['contactno'];
	$email = $_POST['email'];
	$query = mysqli_query($con, "select id from  doctors where contactno='$contactno' and docEmail='$email'");
	$row = mysqli_num_rows($query);
	if ($row > 0) {

		$_SESSION['cnumber'] = $contactno;
		$_SESSION['email'] = $email;
		header('location:reset-password.php');
	} else {
		echo "<script>alert('Detalles no válidos. Intente con detalles válidos');</script>";
		echo "<script>window.location.href ='forgot-password.php'</script>";
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Recuperación de contraseña</title>
</head>

<body class="login">
	<div class="row">
		<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="logo margin-top-30">
				<a href="../../index.html">
					<h2> Recuperación de la contraseña del médico</h2>
				</a>
			</div>

			<div class="box-login">
				<form class="form-login" method="post">
					<fieldset>
						<legend>
							Recuperación de la contraseña del médico </legend>
						<p>
							Por favor escriba su número de contacto y correo electrónico para recuperar su contraseña.<br />

						</p>

						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="text" class="form-control" name="contactno" placeholder="Número de contacto registrado">
								<i class="fa fa-lock"></i>
							</span>
						</div>

						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="email" placeholder="Email registrado">
								<i class="fa fa-user"></i> </span>
						</div>

						<div class="form-actions">

							<button type="submit" class="btn btn-primary pull-right" name="submit">
								Cambiar <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
						<div class="new-account">
							¿Ya tienes una cuenta?
							<a href="index.php">
								Ingresar
							</a>
						</div>
					</fieldset>
				</form>

				<div class="copyright">
					&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> Cruz del sur</span>. <span>Todos los derechos reservados</span>
				</div>

			</div>

		</div>
	</div>

	<script>
		jQuery(document).ready(function() {
			Main.init();
			Login.init();
		});
	</script>

</body>
<!-- end: BODY -->

</html>