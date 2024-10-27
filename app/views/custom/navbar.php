<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Enlace al archivo CSS -->
    <link rel="stylesheet" href="<?php echo URL_PROJECT; ?>/public/css/navbar.css">
    <!-- Puedes agregar más enlaces a otros CSS o librerías aquí -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">
</head>

<body>
    <header>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?php echo URL_PROJECT; ?>/home""><i class="ri-thunderstorms-line"></i> Thunderstorm</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?php echo URL_PROJECT; ?>/home"><i class="ri-home-7-line"></i> Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="ri-user-line"></i> Usuarios</a>
                            </li>
                        </ul>

                        <div class="input-group me-3"> <!-- Agrupamos aquí -->
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit"><i class="ri-search-line"></i></button> <!-- Ícono de búsqueda dentro del botón -->
                        </div>

                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="ri-mail-line"></i> Mensajes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="ri-notification-line"></i> Notificaciones</a>
                            </li>
                            <li class="nav-item dropdown">
                                
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">                               
                               <img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil?>" alt="Perfil" class="rounded-circle" width="30" height="30">
                               <span><?php echo ucwords($_SESSION['usuario']); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- <li><a class="dropdown-item" href="#">Acción 1</a></li> -->
                                <!-- <li><a class="dropdown-item" href="#">Acción 2</a></li> -->
                                <!-- <li><hr class="dropdown-divider"></li> -->
                                <li><a class="dropdown-item" href="<?php echo URL_PROJECT; ?>/home/logout">Salir</a></li>
                            </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</body>

</html>
