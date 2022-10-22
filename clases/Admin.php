<?php
require_once('DataBase.php');

class Admin extends Base{

	protected $con;
 
   //Método que chequea los datos del inicio de sesión en la BDD. 
   //de no ser correctos lo redirecciona a la pagina de inicio de sesión
	public function checkloginadmin()
   {
	if(strlen($_SESSION['login'])==0)
		{	
			$host = $_SERVER['HTTP_HOST'];
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');		
			$_SESSION["login"]="";
			$extra = "index-admin.php";
			return header("Location: http://$host$uri/$extra");
		}
	
   }

   //Método que hace una consulta en la BDD, donde en el resultado final esta le devuelve la cantidad de 
   //filas del resultado en un string, y luego mediante una función dentro del otro archivo (dashboardadmin)
   // son transcriptas a entidades HTML. 
   //-- valor devuelto es un int-- busca la cantidad de usuarios registrados (No manejan el sistema interno, son pacientes)
   public function CantidadUsuarios()
   {
		$this->con = $this->abrir_conexion();
		$result = mysqli_query($this->con, "SELECT * FROM admin ");
		$num_rows = mysqli_num_rows($result);
		return $num_rows;
   }

   //Método que hace una consulta en la BDD, donde en el resultado final esta le devuelve la cantidad de 
   //filas del resultado en un string, y luego mediante una función dentro del otro archivo (dashboardadmin)
   // son transcriptas a entidades HTML. 
   //-- valor devuelto es un int-- busca la cantidad de doctores registrados
   public function CantidadProf()
   {
		$this->con = $this->abrir_conexion();
		$result1 = mysqli_query($this->con, "SELECT * FROM doctors");
		$num_rows1 = mysqli_num_rows($result1);
		return $num_rows1;
   }

   
   //Método que hace una consulta en la BDD, donde en el resultado final esta le devuelve la cantidad de 
   //filas del resultado en un string, y luego mediante una función dentro del otro archivo (dashboardadmin)
   // son transcriptas a entidades HTML. 
   //-- valor devuelto es un int-- busca la cantidad de pacientes registradas
   public function CantidadPac()
   {
		$this->con = $this->abrir_conexion();
		$result2 = mysqli_query($this->con, "SELECT * FROM tblpatient");
		$num_rows2 = mysqli_num_rows($result2);
		return $num_rows2;
   }

   //Método que hace una consulta en la BDD, donde en el resultado final esta le devuelve la cantidad de 
   //filas del resultado en un string, y luego mediante una función dentro del otro archivo (dashboardadmin)
   // son transcriptas a entidades HTML. 
   //-- valor devuelto es un int-- busca la cantidad de concultas nuevas realizadas
   public function CantidadCons()
   {
		$this->con = $this->abrir_conexion();
		$resultado3 = mysqli_query($this->con, "SELECT * FROM tblcontactus where  IsRead is null");
		$num_rows3 = mysqli_num_rows($resultado3);
		return $num_rows3;
   }

   //Método que inserta un doctor en la BDD
   //está relacionado con el html, si se hace un submit (se envia el formulario),
   //se van tomando los datos 1 a 1 y se los pasa a la base de datos en el value
   //-- valor devuelto es un booleano-- False si no se pudo completar el insert, verdadero si fue satisfecha
   public function insertaDoc()
   {
	$this->con = $this->abrir_conexion();
   	if (isset($_POST['submit'])) {
		$docspecialization = $_POST['Doctorspecialization'];
		$docname = $_POST['docname'];
		$docaddress = $_POST['clinicaddress'];
		$docfees = $_POST['docfees'];
		$doccontactno = $_POST['doccontact'];
		$docemail = $_POST['docemail'];
		$password = md5($_POST['npass']);
		$sql = mysqli_query($this->con, "insert into doctors(specilization,doctorName,address,docFees,contactno,docEmail,password) values('$docspecialization','$docname','$docaddress','$docfees','$doccontactno','$docemail','$password')");
		return $sql;
		}
	}

	//Método que trae todos los datos de la tabla doctorspecilization
	//--valor devuelto es un booleano-- 
	public function consultadocesp()
	{
		$this->con = $this->abrir_conexion();
		$ret = mysqli_query($this->con, "select * from doctorspecilization");
		return $ret;
	}


	//obtiene "del" de los botones delete del html
	//si la sentencia if es verdadera entonces establece la conexion con la bdd
	//borra el registro y hace una consulta para saber si la acción se realizó con exito
	//--valor devuelto es un array asociativo que contiene variables de sesión disponibles-- 
	public function borrarDoc()
	{
		$this->con = $this->abrir_conexion();
		if(isset($_GET['del']))
		  {
		        mysqli_query($this->con,"delete from doctors where id = '".$_GET['id']."'");
                return $_SESSION['msg']="datos borrados";
		  }
	}

	//Método que trae todos los datos de la tabla doctors
	//--valor devuelto es un booleano--
	public function BuscaDOC()
	{
		$this->con = $this->abrir_conexion();
		$sql=mysqli_query($this->con,"select * from doctors");
		return $sql;
	}

