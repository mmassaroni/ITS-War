<?php 
	
	
	include_once "personaje.php";
	include_once "usuario.php";
	include_once "partida.php";
	
	class usu_per_partida{

		private $numero;
		private $ubicaciony;
		private $ubicacionx;
		private $personaje;
		private $usuario;
		private $partida;
		private $vida;
		private $fuerza;
		private $energia;
		private $resistencia;


		public function __construct($numero, $partida, $usuario, $personaje, $ubicaciony, $ubicacionx, $vida, $fuerza, $energia, $resistencia){
			$this->numero=$numero;
			$this->ubicaciony=$ubicaciony;
			$this->ubicacionx=$ubicacionx;
			$this->vida=$vida;
			$this->fuerza=$fuerza;
			$this->energia=$energia;
			$this->resistencia=$resistencia;
			$this->partida=$partida;
			$this->personaje=$personaje;
			$this->usuario=$usuario;
		}

		// ####################################                   abre get y set

		public function getnumero(){
			return $this->numero;
		}

		public function setnumero($numero){
			$this->numero=$numero;
		}

		public function getubicaciony(){
			return $this->ubicaciony;
		}

		public function setubicaciony($ubicaciony){
			$this->ubicaciony=$ubicaciony;
		}

		public function getubicacionx(){
			return $this->ubicacionx;
		}

		public function setubicacionx($ubicacionx){
			$this->ubicacionx=$ubicacionx;
		}
		
		
		public function getvida(){
			return $this->vida;
		}

		public function setvida($vida){
			$this->vida=$vida;
		}

		public function getfuerza(){
			return $this->fuerza;
		}

		public function setfuerza($fuerza){
			$this->fuerza=$fuerza;
		}
		public function getenergia(){
			return $this->energia;
		}

		public function setenergia($energia){
			$this->energia=$energia;
		}
		
		
		public function getresistencia(){
			return $this->resistencia;
		}

		public function setresistencia($resistencia){
			$this->resistencia=$resistencia;
		}


		// ####################################              cierre de get y set

	}

?>