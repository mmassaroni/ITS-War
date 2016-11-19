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

		public static function asignarTurno($partida, $numero){
			$db = new Conexion();
			$db->query("UPDATE usu_pj_partida set turno = 1 WHERE numero = ".$numero." and partida = ".$partida->getid()) or die("ERROR CON LA BD");
			mysqli_close($db);
			$db2 = new Conexion();
			$db2->query("UPDATE usu_pj_partida set turno = 0 WHERE numero <> ".$numero." and partida = ".$partida->getid()) or die("ERROR CON LA BD");
			mysqli_close($db2);
		}
	}
?>