<?php 
	require('juego/usuario.php');
	require('juego/personaje.php');

	function estados($usuarioLocal){
		if ($_GET['accion']==null) {
			$usuarioLocal->setestado("conectado");
			$usuarioLocal->actualizar();
		}
		elseif ($_GET['accion']=="1") {
			$usuarioLocal->setestado("buscando");
			$usuarioLocal->actualizar();
			mostrarPersonajes($usuarioLocal);

		}
		elseif ($_GET['accion']=="2") {
			$usuarioLocal->setestado("jugando");
			$usuarioLocal->actualizar();
		} 
		elseif ($_GET['accion']=="3") {
			$usuarioLocal->setestado("desconectado");
			$usuarioLocal->actualizar();
			session_destroy();
			header("location:/");
		}

	} 
	function mostrarPersonajes($usuarioLocal){
		
		$db = new Conexion();
		$personajes=array();
		$habilidades=array();
		
		$registrosPer = $db->query("select p.* from personaje p, usu_tiene_per utp, usuario u where u.id = utp.usuario and utp.personaje = p.id and u.id = ". $usuarioLocal->getid() .";") or die("ERROR CON LA BD");

		while($registroPer = mysqli_fetch_array($registrosPer, MYSQLI_ASSOC)){
			header('location:index.html');
			$objPer = new Personaje($registroPer["id"], $registroPer["nombre"], $registroPer["imgCuerpo"], $registroPer["imgFicha"], $registroPer["fuerza"], $registroPer["movimiento"], $registroPer["resistencia"], $registroPer["alcance"], $registroPer["vida"], $registroPer["energia"], $registroPer["precio"]);
			$db2 = new Conexion();
			$registrosHab = $db2->query("select h.* from habilidad h, personaje p where p.id = h.personaje and p.id = '". $objPer.getid() ."'") or die("ERROR CON LA BD2");
			while($registroHab = mysqi_fetch_array($registrosHab, MYSQLI_ASSOC)){
				
			}

		}
		mysqli_close($db);

	}

?>