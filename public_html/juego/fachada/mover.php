<?php 
	require_once('fachada.php');
	session_start();

	$coordenadas = posicionDeLaFicha($_POST['coordenadaX'], $_POST['coordenadaY']);

	if ($_POST['accion'] == "mover" OR $_POST['accion'] == "posicionamiento") {
		$db = new Conexion();
		$db->query("update usu_pj_partida set ubicacionx = " . $coordenadas[0] . ", ubicaciony = " . $coordenadas[1] . " where partida = " . $_SESSION['partida']->getid() . " and turno = 1") or die("ERROR CON LA BD");
		mysqli_close($db);
		echo json_encode(777);
	}else if($_POST['accion'] == "atacar") {
		$db2 = new Conexion();
		$regVictima = $db2->query("select numero, vida, resistencia from usu_pj_partida where ubicacionx = ".$coordenadas[0]." and ubicaciony = ".$coordenadas[1]." and usuario <> ".$_SESSION['objUsu']->getid()) or die("ERROR CON LA BD");
		$victima = $regVictima->fetch_array();
		mysqli_close($db2);
		if (is_null($victima['numero'])) {
			echo json_encode(0);
		}else{
			$db3 = new Conexion();
			$regJugador = $db3->query("SELECT fuerza, energia FROM usu_pj_partida WHERE partida = ".$_SESSION['partida']->getid()." AND usuario = ".$_SESSION['objUsu']->getid()) or die("ERROR CON LA BD");
			$jugador = $regJugador->fetch_array();
			mysqli_close($db3);

			if ($_POST['habilidad'] == 1) {
				$efecto = "daño";
				$tipo = "target";
				$daño = $jugador['fuerza'];
				$alcance = 2;
				$costo_energia = 0;
			}else{
				$db4 = new Conexion();
				$regHabUsada = $db4->query("SELECT h.costo_energia, h.efecto, h.potencia, h.alcance, h.tipo FROM habilidad h, personaje p, usu_pj_partida upp WHERE upp.partida = ".$_SESSION['partida']->getid()." AND upp.usuario = ".$_SESSION['objUsu']->getid()." AND upp.personaje = p.id AND p.id = h.personaje and h.numero = ".$_POST['habilidad']) or die("ERROR CON LA BD"); 
				$habUsada = $regHabUsada->fetch_array();
				mysqli_close($db4);

				$efecto = $habUsada['efecto'];
				$tipo = $habUsada['tipo'];
				$daño = $jugador['fuerza'] * $habUsada['potencia'];
				$alcance = $habUsada['alcance'];
				$costo_energia = $habUsada['costo_energia'];
			}

			if ($jugador['energia'] < $costo_energia) {
				echo json_encode(1);
			}else{
				$vidaVictima = $victima['vida'] - ($daño - $victima['resistencia']);

				$db5 = new Conexion();
				$db5->query("update usu_pj_partida set vida = ".$vidaVictima." where numero = ".$victima['numero']." and partida = ".$_SESSION['partida']->getid()) or die("ERROR CON LA BD");
				mysqli_close($db5);
			}
			
			
			
		}
	}
	

?>