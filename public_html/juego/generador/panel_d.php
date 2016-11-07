<?php 
	require('../conexion.php');
	$db = new Conexion();
	$registros = $db->query("select upp.numero, u.nombre as nombreJugador, upp.vida, upp.energia, upp.fuerza, upp.resistencia, per.imgCuerpo, per.nombre as nombrePJ from usuario u, usu_pj_partida upp, partida p, personaje per where upp.partida = ".$_GET['partida']." and upp.usuario = u.id and upp.personaje = per.id and (upp.numero = 3 or upp.numero = 4) and (p.estado = 'creando' or p.estado = 'en curso')") or die("ERROR CON LA BD");
	while ($reg = $registros->fetch_array()) {
		if ($reg['numero'] == 3){
			$datosJ3 = $reg;
		}elseif ($reg['numero'] == 4) {
			$datosJ4 = $reg;
		}
	}
	mysqli_close($db);
?>
<div class="j3">
	<h1><?php
			if (empty($datosJ3['nombreJugador'])){ echo "JUGADOR3";} else{ echo $datosJ3['nombreJugador'];} 
		?>
	</h1>
	<div class="row vertical">
		<div class="img-per"><img <?php if (empty($datosJ3['imgCuerpo'])){ echo "src='../../images/mrBean.gif'"; } else{echo "src='" . $datosJ3['imgCuerpo'] . "'";} echo "title='".$datosJ3['nombrePJ']."'"; ?>></div>
		<div class="valores-per">
			<h2>VIDA</h2>
				<div id="myProgress_vida">
					<div id="myBar_vida">
						<div id="label_vida"><?php echo $datosJ3['vida']; ?></div>
					</div>
				</div>
			<h2>ENERGÍA</h2>
				<div id="myProgress_energia">
					<div id="myBar_energia"></div>
					<div id="label_energia"><?php echo $datosJ3['energia']; ?></div>
				</div> 
			<h2>FUERZA<span> <?php echo $datosJ3['fuerza']; ?></span></h2>
			<hr>
			<h2>RESISTENCIA<span> <?php echo $datosJ3['resistencia']; ?></span></h2>
		</div>
	</div>
</div>
<hr/>
<div class="j4">
	<h1><?php
			if (empty($datosJ4['nombreJugador'])){ echo "JUGADOR4";} else{ echo $datosJ4['nombreJugador'];} 
		?>
	</h1>
	<div class="row vertical">
		<div class="img-per"><img <?php if (empty($datosJ4['imgCuerpo'])){ echo "src='../../images/mrBean.gif'"; } else{echo "src='" . $datosJ4['imgCuerpo'] . "'";} echo "title='".$datosJ4['nombrePJ']."'"; ?>></div>
		<div class="valores-per">
			<h2>VIDA</h2>
				<div id="myProgress_vida">
					<div id="myBar_vida">
						<div id="label_vida"><?php echo $datosJ4['vida']; ?></div>
					</div>
				</div>
			<h2>ENERGÍA</h2>
				<div id="myProgress_energia">
					<div id="myBar_energia"></div>
					<div id="label_energia"><?php echo $datosJ4['energia']; ?></div>
				</div> 
			<h2>FUERZA<span> <?php echo $datosJ4['fuerza']; ?></span></h2>
			<hr>
			<h2>RESISTENCIA<span> <?php echo $datosJ4['resistencia']; ?></span></h2>
		</div>
	</div>
</div>
<?php  
	if ($_GET['accion'] == 'esperando') {
		$db = new Conexion();
		$registros = $db->query("select count(*) as cantidadReg from usu_pj_partida where partida = ".$_GET['partida']) or die("ERROR CON LA BD1");
		$reg = $registros->fetch_array();
		mysqli_close($db);
		if ($reg['cantidadReg'] == 4) {
			$db2 = new Conexion();
			$consulta = $db2->query("select numero from usu_pj_partida where partida = ".$_GET['partida']." and usuario =".$_GET['jugador']." order by numero") or die("ERROR CON LA BD2");
			$numeroJugador = $consulta->fetch_array();
			mysqli_close($db2);
			if ($numeroJugador['numero'] == 1) {
				$db3 = new Conexion();
				$db3->query("update partida set estado = 'en curso' where id = ".$_GET['partida']) or die("ERROR EN LA BD3");
				mysqli_close($db3);
			}
			//header('Location:../../game.php?&accion=jugando&tab=1&personaje='.$_GET['personaje'].'&partida='.$_GET['partida'].'&jugador='.$_GET['jugador']);
			echo "<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'>clearInterval(intervalo);</script>";
			//../../game.php?&accion=jugando&tab=1&personaje=".$_GET['personaje']."&partida=".$_GET['partida']."&jugador=".$_GET['jugador']."
		}	
	}
	
?>