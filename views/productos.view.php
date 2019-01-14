<?php require_once('views/templates/openTags.php') ?>
<?php require_once('views/templates/navbar.php'); ?>
<section class="containerr">
    <h2>Productos</h2>
    <b></b>
    <table id="myTable1" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Costo</th>
                <th>Precio</th>
                <th>Fecha de creacion</th>
                <th>Estado</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($arrayProductos as $producto): ?>
            <tr>
                <td id="id"><?php echo $producto['idProducto'] ?></td>
                <td class="nameProduct"><?php echo $producto['Nombre'] ?></td>
                <td class="descripcion"><?php echo $producto['Descripcion'] ?></td>
                <td class="costoProduct"><?php echo $producto['Costo'] ?></td>
                <td class="priceProduct"><?php echo $producto['Precio'] ?></td>
                <td><?php echo $producto['fechaCreacion'] ?></td>
                <?php if($producto['Estado'] == "Activo"): ?>
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
                <td><a href="" class="icon-update updateProduct" title="Actualizar producto"></a></td>
                <td><a href="" class="icon-delete" title="Eliminar producto"></a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="flex">
        <a href="" class="icon-plus" title="Agregar producto"></a>
    </div>
</section>
<?php require_once('views/templates/aside.php'); ?>
<?php require_once('views/templates/closeTags.php'); ?>