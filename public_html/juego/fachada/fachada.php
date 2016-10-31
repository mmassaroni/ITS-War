<?php 
	require('juego/usuario.php');
	require('juego/personaje.php');

	function estados($usuario){
		if ($_GET['accion']==null) {
			$usuario->setestado("conectado");
			$usuario->actualizar();
		}
		elseif ($_GET['accion']=="1") {
			$usuario->setestado("buscando");
			$usuario->actualizar();
			//mostrarPersonajes($usuario);

		}
		elseif ($_GET['accion']=="2") {
			$usuario->setestado("jugando");
			$usuario->actualizar();
		} 
		elseif ($_GET['accion']=="3") {
			$usuario->setestado("desconectado");
			$usuario->actualizar();
			session_destroy();
			header("location:/");
		}

	}
	function instanciar_Personajes_Habilidades(){
		$db = new Conexion();
		$personajes=array();
		//$habilidades=array();

		$registrosPer = $db->query("select * from personaje") or die("ERROR CON LA BD");
		while($registroPer = $registrosPer->fetch_array()){
			$objPer = new Personaje($registroPer["id"], $registroPer["nombre"], $registroPer["imgCuerpo"], $registroPer["imgFicha"], $registroPer["fuerza"], $registroPer["movimiento"], $registroPer["resistencia"], $registroPer["alcance"], $registroPer["vida"], $registroPer["energia"], $registroPer["precio"]);

			$db2 = new Conexion();
			$registrosHab = $db2->query("select h.* from habilidad h, personaje p where p.id = h.personaje and p.id = ". $objPer->getid()) or die("ERROR CON LA BD2");

			$dosHabilidades = array();
			while($registroHab = $registrosHab->fetch_array()){
				$objHab = new Habilidad($registroHab['id'], $registroHab['personaje'], $registroHab['nombre'], $registroHab['costo_energia'], $registroHab['efecto'], $registroHab['potencia'], $registroHab['tipo']);
				//array_push($habilidades, $objHab);
				array_push($dosHabilidades, $objHab);
			}
			$objPer->setHabilidades($dosHabilidades);
			array_push($personajes, $objPer);
			$dosHabilidades = null;
			mysqli_close($db2);
		}
		mysqli_close($db);
		return $personajes;
	} 
	function mostrarPersonajes($usuario){
		//NO ANDA HAY QUE CAMBIAR TODO
		$db = new Conexion();
		$personajes=array();
		$habilidades=array();
		
		$registrosPer = $db->query("select p.* from personaje p, usu_tiene_per utp, usuario u where u.id = utp.usuario and utp.personaje = p.id and u.id = ". $usuario->getid() .";") or die("ERROR CON LA BD");

		while($registroPer = mysqli_fetch_array($registrosPer, MYSQLI_ASSOC)){
			header('location:index.html');
			$objPer = new Personaje($registroPer["id"], $registroPer["nombre"], $registroPer["imgCuerpo"], $registroPer["imgFicha"], $registroPer["fuerza"], $registroPer["movimiento"], $registroPer["resistencia"], $registroPer["alcance"], $registroPer["vida"], $registroPer["energia"], $registroPer["precio"]);


		}
		mysqli_close($db);

	}

?>