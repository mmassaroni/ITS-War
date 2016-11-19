<?php 
	require_once('fachada.php');
	session_start();

	$coordenadas = posicionDeLaFicha($_POST['coordenadaX'], $_POST['coordenadaY']);

	$db = new Conexion();
	$db->query("update usu_pj_partida set ubicacionx = " . $coordenadas[0] . ", ubicaciony = " . $coordenadas[1] . " where partida = " . $_SESSION['partida']->getid() . " and turno = 1") or die("ERROR CON LA BD");
	mysqli_close($db);

	$db2 = new Conexion();
	$registro = $db2->query("select numero from usu_pj_partida where partida = " . $_SESSION['partida']->getid() . " and turno = 1");
	$a = $registro->fetch_array();
	mysqli_close($db2);

	if ($a['numero'] < 4) {
		$b = $a['numero']+1;
	} else {
		$b = 1;
	}

	$db3 = new Conexion();
	$db3->query("update usu_pj_partida set turno = 0 where partida = " . $_SESSION['partida']->getid());
	$db3->query("update usu_pj_partida set turno = 1 where partida = " . $_SESSION['partida']->getid() ." and numero = " . $b);
	mysqli_close($db3);

?>