<?php
require('clases/Contacto.php');
if (isset($_POST['submit'])) {
	Contact::insertar();
	echo "<script>alert('Your information succesfully submitted');</script>";
	echo "<script>window.location.href ='contact.php'</script>";
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Contacto</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
</head>

<body>
	<!--start-wrap-->

	<!--start-header-->
	<div class="header">
		<div class="wrap">
			<!--start-logo-->
			<div class="logo">
				<a href="index.html" style="font-size: 30px;">CRUZ DEL SUR</a>
			</div>
			<!--end-logo-->
			<!--start-top-nav-->
			<div class="top-nav">
				<ul>
					<li><a href="index.html">Inicio</a></li>

					<li class="active"><a href="contact.php">Contacto</a></li>
				</ul>
			</div>
			<div class="clear"> </div>
			<!--end-top-nav-->
		</div>
		<!--end-header-->
	</div>
	<div class="clear"> </div>
	<div class="wrap">
		<div class="contact">
			<div class="section group">
				<div class="col span_1_of_3">

					<div class="company_address">
						<h2>Centro Medico Cruz del Sur :</h2>
						<p>Av. Filippini 1905, S2124 Villa Gdor. Galvez</p>
						<p>Teléfono: 0341 492-3333</p>
						<p>Email: <span>admin@cruzdelsur.com</span></p>
						<p>Horario: Lunes a Viernes de 8:00 am a 5:00 pm</p>

					</div>
				</div>
				<div class="col span_2_of_3">
					<div class="contact-form">
						<h2>Contacta con nosotros</h2>
						<form name="contactus" method="post">
							<div>
								<span><label>Nombre</label></span>
								<span><input type="text" name="nombre_contact" required="true" value=""></span>
							</div>
							<div>
								<span><label>E-MAIL</label></span>
								<span><input type="email" name="mail_contacto" required="ture" value=""></span>
							</div>
							<div>
								<span><label>Telefono</label></span>
								<span><input type="text" name="tel_contact" required="true" value=""></span>
							</div>
							<div>
								<span><label>Descripción</label></span>
								<span><textarea name="descripcion" required="true"> </textarea></span>
							</div>
							<div>
								<span><input type="submit" name="submit" value="Enviar"></span>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="clear"> </div>
		</div>
		<div class="clear"> </div>
	</div>
	<div class="clear"> </div>
	<div class="clear"> </div>
	<div class="footer">
		<div class="wrap">
			<div class="txt-center">
				<a href="">Copyright © 2022 Cruz del Sur. Todos los derechos reservados.</a>
			</div>

			<div class="clear"> </div>
		</div>
	</div>
	<!--end-wrap-->
</body>

</html>
