<?php
    $state = isset($_POST['estado'])? $_POST['estado']: 'null';    
    $id = isset($_POST['id'])? $_POST['id'] : 'null';
    $idDelete = isset($_POST['idDelete'])? $_POST['idDelete']: 'null';

    if($state == 'Activo'){
        $estado = 1;
    }elseif($state == "Inactivo"){
        $estado = 2;
    }

    $productos = new Productos;
    if($state != 'null'){
        $stateResponse = $productos->statusUpdate($id, $estado);
    }elseif($idDelete != 'null'){
        $deleteResponse = $productos->deleteProduct($idDelete);
    }
    $arrayProductos = $productos->getProductos();
    require_once('views/productos.view.php');
