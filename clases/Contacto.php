<?php
require('DataBase.php');
class Contact extends Base{
    //propiedades $nombre_contact,$mail_contacto,$tel_contact,$descripcion
	public $nombre_contact;
	public $mail_contacto;
    public $tel_contact;
    public $descripcion;
	protected static $nombre_tabla = "contact";
	//protected static $campos_tabla = array("nombre_contact","mail_contacto","tel_contact","descripcion");
   
    //Método que inserta un contacto en la base de datos
    public static function insertar()
    {
		if (isset($_POST['submit'])) {
        	global $bd;
        	$name = $_POST['nombre_contact'];
	    	$email = $_POST['mail_contacto'];
	    	$mobileno =  $_POST['tel_contact'];
	    	$dscrption = $_POST['descripcion'];
	    	$query = mysqli_query($bd->abrir_conexion(), "insert into tblcontactus(fullname,email,contactno,message)value('$name','$email','$mobileno','$dscrption')");
			return $query;
		}
    }

}

?>