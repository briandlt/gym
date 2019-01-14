<?php
    // VARIABLES PARA LA ACTUALIZACION DEL ESTADO DEL SOCIO
    $id = isset($_POST['id'])? $_POST['id']: 'null';
    $state = isset($_POST['estado'])? $_POST['estado']: 'null';
    // VARIABLE PARA ELIMINACION DE SOCIOS
    $idDelete = isset($_POST['idDelete'])? $_POST['idDelete']: 'null';
    // VARIABLES PARA LA ACTUALIZACION DE LOS DATOS DE UN SOCIO
    $idUpdate = isset($_POST['idUpdate'])? $_POST['idUpdate']: 'null';
    $nombre = isset($_POST['nNombre'])? $_POST['nNombre']: 'null';
    $apaterno = isset($_POST['nApaterno'])? $_POST['nApaterno']: 'null';
    $amaterno = isset($_POST['nAmaterno'])? $_POST['nAmaterno']: 'null';
    $tel = isset($_POST['nTel'])? $_POST['nTel']: 'null';

    if($state == 'Activo'){
        $estado = 1;
    }elseif($state == 'Inactivo'){
        $estado = 2;
    }
    
    $socios = new Socios;
    if($state!='null'){
        $stateResponse = $socios->statusUpdate($id, $estado);
    }elseif($idDelete != "null"){
        $deleteResponse = $socios->deleteMember($idDelete);
    }elseif($idUpdate != "null"){
        $updateResponse = $socios->updateMember($idUpdate, $nombre, $apaterno, $amaterno, $tel);
    }
    $arraySocios = $socios->getSocios();
    require_once('views/socios.view.php');