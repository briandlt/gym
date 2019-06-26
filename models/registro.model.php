<?php
require_once('./models/conexion.php');
class Registro extends Conexion
{
    private $stmt;

    public function __construct()
    {
        parent::__construct();
    }

    public function getSocio($id)
    {
        $query = 'SELECT Nombre, Paterno, Materno, Vencimiento, foto FROM vwsociomembresias WHERE idSocio = ? ORDER BY idSocioMembresia DESC LIMIT 1;';
        $this->stmt = $this->conexion->prepare($query);
        $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
        $this->stmt->execute();
        $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
        if ($this->result != '') {
            die(json_encode($this->result));
        } else {
            die("No hay registros con esa clave!!!");
        }
    }
}
