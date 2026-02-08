<main class="container mt-4">
    <section class="d-flex justify-content-center w-100">
        <div class="card w-50">
        <div class="card-header">
            Editar Usuario
        </div>
        <div class="card-body">
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">No se pudo guardar. Revisa los datos e inténtalo de nuevo.</div>
            <?php endif; ?>
            <form id="editarUsuarioForm" method="POST" action="/admin/usuarios/update">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">
            <div class="mb-3">
                <label for="editarUsuarioNombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="editarUsuarioNombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required minlength="2" maxlength="100">
            </div>
            <div class="mb-3">
                <label for="editarUsuarioEmail" class="form-label">Correo</label>
                <input type="email" class="form-control" id="editarUsuarioEmail" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required maxlength="150">
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <button type="button" class="btn btn-secondary" onclick="location.href='/admin/usuarios'">Cancelar</button>
            </form>
        </div>
        </div>
    </section>
</main>