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
			$pjElegido = datosPjElegido($usuario);
			$_SESSION['partida'] = Partidas::buscarPartida($usuario, $pjElegido);
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

	}
	
	function datosPjElegido($usuario){
		foreach($usuario->getpersonajes()->getpersonajes() as $personaje){
			if($personaje->getid() == $_GET['personaje']){
				$personajeParaRetornar = $personaje;
			}
		}
		return $personajeParaRetornar;
	}

?>