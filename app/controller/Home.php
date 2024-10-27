<?php

class Home extends Controller
{
    public function __construct()
    {
        $this->usuario = $this->model('usuario');
        $this->publicaciones = $this->model('publicar');
    }

    public function index()
    {
        if (isset($_SESSION['logueado'])) {

            $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
            $datosPerfil = $this->usuario->getPerfil($_SESSION['logueado']);
            $datosPublicaciones = $this->publicaciones->getPublicaciones();
            //Recoger datos de las publicaciones
            //$userPublicacion = $this->publicaciones->getPublicacionUsuario($datosPublicaciones);

            if ($datosPerfil) {
                $datosRed = [
                    'usuario' => $datosUsuario,
                    'perfil' => $datosPerfil,
                    'publicaciones' => $datosPublicaciones
                ];
                $this->view('pages/home', $datosRed);

            } else {
                $this->view('pages/completarperfil', $_SESSION['logueado']);
            }

        } else {
            redirection('/home/login');
        }
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datosLogin = [
                'usuario' => trim($_POST['usuario']),
                'contrasena' => trim($_POST['contrasena'])
            ];

            $datosUsuario = $this->usuario->getUsuario($datosLogin['usuario']);

            if ($datosUsuario && $this->usuario->verificarContrasena($datosUsuario, $datosLogin['contrasena'])) {
                $_SESSION['logueado'] = $datosUsuario->idusuario; // Almacena el ID del usuario
                $_SESSION['usuario'] = $datosUsuario->usuario;

                // Verifica si el usuario ya tiene un perfil
                $datosPerfil = $this->usuario->getPerfil($datosUsuario->idusuario); // Cambia a idusuario

                if ($datosPerfil) {
                    header('Location: ' . URL_PROJECT . '/home');
                } else {
                    // Redirige a completar perfil
                    header('Location: ' . URL_PROJECT . '/home/completarperfil');
                }
                exit();
            } else {
                $_SESSION['errorLogin'] = 'El usuario o la contraseña son incorrectos';
                redirection('/home/login');
            }
        } else {
            if (isset($_SESSION['logueado'])) {
                redirection('/home');
            } else {
                $this->view('pages/login');
            }
        }
    }

    public function completarPerfil(): void
    {
        if (isset($_SESSION['logueado'])) {
            $idUsuario = $_SESSION['logueado'];
            $datosPerfil = $this->usuario->getPerfil($idUsuario);

            if ($datosPerfil) {
                redirection('/home');
            } else {
                $this->view('pages/completarperfil', ['idUsuario' => $idUsuario]);
            }
        } else {
            redirection('/home/login');
        }
    }


    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datosRegistro = [
                'privilegio' => '2',
                'email' => trim($_POST['email']),
                'usuario' => trim($_POST['usuario']),
                'contrasena' => password_hash(trim($_POST['contrasena']), PASSWORD_DEFAULT)
            ];

            
            if ($this->usuario->verificarUsuario($datosRegistro)) {
                
                if ($this->usuario->register($datosRegistro)) {
                    
                    $nuevoUsuario = $this->usuario->getUsuario($datosRegistro['usuario']);

                    
                    $_SESSION['loginComplete'] = 'Registro completado exitosamente, ahora puedes ingresar.';

                    
                    redirection('/home/login');
                } else {
                    
                    echo 'Hubo un error al registrar el usuario.';
                }
            } else {
                
                $_SESSION['usuarioError'] = 'El usuario no está disponible, intente con otro nombre de usuario.';
                $this->view('pages/register');
            }
        } else {
            
            $this->view('pages/register');
        }
    }

    public function insertarRegistrosPerfil(): void
    {
        $carpeta = 'C:/xampp/htdocs/REDSOCIAl/public/img/imagenesPerfil/';

        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        // Guardar la foto de perfil
        $rutaImagen = 'img/imagenesPerfil/' . basename($_FILES['imagen']['name']);
        $rutaPerfil = $carpeta . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaPerfil);

        // Guardar la foto de portada
        $rutaPortada = 'img/imagenesPerfil/' . basename($_FILES['portada']['name']); // Mismo directorio
        $rutaPortadaFinal = $carpeta . basename($_FILES['portada']['name']);
        move_uploaded_file($_FILES['portada']['tmp_name'], $rutaPortadaFinal);

        $datos = [
            'idUsuario' => trim($_POST['id_user']),
            'nombre' => trim($_POST['nombre']),
            'ruta' => $rutaImagen,
            'rutaPortada' => $rutaPortada
        ];

        if ($this->usuario->insertarPerfil($datos)) {
            $_SESSION['usuario'] = $datos['nombre'];
            redirection('/home');
        } else {
            echo 'El perfil no ha sido guardado exitosamente...';
        }
    }

    public function cambiarPortada(): void
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idUsuario = $_POST['idUsuario'];
        $carpetaPortada = 'C:/xampp/htdocs/REDSOCIAl/public/img/imagenesPerfil/';

        if (!is_dir($carpetaPortada)) {
            mkdir($carpetaPortada, 0777, true);
        }

        $rutaPortada = 'img/imagenesPerfil/' . basename($_FILES['portada']['name']);
        $rutaPortadaFinal = $carpetaPortada . basename($_FILES['portada']['name']);

        if (move_uploaded_file($_FILES['portada']['tmp_name'], $rutaPortadaFinal)) {
            $datos = [
                'idUsuario' => $idUsuario,
                'fotoPortada' => $rutaPortada
            ];

            if ($this->usuario->actualizarPortada($datos)) {
                redirection('/perfil/' . $_SESSION['usuario']);
            } else {
                echo 'Error al actualizar la portada.';
            }
        } else {
            echo 'Error al subir la nueva imagen de portada.';
        }
    } else {
        redirection('/home');
    }
}


    public function logout(): void
    {
        session_start();

        $_SESSION = [];

        session_destroy();

        redirection('/home');
    }
}