<?php
    $state = isset($_POST['estado'])? $_POST['estado']: 'null';    
    $id = isset($_POST['id'])? $_POST['id'] : 'null';
    if($state == 'Activo'){
        $estado = 1;
    }elseif($state == "Inactivo"){
        $estado = 2;
    }

    $ventas = new Ventas;
    if($state != 'null'){
        $stateResponse = $ventas->statusUpdate($id, $estado);
    }
    $arrayVentas = $ventas->getVentas();
    require_once('views/ventas.view.php');