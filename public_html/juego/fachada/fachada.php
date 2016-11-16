<?php 
	require_once('juego/conexion.php');
	require_once('juego/habilidad.php');
	require_once('juego/habilidades.php');
	require_once('juego/partida.php');
	require_once('juego/partidas.php');
	require_once('juego/personaje.php');
	require_once('juego/personajes.php');
	require_once('juego/potenciador.php');
	require_once('juego/potenciador_partida.php');
	require_once('juego/usu_per_partida.php');
	require_once('juego/usus_pers_partida.php');
	require_once('juego/usuario.php');
	require_once('juego/usuarios.php');

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
		$numeroX = intval((strval($coordenadaX / 62.5))[0]);
		$numeroY = intval((strval($coordenadaY / 62.5))[0]);

		function posicionFinal($numero){
			switch ($numero) {
				case 0:
					return 0;
					break;
				case 1:
					return 62.5;
					break;
				case 2:
					return 125;
					break;
				case 3:
					return 187.5;
					break;
				case 4:
					return 250;
					break;
				case 5:
					return 312.5;
					break;
				case 6:
					return 375;
					break;
				case 7:
					return 437.5;
					break;
				default:
					die("ERROR en coordenadas");
					break;
			}
		}

		$xFinal = posicionFinal($numeroX);
		$yFinal = posicionFinal($numeroY);

		$coordenadas = array($xFinal, $yFinal);
		return $coordenadas
	}

?>