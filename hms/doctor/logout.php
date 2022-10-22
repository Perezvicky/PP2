<?php
session_start();
include ('include/doctor-functions.php');
//mysqli_query($conexion,"UPDATE doctorslog  SET logout = '$ldate' WHERE uid = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1");
$doctor = new doctor();
$doctor->updateDoctorlog();
session_unset();
?>
<script language="javascript">
document.location="../../index.html";
</script>
