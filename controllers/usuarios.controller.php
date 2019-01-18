<?php
    // VARIABLES PARA ACTUALIZACION DE ESTADO
    $id = isset($_POST['id'])? $_POST['id'] : 'null';
    $state = isset($_POST['estado'])? $_POST['estado']: 'null';    
    // VARIABLE DE ELIMINACION
    $idDelete = isset($_POST['idDelete'])? $_POST['idDelete']: 'null';
    // VARIABLES DE ACTUALIZACION DEL REGISTRO
    $idUpdate = isset($_POST['idUpdate'])? $_POST['idUpdate']: 'null';
    $userUpdate = isset($_POST['nUser'])? $_POST['nUser']: 'null';
    $passUpdate = isset($_POST['passUser'])? $_POST['passUser']: 'null';
    $nameUpdate = isset($_POST['nNombre'])? $_POST['nNombre']: 'null';
    // VARIABLES PARA INSERTAR UN NUEVO USUARIO
    $userInsert = isset($_POST['newUser'])? $_POST['newUser']: 'null';
    $passInsert = isset($_POST['newPass'])? $_POST['newPass']: 'null';
    $nameInsert = isset($_POST['newNameUser'])? $_POST['newNameUser']: 'null';

    if($state == 'Activo'){
        $estado = 1;
    }elseif($state == "Inactivo"){
        $estado = 2;
    }

    $usuarios = new Usuarios;
    if($state != 'null'){
        $stateResponse = $usuarios->statusUpdate($estado, $id);
    }elseif($idDelete != 'null'){
        $deleteResponse = $usuarios->deleteUser($idDelete);
    }elseif($idUpdate != 'null'){
        $updateUser = $usuarios->updateUser($idUpdate, $userUpdate, $passUpdate, $nameUpdate);
    }elseif($userInsert != 'null'){
        $insertUser = $usuarios->addUser($userInsert, $passInsert, $nameInsert);
    }
    $arrayUsuarios = $usuarios->getUsuarios();
    require_once('./views/usuarios.view.php');