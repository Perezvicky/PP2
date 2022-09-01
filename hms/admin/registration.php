<?php
include_once('include/config.php');
if (isset($_POST['submit'])) {
	$fname = $_POST['full_name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$query = mysql_query("insert into users(fullname,address,city,gender,email,password) values('$fname','$address','$city','$gender','$email','$password')");
	if ($query) {
		echo "<script>alert('Registrado exitosamente. Puedes iniciar sesión ahora');</script>";
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>User Registration</title>
	<link rel="icon" href="images/favicon.png">
</head>

<body class="login">
	<!-- start: REGISTRATION -->
	<div class="row">
		<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="logo margin-top-30">
				<img src="assets/images/logo.png" alt="Clip-Two" />
			</div>
			<!-- start: REGISTER BOX -->
			<div class="box-register">
				<form name="registration" id="registration" method="post">
					<fieldset>
						<legend>
							Registrarse
						</legend>
						<p>
							Introduzca sus datos personales a continuación:
						</p>
						<div class="form-group">
							<input type="text" class="form-control" name="full_name" placeholder="Apellido y Nombre" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="address" placeholder="Dirección" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="city" placeholder="Ciudad" required>
						</div>
						<div class="form-group">
							<label class="block">
								Género
							</label>
							<div class="clip-radio radio-primary">
								<input type="radio" id="rg-female" name="gender" value="female">
								<label for="rg-female">
									Femenino
								</label>
								<input type="radio" id="rg-male" name="gender" value="male">
								<label for="rg-male">
									Masculino
								</label>
							</div>
						</div>
						<p>
							Ingrese los detalles de su cuenta a continuación:
						</p>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()" placeholder="Email" required>
								<i class="fa fa-envelope"></i> </span>
							<span id="user-availability-status1" style="font-size:12px;"></span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" name="password_again" placeholder="Password Again" required>
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<div class="checkbox clip-check check-primary">
								<input type="checkbox" id="agree" value="agree">
								<label for="agree">
									Estoy de acuerdo
								</label>
							</div>
						</div>
						<div class="form-actions">
							<p>
								¿Ya tienes una cuenta?
								<a href="user-login.php">
									Ingresar
								</a>
							</p>
							<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
								Enviar <i class="fa fa-arrow-circle-right"></i>
							</button>
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

	<script>
		function userAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_availability.php",
				data: 'email=' + $("#email").val(),
				type: "POST",
				success: function(data) {
					$("#user-availability-status1").html(data);
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}
	</script>

</body>
<!-- end: BODY -->

</html>