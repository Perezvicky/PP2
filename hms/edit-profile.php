<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_POST['submit'])) {
	$fname = $_POST['fname'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$gender = $_POST['gender'];

	$sql = mysqli_query($con, "Actualizar conjunto de usuarios fullName='$fname',address='$address',city='$city',gender='$gender' where id='" . $_SESSION['id'] . "'");
	if ($sql) {
		$msg = "Tu perfil actualizado con éxito";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Usuario | Editar perfil</title>
	<link rel="icon" href="images/favicon.png">

</head>

<body>
	<div id="app">
		<?php include('include/sidebar.php'); ?>
		<div class="app-content">

			<?php include('include/header.php'); ?>

			<!-- end: TOP NAVBAR -->
			<div class="main-content">
				<div class="wrap-content container" id="container">
					<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle">Usuario | Editar perfil</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Usuario </span>
								</li>
								<li class="active">
									<span>Editar perfil</span>
								</li>
							</ol>
						</div>
					</section>
					<!-- end: PAGE TITLE -->
					<!-- start: BASIC EXAMPLE -->
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-12">
								<h5 style="color: green; font-size:18px; ">
									<?php if ($msg) {
										echo htmlentities($msg);
									} ?> </h5>
								<div class="row margin-top-30">
									<div class="col-lg-8 col-md-12">
										<div class="panel panel-white">
											<div class="panel-heading">
												<h5 class="panel-title">Editar perfil</h5>
											</div>
											<div class="panel-body">
												<?php
												$sql = mysqli_query($con, "select * from users where id='" . $_SESSION['id'] . "'");
												while ($data = mysqli_fetch_array($sql)) {
												?>
													<h4>Perfil de <?php echo htmlentities($data['fullName']); ?></h4>
													<p><b>Registro de perfil Fecha: </b><?php echo htmlentities($data['regDate']); ?></p>
													<?php if ($data['updationDate']) { ?>
														<p><b>Perfil Última Fecha de actualización: </b><?php echo htmlentities($data['updationDate']); ?></p>
													<?php } ?>
													<hr />
													<form role="form" name="edit" method="post">


														<div class="form-group">
															<label for="fname">
																Nombre de usuario
															</label>
															<input type="text" name="fname" class="form-control" value="<?php echo htmlentities($data['fullName']); ?>">
														</div>


														<div class="form-group">
															<label for="address">
																Dirección
															</label>
															<textarea name="address" class="form-control"><?php echo htmlentities($data['address']); ?></textarea>
														</div>
														<div class="form-group">
															<label for="city">
																Ciudad
															</label>
															<input type="text" name="city" class="form-control" required="required" value="<?php echo htmlentities($data['city']); ?>">
														</div>

														<div class="form-group">
															<label for="gender">
																Genero
															</label>

															<select name="gender" class="form-control" required="required">
																<option value="<?php echo htmlentities($data['gender']); ?>"><?php echo htmlentities($data['gender']); ?></option>
																<option value="male">Masculino</option>
																<option value="female">Femenino</option>
																<option value="other">Otro</option>
															</select>

														</div>

														<div class="form-group">
															<label for="fess">
																Email
															</label>
															<input type="email" name="uemail" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['email']); ?>">
															<a href="change-emaild.php">Actualice su identificación de correo electrónico</a>
														</div>







														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Actualizar
														</button>
													</form>
												<?php } ?>
											</div>
										</div>
									</div>

								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="panel panel-white">


								</div>
							</div>
						</div>
					</div>

					<!-- end: BASIC EXAMPLE -->






					<!-- end: SELECT BOXES -->

				</div>
			</div>
		</div>
	<script>
		jQuery(document).ready(function() {
			Main.init();
			FormElements.init();
		});
	</script>
</body>

</html>