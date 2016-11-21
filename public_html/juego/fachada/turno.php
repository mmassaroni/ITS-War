<?php 
	require_once('../conexion.php');
	require_once('../habilidad.php');
	require_once('../habilidades.php');
	require_once('../partida.php');
	require_once('../partidas.php');
	require_once('../personaje.php');
	require_once('../personajes.php');
	require_once('../potenciador.php');
	require_once('../potenciador_partida.php');
	require_once('../usu_per_partida.php');
	require_once('../usus_pers_partida.php');
	require_once('../usuario.php');
	require_once('../usuarios.php');
	session_start();

	if ($_POST['accion'] == "miTurno") {
		$respuesta = array();

		$db = new Conexion();
		$registros = $db->query("select usuario, turno from usu_pj_partida where partida = ". $_SESSION['partida']->getid()) or die("ERROR CON LA BD");
		while ($reg = $registros->fetch_array()) {
			if ($reg['usuario'] == $_SESSION['objUsu']->getid() && $reg['turno'] == 1) {
				$respuesta[0] = $reg['turno'];
			}
		}
		mysqli_close($db);

		$db2 = new Conexion();
		$registros = $db2->query("select * from usu_pj_partida where partida = ". $_SESSION['partida']->getid() ." and ubicacionx IS NOT NULL and ubicaciony IS NOT NULL");
		$jugadores = 0;
		while ($reg = $registros->fetch_array()) {
			$jugadores += 1;
		}
		mysqli_close($db2);

		$respuesta[1] = $jugadores;


		if ($respuesta[0] == 1){
			//SUBIR ENERGIA EN LOS TURNOS
			$db4 = new Conexion();
			$regEnergia = $db4->query("select energia from usu_pj_partida where turno = 1 and partida = ".$_SESSION['partida']->getid()) or die("ERROR CON LA BD");
			$energia = $regEnergia->fetch_array();
			mysqli_close($db4);
			
			$energiaFinal = $energia['energia'] + 4;
			if ($energiaFinal > 10){
				$energiaFinal = 10;
			}

			$db5 = new Conexion();
			$db5->query("update usu_pj_partida set energia = ".$energiaFinal." where turno = 1 and partida = ".$_SESSION['partida']->getid()) or die("ERROR CON LA BD");
			mysqli_close($db5);
		}
		
		echo json_encode($respuesta);
	} elseif ($_POST['accion'] == "pasar") {
		$db3 = new Conexion();
		$registro = $db3->query('select numero from usu_pj_partida where partida = '. $_SESSION['partida']->getid() .' and turno = 1');
		$a = $registro->fetch_array();
		mysqli_close($db2);

		if ($a['numero'] < 4) {
			$b = $a['numero']+1;
		} else {
			$b = 1;
		}

		$db4 = new Conexion();
		$db4->query('update usu_pj_partida set turno = 0 where partida = ' . $_SESSION['partida']->getid());
		$db4->query('update usu_pj_partida set turno = 1 where partida = ' . $_SESSION['partida']->getid() .' and numero = ' . $b);
		mysqli_close($db3);

	}

?>