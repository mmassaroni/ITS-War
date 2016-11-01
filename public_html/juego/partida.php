<?php 
	
	class partida{

		private $id;
		private $ganador;
		private $estado;



		public function __construct($id, $ganador, $estado){
			$this->id=$id;
			$this->ganador=$ganador;
			$this->estado=$estado;
		}

		// ####################################                   abre get y set

		public function getid(){
			return $this->id;
		}

		public function setid($id){
			$this->id=$id;
		}

		public function getturno(){
			return $this->turno;
		}

		public function setturno($turno){
			$this->turno=$turno;
		}

		public function getnumero(){
			return $this->numero;
		}

		public function setnumero($numero){
			$this->numero=$numero;
		}

		public function getestado(){
			return $this->estado;
		}

		public function setestado($estado){
			$this->estado=$estado;
		}


		// ####################################              cierre de get y set

	}

?>