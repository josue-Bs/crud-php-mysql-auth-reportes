<?php
require_once "models/entities/User.php";

class UserDAO {
    private $conn;
    private $table_name = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && password_verify($password, $row['password'])) {
            return new User($row['id'], $row['username'], $row['email'], $row['password'], $row['rol']);
        }
        return null;
    }

    public function readAll() {
        $query = "SELECT id, username, email, password, rol FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($row['id'], $row['username'], $row['email'], $row['password'], $row['rol']);
        }
        return $users;
    }

    public function create(User $user) {
    $query = "INSERT INTO " . $this->table_name . " (username, email, password, rol) VALUES (:username, :email, :password, :rol)";
    $stmt = $this->conn->prepare($query);
    
    
    $stmt->bindValue(":username", $user->getUsername());
    $stmt->bindValue(":email", $user->getEmail());
    
    $stmt->bindValue(":password", password_hash($user->getPassword(), PASSWORD_BCRYPT));
    $stmt->bindValue(":rol", $user->getRol());

    
    if ($stmt->execute()) {
        return true;
    } else {
        
         
        return false;
    }
}

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    
}
