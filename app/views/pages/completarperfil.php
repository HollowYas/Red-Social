<?php
include_once URL_APP . '/views/custom/header.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completa tu Perfil</title>
    <link rel="stylesheet" href="<?php echo URL_PROJECT; ?>/public/css/profile.css">
</head>

<body>
    <div class="completarperfil">
        <div class="container">
            <h2 class="text-center">Completa tu Perfil</h2>
            <h6 class="text-center">Antes de continuar deberás completar tu perfil</h6>
            <hr>
            <div class="content-completar-perfil center">
                <form action="<?php echo URL_PROJECT ?>/home/insertarRegistrosPerfil" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['logueado'] ?>">
                    <div class="form-group">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required>
                    </div>
                    <div class="form-group">
                        <label for="imagen">Seleccionar una foto de perfil:</label>
                        <input type="file" class="custom-file-input" name="imagen" id="imagen" required>
                    </div>

                    <div class="form-group">
                        <label for="portada">Seleccionar una foto de portada:</label>
                        <input type="file" class="custom-file-input" name="portada" id="portada" required>
                    </div>
                    <button class="btn-purple btn-block">Registrar Datos</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include_once URL_APP . '/views/custom/footer.php';
?>