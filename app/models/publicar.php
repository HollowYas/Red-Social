<?php   

class publicar
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }   
    
    public function publicar($datos)
    {
        $this->db->query('INSERT INTO publicaciones (idUserPublico, contenidoPublicacion, fotoPublicacion) VALUES (:iduser, :contenido, :foto)');
        $this->db->bind(':iduser', $datos['iduser']);
        $this->db->bind(':contenido', $datos['contenido']);
        $this->db->bind(':foto', $datos['foto']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getPublicaciones()
    {
        $this->db->query('SELECT P.contenidoPublicacion, P.fotoPublicacion, P.fechaPublicacion, U.usuario, Per.fotoPerfil FROM publicaciones P 
        INNER JOIN usuarios U ON U.idusuario = P.idUserPublico
        INNER JOIN perfil Per ON Per.idUsuario = P.idUserPublico');
        return $this->db->registers(); 
    }

    // public function getPublicacionUsuario($datosPublicaciones)
    // {
    //     //var_dump($datosPublicaciones);
    //     $this->db->query('SELECT * FROM publicaciones ');
    // }
}