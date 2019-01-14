<?php require_once('views/templates/openTags.php') ?>
<?php require_once('views/templates/navbar.php'); ?>
<section class="containerr">
    <h2>Socios</h2>
    <b></b>
    <table id="myTable1" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Telefono</th>
                <th>Fecha de creacion</th>
                <th>Estado</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($arraySocios as $socio): ?>
            <tr>
                <td id="id"><?php echo $socio['idSocio'] ?></td>
                <td class="nameMember"><?php echo $socio['Nombre'] ?></td>
                <td class="apaterMember"><?php echo $socio['Paterno'] ?></td>
                <td class="amaterMember"><?php echo $socio['Materno'] ?></td>
                <td class="tel"><?php echo $socio['Telefono'] ?></td>
                <td><?php echo $socio['fechaCreacion'] ?></td>
                <?php if($socio['Estado'] == "Activo"): ?>
                <td><select name="Estado" id="">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select></td>
                <?php else: ?>
                <td><select name="Estado" id="">
                    <option value="Inactivo">Inactivo</option>
                    <option value="Activo">Activo</option>
                </select></td>
                <?php endif; ?>
                <td><a href="" class="icon-update updateMember" title="Actualizar socio"></a></td>
                <td><a href="" class="icon-delete" title="Eliminar socio"></a></td>
                <td><a href="" class="icon-calendar" title="Agregar membresia"></a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="flex">
        <a href="" class="icon-plus" title="Agregar socio"></a>
    </div>
</section>
<?php require_once('views/templates/aside.php'); ?>
<?php require_once('views/templates/closeTags.php'); ?>