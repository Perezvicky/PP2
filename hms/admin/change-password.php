<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
date_default_timezone_set('Asia/Kolkata'); // change according timezone
$currentTime = date('d-m-Y h:i:s A', time());
if (isset($_POST['submit'])) {
	$sql = mysqli_query($con, "SELECT password FROM  admin where password='" . $_POST['cpass'] . "' && username='" . $_SESSION['login'] . "'");
	$num = mysqli_fetch_array($sql);
	if ($num > 0) {
		$con = mysqli_query($con, "update admin set password='" . $_POST['npass'] . "', updationDate='$currentTime' where username='" . $_SESSION['login'] . "'");
		$_SESSION['msg1'] = "Password Changed Successfully !!";
	} else {
		$_SESSION['msg1'] = "Old Password not match !!";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin | change Password</title>
	<meta charset="utf-8" />

	<link rel="icon" href="images/favicon.png">

	<script type="text/javascript">
		function valid() {
			if (document.chngpwd.cpass.value == "") {
				alert("Contraseña actual Filed is Empty !!");
				document.chngpwd.cpass.focus();
				return false;
			} else if (document.chngpwd.npass.value == "") {
				alert("Nueva contraseña Filed is Empty !!");
				document.chngpwd.npass.focus();
				return false;
			} else if (document.chngpwd.cfpass.value == "") {
				alert("Confirmar contraseña Filed is Empty !!");
				document.chngpwd.cfpass.focus();
				return false;
			} else if (document.chngpwd.npass.value != document.chngpwd.cfpass.value) {
				alert("Password and Confirmar contraseña Field do not match  !!");
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

			</header>
			<!-- end: TOP NAVBAR -->
			<div class="main-content">
				<div class="wrap-content container" id="container">
					<!-- start: PAGE TITLE -->
					<section id="page-title">
						<div class="row">
							<div class="col-sm-8">
								<h1 class="mainTitle">Admin | Cambia la contraseña</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Admin</span>
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
														<input type="password" name="cpass" class="form-control" placeholder="Ingresar actual contraseña">
													</div>
													<div class="form-group">
														<label for="exampleInputPassword1">
															Nueva contraseña
														</label>
														<input type="password" name="npass" class="form-control" placeholder="Ingresar nueva contraseña">
													</div>

													<div class="form-group">
														<label for="exampleInputPassword1">
															Confirmar contraseña
														</label>
														<input type="password" name="cfpass" class="form-control" placeholder="Ingresar nuevamente la contraseña">
													</div>



													<button type="submit" name="submit" class="btn btn-o btn-primary">
														Enviar
													</button>
												</form>
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
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>