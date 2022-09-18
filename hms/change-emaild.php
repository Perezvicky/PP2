<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$sql = mysqli_query($con, "Actualizar conjunto de usuarios email='$email' where id='" . $_SESSION['id'] . "'");
	if ($sql) {
		$msg = "Su correo electrónico actualizado con éxito";
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
												<form name="registration" id="updatemail" method="post">
													<div class="form-group">
														<label for="fess">
															Email
														</label>
														<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()" placeholder="Email" required>

														<span id="user-availability-status1" style="font-size:12px;"></span>
													</div>







													<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
														Actualizar
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

					<!-- end: BASIC EXAMPLE -->






					<!-- end: SELECT BOXES -->

				</div>
			</div>
		</div>
		<!-- start: FOOTER -->
	</div>

	<script>
		jQuery(document).ready(function() {
			Main.init();
			FormElements.init();
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

</html>