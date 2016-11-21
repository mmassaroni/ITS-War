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
	$registros = $db->query("select upp.turno, upp.numero, u.id, u.nombre as nombreJugador, upp.vida, per.vida as pervida, upp.energia, per.energia as perenergia, upp.fuerza, upp.resistencia, per.imgCuerpo, per.nombre as nombrePJ from usuario u, usu_pj_partida upp, partida p, personaje per where upp.partida = ".$_SESSION['partida']->getid()." and upp.usuario = u.id and upp.personaje = per.id and (upp.numero = 1 or upp.numero = 2) and (p.estado = 'creando' or p.estado = 'en curso')") or die("ERROR CON LA BD");
	while ($reg = $registros->fetch_array()) {
		if ($reg['numero'] == 1){
			$datosJ1 = $reg;
		}elseif ($reg['numero'] == 2) {
			$datosJ2 = $reg;
		}
	}
	mysqli_close($db);
?>
<div class="j1">
	<?php
		if (empty($datosJ1['nombreJugador'])){ 
			echo "<h1>JUGADOR1</h1>";
		}else{ 
			if ($datosJ1['id'] == $_SESSION['objUsu']->getid()) {
				if ($datosJ1['turno'] == 1){
					echo "<h1 style='color: #fffb00; background-color: #3B8686;'>&#187; ".$datosJ1['nombreJugador']." &#171;</h1>";
				}else{
					echo "<h1 style='background-color: #3B8686'>".$datosJ1['nombreJugador']."</h1>";
				}
				
			}else{
				if ($datosJ1['turno'] == 1){
					echo "<h1 style='color: #fffb00;'>&#187; ".$datosJ1['nombreJugador']." &#171;</h1>";
				}else{
					echo "<h1>".$datosJ1['nombreJugador']."</h1>";
				}
				
			}
		}	 
	?>
	<div class="row vertical">
		<div class="img-per"><img <?php if (empty($datosJ1['imgCuerpo'])){ echo "src='../../images/loading.png' style='-webkit-animation:spin 2s linear infinite; -moz-animation:spin 2s linear infinite; animation:spin 2s linear infinite;'"; } else{echo "src='" . $datosJ1['imgCuerpo'] . "'";} echo "title='".$datosJ1['nombrePJ']."'"; ?>></div>
		<div class="valores-per">
			<h2>VIDA</h2>
				<div id="myProgress_vida">
					<div id="myBar_vida" <?php if (isset($datosJ1['vida'])) {
						echo "style=\"width: ". (($datosJ1['vida'] * 100) / $datosJ1['pervida']) ."%\""; } ?>></div>
					<div id="label_vida"><?php echo $datosJ1['vida']; ?></div>
				</div>
			<h2>ENERGÍA</h2>
				<div id="myProgress_energia">
					<div id="myBar_energia" <?php if (isset($datosJ1['vida'])) {
						echo "style=\"width: ". (($datosJ1['energia'] * 100) / $datosJ1['perenergia']) ."%\""; } ?>></div>
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
	<?php
		if (empty($datosJ2['nombreJugador'])){ 
			echo "<h1>JUGADOR2</h1>";
		}else{ 
			if ($datosJ2['id'] == $_SESSION['objUsu']->getid()) {
				if ($datosJ2['turno'] == 1){
					echo "<h1 style='color: #fffb00; background-color: #3B8686;'>&#187; ".$datosJ2['nombreJugador']." &#171;</h1>";
				}else{
					echo "<h1 style='background-color: #3B8686'>".$datosJ2['nombreJugador']."</h1>";
				}
				
			}else{
				if ($datosJ2['turno'] == 1){
					echo "<h1 style='color: #fffb00;'>&#187; ".$datosJ2['nombreJugador']." &#171;</h1>";
				}else{
					echo "<h1>".$datosJ2['nombreJugador']."</h1>";
				}
				
			}
		}	 
	?>
	<div class="row vertical">
		<div class="img-per"><img <?php if (empty($datosJ2['imgCuerpo'])){ echo "src='../../images/loading.png' style='-webkit-animation:spin 2s linear infinite; -moz-animation:spin 2s linear infinite; animation:spin 2s linear infinite;'"; } else{echo "src='" . $datosJ2['imgCuerpo'] . "'";} echo "title='".$datosJ2['nombrePJ']."'"; ?>></div>
		<div class="valores-per">
			<h2>VIDA</h2>
				<div id="myProgress_vida">
					<div id="myBar_vida" <?php if (isset($datosJ2['vida'])) {
						echo "style=\"width: ". (($datosJ2['vida'] * 100) / $datosJ2['pervida']) ."%\""; } ?>></div>
					<div id="label_vida"><?php echo $datosJ2['vida']; ?></div>
				</div>
			<h2>ENERGÍA</h2>
				<div id="myProgress_energia">
					<div id="myBar_energia" <?php if (isset($datosJ2['vida'])) {
					echo "style=\"width: ". (($datosJ2['energia'] * 100) / $datosJ2['perenergia']) ."%\""; } ?>></div>
					<div id="label_energia"><?php echo $datosJ2['energia']; ?></div>
				</div> 
			<h2>FUERZA<span> <?php echo $datosJ2['fuerza']; ?></span></h2>
			<hr>
			<h2>RESISTENCIA<span> <?php echo $datosJ2['resistencia']; ?></span></h2>
		</div>
	</div>
</div>