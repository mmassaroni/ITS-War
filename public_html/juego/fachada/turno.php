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

	$db = new Conexion();
	$registros = $db->query("select usuario, turno from usu_pj_partida where partida = ". $_SESSION['partida']->getid()) or die("ERROR CON LA BD");
	while ($reg = $registros->fetch_array()) {
		if ($reg['usuario'] == $_SESSION['objUsu']->getid() && $reg['turno'] == 1) {
			echo $reg['turno'];
		}
	}

?>