<?php
	class Conexion extends mysqli{
		public function __construct(){
			parent::__construct('mysql.hostinger.com.ar', 'u851053330_root', 'comoeslacontrasena', 'u851053330_cami');
			$this->query("SET NAMES 'utf8';");
			$this->connect_errno ? die('Error con la conexión') : $x = 'Conectado';
			unset($x);
		}
		public function recorrer($sql){
			return mysqli_fetch_array($sql);
		}
	}



?>