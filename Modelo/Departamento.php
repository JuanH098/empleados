<?php

class Departamento {

    private  $codigo, $descripcion, $localizacion;

    
    public function __construct( $codigo,  $descripcion,  $localizacion) {
        $this->setCodigo($codigo);
        $this->setDescripcion($descripcion);
        $this->setLocalizacion($localizacion);
    }
    

    public function setCodigo($codigo) {
      
            $this->codigo = $codigo;
        
    }

    public function setDescripcion($descripcion) {
       
            $this->descripcion = $descripcion;
        
        
    }

    public function setLocalizacion($localizacion) {
      
            $this->localizacion = $localizacion;
        
    }
    

    public function getCodigo() {
        return $this->codigo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getLocalizacion() {
        return $this->localizacion;
    }

    
}

?>