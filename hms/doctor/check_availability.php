<?php 
require_once("include/doctor-functions.php");
function checkMail(){
$con = new DB();
$conexion = $con->conectar();
if(!empty($_POST["email"])) {
	$email= $_POST["email"];
$result =mysqli_query($conexion,"SELECT PatientEmail FROM tblpatient WHERE PatientEmail='$email'");
$count=mysqli_num_rows($result);
if($count>0){
return "<span style='color:red'> El Email ya existe.</span>";
return "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	return "<span style='color:green'> Correo electrónico disponible para registro.</span>";
	return "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
echo checkMail();
?>
