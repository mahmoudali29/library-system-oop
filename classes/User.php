<?php
require_once __DIR__ . '/../config.php';

class User {
    protected $id;
    protected $name;
    protected $email;
    protected $role;
    protected $pdo; // This will NOT be serialized

    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function __construct($id,$name, $email, $role) {
        global $pdo;
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->pdo = $pdo;
    }

    public function register($password) {
        // Check if email already exists
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$this->email]);
        $count = $stmt->fetchColumn();
    
        if ($count > 0) {
            return "Error: This email is already registered!";
        }
    
        // Hash password and insert new user
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        
        if ($stmt->execute([$this->name, $this->email, $hashedPassword, $this->role])) {
            return "Success: User registered successfully!";
        } else {
            return "Error: Registration failed!";
        }
    }

    public static function login($email, $password) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return new self($user['id'],$user['name'], $user['email'], $user['role']);
        }
        return null;
    }


    // Prevent serialization of PDO
    public function __sleep() {
        return ['id', 'name', 'email', 'role']; // Exclude $pdo
    }

    public function __wakeup() {
        global $pdo;
        $this->pdo = $pdo; // Restore PDO when unserializing
    }
}
?>
