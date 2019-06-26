<?php
    // VARIABLES PARA INICIAR SESION EN EL SISTEMA
    $user = isset($_POST['user'])? $_POST['user']: 'null';
    $pass = isset($_POST['pass'])? $_POST['pass']: 'null';
    // VARIABLE PARA CERRAR SESION
    $salir = isset($_POST['salir'])? $_POST['salir']: false;
    
    $usuario = new Usuarios;

    if($user != "null"){
        $login = $usuario->login($user,$pass);
    }elseif($salir){
        $cerrar = $usuario->cerrarSesion();
    }

    if(!isset($_SESSION['usuario'])){
        require_once('views/login.view.php');
    }
