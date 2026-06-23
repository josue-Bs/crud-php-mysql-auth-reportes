<?php
require_once "config/Database.php";
require_once "models/dao/ProyectoDAO.php";
require_once "models/dao/ClienteDAO.php"; 
require_once "models/entities/Proyecto.php"; 
require_once "controllers/AuthController.php";
require_once "libs/fpdf/fpdf.php"; 

class ProyectoController { 
    private $proyectoDAO;
    private $db; // 

    public function __construct() {
        AuthController::checkAuth();
        $database = new Database();
        $this->db = $database->getConnection(); 
        $this->proyectoDAO = new ProyectoDAO($this->db); 
    }

    public function index() {
        $proyectos = $this->proyectoDAO->readAll();
        require_once "views/proyectos/index.php";
    }

    public function create() {
    $database = new Database();
    $db = $database->getConnection(); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $proyecto = new Proyecto($_POST['codigo'], $_POST['nombre'], $_POST['estado'], $_POST['tareas'], $_POST['CodCliente']);
        if ($this->proyectoDAO->create($proyecto)) {
            header("Location: index.php?action=proyects");
            exit;
        }
    }

    require_once "models/dao/ClienteDAO.php"; 
    $clienteDAO = new ClienteDAO($db);
    $listaClientes = $clienteDAO->listarTodos(); 

    require_once "views/proyectos/create.php";
}

    public function edit() {
        $codigo = $_GET['id'];
        $p = $this->proyectoDAO->readOne($codigo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $p->setNombre_Proyecto($_POST['nombre']);  
            $p->setEstado($_POST['estado']);  
            $p->setTareas($_POST['tareas']);   
            $p->setIdCliente($_POST['CodCliente']); 

            if ($this->proyectoDAO->update($p)) {
                header("Location: index.php?action=proyects");
                exit;
            }
        }

        $clienteDAO = new ClienteDAO($this->db);
        $listaClientes = $clienteDAO->listarTodos();

        require_once "views/proyectos/edit.php";
    }

    public function delete() {
        $codigo = $_GET['id'];
        if ($this->proyectoDAO->delete($codigo)) {
            header("Location: index.php?action=proyects");
            exit;
        }
    }

    public function exportPDF() {
    $proyectos = $this->proyectoDAO->readAll();

    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', '16');

    $pdf->Cell(0, 10, utf8_decode('SISTEMA CRUD - REPORTE DE PROYECTOS'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', '10');
    $pdf->Cell(0, 10, 'Fecha de reporte: ' . date('d/m/Y H:i'), 0, 1, 'R');
    $pdf->Ln(5);

    $pdf->SetFillColor(33, 37, 41); 
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', '11');

    // RECALCULADO: Ajustamos los anchos para sumar exactamente 190mm incluyendo Distrito
    // Código(25) + Nombre(65) + Edad(20) + Salario(35) + Distrito(45) = 190mm
    $pdf->Cell(25, 8, utf8_decode('Código'), 1, 0, 'C', true);
    $pdf->Cell(65, 8, utf8_decode('Nombre'), 1, 0, 'L', true);
    $pdf->Cell(20, 8, 'Estado', 1, 0, 'C', true);
    $pdf->Cell(35, 8, 'Tareas', 1, 0, 'R', true);
    $pdf->Cell(45, 8, 'Cliente', 1, 1, 'L', true); // El último lleva '1' para el salto de línea

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', '10');
    
    $fill = false; 
    foreach ($proyectos as $p) {
        $pdf->SetFillColor(245, 245, 245); 
        
        // Dependiendo de qué opción elegiste en el paso anterior para solucionar el error de "private", 
        // aquí llamamos a la propiedad. Usaré la Opción 1 (getNombreDistrito()) que es la más segura:
        $distritoTexto = (method_exists($p, 'getNombreDistrito')) ? $p->getNombreDistrito() : ($p->nombreDistrito ?? 'No asignado');

        // Renderizado de las celdas con las nuevas medidas y el distrito integrado
        $pdf->Cell(25, 7, utf8_decode($p->getCodigo()), 1, 0, 'C', $fill);
        $pdf->Cell(65, 7, utf8_decode($p->getNombre_Proyecto()), 1, 0, 'L', $fill);
        $pdf->Cell(20, 7, $p->getEstado(), 1, 0, 'C', $fill);
        $pdf->Cell(35, 7, $p->getTareas(), 1, 0, 'R', $fill);
        $pdf->Cell(45, 7, utf8_decode($p->getNombreCliente()), 1, 1, 'L', $fill); // Salto de línea al final de la fila
        
        $fill = !$fill; 
    }

    $pdf->Output('I', 'Reporte_Proyectos_' . date('Ymd') . '.pdf');
    exit;
}
}