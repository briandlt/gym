<?php
    $registro = new Registro;
    // VARIABLE PARA EL REGISTRO DE ASISTENCIA
    $clave = isset($_POST['clave'])? $_POST['clave']: 'null';
    if($clave != 'null'){
        $asistir = $registro->getSocio($clave);
    }
    require_once('views/registro.view.php');