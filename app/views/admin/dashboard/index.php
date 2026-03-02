<main>
    <section class="d-flex flex-column justify-content-center align-items-center w-100">
        <h1 class="mb-4">Dashboard</h1>

        <!-- Cards de métricas -->
         <div class="row mb-4">
            <div class="col-md-6">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Productos</h5>
                        <p class="card-text fs-2"><?= $totalProductos ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Stock Bajo</h5>
                        <p class="card-text fs-2"><?= count($productosStockBajo) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4>Productos con Stock Bajo</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productosStockBajo as $producto): ?>
                            <tr>
                                <td><?= $producto['nombre'] ?></td>
                                <td><?= $producto['stock'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>