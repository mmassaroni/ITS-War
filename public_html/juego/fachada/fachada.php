<?php 
	require_once('juego/conexion.php');
	require_once('juego/habilidad.php');
	require_once('juego/habilidades.php');
	require_once('juego/partida.php');
	require_once('juego/personaje.php');
	require_once('juego/personajes.php');
	require_once('juego/potenciador.php');
	require_once('juego/potenciador_partida.php');
	require_once('juego/usu_per_partida.php');
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
			//aca va el codigo para armar la partida
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
	

?>