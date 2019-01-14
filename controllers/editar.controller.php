<?php
    $tabla = isset($_POST['tabla'])? $_POST['tabla']: 'null';
    require_once('views/editar.view.php');