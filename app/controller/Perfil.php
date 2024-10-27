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
            $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
            $datosPerfil = $this->usuario->getPerfil($_SESSION['logueado']);

            if ($datosPerfil) {
                $datosRed = [
                    'usuario' => $datosUsuario,
                    'perfil' => $datosPerfil
                ];
                $this->view('pages/perfil/perfil', $datosRed);

            }
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