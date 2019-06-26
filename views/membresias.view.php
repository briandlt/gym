<?php require_once('views/templates/openTags.php') ?>
<?php require_once('views/templates/navbar.php'); ?>
<section class="containerr">
    <h2>Membresias</h2>
    <b></b>
    <table id="myTable1" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Meses</th>
                <th>Hora inicio</th>
                <th>Hora final</th>
                <th>Fecha de creacion</th>
                <th>Estado</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arrayMembresias as $membresia) : ?>
                <tr>
                    <td id="id"><?php echo $membresia['idMembresia'] ?></td>
                    <td class="nameMship"><?php echo $membresia['Nombre'] ?></td>
                    <td class="priceMship"><?php echo number_format($membresia['Precio'], 2) ?></td>
                    <td class="monthMship"><?php echo $membresia['meses'] ?></td>
                    <td class="horaInicio"><?php echo $membresia['horaInicio'] ?></td>
                    <td class="horaFin"><?php echo $membresia['horaFinal'] ?></td>
                    <td><?php echo $membresia['fechaCreacion'] ?></td>
                    <?php if ($membresia['Estado'] == "Activo") : ?>
                        <td><select name="Estado" id="">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select></td>
                    <?php else : ?>
                        <td><select name="Estado" id="">
                                <option value="Inactivo">Inactivo</option>
                                <option value="Activo">Activo</option>
                            </select></td>
                    <?php endif; ?>
                    <td><a href="" class="icon-update updateMembership" title="Actualizar membresia"></a></td>
                    <td><a href="" class="icon-delete" title="Eliminar membresia"></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="flex">
        <a href="" class="icon-plus" title="Agregar membresia"></a>
    </div>
</section>

<?php require_once('views/templates/aside.php'); ?>
<?php require_once('views/templates/closeTags.php'); ?>