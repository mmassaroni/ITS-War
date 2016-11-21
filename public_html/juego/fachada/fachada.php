<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/conexion.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/habilidad.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/habilidades.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/partida.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/partidas.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/personaje.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/personajes.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/potenciador.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/potenciador_partida.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/usu_per_partida.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/usus_pers_partida.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/usuario.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/juego/usuarios.php');

	function estados($usuario){
		if ($_GET['accion']==null) {
			$usuario->setestado("conectado");
			Usuarios::actualizar($usuario);
		}
		elseif ($_GET['accion']=="eligiendo") {

		}
		elseif ($_GET['accion']=="buscando") {
			$usuario->setestado("buscando");
			Usuarios::actualizar($usuario);
			$_SESSION['pjElegido'] = datosPjElegido($usuario);
			$_SESSION['partida'] = Partidas::buscarPartida($usuario, $_SESSION['pjElegido']);
			header('Location:game.php?&accion=esperando');
		}
		elseif ($_GET['accion']=="esperando") {

		}
		elseif ($_GET['accion']=="jugando") {
			$usuario->setestado("jugando");
			Usuarios::actualizar($usuario);
			if($_SESSION['partida']->getcolJugadores()->getususPersPartida()[1]->getusuario() == $usuario->getid()){
				$num = rand(1, 4);
				usus_pers_partida::asignarTurno($_SESSION['partida'], $num);
			}
			while ($var == true) {
				$db = new Conexion();
				$registros = $db->query("SELECT numero, turno from usu_pj_partida where partida = ".$_SESSION['partida']->getid()) or die("ERROR CON LA BD");
				if($registros->fetch_array()['turno'] != null){
					$var = false;
					while($registro = $registros->fetch){
						$_SESSION['partida']->getcolJugadores[$registro['numero']]->setturno($registro['turno']);
					}
				}
				mysqli_close($db);
			}
		}
		elseif ($_GET['accion']=="salir") {
			$usuario->setestado("desconectado");
			Usuarios::actualizar($usuario);
			session_destroy();
			header("location:/");
		}
		elseif ($_GET['accion']=="saliendo") {
			$usuario->setestado("conectado");
			Usuarios::actualizar($usuario);
			saliendoPartida($_SESSION['objUsu']->getid(), $_SESSION['partida']->getid());
			header("Location:game.php");
		}

	}
	
	function datosPjElegido($usuario){
		foreach($usuario->getpersonajes()->getpersonajes() as $personaje){
			if($personaje->getid() == $_GET['personaje']){
				$personajeParaRetornar = $personaje;
			}
		}
		return $personajeParaRetornar;
	}

	function nombreJugador($id){
		$db = new Conexion();
		$reg = $db->query("select nombre from usuario where id = " . $id);
		$nombre = $reg->fetch_array();
		mysqli_close($db);
		return $nombre['nombre'];
	}

	function saliendoPartida($usu, $partida){
		$db = new Conexion();
		$db->query("delete from usu_pj_partida where usuario = " . $usu . " AND partida = " . $partida);
		mysqli_close($db);
		session_destroy($_SESSION['partida']);
	}

	function posicionDeLaFicha($coordenadaX, $coordenadaY){
		$xFinal = null;
		$yFinal = null;
		$numeroX = intval(strval($coordenadaX / 62.5)[0]);
		$numeroY = intval(strval($coordenadaY / 62.5)[0]);


		function posicionFinalX($numero){
			switch ($numero) {
				case 0:
					return 0;
					break;
				case 1:
					return 62;
					break;
				case 2:
					return 124;
					break;
				case 3:
					return 186;
					break;
				case 4:
					return 247;
					break;
				case 5:
					return 309;
					break;
				case 6:
					return 371;
					break;
				case 7:
					return 434;
					break;
				default:
					die("ERROR en coordenadas");
					break;
			}
		}

		function posicionFinalY($numero){
			switch ($numero) {
				case 0:
					return 0;
					break;
				case 1:
					return 62;
					break;
				case 2:
					return 123;
					break;
				case 3:
					return 186;
					break;
				case 4:
					return 248;
					break;
				case 5:
					return 309;
					break;
				case 6:
					return 369;
					break;
				case 7:
					return 432;
					break;
				default:
					die("ERROR en coordenadas");
					break;
			}
		}

		$xFinal = posicionFinalX($numeroX);
		$yFinal = posicionFinalY($numeroY);

		$coordenadas = array($xFinal, $yFinal);
		return $coordenadas;
	}

?>