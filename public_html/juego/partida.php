<?php 
	
	class Partida{

		private $id;
		private $estado;
		private $colJugadores = array();

		public function __construct($id, $estado, $colJugadores){
			$this->id=$id;
			$this->estado=$estado;
			$this->colJugadores=$colJugadores;
		}

		// ####################################                   abre get y set

		public function getid(){
			return $this->id;
		}

		public function setid($id){
			$this->id=$id;
		}

		public function getestado(){
			return $this->estado;
		}

		public function setestado($estado){
			$this->estado=$estado;
		}

		public function getcolJugadores(){
			return $this->colJugadores;
		}

		public function setcolJugadores($colJugadores){
			$this->colJugadores=$colJugadores;
		}		

		// ####################################              cierre de get y set

	}

?>