<?php 

	class Habilidades{
		private $colHabilidades = array();

		public function gethabilidades(){
			return $this->colHabilidades;
		}

		public function sethabilidades($habilidades){
			$this->colHabilidades=$habilidades;
		}

		public static function habilidadesPorPj($personaje){
			$db2 = new Conexion();
			$registrosHab = $db2->query("select h.* from habilidad h, personaje p where p.id = h.personaje and p.id = ". $personaje->getid()) or die("ERROR CON LA BD");
			$dosHabilidades = new Habilidades();
			while($registroHab = $registrosHab->fetch_array()){
				$objHab = new Habilidad($registroHab['id'], $registroHab['personaje'], $registroHab['nombre'], $registroHab['costo_energia'], $registroHab['efecto'], $registroHab['potencia'], $registroHab['tipo']);
				//array_push($habilidades, $objHab);
				$dosHabilidades->agregarHabilidad($objHab);
			}
			mysqli_close($db2);
			return $dosHabilidades;
		}

		public function agregarHabilidad($habilidad){
			array_push($this->colHabilidades, $habilidad);
		}
	}
?>
