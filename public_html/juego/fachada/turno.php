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

	if ($_POST['accion'] = "miTurno") {
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

		echo json_encode($respuesta);
	}

?>