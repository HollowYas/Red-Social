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
}