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
    }