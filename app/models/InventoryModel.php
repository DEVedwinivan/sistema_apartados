<?php
class InventoryModel{
    private PDO $db;
    public function __construct()
    {
        $this->db = db::dbConnect();
    }
    public function getAllProducts(): array{
        $stmt = $this->db->prepare("SELECT * FROM productos");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getProductById(int $id): ?array{
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
    public function updateProduct(int $id, array $data): bool{
        $fields = [];
        $values = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }
        $values[] = $id; // Para la cláusula WHERE
        $sql = "UPDATE productos SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }
}

?>