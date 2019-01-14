<?php
    require_once('models/conexion.php');
    class Productos extends Conexion{
        private $stmt;

        public function __construct(){
            parent::__construct();
        }

        public function getProductos(){
            $query = 'SELECT * FROM vwproductos';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->execute();
            $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->result;
        }

        public function statusUpdate($id, $estado){
            $query = "UPDATE PRODUCTO SET idEstado = ? WHERE idProducto = ?";
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $estado, PDO::PARAM_INT);
            $this->stmt->bindParam(2, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            if($this->stmt){
                die('Actualizacion exitosa');
            }else{
                die('Falló la actualización');
            }
        }

        public function deleteProduct($id){
            $query = 'DELETE FROM PRODUCTO WHERE idProducto = ?';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            if($this->stmt){
                die("Producto eliminado con éxito");
            }else{
                die("Error en la eliminación del producto");
            }
        }
    }