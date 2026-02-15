<?php 
class UploadproductsModel {
    private PDO $db;
    
    public function __construct(){
        $this->db = db::dbConnect();
    }
    
    public function createProduct(string $titulo, string $descripcion, float $precio, int $stock, string $imagen): bool {
        $stmt = $this->db->prepare("INSERT INTO productos (nombre, descripcion, precio, stock, imagen, activo, creado_en) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$titulo, $descripcion, $precio, $stock, $imagen, 1, date('Y-m-d H:i:s')]);
    }
    
    public function getAllProducts(): array {
        $stmt = $this->db->prepare("SELECT id, nombre, descripcion, precio, imagen, creado_en FROM productos ORDER BY creado_en DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getProductById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT id, nombre, descripcion, precio, imagen FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
