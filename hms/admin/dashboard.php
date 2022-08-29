<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin | Panel</title>
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
								<h1 class="mainTitle">Admin | Panel</h1>
							</div>
							<ol class="breadcrumb">
								<li>
									<span>Admin</span>
								</li>
								<li class="active">
									<span>Panel</span>
								</li>
							</ol>
						</div>
					</section>
					<!-- end: PAGE TITLE -->
					<!-- start: BASIC EXAMPLE -->
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-sm-6">
								<div class="panel panel-white no-radius text-center">
									<div class="panel-body">
										<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i> </span>
										<h2 class="StepTitle">Administrar usuarios</h2>

										<p class="links cl-effect-1">
											<a href="manage-users.php">
												<?php $result = mysqli_query($con, "SELECT * FROM users ");
												$num_rows = mysqli_num_rows($result); {
												?>
													Total Usuarios :<?php echo htmlentities($num_rows);
																} ?>
											</a>
										</p>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="panel panel-white no-radius text-center">
									<div class="panel-body">
										<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
										<h2 class="StepTitle">Administrar médicos</h2>

										<p class="cl-effect-1">
											<a href="manage-doctors.php">
												<?php $result1 = mysqli_query($con, "SELECT * FROM doctors ");
												$num_rows1 = mysqli_num_rows($result1); {
												?>
													Total Doctores :<?php echo htmlentities($num_rows1);
																} ?>
											</a>

										</p>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="panel panel-white no-radius text-center">
									<div class="panel-body">
										<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
										<h2 class="StepTitle"> Equipo</h2>

										<p class="links cl-effect-1">
											<a href="book-appointment.php">
												<a href="appointment-history.php">
													<?php $sql = mysqli_query($con, "SELECT * FROM appointment");
													$num_rows2 = mysqli_num_rows($sql); {
													?>
														Total Equipo :<?php echo htmlentities($num_rows2);
																	} ?>
												</a>
											</a>
										</p>
									</div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="panel panel-white no-radius text-center">
									<div class="panel-body">
										<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i> </span>
										<h2 class="StepTitle">Administrar pacientes</h2>

										<p class="links cl-effect-1">
											<a href="manage-patient.php">
												<?php $result = mysqli_query($con, "SELECT * FROM tblpatient ");
												$num_rows = mysqli_num_rows($result); {
												?>
													Total Pacientes :<?php echo htmlentities($num_rows);
																} ?>
											</a>
										</p>
									</div>
								</div>
							</div>





							<div class="col-sm-6">
								<div class="panel panel-white no-radius text-center">
									<div class="panel-body">
										<span class="fa-stack fa-2x"> <i class="ti-files fa-1x text-primary"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
										<h2 class="StepTitle"> Nuevas Consultas</h2>

										<p class="links cl-effect-1">
											<a href="book-appointment.php">
												<a href="unread-queries.php">
													<?php
													$sql = mysqli_query($con, "SELECT * FROM tblcontactus where  IsRead is null");
													$num_rows22 = mysqli_num_rows($sql);
													?>
													Total Nuevas Consultas :<?php echo htmlentities($num_rows22);   ?>
												</a>
											</a>
										</p>
									</div>
								</div>
							</div>



						</div>
					</div>






					<!-- end: SELECT BOXES -->

				</div>
			</div>
		</div>
		<!-- start: FOOTER -->
		<?php include('include/footer.php'); ?>
		<!-- end: FOOTER -->

		<!-- start: SETTINGS -->
		<?php include('include/setting.php'); ?>
		<>
			<!-- end: SETTINGS -->
	</div>
	<script>
		jQuery(document).ready(function() {
			Main.init();
			FormElements.init();
		});
	</script>

</body>

</html>