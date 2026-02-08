<main class="container" id="content">
            <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>    
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success text-center">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
 <section class="form-container">
        <section class="container-form iniciar">
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
    
                <form class="formCP" action="/iniciar" method="post">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                    <label for="emailL">
                        <input type="email" placeholder="Correo electrónico" name="emailL" required>
                    </label>
                    <label for="passwordL">
                        <input type="password" placeholder="Contraseña" name="passwordL" required>
                    </label>
                    <input class="submit" type="submit" value="Iniciar">
                </form>
            </div>
        </section>

         <section class="container-form registrar hide">
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
                <form class="formCP" action="/registrar" method="post">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                    <label for="nombreR">
                        <input type="text" placeholder="Nombre de usuario" name="nombreR" required minlength="2" maxlength="100">
                    </label>
                    <label for="emailR">
                        <input type="email" placeholder="Correo electrónico" name="emailR" required>
                    </label>
                    <label for="passwordR">
                        <input type="password" placeholder="Contraseña" name="passwordR" required minlength="6">
                    </label>
                    <input class="submit" type="submit" value="Registrar">
                </form>
            </div>
        </section>
    </section>
</main>
