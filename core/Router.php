<?php
class Router {
    private array $routes = [];
    
    public function get($url, $action){
        $this->routes['GET'][$url] = $action;
    }
    public function post($url, $action){
        $this->routes['POST'][$url] = $action;
    }

    public function run(){
        $method = $_SERVER['REQUEST_METHOD'];
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $basepath = str_replace('\\', '/sistema_apartados/public', dirname($_SERVER['SCRIPT_NAME']));
        $url = str_replace($basepath, '', $url);
        if ($url === '') {
            $url = '/';
        }
        if(isset($this->routes[$method][$url])){
            $action = $this->routes[$method][$url];
            if(is_callable($action)){
                call_user_func($action);
            } elseif(is_string($action)){
                $parts = explode('@', $action);
                $controllerName = $parts[0];
                $methodName = $parts[1];
                
                require_once __DIR__ . '/../app/controllers/' . $controllerName . '.php';
                $controller = new $controllerName();
                $controller->$methodName();
            }
        } else {
            $allowedMethods = [];
            foreach ($this->routes as $routeMethod => $routesByMethod) {
                if (isset($routesByMethod[$url])) {
                    $allowedMethods[] = $routeMethod;
                }
            }

            if (!empty($allowedMethods)) {
                http_response_code(405);
                header('Allow: ' . implode(', ', $allowedMethods));
                Views::render('errors/error_http', [
                    'status_code' => 405,
                    'title' => 'Método no permitido',
                    'message' => 'El método HTTP utilizado no está permitido para esta ruta.'
                ]);
            } else {
                http_response_code(404);
                Views::render('errors/error_http', [
                    'status_code' => 404,
                    'title' => 'Página no encontrada',
                    'message' => 'La página solicitada no existe o fue movida.'
                ]);
            }
        }
    }
}