	//obtiene "del" de los botones delete del html
	//si la sentencia if es verdadera entonces establece la conexion con la bdd
	//borra el registro y hace una consulta para saber si la acción se realizó con exito
	//--valor devuelto es un array asociativo que contiene variables de sesión disponibles-- 
	public function borrarEsp()
	{
		if(isset($_GET['del']))
		  {
				$this->con = $this->abrir_conexion();
		        mysqli_query($this->con,"delete from doctorSpecilization where id = '".$_GET['id']."'");
                return $_SESSION['msg']="datos borrados";
		  }
	}

	public function InsertaEsp()
	{
		$this->con = $this->abrir_conexion();	
		if (isset($_POST['submit'])) {
			$sql = mysqli_query($this->con, "insert into doctorSpecilization(specilization) values('" . $_POST['doctorspecilization'] . "')");
			return $sql;
		}
	}

	//Método que trae todos los datos de la tabla doctorSpecilization
	//--valor devuelto es un booleano--
	public function BuscarEsp()
	{
		$this->con = $this->abrir_conexion();	
		$sql = mysqli_query($this->con, "select * from doctorSpecilization");
		return $sql;
	}

	//Método que trae todos los datos de la tabla tblpatient
	//--valor devuelto es un booleano--

	public function BuscarPac()
	{
		$this->con = $this->abrir_conexion();
		$sql =  mysqli_query($this->con, "select * from tblpatient");
		return $sql;
	}

	//obtiene "del" de los botones delete del html
	//si la sentencia if es verdadera entonces establece la conexion con la bdd
	//borra el registro y hace una consulta para saber si la acción se realizó con exito
	//--valor devuelto es un array asociativo que contiene variables de sesión disponibles-- 
	public function BorrarUsuario()
	{
		$this->con = $this->abrir_conexion();	
		if(isset($_GET['del']))
		  {
		          mysqli_query($this->con,"delete from admin where id = '".$_GET['id']."'");
                  return $_SESSION['msg']="datos borrados";
		  }
	}

	//Método que trae todos los datos de la tabla admin
	//--valor devuelto es un booleano--

	public function BuscarAdmin()
	{
		$this->con = $this->abrir_conexion();	
		$sql = mysqli_query($this->con,"select * from admin");
		return $sql;
	}

	//Método que trae el nombre del doctor y los datos de la cita, mediante un join.
	//--valor devuelto es un booleano--

	public function BuscarCitas()
	{
		$this->con = $this->abrir_conexion();	
		$sql = mysqli_query($this->con, "select doctors.doctorName as docname,appointment.*  from appointment join doctors on doctors.id=appointment.doctorId");
		return $sql;
	}

	//obtiene "del" de los botones delete del html
	//si la sentencia if es verdadera entonces establece la conexion con la bdd
	//borra el registro y hace una consulta para saber si la acción se realizó con exito
	//--valor devuelto es un array asociativo que contiene variables de sesión disponibles-- 

	public function BorrarConsulta()
	{
		$this->con = $this->abrir_conexion();	
		if(isset($_GET['del']))
		  {
		        mysqli_query($this->con,"delete from doctors where id = '".$_GET['id']."'");
                return $_SESSION['msg']="datos borrados";
		  }
	}

	//Método que trae todos los datos de la tabla tblcontactus correspondiente a consultas no leidas
	//--valor devuelto es un booleano--

	public function BuscarNOleidas()
	{
		$this->con = $this->abrir_conexion();	
		$sql = mysqli_query($this->con,"select * from tblcontactus where IsRead is NULL");
		return $sql;
	}

	//obtiene "del" de los botones delete del html
	//si la sentencia if es verdadera entonces establece la conexion con la bdd
	//borra el registro y hace una consulta para saber si la acción se realizó con exito
	//--valor devuelto es un array asociativo que contiene variables de sesión disponibles-- 

	public function BorrarLeida()
	{
		$this->con = $this->abrir_conexion();	
		if(isset($_GET['del']))
		  {
		          mysqli_query($this->con,"delete from doctors where id = '".$_GET['id']."'");
                  $_SESSION['msg']="datos borrados";
		  }
	}
	//Método que trae todos los datos de la tabla tblcontactus correspondiente a consultas leidas
	//--valor devuelto es un booleano--
	public function Leida()
	{
		$this->con = $this->abrir_conexion();	
		$sql= mysqli_query($this->con,"select * from tblcontactus where IsRead is not null");
		return $sql;
	}

	//Método que trae todos los datos de la tabla doctorslog correspondiente a los inicio de sesión de los profesionales
	//--valor devuelto es un booleano--
	public function LoginDoc()
	{
		$this->con = $this->abrir_conexion();	
		$sql= mysqli_query($this->con,"select * from doctorslog ");
		return $sql;
	}

	//Método que trae todos los datos de la tabla userlog correspondiente a los inicio de sesión de los usuarios, futuros pacientes
	//--valor devuelto es un booleano--
	public function LoginUser()
	{
		$this->con = $this->abrir_conexion();	
		$sql= mysqli_query($this->con,"select * from userlog ");
		return $sql;
	}

	//Método que trae todos los datos de la tabla userlog correspondiente a los inicio de sesión de los usuarios, futuros pacientes
	//--valor devuelto es un booleano--
	public function BuscaPaciente($Datos)
	{
		$this->con = $this->abrir_conexion();;	
		$sdata= $Datos;
		$sql=  mysqli_query($this->con, "select * from tblpatient where PatientName like '%$sdata%'|| PatientContno like '%$sdata%'");
		return $sql;
	}
}

?>