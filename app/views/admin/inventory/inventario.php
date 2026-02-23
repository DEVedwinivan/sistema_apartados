<main class="container mt-4">
    <?php if (isset($_GET['success']) && $_GET['success'] === 'updated'): ?>
        <div class="alert alert-success text-center" role="alert">Producto actualizado correctamente.</div>
    <?php elseif (isset($_GET['error']) && $_GET['error'] === 'update'): ?>
        <div class="alert alert-danger text-center" role="alert">Ocurrió un error al actualizar el producto.</div>
    <?php endif; ?>
    <?php if (isset($_GET['success']) && $_GET['success'] === 'deactivated'): ?>
        <div class="alert alert-success text-center" role="alert">Producto desactivado correctamente.</div>
    <?php elseif (isset($_GET['error']) && $_GET['error'] === 'deactivate'): ?>
        <div class="alert alert-danger text-center" role="alert">Ocurrió un error al desactivar el producto.</div>
    <?php endif; ?>
    <section class="d-flex justify-content-center w-100">
        <table id="GenericTable" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto['nombre']) ?></td>
                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= htmlspecialchars($producto['descripcion']) ?>"><?= htmlspecialchars($producto['descripcion']) ?></td>
                    <td><?= htmlspecialchars($producto['precio']) ?></td>
                    <td><?= htmlspecialchars($producto['stock']) ?></td>
                    <td><img src="<?= BASE_URL ?>assets/uploads/<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" style="max-width: 100px;"></td>
                    <td><?= htmlspecialchars($producto['activo']) ?></td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="location.href='/admin/inventario/editar?id=<?= $producto['id'] ?>'">Editar</button>

                        <?php if ($producto['activo']): ?>
                            <form class="d-inline" method="POST" action="/admin/inventario/desactivar" onsubmit="return confirm('¿Seguro que deseas desactivar este producto?');">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Desactivar</button>
                        </form>
                        <?php else: ?>
                            <form class="d-inline" method="POST" action="/admin/inventario/activar" onsubmit="return confirm('¿Seguro que deseas activar este producto?');">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
                            <button type="submit" class="btn btn-sm btn-success">Activar</button>
                        </form>
                        <?php endif; ?>
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    </main>