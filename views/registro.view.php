<?php require_once('views/templates/openTags.php'); ?>

<body>
    <div id="Registro">
        <div class="containerRegistro">
            <section class="datosGym">
                <div class="dataGym">
                    <h2>Capitan Cross Training</h2>
                    <p>Salvador Garcia Diego #273</p>
                    <p>36433211</p>
                    <p id="welcome">Bienvenido!!!</p>
                </div>
                <div class="imgGym">
                    <img src="imgs/fondoCapitam.jpg" alt="imagen gym">
                </div>
            </section>
            <section class="datosSocio">
                <div id="formSocio">
                    <form action="">
                        <label for="claveSocio">Clave de socio</label>
                        <input type="text" name="" id="claveSocio">
                    </form>
                </div>
                <div id="datosPerSocio">
                    <p class="name">Nombre: <span></span></p>
                    <p class="apater">Apellido Paterno: <span></span></p>
                    <p class="amater">Apellido Materno: <span></span></p>
                    <p id="vencimiento">Vencimiento: <span></span></p>
                </div>
                <div id="imgSilueta">
                    <img src="./imgs/imgSocios/Trainer-icon.jpg" alt="">
                </div>
            </section>
            <section class="fechaHora">
                <div class="fecha">
                    <p><?php echo $dias[date('w')] . " " . date('j') . " de " . $meses[date('n')] . " del " . date('Y'); ?></p>
                </div>
                <div class="hora">
                    <p><span id="horas"></span><span id="minutos"></span><span id="segundos"></span></p>
                </div>
            </section>
        </div>
    </div>
    <?php require_once('views/templates/closeTags.php'); ?>