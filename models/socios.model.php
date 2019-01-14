<?php
    require_once('./models/conexion.php');    
    class Socios extends Conexion{
        private $stmt;

        public function __construct(){
            parent::__construct();
        }

        public function getSocios(){
            $query = 'SELECT * FROM vwsocios';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->execute();
            $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->result;
        }

        public function statusUpdate($id, $estado){
            $query = 'UPDATE SOCIO SET idEstado = ? WHERE idSocio = ?';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $estado, PDO::PARAM_INT);
            $this->stmt->bindParam(2, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            if($this->stmt){
                die("Actualizacion exitosa");
            }else{
                die("Falló en la actualización");
            }
        }

        public function deleteMember($id){
            $query = 'DELETE FROM SOCIO WHERE idSocio = ?';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            if($this->stmt){
                die("Socio eliminado con éxito");
            }else{
                die("Error en la eliminación del socio");
            }
        }

        public function updateMember($id, $nombre, $apaterno, $amaterno, $tel){
            $query = 'UPDATE SOCIO SET Nombre = ?, Paterno = ?, Materno = ?, Telefono = ? WHERE idSocio = ?';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $nombre, PDO::PARAM_STR);
            $this->stmt->bindParam(2, $apaterno, PDO::PARAM_STR);
            $this->stmt->bindParam(3, $amaterno, PDO::PARAM_STR);
            $this->stmt->bindParam(4, $tel, PDO::PARAM_STR);
            $this->stmt->bindParam(5, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            if($this->stmt){
                die('Actualización exitosa');
            }else{
                die('Error en la actualización');
            }
        }
    }