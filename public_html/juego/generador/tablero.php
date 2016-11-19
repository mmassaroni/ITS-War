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
?>

<!-- Colocar las fichas -->
<!-- <img src="../../images/juego/Brune_ficha.png" style="position: absolute; max-width: 62.5px; margin-top: 0px; margin-left: 0px"> -->

<?php 

	if ($_GET['accion'] == 'jugando') {
		$salir = 0;
		$db = new Conexion();
		$registros = $db->query("select upp.usuario, upp.ubicacionx, upp.ubicaciony, p.imgFicha from usu_pj_partida upp, personaje p where upp.partida = ".$_SESSION['partida']->getid()." and upp.personaje = p.id") or die("ERROR CON LA BD");
		while ($reg = $registros->fetch_array()) {
			if(!is_null($reg['ubicacionx'])) {
				$salir += 1;
				if ($reg['usuario'] == $_SESSION['objUsu']->getid()) {
					echo "<img src=\"".$reg['imgFicha']."\" style=\"position: absolute; background-color: #3b8686; max-width: 62.5px; margin-top: ".$reg['ubicaciony']."px; margin-left: ".$reg['ubicacionx']."px\">";
				} else {
					echo "<img src=\"".$reg['imgFicha']."\" style=\"position: absolute; max-width: 62.5px; margin-top: ".$reg['ubicaciony']."px; margin-left: ".$reg['ubicacionx']."px\">";
				}
			}
		}
		mysqli_close($db);
		echo json_encode($salir);
	}

?>
		
