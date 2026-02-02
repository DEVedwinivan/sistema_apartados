<?php
Class AuthModel {
    private PDO $db;

    public function __construct(){
        $this->db = db::dbConnect();
    }
    public function findByEmail(string $email): ?array{
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ?: null;
    }
    public function login(string $email, string $password): ?array{
        $user = $this->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return null;
        }
        return $user;
    }

    public function register(array $data): bool{
        $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, 'cliente')");

        return $stmt->execute([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }
}


?>