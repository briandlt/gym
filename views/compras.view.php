<?php require_once('views/templates/openTags.php') ?>
<?php require_once('views/templates/navbar.php'); ?>
<section class="containerr">
    <h2>Compras</h2>
    <b></b>
    <table id="myTable1" class="display">
        <thead>
            <tr>
                <th>ID compra</th>
                <th>Usuario encargado</th>
                <th>Fecha de compra</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arrayCompras as $compras) : ?>
                <tr>
                    <td id="id"><?php echo $compras['idEntrada'] ?></td>
                    <td><?php echo $compras['usuarioCreo'] ?></td>
                    <td><?php echo $compras['fechaCreacion'] ?></td>
                    <td><span>$</span><?php echo number_format($compras['Total'], 2) ?></td>
                    <td><a href="" class="icon-info" title="Detalles de compra"></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="flex">
        <a href="" class="icon-plus" title="Agregar compra"></a>
    </div>

</section>
<?php require_once('views/templates/aside.php'); ?>
<?php require_once('views/templates/closeTags.php'); ?>