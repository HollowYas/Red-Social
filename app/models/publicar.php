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

    public function getPublicacion($id)
    {
        $this->db->query('SELECT * FROM publicaciones WHERE idpublicacion = :id');
        $this->db->bind(':id', $id);
        return $this->db->register();
    }

    public function getPublicaciones()
    {
        $this->db->query('SELECT P.idpublicacion, P.contenidoPublicacion, P.fotoPublicacion, P.fechaPublicacion, U.usuario, Per.fotoPerfil FROM publicaciones P 
        INNER JOIN usuarios U ON U.idusuario = P.idUserPublico
        INNER JOIN perfil Per ON Per.idUsuario = P.idUserPublico
        ORDER BY P.fechaPublicacion DESC');
        return $this->db->registers(); 
    }

    public function eliminarPublicacion($publicacion)
    {
        $this->db->query('DELETE FROM publicaciones where idpublicacion = :id');
        $this->db->bind(':id', $publicacion->idpublicacion);
        if( $this->db->execute()) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
}