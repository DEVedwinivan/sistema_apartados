<nav id="sidebar" class="shadow-sm">
    <div class="sidebar-header">
        <img src="<?php echo BASE_URL; ?>/assets/img/ri.png" alt="Logo" class="logo-sidebar">
        <h4 class="cursor-default">REGALOS IRMA</h4>
    </div>

    <ul class="menu">
        <li><a href="<?= BASE_URL ?>"><i class="bi bi-house"></i> Inicio</a></li>
        <li><a href="<?= BASE_URL ?>iniciar"><i class="bi bi-person-vcard"></i> Iniciar Sesión</a></li>
        <li><a href="<?= BASE_URL ?>apartados/mis_apartados"><i class="bi bi-cart"></i> Mis apartados</a></li>
        <li><a href="<?= BASE_URL ?>products/productos"><i class="bi bi-box-seam"></i> Productos</a></li>
        <li><a href="<?= BASE_URL ?>privacidad"><i class="bi bi-file-earmark-lock"></i>Privacidad</a></li>
        <!-- Apardado de administrador -->
        <li><a href="<?= BASE_URL ?>admin/usuarios"><i class="bi bi-people"></i>Usuarios</a></li>
        <li><a href="<?= BASE_URL ?>admin/dashboard"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
        <li><a href="<?= BASE_URL ?>admin/apartados"><i class="bi bi-cart"></i> Apartados</a></li>
        <li><a href="<?= BASE_URL ?>admin/subir_producto"><i class="bi bi-upload"></i>Subir producto</a></li>
        <li><a href="<?= BASE_URL ?>admin/inventario"><i class="bi bi-box-seam"></i>Inventario</a></li>
    </ul>
</nav>

<button id="btn-menu" class="btn-menu">
    ☰
</button>
