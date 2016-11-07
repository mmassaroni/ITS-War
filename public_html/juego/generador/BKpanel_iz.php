<?php 
	//require('../conexion.php');
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
	// $db = new Conexion();
	// $registros = $db->query("select upp.numero, u.nombre as nombreJugador, upp.vida, upp.energia, upp.fuerza, upp.resistencia, per.imgCuerpo, per.nombre as nombrePJ from usuario u, usu_pj_partida upp, partida p, personaje per where upp.partida = ".$_GET['partida']." and upp.usuario = u.id and upp.personaje = per.id and (upp.numero = 1 or upp.numero = 2) and (p.estado = 'creando' or p.estado = 'en curso')") or die("ERROR CON LA BD");
	// while ($reg = $registros->fetch_array()) {
	// 	if ($reg['numero'] == 1){
	// 		$datosJ1 = $reg;
	// 	}elseif ($reg['numero'] == 2) {
	// 		$datosJ2 = $reg;
	// 	}
	// }
	// mysqli_close($db);
?>
<div class="j1">
	<h1><?php
			if (empty($datosJ1['nombreJugador'])){ echo "JUGADOR1";} else{ echo $datosJ1['nombreJugador'];} 
		?>
	</h1>
	<div class="row vertical">
		<div class="img-per"><img <?php if (empty($datosJ1['imgCuerpo'])){ echo "src='../../images/mrBean.gif'"; } else{echo "src='" . $datosJ1['imgCuerpo'] . "'";} echo "title='".$datosJ1['nombrePJ']."'"; ?>></div>
		<div class="valores-per">
			<h2>VIDA</h2>
				<div id="myProgress_vida">
					<div id="myBar_vida">
						<div id="label_vida"><?php echo $datosJ1['vida']; ?></div>
					</div>
				</div>
			<h2>ENERGÍA</h2>
				<div id="myProgress_energia">
					<div id="myBar_energia"></div>
					<div id="label_energia"><?php echo $datosJ1['energia']; ?></div>
				</div> 
			<h2>FUERZA<span> <?php echo $datosJ1['fuerza']; ?></span></h2>
			<hr>
			<h2>RESISTENCIA<span> <?php echo $datosJ1['resistencia']; ?></span></h2>
		</div>
	</div>
</div>
<hr/>
<div class="j2">
	<h1><?php
			if (empty($datosJ2['nombreJugador'])){ echo "JUGADOR2";} else{ echo $datosJ2['nombreJugador'];} 
		?>
	</h1>
	<div class="row vertical">
		<div class="img-per"><img <?php if (empty($datosJ2['imgCuerpo'])){ echo "src='../../images/mrBean.gif'"; } else{echo "src='" . $datosJ2['imgCuerpo'] . "'";} echo "title='".$datosJ2['nombrePJ']."'"; ?>></div>
		<div class="valores-per">
			<h2>VIDA</h2>
				<div id="myProgress_vida">
					<div id="myBar_vida">
						<div id="label_vida"><?php echo $datosJ2['vida']; ?></div>
					</div>
				</div>
			<h2>ENERGÍA</h2>
				<div id="myProgress_energia">
					<div id="myBar_energia"></div>
					<div id="label_energia"><?php echo $datosJ2['energia']; ?></div>
				</div> 
			<h2>FUERZA<span> <?php echo $datosJ2['fuerza']; ?></span></h2>
			<hr>
			<h2>RESISTENCIA<span> <?php echo $datosJ2['resistencia']; ?></span></h2>
		</div>
	</div>
</div>