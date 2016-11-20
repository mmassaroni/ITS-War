<?php 
	require_once('fachada.php');
	session_start();

	$coordenadas = posicionDeLaFicha($_POST['coordenadaX'], $_POST['coordenadaY']);

	if ($_POST['accion'] == "mover" OR $_POST['accion'] == "posicionamiento") {
		$db = new Conexion();
		$db->query("update usu_pj_partida set ubicacionx = " . $coordenadas[0] . ", ubicaciony = " . $coordenadas[1] . " where partida = " . $_SESSION['partida']->getid() . " and turno = 1") or die("ERROR CON LA BD");
		mysqli_close($db);
	}else if($_POST['accion'] == "atacar") {
		
	}
	

?>