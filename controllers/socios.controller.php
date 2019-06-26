<?php
// VARIABLES PARA LA ACTUALIZACION DEL ESTADO DEL SOCIO
$id = isset($_POST['id']) ? $_POST['id'] : 'null';
$state = isset($_POST['estado']) ? $_POST['estado'] : 'null';
// VARIABLE PARA ELIMINACION DE SOCIOS
$idDelete = isset($_POST['idDelete']) ? $_POST['idDelete'] : 'null';
// VARIABLES PARA LA ACTUALIZACION DE LOS DATOS DE UN SOCIO
$idUpdate = isset($_POST['idUpdate']) ? $_POST['idUpdate'] : 'null';
$nombre = isset($_POST['nNombre']) ? ucwords($_POST['nNombre']) : 'null';
$apaterno = isset($_POST['nApaterno']) ? ucwords($_POST['nApaterno']) : 'null';
$amaterno = isset($_POST['nAmaterno']) ? ucwords($_POST['nAmaterno']) : 'null';
$tel = isset($_POST['nTel']) ? $_POST['nTel'] : 'null';
$foto = isset($_POST['nImagen']) ? $_POST['nImagen'] : 'null';
// VARIABLES PARA AGREGAR SOCIOS
$nNombre = isset($_POST['newName']) ? ucwords($_POST['newName']) : 'null';
$nApaterno = isset($_POST['newApaterno']) ? ucwords($_POST['newApaterno']) : 'null';
$nAmaterno = isset($_POST['newAmaterno']) ? ucwords($_POST['newAmaterno']) : 'null';
$nTel = isset($_POST['newTel']) ? $_POST['newTel'] : 'null';
$nFoto = isset($_POST['newImg']) ? $_POST['newImg'] : 'null';
// VARIABLE PARA CONSULTAR UNA MEMBRESIA
$idMemberS = isset($_POST['idMemberS']) ? $_POST['idMemberS'] : 'null';
// VARIABLES PARA AGREGAR AGREGAR UNA MEMBRESIA A UN SOCIO
$idSocio = isset($_POST['idSocio']) ? $_POST['idSocio'] : 'null';
$idMembre = isset($_POST['idMembre']) ? $_POST['idMembre'] : 'null';
$precio = isset($_POST['precio']) ? $_POST['precio'] : 'null';
$fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : 'null';
// VARIABLE PARA OBTENER EL HISTORIAL DE MEMBRESIAS DEL SOCIO
$idMember = isset($_POST['idMember']) ? $_POST['idMember'] : 'null';
// VARIABLE PARA ELIMINAR MEMBRESIA DEL SOCIO
$idSocMembre = isset($_POST['idSocMembre']) ? $_POST['idSocMembre'] : 'null';
// VARIABLE PARA OBTENER UN SOCIO EN ESPECIFICO
$idSoc = isset($_POST['idSoc']) ? $_POST['idSoc'] : 'null';


if ($state == 'Activo') {
    $estado = 1;
} elseif ($state == 'Inactivo') {
    $estado = 2;
}

$socios = new Socios;
$membresias = new Membresias;
if ($state != 'null') {
    $stateResponse = $socios->statusUpdate($id, $estado);
} elseif ($idDelete != "null") {
    $deleteResponse = $socios->deleteMember($idDelete);
} elseif ($idUpdate != "null") {
    $updateResponse = $socios->updateMember($idUpdate, $nombre, $apaterno, $amaterno, $tel, $foto);
} elseif ($nNombre != "null") {
    $insertMember = $socios->addMember($nNombre, $nApaterno, $nAmaterno, $nTel, $nFoto);
} elseif ($idMemberS != 'null') {
    $membresias->getMembresia($idMemberS);
} else if ($idSocio != "null") {
    $membresiaSocio = $socios->addSocioMembresia($idSocio, $idMembre, $precio, $fechaInicio);
} else if ($idMember != "null") {
    $membresiasSocio = $socios->getMembresiasSocio($idMember);
} else if ($idSocMembre != 'null') {
    $socios->deleteMembresiaSocio($idSocMembre);
} else if ($idSoc != 'null') {
    $socios->getSocio($idSoc);
}
$arraySocios = $socios->getSocios();
$arrayMemberS = $membresias->getMembresias();
require_once('views/socios.view.php');
