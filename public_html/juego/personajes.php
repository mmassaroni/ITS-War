<?php 
	require('personaje.php');
	//require('conexion.php');

	class Personajes{
		private $colPersonajes = array();
	
		public static function instanciar_Personajes_Habilidades(){
			$db = new Conexion();
			$personajes=new Personajes();
			//$habilidades=array();

			$registrosPer = $db->query("select * from personaje") or die("ERROR CON LA BD");
			while($registroPer = $registrosPer->fetch_array()){
				$objPer = new Personaje($registroPer["id"], $registroPer["nombre"], $registroPer["imgCuerpo"], $registroPer["imgFicha"], $registroPer["fuerza"], $registroPer["movimiento"], $registroPer["resistencia"], $registroPer["alcance"], $registroPer["vida"], $registroPer["energia"], $registroPer["precio"]);				

				$objPer->setHabilidades(Habilidades::habilidadesPorPj($objPer));
				$personajes->agregarPersonaje($objPer);
				$dosHabilidades = null;
				mysqli_close($db2);
			}
			mysqli_close($db);
			return $personajes;
		} 
		
		public static function personajesDelUsuario($usuario, $personajes){
			$db = new Conexion();
			$pjsDelUsu = new Personajes();
			$registrosPerDelUsu = $db->query("select personaje from usu_tiene_per where usuario=". $usuario->getid()) or die("ERROR CON LA BD");
			while($registro = $registrosPerDelUsu->fetch_array()){
				foreach($personajes as $personaje){
					if($personaje->getid() == $registro[0]){
						$pjsDelUsu->agregarPersonaje($personaje);
					}
				}
			}
			mysqli_close($db);
			return $pjsDelUsu;
		}

		public static function agregarPersonaje($personaje){
			array_push($this->colPersonajes, $personaje);
		}

	}
?>
