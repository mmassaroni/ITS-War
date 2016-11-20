<?php
	class Conexion extends mysqli{
		public function __construct(){
			//itswar.esy.es
			//parent::__construct('mysql.hostinger.com.ar', 'u775405038_root', 'comoeslacontrasena', 'u775405038_cami');
			//itswar.96.lt
			//parent::__construct('mysql.hostinger.com.ar', 'u851053330_root', 'comoeslacontrasena', 'u851053330_cami');
			//itswar.hol.es
			parent::__construct('mysql.hostinger.com.ar', 'u685617985_root', 'comoeslacontrasena', 'u685617985_cami');
			$this->query("SET NAMES 'utf8';");
			$this->connect_errno ? die('Error con la conexión') : $x = 'Conectado';
			unset($x);
		}
		public function recorrer($sql){
			return mysqli_fetch_array($sql);
		}
	}



?>