<?php 
    require_once("./core/core.php");
    session_start();
    if(isset($_SESSION['usuario'])){
        if(isset($_GET['views'])){
            $listaBlanca = ['home', 'usuarios', 'socios', 'productos', 'membresias', 'compras', 'ventas', 'registro', 'reportes'];
            $ruta = explode('/', $_GET['views']);
            if(in_array($ruta[0], $listaBlanca)){
                require_once('./controllers/'.$ruta[0].'.controller.php');
            }else{
                require_once('./controllers/home.controller.php');
            }
        }else{
            require_once('./controllers/home.controller.php');
            require_once("./views/editar.view.php");

        }
        require_once("./controllers/login.controller.php");
    }else{
        require_once("./controllers/login.controller.php");
    }
    require_once("./views/editar.view.php");
    require_once("./views/detalles.view.php");
    require_once("./views/addMember.view.php");
