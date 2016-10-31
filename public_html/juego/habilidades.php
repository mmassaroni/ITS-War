<?php  
	require('habilidad.php');

	class habilidades{

		public static function habilidadesPorPj($personaje);
			$db2 = new Conexion();
			$registrosHab = $db2->query("select h.* from habilidad h, personaje p where p.id = h.personaje and p.id = ". $personaje->getid()) or die("ERROR CON LA BD");
			$dosHabilidades = array();
			while($registroHab = $registrosHab->fetch_array()){
				$objHab = new Habilidad($registroHab['id'], $registroHab['personaje'], $registroHab['nombre'], $registroHab['costo_energia'], $registroHab['efecto'], $registroHab['potencia'], $registroHab['tipo']);
				//array_push($habilidades, $objHab);
				array_push($dosHabilidades, $objHab);
			}
			return $dosHabilidades;
	}
?>
