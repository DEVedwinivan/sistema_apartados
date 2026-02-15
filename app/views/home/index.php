
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
                <div class="card" style="width: 18rem;">
                    <img src="" class="card-img-top" alt="Nombre">
                    <div class="card-body">
                        <h5 class="card-title">Titulo</h5>
                        <p class="card-text">Descripción <br> $1000</p>
                        <a href="#" class="btn btn_product w-100">Ver Producto</a>
                    </div>
                </div>
                                <div class="card" style="width: 18rem;">
                    <img src="" class="card-img-top" alt="Nombre">
                    <div class="card-body">
                        <h5 class="card-title">Titulo</h5>
                        <p class="card-text">Descripción <br> $1000</p>
                        <a href="#" class="btn btn_product w-100">Ver Producto</a>
                    </div>
                </div>
        </div>
    </section>
</main>
<?php
include ROOT . '/app/views/home/modal-info.php';
?>