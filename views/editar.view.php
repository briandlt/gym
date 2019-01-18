<div class="iziModal" id="modal">
    <section id="formUser" class="formEdit">
        <h3></h3>
        <form action="" method="post" id="formulario">
            <div>
                <label for="user">Usuario:</label>
                <input type="text" name="usuario" id="user" value="">
            </div>
            <div>
                <label for="passUser">Contraseña:</label>
                <input type="password" name="passUser" id="passUser">
            </div>
            <div>
                <label for="nameUser">Nombre:</label>
                <input type="text" name="name" id="nameUser" value="">
            </div>
            <input type="submit" value="Guardar" id="UserButton">
        </form>
    </section>

    <section id="formMember" class="formEdit">
        <h3></h3>
        <form action="" method="post" id="formulario">
            <div>
                <label for="nameMember">Nombre:</label>
                <input type="text" name="nameMember" id="nameMember" value="">
            </div>
            <div>
                <label for="apaterMember">Apellido paterno:</label>
                <input type="text" name="apaterMember" id="apaterMember">
            </div>
            <div>
                <label for="amaterMember">Apellido materno:</label>
                <input type="text" name="amaterMember" id="amaterMember" value="">
            </div>
            <div>
                <label for="telMember">Teléfono:</label>
                <input type="text" name="telMember" id="telMember">
            </div>
            <input type="submit" value="Guardar" id="MemberButton">
        </form>
    </section>

    <section id="formMembership" class="formEdit">
        <h3></h3>
        <form action="" method="post" id="formulario">
            <div>
                <label for="nameMship">Nombre:</label>
                <input type="text" name="nameMship" id="nameMship" value="">
            </div>
            <div>
                <label for="priceMship">Precio:</label>
                <input type="text" name="priceMship" id="priceMship">
            </div>
            <div>
                <label for="monthMship">Meses:</label>
                <select name="monthMship" id="monthMship">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div>
                <label for="hInicio">Hora inicio:</label>
                <input type="time" name="hInicio" id="hInicio">
            </div>
            <div>
                <label for="hFin">Hora final:</label>
                <input type="time" name="hFin" id="hFin">
            </div>
            <input type="submit" value="Guardar" id="MshipButton">
        </form>
    </section>
    <section id="formProduct" class="formEdit">
        <h3></h3>
        <form action="" method="post" id="formulario">
            <div>
                <label for="nameProduct">Nombre:</label>
                <input type="text" name="nameProduct" id="nameProduct" value="">
            </div>
            <div>
                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" id="descripcion">
            </div>
            <div>
                <label for="costoProduct">Costo:</label>
                <input type="text" name="costoProduct" id="costoProduct" value="">
            </div>
            <div>
                <label for="priceProduct">Precio:</label>
                <input type="text" name="priceProduct" id="priceProduct">
            </div>
            <input type="submit" value="Guardar" id="ProductButton">
        </form>
    </section>
</div>