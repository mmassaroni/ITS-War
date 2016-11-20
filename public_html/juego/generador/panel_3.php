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
$db = new Conexion;
$regDatosPer = $db->query("SELECT p.fuerza FROM personaje p, usu_pj_partida upp WHERE upp.partida = ".$_SESSION['partida']->getid()." AND upp.usuario = ".$_SESSION['objUsu']->getid()." AND upp.personaje = p.id") or die("ERROR CON LA BD");
$datosPer = $regDatosPer->fetch_array();

$db2 = new Conexion;
$regDatosHab = $db2->query("SELECT h.numero, h.nombre, h.costo_energia, h.efecto, h.potencia, h.alcance, h.tipo FROM habilidad h, personaje p, usu_pj_partida upp WHERE upp.partida = ".$_SESSION['partida']->getid()." AND upp.usuario = ".$_SESSION['objUsu']->getid()." AND upp.personaje = p.id AND p.id = h.personaje") or die("ERROR CON LA BD"); 

$db3 = new Conexion;
$regTurno = $db->query("SELECT turno FROM usu_pj_partida WHERE partida = ".$_SESSION['partida']->getid()." AND usuario = ".$_SESSION['objUsu']->getid()." AND turno = 1") or die("ERROR CON LA BD");
$turno = $regTurno->fetch_array();
?>


<?php if ($turno['turno'] == 0) { echo "<img id='matePanel' src='/images/mate.png' style='-webkit-animation-name: rotate; -webkit-animation-duration: 6s; -webkit-animation-iteration-count: infinite; animation-name: rotate; animation-duration: 6s; animation-iteration-count: infinite;'>"; } else { echo "<img id='matePanel' src='/images/mate.png' style='-webkit-animation-name: rotate; -webkit-animation-duration: 6s; -webkit-animation-iteration-count: infinite; animation-name: rotate; animation-duration: 6s; animation-iteration-count: infinite; height: 0%'>"; } ?>



<?php if ($turno['turno'] == 0) { echo "<div class=\"movimientos\" style='visibility: hidden;'>"; } else { echo "<div class=\"movimientos\" style='visibility: visible;'>"; } ?>
	<?php if ($turno['turno'] == 1) { echo "<a href=\"#\" onclick=\"if (mover == 0){document.getElementById('tablero').style.cursor = 'crosshair'; tomarXY = 1; accion = 'mover'; mover = 1;}\" class=\"movBtn\">MOVER</a>"; } else { echo "<a href='#' class=\"movBtn\">MOVER</a>"; } ?>
	<?php if ($turno['turno'] == 1) { echo "<a href=\"#\" onclick=\"pasar(); jugar();\" class=\"movBtn\">PASAR</a>"; } else { echo "<a href='#' class=\"movBtn\">PASAR</a>"; } ?>
</div>

<?php if ($turno['turno'] == 0) { echo "<hr style='visibility: hidden;'>"; } else { echo "<hr style='visibility: visible;'>"; } ?>

<div class="ataques" <?php if ($turno['turno'] == 0) { echo "style='visibility: hidden;'"; } ?>>
	<div class="tooltip"><a href="#" style="margin: 0 15px;"><img src="../../images/juego/at1.png" style="margin-top: 4px"><span class="tooltiptext"><?php echo "<span class='nombreHab'>Golpe</span><br><hr><span class='cuerpoHab'>Efecto: Daño<br>Tipo: Target<br>Daño: <span style='color: #c70000'>".$datosPer['fuerza']."</span><br>Alcance: <span style='color: #1795de'>2</span><br>Costo de energia: <span style='color: #efea56'>0</span></span>"; ?></span></a></div>
	
	<div class="tooltip">
		<?php
			if ($turno['turno'] == 1) {
				echo '<a href="#" onclick="if (atacar == 0){document.getElementById("tablero").style.cursor = "crosshair"; tomarXY = 1; accion = "atacar"; atacar = 1; habilidad = 1;}" style="margin: 0 15px;"><img src="../../images/juego/at2.png" style="margin-top: 4px">';
			}else{
				echo '<a href="#" style="margin: 0 15px;"><img src="../../images/juego/at2.png" style="margin-top: 4px">';
			}
		?>

		<span class="tooltiptext">
		<?php 
			while ($datosHab = $regDatosHab->fetch_array()) {
			 	if ($datosHab['numero'] == 1) {
			 		echo "<span class='nombreHab'>".$datosHab['nombre']."</span><br><hr><span class='cuerpoHab'>Efecto: ".$datosHab['efecto']."<br>Tipo: ".$datosHab['tipo']."<br>Daño: <span style='color: #c70000'>".($datosPer['fuerza'] * $datosHab['potencia'])."</span><br>Alcance: <span style='color: #1795de'>".$datosHab['alcance']."</span><br>Costo de energia: <span style='color: #efea56'>".$datosHab['costo_energia']."</span></span>";
			 		break;
			 	}
			} 
		?>
	</span></a></div>
	
	<div class="tooltip">
		<a href="#" style="margin: 0 15px;"><img src="../../images/juego/at3.png" style="margin-top: 4px">

		<span class="tooltiptext">
		<?php 
			while ($datosHab = $regDatosHab->fetch_array()) {
			 	if ($datosHab['numero'] == 2) {
			 		echo "<span class='nombreHab'>".$datosHab['nombre']."</span><br><hr><span class='cuerpoHab'>Efecto: ".$datosHab['efecto']."<br>Tipo: ".$datosHab['tipo']."<br>Daño: <span style='color: #c70000'>".($datosPer['fuerza'] * $datosHab['potencia'])."</span><br>Alcance: <span style='color: #1795de'>".$datosHab['alcance']."</span><br>Costo de energia: <span style='color: #efea56'>".$datosHab['costo_energia']."</span></span>";
			 		break;
			 	}
			} 
		?>
	</span></a></div>
</div>

<?php  
mysqli_close($db);
mysqli_close($db2);
mysqli_close($db3);
?>