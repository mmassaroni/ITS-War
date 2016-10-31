<?php 
	require('juego/usuarios.php');
	require('juego/personajes.php');

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