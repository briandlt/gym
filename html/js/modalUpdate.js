$(document).ready(function () {
    // MODAL
    // FUNCION PARA ACTUALIZAR REGISTROS DE LAS TABLAS
    $('#myTable1').on("click", ".icon-update", function (e) {
        e.preventDefault();
        var tabla = $(this).attr('title');
        $('.formEdit h3').html(tabla.toUpperCase());

        if (tabla == 'Actualizar usuario') { // USUARIOS
            $('#modal section').hide();
            $('#formUser').show();
            let usuario = $(this).parent().siblings('.usuario').text();
            let nombre = $(this).parent().siblings('.nameUser').text();
            let idUpdate = $(this).parent().siblings('#id').text();
            $('#formUser #user').val(usuario);
            $('#formUser #nameUser').val(nombre);

            var refreshRow = $(this).parent();

            function actualizarFila(usu, nom) {
                refreshRow.siblings('.usuario').text(usu);
                refreshRow.siblings('.nameUser').text(nom);
            }

            $('#UserButton').click(function (e) {
                e.preventDefault();
                let nNombre = $(this).parent().find('input#nameUser').val();
                let nUser = $(this).parent().find('input#user').val();
                let passUser = $(this).parent().find('input#passUser').val();
                let pic = $(this).parent().find('input#imgUser').val().split('\\');
                var picUser = pic[pic.length - 1];
                $.ajax({
                    type: "POST",
                    data: {
                        idUpdate,
                        nUser,
                        passUser,
                        nNombre,
                        picUser
                    },
                    success: function (response) {
                        if (!response.error) {
                            let respuesta = (response);
                            if (respuesta == "Actualización exitosa") {
                                toastr.success(respuesta);
                                actualizarFila(nUser, MaysPrimera(nNombre));
                                $('input#passUser').val('');
                                $('.iziModal-button-close').click();
                            }
                        }
                    },
                    error: function (xhr, status) {

                    },
                });
            });

        } else if (tabla == 'Actualizar socio') { // SOCIOS
            $('#modal section').hide();
            $('#formMember').show();
            let idUpdate = $(this).parent().siblings('#id').text();
            let nameMember = $(this).parent().siblings('.nameMember').text();
            let apaterMember = $(this).parent().siblings('.apaterMember').text();
            let amaterMember = $(this).parent().siblings('.amaterMember').text();
            let tel = $(this).parent().siblings('.tel').text();
            $('#formMember #nameMember').val(nameMember);
            $('#formMember #apaterMember').val(apaterMember);
            $('#formMember #amaterMember').val(amaterMember);
            $('#formMember #telMember').val(tel);

            var refreshRow = $(this).parent();

            function actualizarFila(nom, apater, amater, tel) {
                refreshRow.siblings('.nameMember').text(nom);
                refreshRow.siblings('.apaterMember').text(apater);
                refreshRow.siblings('.amaterMember').text(amater);
                refreshRow.siblings('.tel').text(tel);
            }

            $('#MemberButton').click(function (e) {
                e.preventDefault();
                let nNombre = $(this).parent().find('input#nameMember').val();
                let nApaterno = $(this).parent().find('input#apaterMember').val();
                let nAmaterno = $(this).parent().find('input#amaterMember').val();
                let nTel = $(this).parent().find('input#telMember').val();
                let img = $(this).parent().find('input#imgMember').val().split('\\');
                let nImagen = img[img.length - 1];
                $.ajax({
                    type: "POST",
                    data: {
                        idUpdate,
                        nNombre,
                        nApaterno,
                        nAmaterno,
                        nTel,
                        nImagen
                    },
                    success: function (response) {
                        if (!response.error) {
                            let respuesta = (response);
                            if (respuesta == "Actualización exitosa") {
                                actualizarFila(nNombre, nApaterno, nAmaterno, nTel);
                                $('.iziModal-button-close').click();
                            }
                        }
                    },
                    error: function (xhr, status) {

                    },
                });
            });

        } else if (tabla == 'Actualizar membresia') { // MEMBRESIAS
            $('#modal section').hide();
            $('#formMembership').show();
            let idUpdate = $(this).parent().siblings('#id').text();
            let nameMship = $(this).parent().siblings('.nameMship').text();
            let priceMship = $(this).parent().siblings('.priceMship').text();
            let monthMship = $(this).parent().siblings('.monthMship').text();
            let hInicio = $(this).parent().siblings('.horaInicio').text().substr(0, 5);
            let hFin = $(this).parent().siblings('.horaFin').text().substr(0, 5);
            $('#formMembership #nameMship').val(nameMship);
            $('#formMembership #priceMship').val(priceMship);
            $('#formMembership #monthMship').val(monthMship);
            setTimeout(function () {
                $('#formMembership #hInicio').val(hInicio);
            }, 500);
            setTimeout(function () {
                $('#formMembership #hFin').val(hFin);
            }, 500);

            var refreshRow = $(this).parent();

            function actualizarFila(nombre, precio, meses, hInicio, hFin) {
                refreshRow.siblings('.nameMship').text(nombre);
                refreshRow.siblings('.priceMship').text(precio);
                refreshRow.siblings('.monthMship').text(meses);
                refreshRow.siblings('.horaInicio').text(hInicio);
                refreshRow.siblings('.horaFin').text(hFin);
            }

            $('#MshipButton').click(function (e) {
                e.preventDefault();
                let nNombre = $(this).parent().find('input#nameMship').val();
                let nPriceMS = $(this).parent().find('input#priceMship').val();
                let nMonth = $(this).parent().find('select#monthMship').val();
                let nHinicio = $(this).parent().find('input#hInicio').val();
                let nHfin = $(this).parent().find('input#hFin').val();
                $.ajax({
                    type: "POST",
                    data: {
                        idUpdate,
                        nNombre,
                        nPriceMS,
                        nMonth,
                        nHinicio,
                        nHfin
                    },
                    success: function (response) {
                        if (!response.error) {
                            let respuesta = (response);
                            if (respuesta == "Actualización exitosa") {
                                actualizarFila(nNombre, nPriceMS, nMonth, nHinicio, nHfin);
                                $('.iziModal-button-close').click();
                            }
                        }
                    },
                    error: function (xhr, status) {

                    },
                });
            });

        } else if (tabla == 'Actualizar producto') { // PRODUCTOS
            $('#modal section').hide();
            $('#formProduct').show();
            let idUpdate = $(this).parent().siblings('#id').text();
            let nameProduct = $(this).parent().siblings('.nameProduct').text();
            let descripcion = $(this).parent().siblings('.descripcion').text();
            let costoProduct = $(this).parent().siblings('.costoProduct').text();
            let priceProduct = $(this).parent().siblings('.priceProduct').text();
            $('#formProduct #nameProduct').val(nameProduct);
            $('#formProduct #descripcion').val(descripcion);
            $('#formProduct #costoProduct').val(costoProduct);
            $('#formProduct #priceProduct').val(priceProduct);

            var refreshRow = $(this).parent();

            function actualizarFila(nombre, descripcion, costo, precio) {
                refreshRow.siblings('.nameProduct').text(nombre);
                refreshRow.siblings('.descripcion').text(descripcion);
                refreshRow.siblings('.costoProduct').text(costo);
                refreshRow.siblings('.priceProduct').text(precio);
            }

            $('#ProductButton').click(function (e) {
                e.preventDefault();
                let nNombre = $(this).parent().find('input#nameProduct').val();
                let description = $(this).parent().find('input#descripcion').val();
                let nCostoProd = $(this).parent().find('input#costoProduct').val();
                let nPriceProd = $(this).parent().find('input#priceProduct').val();
                nCostoProd = nCostoProd.indexOf(".") == -1 ? nCostoProd += ".00" : nCostoProd;
                nPriceProd = nPriceProd.indexOf(".") == -1 ? nPriceProd += ".00" : nPriceProd;
                $.ajax({
                    type: "POST",
                    data: {
                        idUpdate,
                        nNombre,
                        description,
                        nCostoProd,
                        nPriceProd
                    },
                    success: function (response) {
                        if (!response.error) {
                            let respuesta = (response);
                            if (respuesta == "Actualización exitosa") {
                                actualizarFila(nNombre, description, nCostoProd, nPriceProd);
                                $('.iziModal-button-close').click();
                            }
                        }
                    },
                    error: function (xhr, status) {

                    },
                });
            });
        }
        $('#modal').iziModal('open');
    });

    function MaysPrimera(string) {
        string = string.split(" ");
        for (let i = 0; i < string.length; i++) {
            string[i] = string[i].charAt(0).toUpperCase() + string[i].slice(1);
        }
        return string = string.join(' ');
    }
});