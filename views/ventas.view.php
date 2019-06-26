<?php require_once('views/templates/openTags.php') ?>
<?php require_once('views/templates/navbar.php'); ?>
<section class="containerr">
    <h2>Ventas</h2>
    <b></b>
    <table id="myTable1" class="display">
        <thead>
            <tr>
                <th>ID venta</th>
                <th>Usuario encargado</th>
                <th>Fecha de venta</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arrayVentas as $ventas) : ?>
                <tr>
                    <td id="id"><?php echo $ventas['idSalida'] ?></td>
                    <td><?php echo $ventas['usuarioCreo'] ?></td>
                    <td><?php echo $ventas['fechaCreacion'] ?></td>
                    <td><span>$</span><?php echo number_format($ventas['total'], 2) ?></td>
                    <td><a href="" class="icon-info" title="Detalles de venta"></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="flex">
        <a href="" class="icon-plus" title="Agregar venta"></a>
    </div>
</section>
<?php require_once('views/templates/aside.php'); ?>
<?php require_once('views/templates/closeTags.php'); ?>