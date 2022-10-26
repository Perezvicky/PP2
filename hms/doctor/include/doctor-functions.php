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
    protected $id;
    protected $bp;
    protected $weight;
    protected $temp;
    protected $pres;
	function __construct() {
		
	}

    public function comprobar($username, $password){ //checklogin de inicio de sesion
        $this->username = $username;
        $this->password = $password;
        $uip=$_SERVER['REMOTE_ADDR'];
	    $status = 0;
        $con = new DB();
        $conexion = $con->conectar();
        $sqli = "SELECT * FROM doctors WHERE docEmail = '$this->username' and password = '".md5($this->password)."'";
        $ret = mysqli_query($conexion, $sqli);
        $num = mysqli_fetch_array($ret);
        if($num>0) {
            $_SESSION['login'] = $this->username;
            $_SESSION['id'] = $num['id'];
            $status=1;
            $extra="dashboard.php";
            $log = $this->doctorlog($uip, $status);
            header($this->redirect($extra));
                }
            else 	{
                
                $_SESSION['login']=$_POST['username'];
                $status=0;
                $extra="index.php";
                $log = $this->doctorlog($uip, $status);
                $_SESSION['errmsg']="Usuario o contraseña invalido"; //arreglar, no muestra el mensaje
                header($this->redirect($extra));
                    }
    }

    public function getPassword($password) { //obtiene la contraseña de la cuenta
        $this->password = $password;
        $con = new DB();
        $conexion = $con->conectar();
        $query=mysqli_query($conexion,"SELECT password FROM  doctors WHERE password='".md5($this->password)."' && id='".$_SESSION['id']."'");
        return $query;
    }

    public function updatePassword($newpassword, $currentTime) { // Modifica la contraseña de la cuenta
        $this->newpassword = $newpassword;
        $this->currentTime = $currentTime;
        $con = new DB();
        $conexion = $con->conectar();
        $num = mysqli_query($conexion,"UPDATE doctors SET password='".md5($this->newpassword)."', updationDate='$this->currentTime' WHERE id='".$_SESSION['id']."'");
        if($num>0)
{
	$extra = "change-password.php";
    header($this->redirect($extra));
    $_SESSION['msg1']="Contraseña modificada.";
    }
        else
    {
	$extra = "change-password.php";
    header($this->redirect($extra));

    $_SESSION['msg1']="La contraseña antigua no es valida.";
    }
        
    }

    public function forgotPasword($contactno, $email){ //seleccion la cuenta a modificar la contraseña en caso de ser olvidada la misma, esto se hace mediante el ingreso del email y numero telefonico asociado
        $this->contactno = $contactno;
        $this->email = $email;
        $con = new DB();
        $conexion = $con->conectar();
        $query=mysqli_query($conexion,"SELECT id FROM  doctors WHERE contactno='$this->contactno' AND docEmail='$this->email'");
        $row=mysqli_num_rows($query);
        if($row>0){
        $_SESSION['cnumber']=$contactno;
        $_SESSION['email']=$email;
        $extra = "reset-password.php";
        header($this->redirect($extra));
        }
}

    public function resetPassword($newpassword) { //reemplaza la contraseña antigua (olvidada) por la nueva
        $this->newpassword = $newpassword;
        $cno = $_SESSION['cnumber'];
        $email = $_SESSION['email'];
        $con = new DB();
        $conexion = $con->conectar();
        $query=mysqli_query($conexion,"update doctors set password='".md5($this->newpassword)."' where contactno='$cno' and docEmail='$email'");
        if ($query) {
            echo "<script>alert('Password successfully updated.');</script>";
            echo "<script>window.location.href ='index.php'</script>";
            }
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

    public function updateDoctorlog(){ //registra el inicio de sesion exitoso o fallido
        $_SESSION['dlogin']=="";
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $currentTime = date( 'd-m-Y h:i:s A', time());
        $con = new DB();
        $conexion = $con->conectar();
        $sql = mysqli_query($conexion,"UPDATE doctorslog  SET logout = '$currentTime' WHERE uid = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1");
        return $sql;
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

    public function getAllPatient(){ //recupera todos los pacientes y sus datos segun el id del doctor
        $con = new DB();
        $conexion = $con->conectar();
        $sql=mysqli_query($conexion,"SELECT * from tblpatient where Docid='".$_SESSION['id']."'");
        return $sql;
    }

    public function getPatient($id){  //recupera los datos del paciente segun su id
        $this->id = $id;
        $con = new DB();
        $conexion = $con->conectar();
        $ret=mysqli_query($conexion,"SELECT * FROM tblpatient WHERE ID='$this->id'");
        return $ret;
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

    public function getPatientbyName($sdata){  //recupera los datos del paciente por el nombre
        $this->sdata = $sdata;
        $con = new DB();
        $conexion = $con->conectar();
        $sql = mysqli_query($conexion, "select * from tblpatient where PatientName like '%$this->sdata%'|| PatientContno like '%$this->sdata%'");
	    $num = mysqli_num_rows($sql);
        return [$sql, $num];
    }

    public function getMedHistory($id){ //recupera el historial medico del paciente
        $this->id = $id;
        $con = new DB();
        $conexion = $con->conectar();
        $ret = mysqli_query($conexion,"SELECT * FROM tblmedicalhistory WHERE PatientID='$this->id'");
        return $ret;
    }

    public function addMedHistory($id, $bp, $weight, $temp, $pres){ //añade historial medico al pacient en cuestion
        $this->id = $id;
        $this->bp = $bp;
        $this->weight = $weight;
        $this->temp = $temp;
        $this->pres = $pres;
        $con = new DB();
        $conexion = $con->conectar();
        $query = mysqli_query($conexion, "INSERT INTO tblmedicalhistory(PatientID, BloodPressure, BloodSugar, Weight, Temperature, MedicalPres) VALUES ('$this->id','$this->bp','$this->bs','$this->weight','$this->temp','$this->pres')");
        return $query;
    }


    public function getAppointment(){ //recupera las citas mediante el id del doctor
        $con = new DB();
        $conexion = $con->conectar();
        $sql=mysqli_query($conexion,"select users.fullName as fname,appointment.*  from appointment join users on users.id=appointment.userId where appointment.doctorId='".$_SESSION['id']."'");
        return $sql;
    }

    public function updateAppointment($id){ //actualiza el estado de la cita
        $con = new DB();
        $conexion = $con->conectar();
        mysqli_query($conexion,"update appointment set doctorStatus='0' where id ='".$id."'");
    }
}
?>