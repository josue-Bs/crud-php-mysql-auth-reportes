<?php

class Cliente {

  private $codigo;
  private $nombre;
  private $ruc;
  private $telefono;


  public function __construct($codigo = null, $nombre = null, $ruc = null, $telefono = null) {

    $this->codigo = $codigo;

    $this->nombre = $nombre;

    $this->ruc = $ruc;

    $this->telefono = $telefono;

    
  }


  public function getCodigo() { return $this->codigo; }

  public function setCodigo($codigo) { $this->codigo = $codigo; }


  public function getNombre() { return $this->nombre; }

  public function setNombre($nombre) { $this->nombre = $nombre; }



  public function getRuc() { return $this->ruc; }

  public function setRuc($ruc) { $this->ruc = $ruc; }


  public function getTelefono() { return $this->telefono; }

  public function setTelefono($telefono) { $this->telefono = $telefono; }
}

