<?php
    require_once('models/conexion.php');
    class Membresias extends Conexion{
        private $stmt;

        public function __construct(){
            parent::__construct();
        }

        public function getMembresias(){
            $query = 'SELECT * FROM vwmembresias';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->execute();
            $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->result;
        }

        public function getMembresia($id){
            $query = 'SELECT * FROM vwmembresias WHERE idMembresia = ?';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            die(json_encode($this->result));
        }

        public function statusUpdate($id, $estado){
            $query = 'UPDATE MEMBRESIA SET idEstado = ? WHERE idMembresia = ?';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $estado, PDO::PARAM_INT);
            $this->stmt->bindParam(2, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            if($this->stmt){
                die('Actualización exitosa');
            }else{
                die('Error en la actualización');
            }
        }

        public function deleteMembership($id){
            $query = 'DELETE FROM MEMBRESIA WHERE idMembresia = ?';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            if($this->stmt){
                die("Membresia eliminada con éxito");
            }else{
                die("Error en la eliminación de la membresia");
            }
        }

        public function updateMembership($id, $nombre, $precio, $meses, $hInicio, $hFin){
            $query = 'UPDATE MEMBRESIA SET Nombre = ?, Precio = ?, meses = ?, horaInicio = ?, horaFinal = ? WHERE idMembresia = ?';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $nombre, PDO::PARAM_STR);
            $this->stmt->bindParam(2, $precio, PDO::PARAM_INT);
            $this->stmt->bindParam(3, $meses, PDO::PARAM_STR);
            $this->stmt->bindParam(4, $hInicio, PDO::PARAM_STR);
            $this->stmt->bindParam(5, $hFin, PDO::PARAM_STR);
            $this->stmt->bindParam(6, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            if($this->stmt){
                die("Actualización exitosa");
            }else{
                die("Error en la acutualización");
            }
        }

        public function addMembership($nombre, $precio, $meses, $hi, $hf){
            $query = "INSERT INTO MEMBRESIA (Nombre, fechaCreacion, Precio, meses, horaInicio, horaFinal, idUsuarioCreo, idEstado) VALUES(?,?,?,?,?,?,?,1)";
            $fechaActual = date('Y-m-d H:i:s');
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $nombre, PDO::PARAM_STR);
            $this->stmt->bindParam(2, $fechaActual, PDO::PARAM_STR);
            $this->stmt->bindParam(3, $precio, PDO::PARAM_INT);
            $this->stmt->bindParam(4, $meses, PDO::PARAM_INT);
            $this->stmt->bindParam(5, $hi, PDO::PARAM_STR);
            $this->stmt->bindParam(6, $hf, PDO::PARAM_STR);
            $this->stmt->bindParam(7, $_SESSION['idUser'], PDO::PARAM_INT);
            $this->stmt->execute();
            if($this->stmt){
                die('Membresia creada exitosamente');
            }else{
                die('Error en la inserción');
            }
        }
    }