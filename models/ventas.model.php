<?php
    require_once('models/conexion.php');
    class Ventas extends Conexion{
        private $stmt;

        public function __construct(){
            parent::__construct();
        }

        public function getVentas(){
            $query = 'SELECT * FROM vwsalidas';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->execute();
            $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->result;
        }

        public function statusUpdate($id, $estado){
            $query = "UPDATE SALIDA SET idEstado = ? WHERE idSalida = ?";
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

        public function detallesVenta($id){
            $query = 'SELECT * FROM vwdetallesalida WHERE idSalida = ?';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            $result = json_encode($this->stmt->fetchAll(PDO::FETCH_ASSOC));
            if($this->stmt){
                die($result);
            }else{
                die('Error en la recopilación de datos');
            }
        }

        public function newSale($total){
            $fechaActual = date('Y-m-d H:i:s');
            $query = 'INSERT INTO salida (idEstado, fechaCreacion, idUsuarioCreo, total) VALUES (1,?,?,?)';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $fechaActual, PDO::PARAM_STR);
            $this->stmt->bindParam(2, $_SESSION['idUser'], PDO::PARAM_INT);
            $this->stmt->bindParam(3, $total, PDO::PARAM_STR);
            $result = $this->stmt->execute();
        }

        public function newDetailsSale($idProd, $cantidad, $precio){
            $query = 'SELECT idSalida FROM salida ORDER BY idSalida DESC LIMIT 1';
            $this->stmt = $this->conexion->query($query);
            $idSalida = $this->stmt->fetch(PDO::FETCH_ASSOC)['idSalida'];

            for($i = 0; $i<$cantidad; $i++){
                $query = 'INSERT INTO detallesalida (idProducto, precioUnitario, idSalida) VALUES (?,?,?)';
                $this->stmt = $this->conexion->prepare($query);
                $this->stmt->bindParam(1, $idProd, PDO::PARAM_INT);
                $this->stmt->bindParam(2, $precio, PDO::PARAM_STR);
                $this->stmt->bindParam(3, $idSalida, PDO::PARAM_INT);
                $this->stmt->execute();

                $query = 'SELECT iddetalleSalida FROM detallesalida ORDER BY iddetalleSalida DESC LIMIT 1';
                $this->stmt = $this->conexion->query($query);
                $idDS = $this->stmt->fetch(PDO::FETCH_ASSOC)['iddetalleSalida'];

                $query = "SELECT idDetalleEntrada FROM detalleentrada WHERE idProducto = ? AND idDetalleSalida IS NULL LIMIT 1";
                $this->stmt = $this->conexion->prepare($query);
                $this->stmt->bindParam(1, $idProd, PDO::PARAM_INT);
                $this->stmt->execute();
                $idDE = $this->stmt->fetch(PDO::FETCH_ASSOC)['idDetalleEntrada'];

                $query = "UPDATE detalleentrada SET idDetalleSalida = ? WHERE idDetalleEntrada = ?";
                $this->stmt = $this->conexion->prepare($query);
                $this->stmt->bindParam(1, $idDS, PDO::PARAM_INT);
                $this->stmt->bindParam(2, $idDE, PDO::PARAM_INT);
                $this->stmt->execute();
            }
        }
    }