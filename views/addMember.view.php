<div class="iziModal" id="modal3">
    <section id="addMember">
        <div class="infoSocio">
            <div>
                <label class="name">Nombre: <span></span></label>
                <label class="tel">Teléfono: <span></span></label>
                <label class="id">Clave: <span></span></label>
            </div>
            <div class="divImg">
                <img src="./imgs/imgUsuarios/IMG_20150812_141351.jpg" alt="">
            </div>
        </div>
        <div class="infoMember">
            <div class="izq">
                <div>
                    <label for="">Membresia:</label>
                    <select name="" id="membresia">
                        <?php foreach ($arrayMemberS as $membresias) : if ($membresias['idMembresia'] != 1) : ?>
                                <option value="<?php echo $membresias['idMembresia']; ?>"><?php echo $membresias['Nombre']; ?></option>
                            <?php endif;
                    endforeach; ?>
                    </select>
                </div>
                <label class="precio">Precio: <span>$<?php echo number_format($arrayMemberS[1]['Precio'], 2); ?></span></label>
                <label class="meses">Meses: <span><?php echo $arrayMemberS[1]['meses']; ?></span></label>
            </div>
            <div class="der">
                <div>
                    <label for="comienzo">Comienzo:</label>
                    <input type="date" name="" id="comienzo" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <label class="hInicio">Hora inicio: <span><?php echo $arrayMemberS[1]['horaInicio']; ?></span></label>
                <label class="hFinal">Hora final: <span><?php echo $arrayMemberS[1]['horaFinal']; ?></span></label>
            </div>
            <div class="divBtn">
                <input type="button" value="Agregar">
            </div>
        </div>
        <div class="tableMembers">
            <table>
                <tr>
                    <th>Inicio</th>
                    <th>Vencimiento</th>
                    <th>Membresia</th>
                    <th>Precio</th>
                    <th></th>
                </tr>
                <tbody class="historyMember">

                </tbody>
            </table>
        </div>
    </section>
</div>