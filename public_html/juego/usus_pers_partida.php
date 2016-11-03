<?php
	class Usus_Pers_Partida{
		private $colUsuPerPartida = array();
		
		public function getususPersPartida(){
			return $this->colUsuPerPartida;
		}

		public function setususPersPartida($ususPersPartida){
			$this->colUsuPerPartida=$ususPersPartida;
		}

		public function agregarJugador($nroJugador, $jugador){
			$this->colUsuPerPartida[$nroJugador] = $jugador;
		}
	}
?>