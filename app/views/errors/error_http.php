<?php
  $code = isset($status_code) ? (int)$status_code : (int)http_response_code();
  $defaultMessages = [
      400 => ['Solicitud incorrecta', 'La solicitud no pudo procesarse.'],
      401 => ['No autorizado', 'Necesitas iniciar sesión para continuar.'],
      403 => ['Acceso denegado', 'No tienes permisos para acceder a esta sección.'],
      404 => ['Página no encontrada', 'La página solicitada no existe o fue movida.'],
      405 => ['Método no permitido', 'El método HTTP utilizado no está permitido para esta ruta.'],
      419 => ['Sesión expirada', 'Tu sesión expiró. Vuelve a intentarlo.'],
      422 => ['Datos inválidos', 'Los datos enviados no son válidos.'],
      500 => ['Error interno', 'Ocurrió un error inesperado en el servidor.'],
      503 => ['Servicio no disponible', 'El servicio no está disponible temporalmente.']
  ];
  $title = $title ?? ($defaultMessages[$code][0] ?? 'Error');
  $message = $message ?? ($defaultMessages[$code][1] ?? 'Ocurrió un error inesperado.');
?>

<div class="container vh-100 d-flex align-items-center justify-content-center">
  <div class="text-center">
    <h1 class="display-1 fw-bold error_title"><?= htmlspecialchars((string)$code) ?></h1>

    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
      <path d="M7.938 2.016a.13.13 0 0 1 .125 0l6.857 11.856c.027.047.027.106 0 .153a.13.13 0 0 1-.125.07H1.205a.13.13 0 0 1-.125-.07.14.14 0 0 1 0-.153L7.938 2.016zM8 4.58a.5.5 0 0 0-.5.5v4.5a.5.5 0 0 0 1 0v-4.5a.5.5 0 0 0-.5-.5zm.002 7a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z"/>
    </svg>

    <p class="lead fw-semibold mt-3 mb-1"><?= htmlspecialchars($title) ?></p>
    <p class="lead text-muted mb-4"><?= htmlspecialchars($message) ?></p>

    <div class="d-flex gap-2 justify-content-center">
      <button type="button" class="btn btn-outline-secondary" onclick="history.back();">Volver</button>
      <a href="/" class="btn btn_errors">Ir al inicio</a>
    </div>
  </div>
</div>
