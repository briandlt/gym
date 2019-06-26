<?php
    // VARIABLES PARA LA ACTUALIZACION DEL STATUS DEL PRODUCTO
    $state = isset($_POST['estado'])? $_POST['estado']: 'null';    
    $id = isset($_POST['id'])? $_POST['id'] : 'null';
    // VARIABLE PARA LA ELIMINACION DEL PRODUCTO
    $idDelete = isset($_POST['idDelete'])? $_POST['idDelete']: 'null';
    // VARIABLES PARA LA ACTUALIZACION DEL PRODUCTO
    $idUpdate = isset($_POST['idUpdate'])? $_POST['idUpdate']: 'null';
    $nombre = isset($_POST['nNombre'])? $_POST['nNombre']: 'null';
    $descripcion = isset($_POST['description'])? $_POST['description']: 'null';
    $costo = isset($_POST['nCostoProd'])? $_POST['nCostoProd']: 'null';
    $precio = isset($_POST['nPriceProd'])? $_POST['nPriceProd']: 'null';
    // VARIABLES PARA AGREGAR PRODUCTOS
    // newProduct, newDescription, newCost, newPrice
    $newProduct = isset($_POST['newProduct'])? $_POST['newProduct']: 'null';
    $newDescription = isset($_POST['newDescription'])? $_POST['newDescription']: 'null';
    $newCost = isset($_POST['newCost'])? $_POST['newCost']: 'null';
    $newPrice = isset($_POST['newPrice'])? $_POST['newPrice']: 'null';

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
    }elseif($idUpdate != 'null'){
        $updateResponse = $productos->updateProduct($idUpdate, $nombre, $descripcion, $costo, $precio);
    }elseif($newProduct != 'null'){
        $createResponse = $productos->addProduct($newProduct, $newDescription, $newCost, $newPrice);
    }
    $arrayProductos = $productos->getProductos();
    require_once('views/productos.view.php');
