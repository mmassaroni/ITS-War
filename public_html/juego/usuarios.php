<?php 

	class Usuarios{

		public static function login($usu_email, $pass){
			$db = new Conexion();
			$sql = $db->query("select * from usuario where email = '" . $usu_email . "' and pass = '" . $pass . "' or nombre ='". $usu_email ."' and pass = '". $pass ."'") or die(header('Location:sesion.php?error=1'));
			$datos = $db->recorrer($sql);

			if ((($datos['email'] == $usu_email AND $datos['pass'] == $pass) OR ($datos['nombre'] == $usu_email AND $datos['pass'] == $pass)) AND !empty($datos)) {
				$usuario = new Usuario($datos['id'], $datos['nombre'], $datos['email'], $datos['pass'], $datos['estado'], $datos['plata']);
				mysqli_close($db);
				return $usuario;
			} else {
				die(header("Location:sesion.php?error=1"));
			}
		}

		public static function registro($user, $email, $pass){
			$db = new Conexion();
			$sql = $db->query("insert into usuario(nombre, pass, email, plata, estado) values ('". $user ."', '". $pass ."', '". $email ."', 30, 'desconectado')") or die(header('Location:sesion.php?error=2'));
			$usuario = new Usuario(mysqli_INSERT_ID($db), $user, $email, $pass, 'desconectado', 30);

			$db2 = new Conexion();
			$registrosPjsPrecio0 = $db2->query("select id from personaje where precio = 0") or die("ERROR CON LA BD");
			while($registroPer = $registrosPjsPrecio0->fetch_array()){
				$db3 = new Conexion();
				$sql3= $db3->query("insert into usu_tiene_per(usuario, personaje) values(". mysqli_INSERT_ID($db) .", ". $registroPer['id'] .")") or die("ERROR CON LA BD");
				mysqli_close($db3);
			}
			
			mysqli_close($db);
			mysqli_close($db2);
			return $usuario;
		}

		public static function actualizar($usuario){
			$db = new Conexion();
			$sql = $db->query("update usuario set nombre = '". $usuario->getnombre() ."', pass = '". $usuario->getpass() ."', email = '". $usuario->getemail() ."', estado = '". $usuario->getestado() ."', plata = ". $usuario->getplata() ." where id = ". $usuario->getid() ."") or die("ERROR CON LA BD");
			mysqli_close($db);
		}
	}


?>