<?php 

	class Usuario{

		private $id;
		private $nombre;
		private $email;
		private $pass;
		private $estado;
		private $plata;
		private $personajes;

		public function __construct($id=null, $nombre=null, $email=null, $pass, $estado=null, $plata=null, $personajes=null){
			$this->id=$id;
			$this->nombre=$nombre;
			$this->email=$email; 
			$this->pass=$pass;
			$this->estado=$estado;
			$this->plata=$plata;
			$this->personajes=$personajes;
		}

		// ####################################                   abre get y set

		public function getid(){
			return $this->id;
		}

		public function setid($id){
			$this->id=$id;
		}

		public function getnombre(){
			return $this->nombre;
		}

		public function setnombre($nombre){
			$this->nombre=$nombre;

		}

		public function getemail(){
			return $this->email;
		}

		public function setemail($email){
			$this->email=$email;
		}

		public function getpass(){
			return $this->pass;
		}

		public function setpass($pass){
			$this->pass=$pass;
		}

		public function getestado(){
			return $this->estado;
		}

		public function setestado($estado){
			$this->estado=$estado;
		}
		public function getplata(){
			return $this->plata;
		}

		public function setplata($plata){
			$this->plata=$plata;
		}

		public function getpersonajes(){
			return $this->personajes;
		}

		public function setpersonajes($personajes){
			$this->personajes=$personajes;
		}
		// ####################################              cierre de get y set
	
	}

?>