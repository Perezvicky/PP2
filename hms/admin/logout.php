<?php
session_start();
require('../../clases/DataBase.php');
$bd->cerrar_conexion();
?>
<script language="javascript">
document.location="../../index.html";
</script>
