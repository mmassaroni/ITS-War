<?php 
	
	class Usu_Per_Partida{
		private $partida;
		private $numero;
		private $usuario;
		private $personaje;
		private $fuerza;
		private $resistencia;
		private $vida;
		private $energia;
		private $ubicacionx;
		private $ubicaciony;
		private $turno;
		private $ganador;


		public function __construct($partida, $numero, $usuario, $personaje, $fuerza, $resistencia, $vida, $energia, $ubicacionx = null, $ubicaciony = null, $turno = null, $ganador = null){
			$this->partida=$partida;
			$this->numero=$numero;
			$this->usuario=$usuario;
			$this->personaje=$personaje;
			$this->fuerza=$fuerza;
			$this->resistencia=$resistencia;
			$this->vida=$vida;
			$this->energia=$energia;
			$this->ubicacionx=$ubicacionx;
			$this->ubicaciony=$ubicaciony;
			$this->turno=$turno;
			$this->ganador=$ganador;
		}

		// ####################################                   abre get y set

		public function getpartida(){
			return $this->partida;
		}

		public function setpartida($partida){
			$this->partida=$partida;
		}

		public function getnumero(){
			return $this->numero;
		}

		public function setnumero($numero){
			$this->numero=$numero;
		}

		public function getusuario(){
			return $this->usuario;
		}

		public function setusuario($usuario){
			$this->usuario=$usuario;
		}

		public function getpersonaje(){
			return $this->personaje;
		}

		public function setpersonaje($personaje){
			$this->personaje=$personaje;
		}

		public function getfuerza(){
			return $this->fuerza;
		}

		public function setfuerza($fuerza){
			$this->fuerza=$fuerza;
		}
		
		public function getresistencia(){
			return $this->resistencia;
		}

		public function setresistencia($resistencia){
			$this->resistencia=$resistencia;
		}
		
		public function getvida(){
			return $this->vida;
		}

		public function setvida($vida){
			$this->vida=$vida;
		}
			
		public function getenergia(){
			return $this->energia;
		}

		public function setenergia($energia){
			$this->energia=$energia;
		}

		public function getubicacionx(){
			return $this->ubicacionx;
		}

		public function setubicacionx($ubicacionx){
			$this->ubicacionx=$ubicacionx;
		}
		
		public function getubicaciony(){
			return $this->ubicaciony;
		}

		public function setubicaciony($ubicaciony){
			$this->ubicaciony=$ubicaciony;
		}

		public function getturno(){
			return $this->turno;
		}

		public function setturno($turno){
			$this->turno=$turno;
		}

		public function getganador(){
			return $this->ganador;
		}

		public function setganador($ganador){
			$this->ganador=$ganador;
		}

		// ####################################              cierre de get y set

	}

?>