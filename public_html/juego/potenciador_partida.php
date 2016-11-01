<?php 

    class potenciador_partida{
 
        private $partida;
        private $potenciador;
        private $ubicacionx;
        private $ubicaciony;
        private $estado;
 
 
        public function __construct($partida, $potenciador, $ubicacionx, $ubicaciony, $estado){
            $this->partida=$partida;
            $this->potenciador=$potenciador;
            $this->ubicacionx=$ubicacionx;
            $this->ubicaciony=$ubicaciony;
            $this->estado=$estado;
        }
 
        // ####################################                   abre get y set
 
        public function getubicacionx(){
            return $this->ubicacionx;
        }
 
        public function setubicacionx($ubicacionx){
            $this->ubicacionx=$ubicacionx;
        }
 
        public function getubicaciony(){
            return $this->ubicaciony;
        }
 
        public function setubicaciony($ubicaciony){
            $this->ubicaciony=$ubicaciony;
        }
        public function getestado(){
            return $this->estado;
        }
 
        public function setestado($estado){
            $this->estado=$estado;
        }
        
        public function getpartida (){
            return $this->partida;
        }

        public function setpartida($partida){
            $this->partida=$partida;
        }
        public function getpotenciador(){
            return $this->potenciador;
        }

        public function setpotenciador($potenciador){
            $this->potenciador=$potenciador;
        }
 
        // ####################################              cierre de get y set
 
    }
 
?>