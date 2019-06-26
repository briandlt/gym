<div class="divProd">
    <div>
        <label for="prod">Productos:</label>
        <select name="" id="prodSelect">
        <option value="0">Selecciona un producto</option>
        <?php foreach($arrayProductos as $productos): ?>
            <option value="<?php echo $productos['idProducto']; ?>"><?php echo $productos['Nombre']; ?></option>
        <?php endforeach; ?>
        </select>
        <label for="canti">Cantidad:</label>
        <input type="number" min="1" name="canti" id="canti">
        <input class="add" type="button" value="Agregar">
    </div>
    <div>
        <label>Costo</label>
        <label class="lblCosto"></label>
        <label>Precio</label>
        <label class="lblPrecio"></label>
    </div>
</div>
<div class="tableBuy">
    <table>
        <tr>
            <th>ID producto</th>
            <th>Cantidad</th>
            <th>Nombre</th>
            <th>Costo</th>
            <th>Total</th>
            <th></th>
        </tr>
        <tbody class="contenBuy">
            
        </tbody>
    </table>
    <div class="divTotal">
        <p>Total: $<span>0.00</span></p>
    </div>
    <input class="addBuy" type="button" value="">
</div>