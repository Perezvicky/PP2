<?php
include("config.php");

class doctor extends DB {
    protected $username;
    protected $password;
    protected $uip;
    protected $status;
    protected $extra;
    protected $docspecialization;
    protected $docname;
    protected $docaddress;
    protected $docfees;
    protected $doccontactno;
    protected $docemail;
    protected $docid;
    protected $eid;
    protected $patname;
    protected $patcontact; 
    protected $patemail;
    protected $gender;
    protected $pataddress; 
    protected $patage;
    protected $medhis;
    protected $doctor;
	function __construct() {
		
	}

    public function comprobar($username, $password){ //checklogin de inicio de sesion
        $this->username = $username;
        $this->password = $password;
        $con = new DB();
        $conexion = $con->conectar();
        $sqli = "SELECT * FROM doctors WHERE docEmail = '$this->username' and password = '$this->password'";
        $ret = mysqli_query($conexion, $sqli);
        $num = mysqli_fetch_array($ret);
        return $num;
    }

    public function doctorlog($uip, $status){ //registra el inicio de sesion exitoso o fallido
        $this->uip = $uip;
        $this->status = $status;
        $con = new DB();
        $conexion = $con->conectar();
        $sqli = "INSERT INTO doctorslog(uid, username, userip, status) VALUES ('".$_SESSION['id']."','".$_SESSION['login']."', '$this->uip','$this->status')";
        $log = mysqli_query($conexion, $sqli);
        return $log;
    }

    public function redirect($extra){ //redirecciona segun la pagina
        $this->extra = $extra;
        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        return "location:http://$host$uri/$this->extra";
    }

    public function getAll(){ //recupera todos los datos del doctor
        $con = new DB();
		$conexion = $con->conectar();
        $sql=mysqli_query($conexion,"select * from doctors where docEmail='".$_SESSION['login']."'");
        return $sql;
    }

    public function getNombre(){ //recupera todos el nombre del doctor
        $con = new DB();
		$conexion = $con->conectar();
        $query = mysqli_query($conexion, "SELECT doctorName FROM doctors WHERE id ='".$_SESSION['id']."'");
			
        while ($row = mysqli_fetch_array($query)) {
            $nombre = $row['doctorName'];
        }
        return $nombre;	
    }

    public function getDoctorspecilization(){ //recupera todas las especializaciónes de los doctores
        $con = new DB();
		$conexion = $con->conectar();
        $ret=mysqli_query($conexion,"select * from doctorspecilization");
        return $ret;
    }

    public function updateDoctor($docspecialization, $docname, $docaddress, $docfees, $doccontactno, $docemail){ //actualiza los datos del doctor
        $this->docspecialization = $docspecialization;
        $this->docname = $docname;
        $this->docaddress = $docaddress;
        $this->docfees = $docfees;
        $this->doccontactno = $doccontactno;
        $this->docemail = $docemail;
        $con = new DB();
		$conexion = $con->conectar();
        $query = "UPDATE doctors SET specilization='$this->docspecialization',doctorName='$this->docname',address='$this->docaddress',docFees='$this->docfees',contactno='$this->doccontactno' where id='".$_SESSION['id']."'";
        $sql = mysqli_query($conexion, $query);
        if($sql)
                {
                    return "<script>alert('Doctor Details updated Successfully');</script>";
                    $_SESSION['errmsg']="Datos actualizados";
                    $_SESSION['errmsg']="";
                }
    
    }

    public function addPatient($docid, $patname, $patcontact, $patemail, $gender, $pataddress, $patage, $medhis){ //añade paciente
        $this->docid = $docid;
        $this->patname = $patname;
        $this->patcontact = $patcontact;
        $this->patemail = $patemail;
        $this->gender = $gender;
        $this->pataddress = $pataddress;
        $this->patage = $patage;
        $this->medhis = $medhis;
        $con = new DB();
		$conexion = $con->conectar();
        $sql=mysqli_query($conexion,"INSERT INTO tblpatient(Docid,PatientName,PatientContno,PatientEmail,PatientGender,PatientAdd,PatientAge,PatientMedhis) VALUES('$this->docid','$this->patname','$this->patcontact','$this->patemail','$this->gender','$this->pataddress','$this->patage','$this->medhis')");
        return $sql;
    }

    public function getPatient(){ //recupera todos los datos de los pacientes segun el id del doctor
        $con = new DB();
        $conexion = $con->conectar();
        $sql=mysqli_query($conexion,"SELECT * from tblpatient where Docid='".$_SESSION['id']."'");
        return $sql;
    }

    public function editPatient($eid, $patname, $patcontact, $patemail, $gender, $pataddress, $patage, $medhis, $doctor){ //edita los pacientes
        $this->eid = $eid;
        $this->patname = $patname;
        $this->patcontact = $patcontact;
        $this->patemail = $patemail;
        $this->gender = $gender;
        $this->pataddress = $pataddress;
        $this->patage = $patage;
        $this->medhis = $medhis;
        $this->doctor = $doctor;
        $con = new DB();
        $conexion = $con->conectar();
        $sql=mysqli_query($conexion,"UPDATE tblpatient SET PatientName='$this->patname',PatientContno='$this->patcontact',PatientEmail='$this->patemail',PatientGender='$this->gender',PatientAdd='$this->pataddress',PatientAge='$this->patage',PatientMedhis='$this->medhis' where ID='$this->eid'");
        return $sql;
    }

    public function getPatientAlone($eid){ 
        $this->eid = $eid;
        $con = new DB();
        $conexion = $con->conectar();
        $ret=mysqli_query($conexion,"SELECT * FROM tblpatient WHERE ID='$this->eid'");
        return $ret;
    }

}
?>