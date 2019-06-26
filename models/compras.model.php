<?php
    require_once('models/conexion.php');
    class Compras extends Conexion{
        private $stmt;

        public function __construct(){
            parent::__construct();
        }

        public function getCompras(){
            $query = 'SELECT * FROM vwentradas';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->execute();
            $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->result;
        }

        public function statusUpdate($id, $estado){
            $query = "UPDATE ENTRADA SET idEstado = ? WHERE idEntrada = ?";
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

        public function detallesCompras($id){
            $query = 'SELECT * FROM vwdetalleentrada WHERE idEntrada = ?';
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

        public function newBuy($total){
            $fechaActual = date('Y-m-d H:i:s');
            $query = 'INSERT INTO entrada (idEstado, fechaCreacion, idUsuarioCreo, Total) VALUES (1,?,?,?)';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $fechaActual, PDO::PARAM_STR);
            $this->stmt->bindParam(2, $_SESSION['idUser'], PDO::PARAM_INT);
            $this->stmt->bindParam(3, $total, PDO::PARAM_STR);
            $result = $this->stmt->execute();
        }

        public function newDetailsBuy($idProd, $cantidad, $costo){
            $query = 'SELECT idEntrada FROM entrada ORDER BY idEntrada DESC LIMIT 1';
            $this->stmt = $this->conexion->query($query);
            $idEntrada = $this->stmt->fetch(PDO::FETCH_ASSOC)['idEntrada'];

            for($i = 0; $i<$cantidad; $i++){
                $query = 'INSERT INTO detalleentrada (idProducto, CostoUnitario, idEntrada) VALUES (?,?,?)';
                $this->stmt = $this->conexion->prepare($query);
                $this->stmt->bindParam(1, $idProd, PDO::PARAM_INT);
                $this->stmt->bindParam(2, $costo, PDO::PARAM_STR);
                $this->stmt->bindParam(3, $idEntrada, PDO::PARAM_INT);
                $this->stmt->execute();
            }

            if($this->stmt){
                die($idEntrada);
            }
        }
    }