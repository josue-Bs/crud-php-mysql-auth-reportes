<?php
require_once "config/Database.php";
require_once "models/dao/UserDAO.php";
require_once "models/entities/User.php";
require_once "controllers/AuthController.php";

class UserController {
    private $userDAO;

    public function __construct() {
        AuthController::checkAdmin();
        $database = new Database();
        $db = $database->getConnection();
        $this->userDAO = new UserDAO($db);
    }

    public function index() {
        $users = $this->userDAO->readAll();
        require_once "views/users/index.php";
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User(null, $_POST['username'],
                                   $_POST['email'],
                                   $_POST['password'],
                                   $_POST['rol']);
            if ($this->userDAO->create($user)) {
                header("Location: index.php?action=users");
            }
        }
        require_once "views/users/create.php";
    }

    public function delete() {
        $id = $_GET['id'];
        if ($this->userDAO->delete($id)) {
            header("Location: index.php?action=users");
        }
    }
}
