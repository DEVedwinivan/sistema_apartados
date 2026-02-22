<main class="container mt-4">
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
                        <form class="d-inline" method="POST" action="/admin/inventario/desactivar" onsubmit="return confirm('¿Seguro que deseas desactivar este producto?');">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Desactivar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    </main>