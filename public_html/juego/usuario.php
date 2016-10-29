<?php 
	require('conexion.php');
	class Usuario{

		private $id;
		private $nombre;
		private $email;
		private $pass;
		private $estado;
		private $plata;

		public function __construct($id=null, $nombre=null, $email=null, $pass, $estado=null, $plata=null){
			$this->id=$id;
			$this->nombre=$nombre;
			$this->email=$email; 
			$this->pass=$pass;
			$this->estado=$estado;
			$this->plata=$plata;
		}

		// ####################################                   abre get y set

		public function getid(){
			return $this->id;
		}

		public function setid($id){
			$this->id=$id;
		}

		public function getnombre(){
			return $this->nombre;
		}

		public function setnombre($nombre){
			$this->nombre=$nombre;

		}

		public function getemail(){
			return $this->email;
		}

		public function setemail($email){
			$this->email=$email;
		}

		public function getpass(){
			return $this->pass;
		}

		public function setpass($pass){
			$this->pass=$pass;
		}

		public function getestado(){
			return $this->estado;
		}

		public function setestado($estado){
			$this->estado=$estado;
		}
		public function getplata(){
			return $this->plata;
		}

		public function setplata($plata){
			$this->plata=$plata;
		}
		// ####################################              cierre de get y set

		public static function login($usu_email, $pass){
			$db = new Conexion();
			$sql = $db->query("select * from usuario where email = '" . $usu_email . "' and pass = '" . $pass . "' or nombre ='". $usu_email ."' and pass = '". $pass ."'") or die(header('Location:sesion.php?error=1'));
			$datos = $db->recorrer($sql);

			if ((($datos['email'] == $usu_email AND $datos['pass'] == $pass) OR ($datos['nombre'] == $usu_email AND $datos['pass'] == $pass)) AND !empty($datos)) {
				session_start();
				$_SESSION['objUsu'] = new Usuario($datos['id'], $datos['nombre'], $datos['email'], $datos['pass'], $datos['estado'], $datos['plata']);
				mysqli_close($db);
				header('Location:game.php');
			} else {
				header("Location:sesion.php?&error=1");
			}
		}

		public static function registro($user, $email, $pass){
			$db = new Conexion();
			$sql = $db->query("insert into usuario (nombre, pass, email, plata, estado) values ('". $user ."', '". $pass ."', '". $email ."', 30, 'desconectado')") or die(header('Location:sesion.php?error=2'));
			session_start();
			$_SESSION['objUsu'] = new Usuario(mysqli_INSERT_ID($db), $user, $email, $pass, 'desconectado', 30);
			mysqli_close($db);
			header("Location:game.php");
		}

		public function actualizar(){
			$db = new Conexion();
			$sql = $db->query("update usuario set nombre = '". $this->nombre ."', pass = '". $this->pass ."', email = '". $this->email ."', estado = '". $this->estado ."', plata = ". $this->plata .""); or die("ERROR CON LA BD");
			mysqli_close($db);
		}
	
	}

?>