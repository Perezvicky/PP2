<?php
session_start();
include ('include/doctor-functions.php');

$doctor = new doctor();
$doctor->updateDoctorlog();
session_unset();
?>
<script language="javascript">
document.location="../../index.html";
</script>
