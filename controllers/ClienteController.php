<?php
// controllers/ClienteController.php

// 1. Importamos tu archivo de base de datos original
require_once "config/Database.php"; 

// 2. Importamos tu DAO de clientes (verifica si está suelto o dentro de /dao/)
require_once "models/dao/ClienteDAO.php"; 

class ClienteController {
    private $clienteDAO;

    public function __construct() {
        //Instanciamos la clase Database como un objeto
        $database = new Database();
        
        // Obtenemos la conexión PDO activa. 
        
        $db = $database->getConnection(); 
        
        $this->clienteDAO = new ClienteDAO($db);
    }

    // Vista Principal
    public function index() {
        $clientes = $this->clienteDAO->listarTodos();
        require_once "views/clientes/index.php";
    }

    // Crear
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cod = $_POST['codCliente'];
            $nom = $_POST['nombre'];
            $ruc = $_POST['ruc'];
            $telefono = $_POST['telefono'];
            
            // Validación básica de duplicados
            if ($this->clienteDAO->obtenerPorCodigo($cod)) {
                echo "<script>alert('El código de cliente ya existe'); window.history.back();</script>";
                exit;
            }

            if ($this->clienteDAO->crear($nom, $cod, $ruc, $telefono)) {
                header("Location: index.php?action=clientes");
                exit;
            }
        }
        require_once "views/clientes/create.php";
    }

    // Editar
    public function edit() {
        $id = $_GET['id'] ?? null;
        $cliente = $this->clienteDAO->obtenerPorCodigo($id);

        if (!$cliente) {
            header("Location: index.php?action=clientes");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nombre'];
            $ruc = $_POST['ruc'];
            $telefono = $_POST['telefono'];
            if ($this->clienteDAO->actualizar($id, $nom, $ruc, $telefono)) {
                header("Location: index.php?action=clientes");
                exit;
            }
        }
        require_once "views/clientes/edit.php";
    }

    // Eliminar
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->clienteDAO->eliminar($id);
        }
        header("Location: index.php?action=clientes");
        exit;
    }
}