$(document).ready(function () {

    function tableUpdate() {
        $('#myTable1 > tbody').remove();
        let actualiza = 1;
        $.ajax({
            type: "POST",
            data: "actualiza",
            success: function (response) {
                let result = (response);
                console.log(result);
                $('#myTable1').append("<tbody>" + result.forEach(function (valor, index) {
                    "<tr><td id='id'>" + valor.idUsuario + "</td><td class='usuario'>" + valor.Usuario + "</td><td class='nameUser'>" + valor.Nombre + "</td><td>" + valor.fechaCreacion + "</td><td><select name='Estado'><option value='Activo'>Activo</option><option value='Inactivo'>Inactivo</option></select></td><td><a class='icon-update updateUser' title='Actualizar usuario'></a></td><td><a class='icon-delete' title='Eliminar Usuario'></a></td></tr>"
                }) + "</tbody>");
            }
        });
    }

    //MODAL
    // FUNCION PARA AGREGAR REGISTROS A LAS TABLAS
    $('.icon-plus').click(function (e) {
        e.preventDefault();
        var tabla = $(this).attr('title');
        $('.formEdit h3').html(tabla.toUpperCase());
        let btn = tabla == "Agregar venta" ? "Realizar venta" : "Realizar compra";
        $('.addBuy').val(btn);

        if (tabla == 'Agregar usuario') { // USUARIOS
            $('#modal section').hide();
            $('#formUser').show();
            $('#UserButton').click(function (e) {
                e.preventDefault();
                let newUser = $('input#user').val();
                let newPass = $('input#passUser').val();
                let newNameUser = $('input#nameUser').val();
                let pic = $('input#imgUser').val().split('\\');
                let newPic = pic[pic.length - 1];
                $.ajax({
                    type: "POST",
                    data: {
                        newUser,
                        newPass,
                        newNameUser,
                        newPic
                    },
                    success: function (response) {
                        if (!response.error) {
                            if (response == "Usuario creado exitosamete") {
                                console.log(response);
                                $('.iziModal-button-close').click();
                                toastr.success(response);
                                setTimeout("window.location='usuarios';", 3000);
                            }
                        }
                    }
                });
            });

        } else if (tabla == 'Agregar socio') { // SOCIOS
            $('#modal section').hide();
            $('#formMember').show();
            $('#MemberButton').click(function (e) {
                e.preventDefault();
                let newName = $('input#nameMember').val();
                let newApaterno = $('input#apaterMember').val();
                let newAmaterno = $('input#amaterMember').val();
                let newTel = $('input#telMember').val();
                let img = $('input#imgMember').val().split('\\');
                let newImg = img[img.length - 1];
                $.ajax({
                    type: "POST",
                    data: {
                        newName,
                        newApaterno,
                        newAmaterno,
                        newTel,
                        newImg
                    },
                    success: function (response) {
                        if (!response.error) {
                            if (response == "Socio creado exitosamete") {
                                console.log(response);
                                $('.iziModal-button-close').click();
                                toastr.success(response);
                                setTimeout("window.location='socios';", 3000);
                            }
                        }
                    }
                });
            });

        } else if (tabla == 'Agregar membresia') { // MEMBRESIAS
            $('#modal section').hide();
            $('#formMembership').show();
            $('#MshipButton').click(function (e) {
                e.preventDefault();
                let newName = $('input#nameMship').val();
                let newPrice = $('input#priceMship').val();
                let newMonths = $('select#monthMship').val();
                let newHI = $('input#hInicio').val();
                let newHF = $('input#hFin').val();
                $.ajax({
                    type: "POST",
                    data: {
                        newName,
                        newPrice,
                        newMonths,
                        newHI,
                        newHF
                    },
                    success: function (response) {
                        if (!response.error) {
                            if (response == "Membresia creada exitosamente") {
                                console.log(response);
                                $('.iziModal-button-close').click();
                                toastr.success(response);
                                setTimeout("window.location='membresias';", 3000);
                            }
                        }
                    }
                });
            });

        } else if (tabla == 'Agregar producto') { // PRODUCTOS
            $('#modal section').hide();
            $('#formProduct').show();
            $('#ProductButton').click(function (e) {
                e.preventDefault();
                let newProduct = $('input#nameProduct').val();
                let newDescription = $('input#descripcion').val();
                let newCost = $('input#costoProduct').val();
                let newPrice = $('input#priceProduct').val();
                $.ajax({
                    type: "POST",
                    data: {
                        newProduct,
                        newDescription,
                        newCost,
                        newPrice
                    },
                    success: function (response) {
                        if (!response.error) {
                            if (response == "Producto creado exitosamente") {
                                console.log(response);
                                $('.iziModal-button-close').click();
                                toastr.success(response);
                                setTimeout("window.location='productos';", 3000);
                            }
                        }
                    }
                });
            });
        } else if (tabla == 'Agregar compra' || tabla == 'Agregar venta') { // COMPRAS O VENTAS
            if (tabla == "Agregar venta") {
                $("label:contains('Costo')").remove();
                $('.lblCosto').remove();
                $('.tableBuy th:contains("Costo")').text("Precio");
                const idProd = 0;

                function inventario() {
                    return $.ajax({
                        type: "post",
                        data: {
                            idProd
                        },
                        success: function (response) {
                            let prod = JSON.parse(response);
                            $('#prodSelect>option').hide();
                            for (let i = 0; i < prod.length; i++) {
                                $("#prodSelect>option[value=" + prod[i]["idProducto"] + "]").show();
                                // $("#prodSelect>option:contains("+ prod[i]["Nombre"] +")").show();
                            }
                        }
                    });
                }
                inventario();

            }
            $('#modal section').hide();
            $('#formCompraVenta').show();
            $('#prodSelect').change(function () {
                let idProd = $(this).val();
                updateStock(idProd, "change");
            });

            function updateStock(idProd, event) {
                if (idProd != 0) {
                    $.ajax({
                        type: "post",
                        data: {
                            idProd
                        },
                        success: function (response) {
                            var prod = JSON.parse(response);
                            let stock;
                            let can = $('.productsBuy .id:contains(' + prod['idProducto'] + ')').siblings('.cantidad').text();
                            if (can != "") {
                                stock = parseInt(prod['stock']) - parseInt(can);
                                $("#canti").attr("max", stock);
                            } else {
                                stock = parseInt(prod['stock'])
                                $("#canti").attr("max", stock);
                            }

                            if (event == "change") {
                                $('.lblCosto').html("$ <span>" + prod['Costo'] + "</span>");
                                $('.lblPrecio').html("$ <span>" + prod['Precio'] + "</span>");
                            } else {
                                if ($('#prodSelect').val() == "0") {
                                    $('#canti').attr("max", "");
                                    $('.lblCosto').html("");
                                    $('.lblPrecio').html("");
                                }
                                $('#prodSelect').focus();
                            }
                        }
                    });
                } else {
                    $('.lblCosto').html('');
                    $('.lblPrecio').html('');
                }
            };

            var arrayIds = [];
            $('.divProd ').on("click", ".add", function (e) {
                e.preventDefault();
                let idProd = $('#prodSelect').val();
                let cantidad = parseInt($(this).siblings('#canti').val());
                let costo = $('.lblCosto span').text();
                let precio = $('.lblPrecio span').text();
                let nameProd = $('#prodSelect option:selected').text();
                var clase = (tabla == "Agregar venta") ? "precio" : "costo";
                let costoPrecio = (tabla == "Agregar venta") ? precio : costo;
                let subtotal = (costoPrecio * cantidad).toFixed(2);

                if (cantidad > 0 && idProd != 0) {
                    if ($('.productsBuy').length > 0 && arrayIds.indexOf(idProd) >= 0) {
                        // SI EL PRODUCTO YA FUE AGREGADO A LA TABLA ENTONCES SOLO INCREMENTARA LA CANTIDAD DE PRODUCTOS
                        let fila = $(".id:contains(" + idProd + ")");
                        let contador = parseInt(fila.siblings('.cantidad').text());
                        let newCanti = contador + cantidad;
                        fila.siblings('.cantidad').text(newCanti);
                        fila.siblings('.total').children('span').text((newCanti * costoPrecio).toFixed(2));
                        $('#prodSelect').val(0).focus();
                        $('.lblCosto').html('');
                        $('.lblPrecio').html('');
                        $('#canti').val('');
                        actualizarTotal();
                    } else {
                        // SI NO HA SIDO AGREGADO EL PRODUCTO A LA LISTA ENTONCES LO AGREGA
                        $('.tableBuy .contenBuy').append("<tr class='productsBuy'><td class='id'>" + idProd + "</td><td class='cantidad'>" + cantidad + "</td><td class='producto'>" + nameProd + "</td><td class=" + clase + ">$<span>" + costoPrecio + "</span></td><td class='total'>$<span>" + subtotal + "</span></td><td><a class='icon-delete' href='' title='Quitar producto'></a></td></tr>");
                        $('#prodSelect').val(0).focus();
                        $('.lblCosto').html('');
                        $('.lblPrecio').html('');
                        $('#canti').val('');
                        actualizarTotal();
                    }
                    arrayIds.push(idProd);

                    // ELIMINAR PRODUCTO DE LA TABLA DE LISTA DE PRODUCTOA A COMPRAR O VENDER.
                    $('.contenBuy .icon-delete').click(function (e) {
                        e.preventDefault();
                        let idProd = $(this).parent().siblings(".id").text();
                        console.log(idProd);
                        $(this).parents('tr').remove();
                        actualizarTotal();
                        updateStock(idProd, "delete");
                    });
                }

                function actualizarTotal() {
                    let total = 0;
                    $('.total>span').each(function (index, element) {
                        total += parseFloat($(this).text(), 2);
                    });
                    $('.divTotal>p>span').text(total.toFixed(2));
                }
            });


            // PASO DE PARAMETROS PARA LA NUEVA COMPRA O VENTA
            if ($('.productsBuy')) {
                $('.addBuy').click(function (e) {
                    e.preventDefault();
                    var total = 0;
                    if ($('.productsBuy').length > 0) {

                        $('.productsBuy').each(function (index, element) {
                            let preTotal = $(this).find('.total>span').text();
                            total += parseFloat(preTotal);
                        });

                        $.ajax({
                            type: "post",
                            data: {
                                total
                            },
                            success: function (response) {
                                $('.iziModal-button-close').click();
                                toastr.success('Compra realizada con exito');
                                setTimeout("window.location='';", 3000);
                            }
                        });

                        $('.productsBuy').each(function (index, element) {
                            let idProdu = $(this).children('.id').text();
                            let canti = $(this).children('.cantidad').text();
                            let costo = $(this).find('.costo>span').text();
                            let precio = $(this).find('.precio>span').text();

                            $.ajax({
                                type: "POST",
                                data: {
                                    idProdu,
                                    canti,
                                    costo,
                                    precio
                                },
                                success: function (response) {

                                }
                            });
                        });
                    }
                });
            }
        }

        $('#modal').iziModal('open');
    });


});