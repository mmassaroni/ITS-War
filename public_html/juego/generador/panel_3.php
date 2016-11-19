<?php 
session_start();
$db = new Conexion;
$regDatosPer = $db->query("SELECT p.fuerza, p.alcance FROM personaje p, usu_pj_partida upp WHERE upp.partida = ".$_SESSION['partida']->getid()." AND upp.usuario = ".$_SESSION['objUsu']->getid()." AND upp.personaje = p.id") or die("ERROR CON LA BD");
$datosPer = $regDatosPer->fetch_array();

$db2 = new Conexion;
$regDatosHab = $db2->query("SELECT h.numero, h.nombre, h.costo_energia, h.efecto, h.potencia, h.tipo FROM habilidad h, personaje p, usu_pj_partida upp WHERE upp.partida = ".$_SESSION['partida']->getid()." AND upp.usuario = ".$_SESSION['objUsu']->getid()." AND upp.personaje = p.id AND p.id = h.personaje") or die("ERROR CON LA BD");
?>
<div class="movimientos">
	<a href="#" class="movBtn">MOVER</a>
	<a href="#" class="movBtn">PASAR</a>
</div>
<hr>
<div class="ataques">
	<div class="tooltip"><a href="#" style="margin: 0 15px;"><img src="../../images/juego/at1.png" style="margin-top: 4px"><span class="tooltiptext"><?php echo "Golpe:<br><br>Ataque super normal...<br><br>Efecto: Daño<br>Tipo: Recto<br>Daño: <span style='color: #c70000'>".$datosPer['fuerza']."</span><br>Alcance: <span style='color: #1795de'>".$datosPer['alcance']."</span><br>Costo de energia: <span style='color: #efea56'>0</span>"; ?></span></a></div>
	
	<div class="tooltip"><a href="#" style="margin: 0 15px;"><img src="../../images/juego/at2.png" style="margin-top: 4px"><span class="tooltiptext">
		<?php 
			while ($datosHab = $regDatosHab->fetch_array()) {
			 	if ($datosHab['numero'] == 1) {
			 		echo $datosHab['nombre'].":<br><br>Efecto: ".$datosHab['efecto']."<br>Tipo: ".$datosHab['tipo']."<br>Daño: <span style='color: #c70000'>".($datosPer['fuerza'] * $datosHab['potencia'])."</span><br>Alcance: <span style='color: #1795de'>".$datosPer['alcance']."</span><br>Costo de energia: <span style='color: #efea56'>0</span>";
			 		break;
			 	}
			} 
		?>
	</span></a></div>
	
	<div class="tooltip"><a href="#" style="margin: 0 15px;"><img src="../../images/juego/at3.png" style="margin-top: 4px"><span class="tooltiptext">
		<?php 
			while ($datosHab = $regDatosHab->fetch_array()) {
			 	if ($datosHab['numero'] == 2) {
			 		echo $datosHab['nombre'].":<br><br>Efecto: ".$datosHab['efecto']."<br>Tipo: ".$datosHab['tipo']."<br>Daño: <span style='color: #c70000'>".($datosPer['fuerza'] * $datosHab['potencia'])."</span><br>Alcance: <span style='color: #1795de'>".$datosPer['alcance']."</span><br>Costo de energia: <span style='color: #efea56'>0</span>";
			 		break;
			 	}
			} 
		?>
	</span></a></div>
</div>
<?php  
mysqli_close($db);
mysqli_close($db2);
?>