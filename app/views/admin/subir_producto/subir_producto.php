<main>
    <section class="container mt-4">
        <h2 class="text-center mb-4">Subir Productos</h2>
        <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success text-center" role="alert">Producto subido correctamente.</div>
        <?php elseif (isset($_GET['error'])): ?>
            <?php 
            $errorMessages = [
                'csrf' => 'Token de seguridad inválido. Por favor, intenta de nuevo.',
                'validation' => 'Datos incompletos o inválidos. Verifica todos los campos.',
                'upload' => 'Error al subir la imagen. Por favor, selecciona un archivo.',
                'size' => 'La imagen excede el tamaño máximo permitido de 5MB.',
                'type' => 'Tipo de archivo no permitido. Solo se aceptan JPG, JPEG y PNG.',
                'extension' => 'Extensión de archivo no válida.',
                'move' => 'Error al guardar la imagen en el servidor.',
                'database' => 'Error al guardar el producto en la base de datos.'
            ];
            $error = $_GET['error'];
            $message = $errorMessages[$error] ?? 'Ocurrió un error al subir el producto. Inténtalo de nuevo.';
            ?>
        <div class="alert alert-danger text-center" role="alert"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <form action="/admin/upload_products" method="POST" enctype="multipart/form-data" class="d-flex flex-column align-items-center gap-3" id="formProducto">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
        <div class="mb-3 w-50">
            <label for="titulo" class="form-label">Título del producto:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" maxlength="255" required>
        </div>
        <div class="mb-3 w-50">
            <label for="descripcion" class="form-label">Descripción del producto:</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3 w-50">
            <label for="precio" class="form-label">Precio del producto:</label>
            <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0.01" required>
        </div>
        <div class="mb-3 w-50">
            <label for="stock" class="form-label">Stock del producto:</label>
            <input type="number" class="form-control" id="stock" name="stock" min="1" required>
        </div>
        <div class="mb-3 w-50">
            <label for="img_product" class="form-label">Selecciona una imagen del producto (máx. 5MB):</label>
            <input type="file" class="form-control" id="img_product" name="img_product" accept=".jpg,.jpeg,.png" required>
            <div class="form-text">Formatos permitidos: JPG, JPEG, PNG. Tamaño máximo: 5MB</div>
        </div>
        <button type="submit" class="btn btn_product">Subir Producto</button>
        </form>
    </section>
</main>

<script>
document.getElementById('formProducto').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('img_product');
    const precio = document.getElementById('precio');
    const maxSize = 5 * 1024 * 1024; // 5MB
    const stock = document.getElementById('stock');
    
    // Validar archivo
    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        
        // Validar tamaño
        if (file.size > maxSize) {
            e.preventDefault();
            alert('La imagen excede el tamaño máximo de 5MB');
            return false;
        }
        
        // Validar extensión
        const allowedExtensions = ['jpg', 'jpeg', 'png'];
        const fileName = file.name.toLowerCase();
        const extension = fileName.split('.').pop();
        
        if (!allowedExtensions.includes(extension)) {
            e.preventDefault();
            alert('Solo se permiten archivos JPG, JPEG o PNG');
            return false;
        }
    }
    
    // Validar precio
    if (parseFloat(precio.value) <= 0) {
        e.preventDefault();
        alert('El precio debe ser mayor a 0');
        return false;
    }

    if (parseInt(stock.value) <= 0) {
        e.preventDefault();
        alert('El stock debe ser mayor a 0');
        return false;
    }
});
</script>