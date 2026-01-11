<?php
include_once __DIR__ . '/layouts/header.php';
include_once __DIR__ . '/layouts/sidebar.php';
?>
<main class="container">
    <section class="bienvenido w-75 mx-auto mt-5 text-center">
        <h1 class="fs-1">Bienvenido a Regalos Irma</h1>
        <p ><strong class="fs-3">Cada regalo cuenta una historia</strong><br> Tu tienda favorita de regalos personalizados.</p>
        <a href="#" class="btn">Ver Todos Los Productos</a>
        <figure>
            <img src="<?= BASE_URL ?>assets/img/bienvenido.png" alt="Imagen de bienvenida" class="img-fluid rounded mx-auto d-block">
        </figure>
    </section>
</main>
<?php

include_once __DIR__ . '/layouts/footer.php';
?>