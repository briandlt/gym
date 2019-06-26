<?php

    #Constantes de conexion
    define('DB_DSN', 'mysql:host=localhost;dbname=gimnasio');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_CHARSET', 'SET CHARACTER SET utf8');

    #Rutas
    define('SEREVER', 'http://localhost/gym/');
    define('CSS', SEREVER.'html/css/');
    define('FONTS', SEREVER.'html/fonts/');
    define('JS', SEREVER.'html/js/');

    #Constantes de encriptacion
    define('METHOD', 'AES-256-CBC');
    define('SECRET_KEY', '$TD@2018');
    define('SECRET_IV', '221192');

    #Autoload de mis clases
    include_once('core/autoload.php');
    include_once('vendor/autoload.php');

    #Variables para Fecha
    date_default_timezone_set('America/Mexico_City');
    $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
    $meses = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    