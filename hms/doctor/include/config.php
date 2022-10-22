<?php
    require ("bdconfig.php");
class DB {
    protected $con;
    public static function conectar(){
        // Check connection
        
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME)
        or die ("Error al conectar con la base de datos");
        
        if ($con) {
            return $con;
        }
        
    }
}
?>