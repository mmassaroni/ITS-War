<?php 

	class habilidad{

		private $id;
		private $personaje;
		private $nombre;
		private $costo_energia;
		private $efecto;
		private $potencia;
		private $tipo;

		public function __construct($id, $personaje, $nombre, $costo_energia, $efecto, $potencia, $tipo){
			$this->id=$id;
			$this->personaje=$personaje;
			$this->nombre=$nombre;
			$this->costo_energia=$costo_energia;
			$this->efecto=$efecto;
			$this->potencia=$potencia;
			$this->tipo=$tipo;
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

		public function getcosto_energia(){
			return $this->costo_energia;
		}

		public function setcosto_energia($costo_energia){
			$this->costo_energia=$costo_energia;
		}

		public function getefecto(){
			return $this->efecto;
		}

		public function setefecto($efecto){
			$this->efecto=$efecto;
		}

		public function getpotencia(){
			return $this->potencia;
		}

		public function setpotencia($potencia){
			$this->potencia=$potencia;
		}

		public function gettipo(){
			return $this->tipo;
		}

		public function settipo($tipo){
			$this->tipo=$tipo;
		}

		// ####################################              cierre de get y set

	}

?>