<?php
session_start();

require_once "controllers/AuthController.php";
require_once "controllers/ProyectoController.php";
require_once "controllers/UserController.php";
require_once "controllers/ClienteController.php"; 

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Los nombres de este array deben coincidir EXACTAMENTE con los 'case' del switch
$acciones_protegidas = [
    'proyects', 'proyecto-pdf', 'proyecto-create', 'proyecto-edit', 'proyecto-delete',
    'users', 'user-create', 'user-delete',
    'clientes', 'cliente-create', 'cliente-edit', 'cliente-delete'
];

// Si la acción es protegida y no hay sesión iniciada, rebota al login
if (in_array($action, $acciones_protegidas) && !isset($_SESSION['user'])) {
    header("Location: index.php?action=login");
    exit;
}

switch ($action) {
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'register':
        $controller = new AuthController();
        $controller->register(); 
        break;
        
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    // Proyectos (Empleados)
    case 'proyects':
        $controller = new ProyectoController();
        $controller->index();
        break;
    
    case 'proyecto-pdf': 
        $controller = new ProyectoController();
        $controller->exportPDF();
        break;
        
    case 'proyecto-create':
        $controller = new ProyectoController();
        $controller->create();
        break;
        
    case 'proyecto-edit': 
        $controller = new ProyectoController();
        $controller->edit();
        break;
        
    case 'proyecto-delete': 
        $controller = new ProyectoController();
        $controller->delete();
        break;

    // Usuarios
    case 'users':
        $controller = new UserController();
        $controller->index();
        break;
        
    case 'user-create':
        $controller = new UserController();
        $controller->create();
        break;
        
    case 'user-delete':
        $controller = new UserController();
        $controller->delete();
        break;

    // Clientes
    case 'clientes':
        $controller = new ClienteController();
        $controller->index();
        break;
        
    case 'cliente-create':
        $controller = new ClienteController();
        $controller->create();
        break;
        
    case 'cliente-edit':
        $controller = new ClienteController();
        $controller->edit();
        break;
        
    case 'cliente-delete':
        $controller = new ClienteController();
        $controller->delete();
        break;

    default:
        // Evitamos redirecciones infinitas llamando directo al método en vez de usar header()
        $controller = new AuthController();
        $controller->login();
        break;
}