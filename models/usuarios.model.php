<?php
require_once('./models/conexion.php');
class Usuarios extends Conexion
{
    private $stmt;

    public function Usuarios()
    {
        parent::__construct();
    }

    public function getUsuarios()
    {
        $query = 'SELECT * FROM vwusuarios';
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->execute();
        $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->result;
    }

    public function statusUpdate($estado, $id)
    {
        $query = "UPDATE USUARIO SET idEstado = ? WHERE idUsuario = ?";
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $estado, PDO::PARAM_INT);
        $this->stmt->bindParam(2, $id, PDO::PARAM_INT);
        $this->stmt->execute();
        if ($this->stmt) {
            die('Actualizacion exitosa');
        } else {
            die('Falló la actualización');
        }
    }

    public function deleteUser($id)
    {
        $query = 'DELETE FROM USUARIO WHERE idUsuario = ?';
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
        $this->stmt->execute();
        if ($this->stmt) {
            die("Usuario eliminado con éxito");
        } else {
            die("Error en la eliminación del usuario");
        }
    }

    public function updateUser($id, $user, $pass, $name, $pic)
    {
        $query = 'UPDATE USUARIO SET Usuario = ?, Nombre = ?, Password = ?, foto = ? WHERE idUsuario = ?';
        $password = $this->encriptar($pass);
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $user, PDO::PARAM_STR);
        $this->stmt->bindParam(2, $name, PDO::PARAM_STR);
        $this->stmt->bindParam(3, $password, PDO::PARAM_STR);
        $this->stmt->bindParam(4, $pic, PDO::PARAM_STR);
        $this->stmt->bindParam(5, $id, PDO::PARAM_INT);
        $this->stmt->execute();
        if ($this->stmt) {
            die("Actualización exitosa");
        } else {
            die("Error en la actualización");
        }
    }

    public function addUser($user, $pass, $name, $pic)
    {
        $query = "INSERT INTO USUARIO (Nombre, Password, Usuario, fechaCreacion, foto) VALUES (?,?,?,?,?)";
        $fechaActual = date('Y-m-d H:i:s');
        $password = $this->encriptar($pass);
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $name, PDO::PARAM_STR);
        $this->stmt->bindParam(2, $password, PDO::PARAM_STR);
        $this->stmt->bindParam(3, $user, PDO::PARAM_STR);
        $this->stmt->bindParam(4, $fechaActual, PDO::PARAM_STR);
        $this->stmt->bindParam(5, $pic, PDO::PARAM_STR);
        $this->stmt->execute();
        if ($this->stmt) {
            die('Usuario creado exitosamete');
        } else {
            die('Error en la inserción');
        }
    }

    public function login($user, $pass)
    {
        $query = "SELECT * FROM USUARIO WHERE Usuario = ? AND Password = ?";
        $password = $this->encriptar($pass);
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $user, PDO::PARAM_STR);
        $this->stmt->bindParam(2, $password, PDO::PARAM_STR);
        $this->stmt->execute();
        $result = $this->stmt->fetch(PDO::FETCH_ASSOC);
        if ($result != null) {
            session_destroy();
            session_start();
            $_SESSION['idUser'] = $result['idUsuario'];
            $_SESSION['usuario'] = $user;
            $_SESSION['foto'] = ($result['foto'] != '') ? $result['foto'] : 'porDefecto.jpg';
            die("Bienvenido");
        } else {
            die('Error de autenticación');
        }
    }

    public function cerrarSesion()
    {
        session_start();
        session_destroy();
    }
}
