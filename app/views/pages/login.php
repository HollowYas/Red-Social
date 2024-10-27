<?php

include_once URL_APP . '/views/custom/header.php';

//include_once URL_APP . '/views/custom/navbar.php';

?>

<div class="container-center center">
    <div class="container-content center">
        <div class="content-action center">
            <h4>Iniciar Sesion</h4>
            <form action="<?php echo URL_PROJECT ?>/home/login" method="POST">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <button class="btn-purple btn-block">Ingresar</button>
            </form>
            
                <!-- Alerta cuando el usuario o password son incorrectos-->
            <?php if (isset($_SESSION['errorLogin'])): ?>

                <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert">
                    <?php echo $_SESSION['errorLogin'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
                <?php unset($_SESSION['errorLogin']); endif ?>

                <!-- Alerta cuando el Registro se completo-->
            <?php if (isset($_SESSION['loginComplete'])): ?>

                <div class="alert alert-success alert-dismissible fade show mt-2 mb-2" role="alert">
                    <?php echo $_SESSION['loginComplete'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
                <?php unset($_SESSION['loginComplete']); endif ?>

            <div class="contenido-link mt-2">
                <span class="mr-2">No tienes una cuenta?</span><a
                    href="<?php echo URL_PROJECT ?>/home/register">Registrarme</a>
            </div>
        </div>
        <div class="content-image center">
            <img src="<?php echo URL_PROJECT ?>/img/header.png" alt="Hombre sentado en computadora">
        </div>
    </div>
</div>

<?php

include_once URL_APP . '/views/custom/footer.php';

?>