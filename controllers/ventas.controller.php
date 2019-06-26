<?php
    $state = isset($_POST['estado'])? $_POST['estado']: 'null';    
    $id = isset($_POST['id'])? $_POST['id'] : 'null';
    if($state == 'Activo'){
        $estado = 1;
    }elseif($state == "Inactivo"){
        $estado = 2;
    }
    $idDetails = isset($_POST['idDetails'])? $_POST['idDetails']: 'null';
    // RECIVIMOS EL ID PARA MOSTAR LOS DETALLES DE UNA VENTA
    $idDetails = isset($_POST['idDetails'])? $_POST['idDetails']: 'null';
    $idProducto = isset($_POST['idProd'])? $_POST['idProd']: 'null';
    // RECIVIMOS LOS PARAMETROS PARA UNA NUEVA VENTA
    $total = isset($_POST['total'])? $_POST['total']: 'null';
    $idProd = isset($_POST['idProdu'])? $_POST['idProdu']: 'null';
    $canti = isset($_POST['canti'])? $_POST['canti']: 'null';
    $precio = isset($_POST['precio'])? $_POST['precio']: 'null';

    $ventas = new Ventas;
    $productos = new Productos;
    if($state != 'null'){
        $stateResponse = $ventas->statusUpdate($id, $estado);
    }else if($idDetails != 'null'){
        $detallesVenta = $ventas->detallesVenta($idDetails);        
    }else if($idProducto != 'null'){
        $producto = $productos->getStock($idProducto);
    }else if($total != 'null'){
        $newSale = $ventas->newSale($total);
        
    }if($idProd != 'null'){
        $newDetailsSale = $ventas->newDetailsSale($idProd, $canti, $precio);
    }

    $arrayVentas = $ventas->getVentas();
    $arrayProductos = $productos->getProductos();
    require_once('views/ventas.view.php');