<?php
class Base{
    //propiedades: Características de los objetos
    const DB_SERVER = "localhost";
    const DB_NAME = "hms";
    const DB_USERNAME = "root";
    const DB_PASSWORD = "";

    private $conexion;
    private $ultima_consulta;
    private $login;
   
    //Métodos: Definen el comportamiento de los objetos.
    public function __construct()
    {
        $this -> abrir_conexion();
    }
    public function __destruct()
    {
        $this -> cerrar_conexion();
    }
    public function abrir_conexion()    
    {
        $con = mysqli_connect(Base::DB_SERVER, Base::DB_USERNAME,Base::DB_PASSWORD, Base::DB_NAME);
        if (!$con)
        {
            die("Failed to connect to MySQL: " . mysqli_connect_errno());
        }
        return $con;
    }
    public function cerrar_conexion()
    {
        if (isset ($this->conexion))
        {
            unset($this->conexion);
            return $this->conexion;
        }
        
    }
    

}
$bd = new Base();


?>