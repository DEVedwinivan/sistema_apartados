<main class="container mt-4">
    <section class="d-flex justify-content-center w-100">
        <div class="card w-50">
        <div class="card-header">
            Editar Producto
        </div>
        <div class="card-body">
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">No se pudo guardar. Revisa los datos e inténtalo de nuevo.</div>
            <?php endif; ?>
            <form id="editarProductoForm" method="POST" action="/admin/inventario/update" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
            <div class="mb-3">
                <label for="editarProductoNombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="editarProductoNombre" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required minlength="2" maxlength="255">
            </div>
            <div class="mb-3">
                <label for="editarProductoDescripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="editarProductoDescripcion" name="descripcion" rows="3" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="editarProductoPrecio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="editarProductoPrecio" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" step="0.01" min="0.01" required>
            </div>
            <div class="mb-3">
                <label for="editarProductoStock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="editarProductoStock" name="stock" value="<?= htmlspecialchars($producto['stock']) ?>" min="0" required>
            </div>
            <div class="mb-3">
                <label for="editarProductoImagen" class="form-label">Imagen (dejar en blanco para mantener la actual)</label>
                <input type="file" class="form-control" id="editarProductoImagen" name="imagen" accept=".jpg,.jpeg,.png">
                <div class="form-text">Formatos permitidos: JPG, JPEG, PNG. Tamaño máximo: 5MB</div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="/admin/inventario" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
</section>
</main>