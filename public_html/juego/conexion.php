<?php
	class Conexion extends mysqli{
		public function __construct(){
			parent::__construct('mysql.hostinger.com.ar', 'u775405038_root', 'comoeslacontraseña', 'u775405038_cami');
			$this->query("SET NAMES 'utf8';");
			$this->connect_errno ? die('Error con la conexión') : $x = 'Conectado';
			echo $x;
			unset($x);
		}
		public function recorrer($sql){
			return mysqli_fetch_array($sql);
		}
	}



?>