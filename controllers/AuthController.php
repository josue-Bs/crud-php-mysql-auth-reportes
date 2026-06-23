<?php
require_once "config/Database.php";
require_once "models/dao/UserDAO.php";

class AuthController {
    private $userDAO;

    // Agrega esto dentro de tu clase AuthController

    public function register() {
        // Si el usuario ya inició sesión, no tiene sentido que se registre de nuevo; lo mandamos a productos
        if (isset($_SESSION['user'])) {
            header("Location: index.php?action=proyects");
            exit;
        }

        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password']; 
            $rol = $_POST['rol'];

            // Validamos que no viajen datos vacíos
            if (!empty($username) && !empty($email) && !empty($password) && !empty($rol)) {
                
                // Creamos el objeto User con los 5 campos en orden (id se envía como null porque la BD lo autogenera)
                $nuevoUsuario = new User(null, $username, $email, $password, $rol);

                // Invocamos el método create() que ya tienes listo en tu UserDAO
                if ($this->userDAO->create($nuevoUsuario)) {
                    // Si todo sale bien, lo mandamos al login con un aviso en la URL
                    header("Location: index.php?action=login&registered=success");
                    exit;
                } else {
                    $error = "Error: El nombre de usuario o correo ya existen en el sistema.";
                }
            } else {
                $error = "Por favor, completa todos los campos requeridos.";
            }
        }

        // Si es una petición GET, simplemente mostramos el formulario que creamos arriba
        require_once "views/auth/register.php";
    }

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->userDAO = new UserDAO($db);
    }

    public function login() {
        if (isset($_SESSION['user'])) {
            header("Location: index.php?action=proyects");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userDAO->login($username, $password);
            if ($user) {
                $_SESSION['user'] = $user->getUsername();
                $_SESSION['rol'] = $user->getRol();
                header("Location: index.php?action=proyects");
                exit;
            } else {
                $error = "Credenciales incorrectas";
            }
        }
        require_once "views/auth/login.php";
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit;
    }

    public static function checkAuth() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit;
        }
    }

    public static function checkAdmin() {
        self::checkAuth();
        if ($_SESSION['rol'] !== 'administrador') {
            die("Acceso denegado: Requiere rol de Administrador.");
        }
    }
}
