<?php
require_once('models/conexion.php');
class Productos extends Conexion
{
    private $stmt;

    public function __construct()
    {
        parent::__construct();
    }

    public function getProductos()
    {
        $query = 'SELECT * FROM vwproductos';
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->execute();
        $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->result;
    }

    public function statusUpdate($id, $estado)
    {
        $query = "UPDATE PRODUCTO SET idEstado = ? WHERE idProducto = ?";
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

    public function deleteProduct($id)
    {
        $query = 'DELETE FROM PRODUCTO WHERE idProducto = ?';
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
        $this->stmt->execute();
        if ($this->stmt) {
            die("Producto eliminado con éxito");
        } else {
            die("Error en la eliminación del producto");
        }
    }

    public function updateProduct($id, $nombre, $descripcion, $costo, $precio)
    {
        $query = 'UPDATE PRODUCTO SET Nombre = ?, Descripcion = ?, Costo = ?, Precio = ? WHERE idProducto = ?';
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $nombre, PDO::PARAM_STR);
        $this->stmt->bindParam(2, $descripcion, PDO::PARAM_STR);
        $this->stmt->bindParam(3, $costo, PDO::PARAM_STR);
        $this->stmt->bindParam(4, $precio, PDO::PARAM_STR);
        $this->stmt->bindParam(5, $id, PDO::PARAM_STR);
        $this->stmt->execute();
        if ($this->stmt) {
            die('Actualización exitosa');
        } else {
            die('Error en la actualización');
        }
    }

    public function addProduct($producto, $descripcion, $costo, $precio)
    {
        $query = "INSERT INTO PRODUCTO (Nombre, Descripcion, fechaCreacion, Costo, Precio, idUsuarioCreo, idEstado) VALUES(?,?,?,?,?,?,1)";
        $fechaActual = date('Y-m-d H:i:s');
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $producto, PDO::PARAM_STR);
        $this->stmt->bindParam(2, $descripcion, PDO::PARAM_STR);
        $this->stmt->bindParam(3, $fechaActual, PDO::PARAM_STR);
        $this->stmt->bindParam(4, $costo, PDO::PARAM_STR);
        $this->stmt->bindParam(5, $precio, PDO::PARAM_STR);
        $this->stmt->bindParam(6, $_SESSION['idUser'], PDO::PARAM_INT);
        $this->stmt->execute();
        if ($this->stmt) {
            die('Producto creado exitosamente');
        } else {
            die('Error en la inserción');
        }
    }

    public function getProducto($id)
    {
        $query = 'SELECT * FROM vwproductos WHERE idProducto = ?';
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
        $this->stmt->execute();
        $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
        die(json_encode($this->result));
    }

    public function getStock($id)
    {
        if ($id == 0) {
            $query = 'SELECT * FROM vwstock';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->execute();
            $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            die(json_encode($this->result));
        } else {
            $query = 'SELECT * FROM vwstock WHERE idProducto = ?';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            die(json_encode($this->result));
        }
    }
}
