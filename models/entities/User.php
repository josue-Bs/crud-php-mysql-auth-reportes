<?php
class User {
    private $id;
    private $username;
    private $email; 
    private $password;
    private $rol;

    
    public function __construct($id = null, $username = null, $email = null, $password = null, $rol = null) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getUsername() { return $this->username; }
    public function setUsername($username) { $this->username = $username; }

    public function getEmail() { return $this->email; } 
    public function setEmail($email) { $this->email = $email; } 

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }

    public function getRol() { return $this->rol; }
    public function setRol($rol) { $this->rol = $rol; }
}