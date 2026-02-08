<main class="container mt-4">
  <?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success" role="alert">Usuario eliminado correctamente.</div>
  <?php elseif (isset($_GET['updated'])): ?>
    <div class="alert alert-success" role="alert">Usuario actualizado correctamente.</div>
  <?php elseif (isset($_GET['error'])): ?>
    <div class="alert alert-danger" role="alert">Ocurrió un error. Inténtalo de nuevo.</div>
  <?php endif; ?>
  <section class="d-flex justify-content-center w-100">
    <table id="usuariosTable" class="table table-striped table-bordered w-100">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Creado en</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $usuario): ?>
          <tr>
            <td><?= htmlspecialchars($usuario['id']) ?></td>
            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
            <td><?= htmlspecialchars($usuario['email']) ?></td> 
            <td><?= htmlspecialchars($usuario['creado_en']) ?></td>
            <td>
              <button class="btn btn-sm btn-primary editarUsuarioBtn" onclick="location.href='/admin/usuarios/editar?id=<?= $usuario['id'] ?>'">Editar</button>
              <form class="d-inline" method="POST" action="/admin/usuarios/eliminar" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">
                <button type="submit" class="btn btn-sm btn-danger eliminarUsuarioBtn">Eliminar</button>
              </form>

            </td>   
          </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
  </section>

</main>