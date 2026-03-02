<?php
class DashModel {
    private PDO $db;

    public function __construct() {
        $this->db = db::dbConnect();
    }

    //Cuanta total de productos 
    public function getTotalProducts(): int {
        $stmt = $this->db->query("SELECT COUNT(*) FROM productos WHERE activo = 1");
        return (int)$stmt->fetchColumn();
    }

    // Productos con stock bajo 
    public function getLowStockProducts(): array {
        $stmt = $this->db->query("SELECT nombre, stock FROM productos WHERE stock < 5 AND activo = 1 ORDER BY stock ASC LIMIT 5");
        return $stmt->fetchAll();
    }

    // Total de apartados activos
    public function getActiveApartados(): int {
        $stmt = $this->db->query("SELECT COUNT(*) FROM apartados WHERE estado = 'confirmado'");
        return (int)$stmt->fetchColumn();
    }
}

?>