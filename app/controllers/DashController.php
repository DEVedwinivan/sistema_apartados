<?php 
class DashController {
    private $model;

    public function __construct(){
        $this->model = new DashModel();
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'admin') {
            http_response_code(403);
            Views::render('errors/error_http', [
                'status_code' => 403,
                'title' => 'Acceso denegado',
                'message' => 'No tienes permisos para acceder a esta sección.'
            ]);
            exit;
        }
    }
    public function index(){
        $data = [
            'totalProductos' => $this->model->getTotalProducts(),
            'productosStockBajo' => $this->model->getLowStockProducts(),
            'apartadosActivos' => $this->model->getActiveApartados(),
            'csrf_token' => $_SESSION['csrf_token']
        ];
        Views::render('admin/dashboard/index', $data);
    }
}

?>