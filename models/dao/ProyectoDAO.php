<?php
require_once "models/entities/Proyecto.php";

class ProyectoDAO {
    private $conn;
    private $table_name = "proyectos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
    $query = "SELECT p.*, c.nombre AS nombreCliente
FROM proyectos p
LEFT JOIN clientes c ON p.idCliente = c.codCliente";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $proyectos = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $proyecto = new Proyecto(
            $row['codProyecto'],
            $row['nombre_proyecto'],
            $row['estado'],
            $row['tareas'],
            $row['idCliente']
        );

        $proyecto->setNombreCliente($row['nombreCliente']);

        $proyectos[] = $proyecto;
    }

    return $proyectos;
}

    public function create(Proyecto $proyecto) {
        
        $query = "INSERT INTO " . $this->table_name . " (codProyecto, nombre_proyecto, estado, tareas, idCliente) 
                  VALUES (:codProyecto, :nombre_proyecto, :estado, :tareas, :idCliente)";
        $stmt = $this->conn->prepare($query);
        
        
        $codigo = $proyecto->getCodigo();
        $nombre = $proyecto->getNombre_Proyecto();
        $estado = $proyecto->getEstado();
        $tareas = $proyecto->getTareas();
        $idCliente = $proyecto->getIdCliente();

        $stmt->bindParam(":codProyecto", $codigo);
        $stmt->bindParam(":nombre_proyecto", $nombre);
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":tareas", $tareas);
        $stmt->bindParam(":idCliente", $idCliente);

        return $stmt->execute();
    }

    public function readOne($codigo) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE codProyecto = :codProyecto LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":codProyecto", $codigo);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            
            return new Proyecto($row['codProyecto'], $row['nombre_proyecto'], $row['estado'], $row['tareas'], $row['idCliente']);
        }
        return null;
    }

    public function update(Proyecto $proyecto) {
        
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre_proyecto = :nombre_proyecto, estado = :estado, tareas = :tareas, idCliente = :idCliente 
                  WHERE codProyecto = :codProyecto";
        $stmt = $this->conn->prepare($query);

        $nombre = $proyecto->getNombre_Proyecto();
        $estado = $proyecto->getEstado();
        $tareas = $proyecto->getTareas();
        $idCliente = $proyecto->getIdCliente();
        $codProyecto = $proyecto->getCodigo();

        $stmt->bindParam(":nombre_proyecto", $nombre);
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":tareas", $tareas);
        $stmt->bindParam(":idCliente", $idCliente);
        $stmt->bindParam(":codProyecto", $codProyecto);

        return $stmt->execute();
    }

    public function delete($codigo) {
        $query = "DELETE FROM " . $this->table_name . " WHERE codProyecto = :codProyecto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":codProyecto", $codigo);
        $return = $stmt->execute();
        return $return;
    }
}