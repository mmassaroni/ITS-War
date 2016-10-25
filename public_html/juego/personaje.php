<?php 

	include_once "habilidad.php";

	class personaje{

		private $id;
		private $nombre;
		private $precio;
		private $imgCuerpo;
		private $imgFicha;
		private $fuerza;
		private $movimiento;
		private $resistencia;
		private $alcance;
		private $vida;
		private $energia;
		private $habilidad;

		public function __construct($id, $nombre, $imgCuerpo, $imgFicha, $fuerza, $movimiento, $resistencia, $alcance, $vida, $energia){
			$this->id=$id;
			$this->nombre=$nombre;
			$this->precio=$precio;
			$this->imgCuerpo=$imgCuerpo;
			$this->imgFicha=$imgFicha;
			$this->fuerza=$fuerza;
			$this->movimiento=$movimiento;
			$this->resistencia=$resistencia;
			$this->alcance=$alcance;
			$this->vida=$vida;
			$this->energia=$energia;
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

		public function getprecio(){
			return $this->$precio;
		}

		public function setid($precio){
			$this->precio=$precio;
		}

		public function getimgCuerpo(){
			return $this->imgCuerpo;
		}

		public function setimgCuerpo($imgCuerpo){
			$this->imgCuerpo=$imgCuerpo;
		}	

		public function getimgFicha(){
			return $this->imgFicha;
		}

		public function setimgFicha($imgFicha){
			$this->imgFicha=$imgFicha;
		}

		public function getfuerza(){
			return $this->fuerza;
		}

		public function setfuerza($fuerza){
			$this->fuerza=$fuerza;
		}

		public function getmovimiento(){
			return $this->movimiento;
		}

		public function setmovimiento($movimiento){
			$this->movimiento=$movimiento;
		}

		public function getresistencia(){
			return $this->resistencia;
		}

		public function setresistencia($resistencia){
			$this->resistencia=$resistencia;
		}

		public function getalcance(){
			return $this->alcance;
		}

		public function setalcance($alcance){
			$this->alcance=$alcance;
		}

		public function getvida(){
			return $this->vida;
		}

		public function setvida($vida){
			$this->vida=$vida;
		}

		public function getenergia(){
			return $this->energia;
		}

		public function setenergia($energia){
			$this->energia=$energia;
		}

		// ####################################               cierre de get y set

	}

?>