<?php

include_once URL_APP . '/views/custom/header.php';

include_once URL_APP . '/views/custom/navbar.php';

//var_dump($datos);

?>

<head>
    <link rel="stylesheet" href="<?php echo URL_PROJECT ?>/public/css/perfil.css">
</head>

<div class="container">
    <div class="row">
        <!-- Columna Perfil  -->
        <div class="col-md-3">
            <div class="container-style-main">
                <!-- Foto de Portada -->
                <div class="portada-usuario">
                <img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPortada ?>" alt="Imagen de portada" class="imagen-portada">

                    <!-- Botón para cambiar la portada -->
                    <div class="portada-upload">
                        <form action="<?php echo URL_PROJECT ?>/home/cambiarPortada" method="POST"
                            enctype="multipart/form-data">
                            <label for="portadaInput" class="btn-cambiar-portada">
                                <i class="ri-image-edit-line"></i> <!-- Ícono de edición -->
                            </label>
                            <input type="file" name="portada" id="portadaInput" class="d-none"
                                onchange="this.form.submit()">
                            <input type="hidden" name="idUsuario" value="<?php echo $datos['usuario']->idusuario; ?>">
                        </form>
                    </div>
                </div>
                <div class="perfil-usuario-main">
                    <div class="background-usuario-main">
                        <!-- Foto de Perfil -->
                        <img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="Foto de perfil">
                        <div class="foto-separation"></div>
                        <div class="text-center nombre-perfil">
                            <?php echo $datos['usuario']->usuario; ?>
                            <br>
                            <br>
                            <?php echo $datos['perfil']->nombreCompleto; ?>
                        </div>
                        <div class="tabla-estadisticas">
                            <!-- <a href="#">Publicaciones <br> 0</a> -->
                            <!-- <a href="#">Likes <br> 0</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna Principal  -->
        <div class="col-md-6">
            <div class="container-style-main">
                <div class="container-usuario-publicar">
                    <img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="">
                    <form action="" class="form-publicar ml-2">
                        <textarea name="" id="" class="published mb-0" name="post" placeholder="Publica algo"
                            required></textarea>
                        <div class="image-upload-file">
                            <div class="upload-photo">
                                <div class="custom-file-upload">
                                    <label for="file"><i class="ri-file-upload-line"></i>Media</label>
                                    <input type="file" id="file" name="file">
                                </div>
                            </div>
                            <button class="btn-publi">Publicar</button>
                        </div>
                    </form>
                </div>
                <div class="container-usuarios-publicaciones">
                    <!-- Aquí se pueden cargar las publicaciones del usuario -->
                </div>
            </div>
        </div>

        <!-- Columna Eventos  -->
        <div class="col-md-3">
            <div class="container-style-main">
                <!-- Foto de Portada -->
                <div class="portada-usuario">
                </div>
                <div class="perfil-usuario-main">
                    <div class="background-usuario-main">
                        <div class="tabla-estadisticas">
                            <a href="#">Publicaciones <br> 0</a>
                            <a href="#">Likes <br> 0</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once URL_APP . '/views/custom/footer.php';
?>