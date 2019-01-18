<?php
    require_once('./models/conexion.php');
    class Usuarios extends Conexion{
        private $stmt;

        public function Usuarios(){
            parent::__construct();
        }

        public function getUsuarios(){
            $query = 'SELECT * FROM vwusuarios';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->execute();
            $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->result;
        }

        public function statusUpdate($estado, $id){
            $query = "UPDATE USUARIO SET idEstado = ? WHERE idUsuario = ?";
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

        public function deleteUser($id){
            $query = 'DELETE FROM USUARIO WHERE idUsuario = ?';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            if($this->stmt){
                die("Usuario eliminado con éxito");
            }else{
                die("Error en la eliminación del usuario");
            }
        }

        public function updateUser($id, $user, $pass, $name){
            $query = 'UPDATE USUARIO SET Usuario = ?, Nombre = ?, Password = ? WHERE idUsuario = ?';
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $user, PDO::PARAM_STR);
            $this->stmt->bindParam(2, $name, PDO::PARAM_STR);
            $this->stmt->bindParam(3, $pass, PDO::PARAM_STR);
            $this->stmt->bindParam(4, $id, PDO::PARAM_INT);
            $this->stmt->execute();
            if($this->stmt){
                die("Actualización exitosa");
            }else{
                die("Error en la actualización");
            }
        }

        public function addUser($user, $pass, $name){
            $query = "INSERT INTO USUARIO (Nombre, Password, Usuario, fechaCreacion) VALUES (?,?,?,?)";
            $fecha = date('Y-m-d H:i:s');
            $this->stmt = $this->conexion->prepare($query);
            $this->stmt->bindParam(1, $name, PDO::PARAM_STR);
            $this->stmt->bindParam(2, $pass, PDO::PARAM_STR);
            $this->stmt->bindParam(3, $user, PDO::PARAM_STR);
            $this->stmt->bindParam(4, $fecha, PDO::PARAM_STR);
            $this->stmt->execute();
            if($this->stmt){
                $query2 = 'SELECT idUsuario, Usuario, Nombre, fechaCreacion, Estado FROM USUARIO JOIN ESTADO ON usuario.idEstado = estado.idEstados ORDER BY idUsuario DESC LIMIT 1';
                $this->stmt = $this->conexion->prepare($query2);
                $this->stmt->execute();
                $response = $this->stmt->fetch(PDO::FETCH_ASSOC);
                if($response){
                    die(json_encode($response));
                }else{
                    die('Error en la inserción');
                }
            }else{
                die('Error en la inserción');
            }
        }
    }