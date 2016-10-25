<?php 
     
     
    class potenciador{
 
        private $id;
        private $nombre;
        private $potencia;
        private $efecto;
        private $foto;
 
 
        public function __construct($id, $nombre, $potencia, $efecto, $foto){
            $this->id=$id;
            $this->nombre=$nombre;
            $this->potencia=$potencia;
            $this->efecto=$efecto;
            $this->foto=$foto;
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
 
        public function getpotencia(){
            return $this->potencia;
        }
 
        public function setpotencia($potencia){
            $this->potencia=$potencia;
        }
 
        public function getefecto(){
            return $this->efecto;
        }
 
        public function setefecto($efecto){
            $this->efecto=$efecto;
        }
        public function getfoto(){
            return $this->foto;
        }
 
        public function setfoto($foto){
            $this->foto=$foto;
        }
 
 
        // ####################################              cierre de get y set
 
    }
 
?>