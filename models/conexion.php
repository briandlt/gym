<?php
    require_once('core/core.php');
    class Conexion{
        protected $conexion;
        public function __construct(){
            try{
                $this->conexion = new PDO(DB_DSN, DB_USER, DB_PASS);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conexion->exec(DB_CHARSET);
                return $this->conexion;
            }catch(Exception $e){
                die("Error en la conexion con la base de datos " . $e->getMessage());
                echo "Error en la linea " . $e->getLine();
            }
        }
    }