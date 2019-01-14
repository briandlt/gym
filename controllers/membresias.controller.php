<?php
    // VARIABLES PARA ACTUALIZAR EL ESTATUS DE LA MEMBRESIA
    $id = isset($_POST['id'])? $_POST['id']: 'null';
    $state = isset($_POST['estado'])? $_POST['estado']: 'null';
    // VARIABLE PARA ELIMINAR MEMBRESIA
    $idDelete = isset($_POST['idDelete'])? $_POST['idDelete']: 'null';
    // VARIABLES PARA ACTUALIZAR MEMBRESIA
    $idUpdate = isset($_POST['idUpdate'])? $_POST['idUpdate']: 'null';
    $name = isset($_POST['nNombre'])? $_POST['nNombre']: 'null';
    $price = isset($_POST['nPriceMS'])? $_POST['nPriceMS']: 'null';
    $months = isset($_POST['nMonth'])? $_POST['nMonth']: 'null';
    $startHour = isset($_POST['nHinicio'])? $_POST['nHinicio']: 'null';
    $finishHour = isset($_POST['nHfin'])? $_POST['nHfin']: 'null';
    
    if($state == 'Activo'){
        $estado = 1;
    }elseif($state == 'Inactivo'){
        $estado = 2;
    }

    $membresias = new Membresias;
    if($state != 'null'){
        $stateResponse = $membresias->statusUpdate($id, $estado);
    }elseif($idDelete != 'null'){
        $deleteResponse = $membresias->deleteMembership($idDelete);
    }elseif($idUpdate != 'null'){
        $updateResponse = $membresias->updateMembership($idUpdate, $name, $price, $months, $startHour, $finishHour);
    }
    
    $arrayMembresias = $membresias->getMembresias();
    require_once('views/membresias.view.php');