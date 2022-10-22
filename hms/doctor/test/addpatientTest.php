<?php
include_once ('..\include');
    class addPatientTest extends PHPUnit\Framework\TestCase {
        private $doctor;
        public function testUsuarioAgregado(){
            $this->doctor = new Doctor();
            $this->assertEquals($_SESSION['errmsg']="Paciente creado.", $this->doctor->addPatient('Juan', '3412337843', 'testmail@gmail.com', 'male', 'Jupiter 6316', '20', 'Vacio'));
        }
    }
?> 