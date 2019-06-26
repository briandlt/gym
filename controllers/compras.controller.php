<?php
    $state = isset($_POST['estado'])? $_POST['estado']: 'null';    
    $id = isset($_POST['id'])? $_POST['id'] : 'null';
    
    if($state == 'Activo'){
        $estado = 1;
    }elseif($state == "Inactivo"){
        $estado = 2;
    }
    // RECIVIMOS EL ID PARA MOSTAR LOS DETALLES DE UNA COMPRA
    $idDetails = isset($_POST['idDetails'])? $_POST['idDetails']: 'null';
    $idProducto = isset($_POST['idProd'])? $_POST['idProd']: 'null';
    // RECIVIMOS LOS PARAMETROS PARA UNA NUEVA COMPRA
    $total = isset($_POST['total'])? $_POST['total']: 'null';
    $idProd = isset($_POST['idProdu'])? $_POST['idProdu']: 'null';
    $canti = isset($_POST['canti'])? $_POST['canti']: 'null';
    $costo = isset($_POST['costo'])? $_POST['costo']: 'null';

    $compras = new Compras;
    $productos = new Productos;
    if($state != 'null'){
        $stateResponse = $compras->statusUpdate($id, $estado);
    }elseif($idDetails != 'null'){
        $detallesCompra = $compras->detallesCompras($idDetails);
    }else if($idProducto != 'null'){
        $producto = $productos->getProducto($idProducto);
    }else if($total != 'null'){
        $newBuy = $compras->newBuy($total);
        
    }if($idProd != 'null'){
        $newDetailsBuy = $compras->newDetailsBuy($idProd, $canti, $costo);
    }
    
    $arrayCompras = $compras->getCompras();
    $arrayProductos = $productos->getProductos();
    require_once('views/compras.view.php');