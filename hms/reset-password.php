<?php
session_start();
//error_reporting(0);
include("include/config.php");
// Code for updating Password
if(isset($_POST['change']))
{
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$newpassword=md5($_POST['password']);
$query=mysqli_query($con,"Actualizar conjunto de usuarios password='$newpassword' where fullName='$name' and email='$email'");
if ($query) {
echo "<script>alert('Contraseña actualizada con éxito.');</script>";
echo "<script>window.location.href ='user-login.php'</script>";
}

}


?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Restablecimiento de contraseña</title>
		<link rel="icon" href="images/favicon.png">
				<script type="text/javascript">
function valid()
{
 if(document.passwordreset.password.value!= document.passwordreset.password_again.value)
{
alert("Password and Confirmar contraseña Field do not match  !!");
document.passwordreset.password_again.focus();
return false;
}
return true;
}
</script>
	</head>
	<body class="login">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
				<a href="../index.html"><h2> Contraseña de restablecimiento del paciente</h2></a>
				</div>

				<div class="box-login">
					<form class="form-login" name="passwordreset" method="post" onSubmit="return valid();">
						<fieldset>
							<legend>
							Contraseña de restablecimiento del paciente
							</legend>
							<p>
							Por favor establezca su nueva contraseña.<br />
								<span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
							</p>

<div class="form-group">
<span class="input-icon">
<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
<i class="fa fa-lock"></i> </span>
</div>
	

<div class="form-group">
<span class="input-icon">
<input type="password" class="form-control"  id="password_again" name="password_again" placeholder="Contraseña" required>
<i class="fa fa-lock"></i> </span>
</div>
							

							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right" name="change">
									Cambiar <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							<div class="new-account">
							¿Ya tienes una cuenta? 
								<a href="user-login.php">
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