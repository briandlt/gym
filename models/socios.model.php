<?php
require_once('./models/conexion.php');
class Socios extends Conexion
{
    private $stmt;

    public function __construct()
    {
        parent::__construct();
    }

    public function getSocios()
    {
        $query = 'SELECT * FROM vwsocios';
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->execute();
        $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->result;
    }

    public function getSocio($id)
    {
        $query = 'SELECT * FROM vwsocios WHERE idSocio = ?';
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
        $this->stmt->execute();
        $this->result = json_encode($this->stmt->fetch(PDO::FETCH_ASSOC));
        die($this->result);
    }

    public function statusUpdate($id, $estado)
    {
        $query = 'UPDATE SOCIO SET idEstado = ? WHERE idSocio = ?';
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $estado, PDO::PARAM_INT);
        $this->stmt->bindParam(2, $id, PDO::PARAM_INT);
        $this->stmt->execute();
        if ($this->stmt) {
            die("Actualizacion exitosa");
        } else {
            die("Falló en la actualización");
        }
    }

    public function deleteMember($id)
    {
        $query = 'DELETE FROM SOCIO WHERE idSocio = ?';
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
        $this->stmt->execute();
        if ($this->stmt) {
            die("Socio eliminado con éxito");
        } else {
            die("Error en la eliminación del socio");
        }
    }

    public function updateMember($id, $nombre, $apaterno, $amaterno, $tel, $foto)
    {
        $query = 'UPDATE SOCIO SET Nombre = ?, Paterno = ?, Materno = ?, Telefono = ?, foto = ? WHERE idSocio = ?';
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $nombre, PDO::PARAM_STR);
        $this->stmt->bindParam(2, $apaterno, PDO::PARAM_STR);
        $this->stmt->bindParam(3, $amaterno, PDO::PARAM_STR);
        $this->stmt->bindParam(4, $tel, PDO::PARAM_STR);
        $this->stmt->bindParam(5, $foto, PDO::PARAM_STR);
        $this->stmt->bindParam(6, $id, PDO::PARAM_INT);
        $this->stmt->execute();
        if ($this->stmt) {
            die('Actualización exitosa');
        } else {
            die('Error en la actualización');
        }
    }

    public function addMember($nombre, $apaterno, $amaterno, $tel, $foto)
    {
        $query = "INSERT INTO SOCIO (fechaCreacion, Nombre, Paterno, Materno, Telefono, foto, idUsuarioCreo, idEstado) VALUES (?,?,?,?,?,?,?,1)";
        $fechaActual = date('Y-m-d H:i:s');
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $fechaActual, PDO::PARAM_STR);
        $this->stmt->bindParam(2, $nombre, PDO::PARAM_STR);
        $this->stmt->bindParam(3, $apaterno, PDO::PARAM_STR);
        $this->stmt->bindParam(4, $amaterno, PDO::PARAM_STR);
        $this->stmt->bindParam(5, $tel, PDO::PARAM_INT);
        $this->stmt->bindParam(6, $foto, PDO::PARAM_STR);
        $this->stmt->bindParam(7, $_SESSION['idUser'], PDO::PARAM_INT);
        $this->stmt->execute();
        if ($this->stmt) {
            die('Socio creado exitosamete');
        } else {
            die('Error en la inserción');
        }
    }

    public function addSocioMembresia($idSocio, $idMembre, $precio, $fechaInicio)
    {
        $fechaActual = date('Y-m-d H:i:s');
        $query = "INSERT INTO sociomembresia (idEstado, fechaCreacion, idUsuarioCreo, idSocio, idMembresia, Precio, fechaInicioMembresia) VALUES (1,?,?,?,?,?,?)";
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $fechaActual, PDO::PARAM_STR);
        $this->stmt->bindParam(2, $_SESSION['idUser'], PDO::PARAM_INT);
        $this->stmt->bindParam(3, $idSocio, PDO::PARAM_INT);
        $this->stmt->bindParam(4, $idMembre, PDO::PARAM_INT);
        $this->stmt->bindParam(5, $precio, PDO::PARAM_STR);
        $this->stmt->bindParam(6, $fechaInicio, PDO::PARAM_STR);
        $this->stmt->execute();
        if ($this->stmt) {
            die('Membresia agregada exitosamente');
        } else {
            die('Error en la inserción');
        }
    }

    public function getMembresiasSocio($id)
    {
        $query = "SELECT * FROM vwsociomembresias WHERE idSocio = ?";
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
        $this->stmt->execute();
        $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        die(json_encode($this->result));
    }

    public function deleteMembresiaSocio($id)
    {
        $query = "DELETE FROM sociomembresia WHERE idSocioMembresia = ?";
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
        $this->result = $this->stmt->execute();
        if ($this->result) {
            die("Membresia eliminada exitosamente");
        } else {
            die("Error en la ejecución de la consulta");
        }
    }
}
