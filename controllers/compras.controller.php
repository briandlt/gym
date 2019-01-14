<?php
    $state = isset($_POST['estado'])? $_POST['estado']: 'null';    
    $id = isset($_POST['id'])? $_POST['id'] : 'null';
    if($state == 'Activo'){
        $estado = 1;
    }elseif($state == "Inactivo"){
        $estado = 2;
    }

    $compras = new Compras;
    if($state != 'null'){
        $stateResponse = $compras->statusUpdate($id, $estado);
    }
    $arrayCompras = $compras->getCompras();
    require_once('views/compras.view.php');