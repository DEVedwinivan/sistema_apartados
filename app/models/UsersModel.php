<?php 
class UsersModel {
    private PDO $db;
    public function __construct(){
        $this->db = db::dbConnect();
    }
    public function getAllUsers(): array{
        $stmt = $this->db->prepare("SELECT id, nombre, email, creado_en FROM usuarios");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getUserById(int $id): ?array{
        $stmt = $this->db->prepare("SELECT id, nombre, email FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
    public function updateUser(int $id, string $nombre, string $email): bool{
        $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
        return $stmt->execute([$nombre, $email, $id]);
    }
    public function deleteUser(int $id): bool{
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}