<?php 
	class Partidas{

		public static function buscarPartida($usuario, $pjElegido){
			$db = new Conexion();
			$consultaPartida = $db->query("select * from partida where estado = 'creando'") or die("ERROR CON LA BD");
			$regPartida = $consultaPartida->fetch_array();
			mysqli_close($db);
			if($regPartida == null){
				$partida = Partidas::crearPartida($usuario, $pjElegido);
			}else{
				$partida = Partidas::unirsePartida($usuario, $pjElegido, $regPartida);	
			}
			return $partida;
		} 
		
		public static function crearPartida($usuario, $pjElegido){
			$db = new Conexion();
			$db->query("insert into partida(estado) values('creando')") or die("ERROR CON LA BD");
			$jugadores = new Usus_Pers_Partida();
			$db2 = new conexion();
			$db2->query("insert into usu_pj_partida(partida, numero, usuario, personaje, fuerza, resistencia, vida, energia) values(".mysqli_INSERT_ID($db).", 1, ".$usuario->getid().", ".$pjElegido->getid().", ".$pjElegido->getfuerza().", ".$pjElegido->getresistencia().", ".$pjElegido->getvida().", ".$pjElegido->getenergia().")") or die("ERROR CON LA BD");
			$jugador = new Usu_Per_Partida(mysqli_INSERT_ID($db), 1, $usuario->getid(), $pjElegido->getid(), $pjElegido->getfuerza(), $pjElegido->getresistencia(), $pjElegido->getvida(), $pjElegido->getenergia());
			$jugadores->agregarJugador(1, $jugador);
			$partida = new Partida(mysqli_INSERT_ID($db), 'creando', $jugadores);
			mysqli_close($db);
			mysqli_close($db2);

			return $partida;
		}

		public static function unirsePartida($usuario, $pjElegido, $regPartida){
			$db = new Conexion();
			$jugadores = new Usus_Pers_Partida();
			$regJugadores = $db->query("select * from usu_pj_partida where partida = ". $regPartida['id']) or die("ERROR CON LA BD");
			while($regJugador = $regJugadores->fetch_array()){
				$jugador = new Usu_Per_Partida($regPartida['id'], $regJugador['numero'], $regJugador['usuario'], $regJugador['personaje'], $regJugador['fuerza'], $regJugador['resistencia'], $regJugador['vida'], $regJugador['energia']);
				$jugadores->agregarJugador($regJugador['numero'], $jugador);
			}
			for ($i=1; $i <= 4; $i++) { 
				if ($jugadores->getususPersPartida()[$i] == null) {
					$db2 = new Conexion();
					$db2->query("insert into usu_pj_partida(partida, numero, usuario, personaje, fuerza, resistencia, vida, energia) values(".$regPartida['id'].", ".$i.", ".$usuario->getid().", ".$pjElegido->getid().", ".$pjElegido->getfuerza().", ".$pjElegido->getresistencia().", ".$pjElegido->getvida().", ".$pjElegido->getenergia().")") or die("ERROR CON LA BD");
					mysqli_close($db2);
					$jugador = new Usu_Per_Partida($regPartida['id'], $i, $usuario->getid(), $pjElegido->getid(), $pjElegido->getfuerza(), $pjElegido->getresistencia(), $pjElegido->getvida(), $pjElegido->getenergia());
					$jugadores->agregarJugador($i, $jugador);
					$i = 5;
				}
			}
			$partida = new Partida($regPartida['id'], $regPartida['estado'], $jugadores);
			mysqli_close($db);
			return $partida;
		}
	}
?>