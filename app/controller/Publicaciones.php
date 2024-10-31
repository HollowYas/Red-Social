<?php

class Publicaciones extends Controller
{
    public function __construct()
    {
        $this->publicar = $this->model('publicar');
    }

    public function publicar($idusuario)
    {
        $rutaImagen = 'No Image'; 

        // Verificar si se subió un archivo y no tiene errores
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $carpeta = 'C:/xampp/htdocs/REDSOCIAl/public/img/imagenesPublicaciones/';
            opendir($carpeta);

            // Obtener nombre de archivo y construir la ruta completa
            $rutaImagen = 'img/imagenesPublicaciones/' . basename($_FILES['imagen']['name']);
            $ruta = $carpeta . basename($_FILES['imagen']['name']);

            // Mover el archivo subido a la carpeta
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
                // Éxito al mover la imagen
            } else {
                // Error al mover la imagen
                $rutaImagen = 'No Image';
            }
        }
        
        $datos = [
            'iduser' => trim($idusuario),
            'contenido' => trim($_POST['contenido']),
            'foto' => $rutaImagen
        ];

        // Guardar los datos y redirigir
        if ($this->publicar->publicar($datos)) {
            redirection('/home');
        } else {
            echo 'Algo salio mal... :(';
        }
    }

    public function eliminar($idpublicacion)
    {        
    $publicacion = $this->publicar->getPublicacion($idpublicacion);

    if ($publicacion) {
        // Construye la ruta absoluta de la imagen en el servidor
        $rutaImagen = 'C:/xampp/htdocs/REDSOCIAl/public/' . $publicacion->fotoPublicacion;

        // Primero elimina la publicación en la base de datos
        if ($this->publicar->eliminarPublicacion($publicacion)) {
            // Verifica si la imagen existe antes de intentar eliminarla
            if (file_exists($rutaImagen)) {
                unlink($rutaImagen); // Elimina la imagen del servidor
            }
            redirection('/home');
        } else {
            echo 'Hubo un error al intentar eliminar la publicación.';
        }
    } else {
        echo 'La publicación no existe o ya ha sido eliminada.';
    }
    }

    public function megusta($idpublicacion, $idusuario)
    {
        $datos = [
            'idpublicacion' => $idpublicacion,
            'idusuario'=> $idusuario
        ];

        if ($this->publicar->rowLikes($datos)) 
        {
            echo 'Hay algo c:';
        }
        else
        {
            echo 'No hay nada :c';
        }
        
    }
}