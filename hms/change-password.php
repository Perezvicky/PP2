<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
date_default_timezone_set('Argentina/Cordoba'); // cambiar según la zona horaria
$currentTime = date('d-m-Y h:i:s A', time());
if (isset($_POST['submit'])) {
	$sql = mysqli_query($con, "SELECT password FROM  users where password='" . md5($_POST['cpass']) . "' && id='" . $_SESSION['id'] . "'");
	$num = mysqli_fetch_array($sql);
	if ($num > 0) {
		$con = mysqli_query($con, "Actualizar conjunto de usuarios password='" . md5($_POST['npass']) . "', updationDate='$currentTime' where id='" . $_SESSION['id'] . "'");
		$_SESSION['msg1'] = "Contraseña cambiada con éxito !!";
	} else {
		$_SESSION['msg1'] = "¡La contraseña anterior no coincide!";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Usuario | cambiar la contraseña</title>

	<script type="text/javascript">
		function valid() {
			if (document.chngpwd.cpass.value == "") {
				alert("Contraseña actual. El campo está vacío!");
				document.chngpwd.cpass.focus();
				return false;
			} else if (document.chngpwd.npass.value == "") {
				alert("Nueva contraseña. El campo está vacío!");
				document.chngpwd.npass.focus();
				return false;
			} else if (document.chngpwd.cfpass.value == "") {
				alert("Confirmar contraseña.El campo está vacío!");
				document.chngpwd.cfpass.focus();
				return false;
			} else if (document.chngpwd.npass.value != document.chngpwd.cfpass.value) {
				alert("El campo Contraseña y Confirmar contraseña no coinciden!");
				document.chngpwd.cfpass.focus();
				return false;
			}
			return true;
		}
	</script>

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
								<h1 class="mainTitle">User | Cambia la contraseña</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>User</span>
								</li>
								<li class="active">
									<span>Cambia la contraseña</span>
								</li>
							</ol>
						</div>
					</section>
					<!-- end: PAGE TITLE -->
					<!-- start: BASIC EXAMPLE -->
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-12">

								<div class="row margin-top-30">
									<div class="col-lg-8 col-md-12">
										<div class="panel panel-white">
											<div class="panel-heading">
												<h5 class="panel-title">Cambia la contraseña</h5>
											</div>
											<div class="panel-body">
												<p style="color:red;"><?php echo htmlentities($_SESSION['msg1']); ?>
													<?php echo htmlentities($_SESSION['msg1'] = ""); ?></p>
												<form role="form" name="chngpwd" method="post" onSubmit="return valid();">
													<div class="form-group">
														<label for="exampleInputEmail1">
															Contraseña actual
														</label>
														<input type="password" name="cpass" class="form-control" placeholder="Contraseña actual">
													</div>
													<div class="form-group">
														<label for="exampleInputPassword1">
															Nueva contraseña
														</label>
														<input type="password" name="npass" class="form-control" placeholder="Nueva contraseña">
													</div>

													<div class="form-group">
														<label for="exampleInputPassword1">
															Confirmar contraseña
														</label>
														<input type="password" name="cfpass" class="form-control" placeholder="Confirmar contraseña">
													</div>



													<button type="submit" name="submit" class="btn btn-o btn-primary">
														Submit
													</button>
												</form>
											</div>
										</div>
									</div>

								</div>
							</div>

						</div>
					</div>

					<!-- end: BASIC EXAMPLE -->






					<!-- end: SELECT BOXES -->

				</div>
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