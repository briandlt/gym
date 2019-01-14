<?php require_once('views/templates/openTags.php') ?>
<?php require_once('views/templates/navbar.php'); ?>
<section class="containerr">
    <h2>Usuarios</h2>
    <b></b>
    <table id="myTable1" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Fecha de creación</th>
                <th>Estado</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($arrayUsuarios as $usuario): ?>
            <tr>
                <td id="id"><?php echo $usuario['idUsuario'] ?></td>
                <td class="usuario"><?php echo $usuario['Usuario']; ?></td>
                <td class="nameUser"><?php echo $usuario['Nombre']; ?></td>
                <td><?php echo $usuario['fechaCreacion']; ?></td>
                <?php if($usuario['Estado'] == "Activo"): ?>
                <td><select name="Estado" id="">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select></td>
                <?php else: ?>
                <td><select name="Estado">
                    <option value="Inactivo">Inactivo</option>
                    <option value="Activo">Activo</option>
                </select></td>
                <?php endif; ?>
                <td><a href="" class="icon-update updateUser" title="Actualizar usuario"></a></td>
                <td><a href="" class="icon-delete" title="Eliminar Usuario"></a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="flex">
        <a href="" class="icon-plus" title="Agregar usuario"></a>
    </div>
</section>
<?php require_once('views/templates/aside.php'); ?>
<?php require_once('views/templates/closeTags.php'); ?>