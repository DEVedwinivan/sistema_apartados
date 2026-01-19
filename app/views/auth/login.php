<?php
include_once ROOT . '/app/views/layouts/header.php';
include_once ROOT . '/app/views/layouts/sidebar.php';
?>

<main class="container" id="content">
    <section class="">
                    <div class="information">
                <div class="info-childs">
                    <h2>Bienvenido</h2>
                    <p>Tener una cuenta te da el privilegio de poder apartar productos. Si aún no tienes una cuenta registrate.</p>
                    <input type="button" value="Registrar" id="reg">
                </div>
            </div>
            <div class="form-information ">
                <div class="form-information-childs">
                    <h2>Iniciar sesión</h2>
                <p>Coloca tus datos.</p>
                </div>
                <form class="formCP" action="" method="post">
                    <label for="">
                        <input type="email" placeholder="Correo electrónico" name="emailL">
                    </label>
                    <label for="">
                        <input type="password" placeholder="Contraseña" name="passwordL">
                    </label>
                    <input class="submit" type="submit" value="Iniciar">
                </form>
            </div>
    </section>
    <section>
         <div class="information">
                <div class="info-childs">
                    <h2>Bienvenido</h2>
                    <p>Tener una cuenta te da el privilegio de poder apartar productos. Si ya tienes una cuenta inicia sesión.</p>
                    <input type="button" value="Iniciar sesión" id="iniciar">
                </div>
            </div>
            <div class="form-information">
                <div class="form-information-childs">
                    <h2>Registrate</h2>
                <p>Coloca tus datos.</p>
                </div>
                <form class="formCP" action="" method="post">
                    <label for="">
                        <input type="text" placeholder="Nombre de usuario" name="nombreR">
                    </label>
                    <label for="">
                        <input type="email" placeholder="Correo electrónico" name="emailR">
                    </label>
                    <label for="">
                        <input type="password" placeholder="Contraseña" name="contraR">
                    </label>
                    <input type="text" name="rolR" value="user" hidden>
                    <input class="submit" type="submit" value="Registrar">
                </form>
            </div>
        </div> 
    </section>
</main>

<?php
include_once ROOT . '/app/views/layouts/footer.php';
?>