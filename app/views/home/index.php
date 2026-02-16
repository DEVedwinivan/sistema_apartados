
<main class="container" id="content">
    <section class="bienvenido mx-auto mt-1 text-center">
        <h2 class="fs-1">Bienvenido a Regalos Irma</h2>
        <p ><strong class="fs-3">Cada regalo cuenta una historia</strong><br> Tu tienda favorita de regalos personalizados.</p>
        <a href="#" class="btn btns_home">Ver Todos Los Productos</a>
        <figure>
            <img src="<?= BASE_URL ?>assets/img/bienvenido.png" alt="Imagen de bienvenida" class="img-fluid rounded mx-auto d-block">
        </figure>
    </section>
    <section class="sn mx-auto mt-5">
        <h2 class="">Sobre Nosotros</h2>
        <p><Strong class="fs-4">Misión y Visión</Strong><br>Ser una empresa de regalos reconocida, brindando productos de alta calidad, comprometidos con los clientes para satisfacer sus necesidades y expectativas que tienen acerca de nuestros productos.<br> Ser una empresa de regalos reconocida, brindando productos de alta calidad, comprometidos con los clientes para satisfacer sus necesidades y expectativas que tienen acerca de nuestros productos</p>
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btns_home">Más Información</a>
    </section>
    <section class="up mx-auto mt-5 mb-5">
        <h2>Ultimos Productos</h2>
        <div class="productos d-flex flex-wrap justify-content-center gap-4 mt-4">
            <?php foreach ($productos as $producto): ?>
                <div class="card" style="width: 18rem;">
                    <img src="<?= BASE_URL ?>assets/uploads/<?= htmlspecialchars($producto['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($producto['descripcion'])) ?><br> $<?= number_format($producto['precio'], 2) ?></p>
                        <a href="#" class="btn btn_product w-100">Apartar producto</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<?php
include ROOT . '/app/views/home/modal-info.php';
?>