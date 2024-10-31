<?php

include_once URL_APP . '/views/custom/header.php';

include_once URL_APP . '/views/custom/navbar.php';

//var_dump($datos);


?>

<head>
    <link rel="stylesheet" href="<?php echo URL_PROJECT ?>/public/css/home.css">
</head>

<div class="container">
    <div class="row">
        <!-- Columna Perfil  -->
        <div class="col-md-3">
            <div class="container-style-main">
                <div class="perfil-usuario-main">
                    <div class="background-usuario-main">
                        <img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="">
                        <div class="foto-separation"></div>
                        <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datos['usuario']->usuario ?>">
                            <div class="text-center nombre-perfil"><?php echo $datos['perfil']->nombreCompleto ?></div>
                        </a>
                        <div class="tabla-estadisticas">
                            <a href="#">Publicaciones <br> 0</a>
                            <a href="#">Likes <br> 0</a>
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
                    <form
                        action="<?php echo URL_PROJECT ?>/publicaciones/publicar/<?php echo $datos['usuario']->idusuario ?>"
                        method="POST" enctype="multipart/form-data" class="form-publicar ml-2">
                        <textarea name="contenido" id="contenido" class="published mb-0" name="post"
                            placeholder="Publica algo" required></textarea>
                        <div class="image-upload-file">
                            <div class="upload-photo">
                                <div class="custom-file-upload">
                                    <label for="file"><i class="ri-file-upload-line"></i>Media</label>
                                    <input type="file" id="file" name="imagen">
                                </div>
                            </div>
                            <button class="btn-publi">Publicar</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php foreach ($datos['publicaciones'] as $datosPublicaciones): ?>
                <div class="container-usuarios-publicaciones">
                    <div class="usuarios-publicaciones-top">
                        <img src="<?php echo URL_PROJECT . '/' . $datosPublicaciones->fotoPerfil ?>" alt=""
                            class="image-border">
                        <div class="informacion-usuario-publico">
                            <h6 class="mb-0"><a
                                    href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datosPublicaciones->usuario ?>"><?php echo ucwords
                                          ($datosPublicaciones->usuario) ?></a></h6>
                            <span><?php echo $datosPublicaciones->fechaPublicacion ?></span>
                        </div>
                        <div class="acciones-publicacion-usuario">
                            <a
                                href="<?php echo URL_PROJECT ?>/Publicaciones/eliminar/<?php echo $datosPublicaciones->idpublicacion ?>"><i
                                    class="ri-delete-bin-line"></i></a>
                        </div>
                    </div>
                    <div class="contenido-publicacion-usuario">
                        <p class="mb-1"><?php echo $datosPublicaciones->contenidoPublicacion ?></p>
                        <img src="<?php echo URL_PROJECT . '/' . $datosPublicaciones->fotoPublicacion ?>" alt=""
                            class="imagen-publicacion-usuario">
                    </div>
                    <div class="acciones-usuario-publicar">
                        <a href="<?php echo URL_PROJECT ?>/publicaciones/megusta/<?php echo $datosPublicaciones->idpublicacion . '/' . $_SESSION['logueado'] ?>"
                            class="
                                <?php foreach ($datos['misLikes'] as $mislikesUser) {
                                    if ($mislikesUser->idPublicacion == $datosPublicaciones->idpublicacion) {
                                        echo 'like-active';
                                    }
                                } ?>"><i class="ri-thumb-up-line"></i> Me gusta <span><?php echo $datosPublicaciones->num_likes ?></span></a>
                        <a href=""><i class="ri-message-3-line"></i> Comentar</a>
                    </div>
                </div>
            <?php endforeach ?>
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