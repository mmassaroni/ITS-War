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
	$registros = $db->query("select per. from usuario u, usu_pj_partida upp, partida p, personaje per where upp.partida = ".$_SESSION['partida']->getid()." and upp.usuario = u.id and upp.personaje = per.id and (upp.numero = 3 or upp.numero = 4) and (p.estado = 'creando' or p.estado = 'en curso')") or die("ERROR CON LA BD");
	while ($reg = $registros->fetch_array()) {
		if ($reg['numero'] == 3){
			$datosJ3 = $reg;
		}elseif ($reg['numero'] == 4) {
			$datosJ4 = $reg;
		}
	}
	mysqli_close($db);
?>

<div class="movimientos">
	
</div>
<hr>
<div class="ataques">
	
</div>