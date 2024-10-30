<?php

class Perfil extends controller
{

    public function __construct()
    {
        $this->perfil = $this->model('perfilUsuario');
        $this->usuario = $this->model('usuario');
    }

    public function index($user)
    {
        if (isset($_SESSION['logueado'])) {
            $datosUsuarioSesion = $this->usuario->getUsuario($_SESSION['usuario']);

            // Obtener el perfil de quien se quiere ver
            $datosPerfil = $this->usuario->getPerfilPorUsuario($user);

            if ($datosPerfil) {
                $datosRed = [
                    'usuario' => $datosUsuarioSesion,  // Usuario logueado
                    'perfil' => $datosPerfil            // Perfil de quien se quiere ver
                ];
                $this->view('pages/perfil/perfil', $datosRed);
            } else {
                // Redirigir si el usuario no existe
                redirection('/home');
            }
        } else {
            redirection('/login');
        }
    }

    public function cambiarImagen($id)
    {
        $carpeta = 'C:/xampp/htdocs/redsocial/public/img/imagenesPerfil/';
        opendir($carpeta);
        $rutaImagen = 'img/imagenesPerfil/' . $_FILES['imagen']['name'];
        $ruta = $carpeta . $_FILES['imagen']['name'];
        copy($_FILES['imagen']['tmp_name'], $ruta);
        $datos = [
            'idusuario' => trim($_POST['id_user']),
            'ruta' => $rutaImagen
        ];
        $imagenActual = $this->usuario->getPerfil($datos['idusuario']);
        unlink("C:/xampp/htdocs/redsocial/public/" . $imagenActual->fotoPerfil);
        if ($this->perfil->editarFoto($datos)) {
            redirection('/home');
        } else {
            echo 'El perfil no se ha guardado';
        }
    }


}