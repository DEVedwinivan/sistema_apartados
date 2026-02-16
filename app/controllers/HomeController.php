<?php 
class HomeController {
    public function index() {
        $productosModel = new UploadproductsModel();
        $productos = $productosModel->getAllProducts();
        Views::render('home/index', ['productos' => $productos]);
    }
}
?>