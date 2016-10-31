<?php 
	require('juego/usuario.php');
	require('juego/personaje.php');

	function estados($usuario){
		if ($_GET['accion']==null) {
			$usuario->setestado("conectado");
			$usuario->actualizar();
		}
		elseif ($_GET['accion']=="eligiendo") {

		}
		elseif ($_GET['accion']=="buscando") {
			$usuario->setestado("buscando");
			$usuario->actualizar();
			//aca va el codigo para armar la partida
		}
		elseif ($_GET['accion']=="jugando") {
			$usuario->setestado("jugando");
			$usuario->actualizar();
		} 
		elseif ($_GET['accion']=="salir") {
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
			$registrosHab = $db2->query("select h.* from habilidad h, personaje p where p.id = h.personaje and p.id = ". $objPer->getid()) or die("ERROR CON LA BD");

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
	function personajesDelUsuario($usuario, $personajes){
		$db = new Conexion();
		$registrosPerDelUsu = $db->query("select personaje from usu_tiene_per where usuario=". $usuario->getid()) or die("ERROR CON LA BD");

		$pjsDelUsu = array();
		while($registro = $registrosPerDelUsu->fetch_array()){
			foreach($personajes as $personaje){
				if($personaje->getid() == $registro[0]){
					array_push($pjsDelUsu, $personaje);
				}
			}
		}
		mysqli_close($db);
		return $pjsDelUsu;
	}

?>