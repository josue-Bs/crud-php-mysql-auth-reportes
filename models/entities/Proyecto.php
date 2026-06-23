<?php
class Proyecto {
   
    private $codProyecto;
    private $nombre_proyecto;
    private $estado;
    private $tareas;
    private $idCliente;
    private $nombreCliente; 

    
    public function __construct($codProyecto = null, $nombre_proyecto = null, $estado = null, $tareas = null, $idCliente = null) {
        $this->codProyecto = $codProyecto;
        $this->nombre_proyecto = $nombre_proyecto;
        $this->estado = $estado;
        $this->tareas = $tareas;
        $this->idCliente = $idCliente;
    }

    public function getCodigo() { 
        return $this->codProyecto; 
    }
    
    public function setCodigo($codProyecto) { 
        $this->codProyecto = $codProyecto; 
    }

    public function getNombre_Proyecto() { 
        return $this->nombre_proyecto; 
    }
    
    public function setNombre_Proyecto($nombre_proyecto) { 
        $this->nombre_proyecto = $nombre_proyecto; 
    }

    public function getEstado() { 
        return $this->estado; 
    }

    public function setEstado($estado) { 
        $this->estado = $estado; 
    }
    public function getTareas() { 
        return $this->tareas; 
    }
    public function setTareas($tareas) { 
        $this->tareas = $tareas; 
    }
    public function getIdCliente() { 
        return $this->idCliente; 
    }
    public function setIdCliente($idCliente) { 
        $this->idCliente = $idCliente; 
    }

    public function getNombreCliente() {
        return $this->nombreCliente;
    }

    public function setNombreCliente($nombreCliente) {
        $this->nombreCliente = $nombreCliente;
    }
}