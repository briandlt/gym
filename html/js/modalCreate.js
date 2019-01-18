$(document).ready(function () {

    //MODAL
    // FUNCION PARA AGREGAR REGISTROS A LAS TABLAS
    $('.icon-plus').click(function (e) { 
        e.preventDefault();
        var tabla = $(this).attr('title');
        $('.formEdit h3').html(tabla.toUpperCase());
        
        if(tabla == 'Agregar usuario'){ // USUARIOS
            $('#modal section').hide();
            $('#formUser').show();
            $('#UserButton').click(function (e) { 
                e.preventDefault();
                let newUser = $('input#user').val();
                let newPass = $('input#passUser').val();
                let newNameUser = $('input#nameUser').val();
                function updateRow(Usuario) {
                    
                }
                $.ajax({
                    type: "POST",
                    data: {newUser, newPass, newNameUser},
                    success: function (response) {
                        if(!response.error) {
                            let respuesta = (JSON.parse(response));
                            $('.iziModal-button-close').click();
                            let table = $('.tableUser tbody');
                            // SI ES LA ULTIMA PAGINACION SE AGREGARA EL REGISTRO AL FINAL DE LA PAGINA
                            if($('#myTable1_next').attr("class") == 'paginate_button next disabled'){
                                table.append("<tr><td id='id'>" + respuesta['idUsuario'] + "</td><td class='usuario'>" + respuesta['Usuario'] + "</td><td class='nameUser'>" + respuesta['Nombre']+"</td><td>" + respuesta['fechaCreacion'] +"</td><td><select name='Estado'><option value='Activo'>Activo</option><option value='Inactivo'>Inactivo</option></select></td><td><a class='icon-update updateUser' title='Actualizar usuario'></a></td><td><a class='icon-delete' title='Eliminar Usuario'></a></td></tr>");

                                // " + respuesta['Estado'] +"
                            }
                        }
                    }
                });
            });

        }else if(tabla == 'Agregar socio'){ // SOCIOS
            $('#modal section').hide();
            $('#formMember').show();   
        }else if(tabla == 'Agregar membresia'){ // MEMBRESIAS
            $('#modal section').hide();
            $('#formMembership').show(); 
        }else if(tabla == 'Agregar producto'){ // PRODUCTOS
            $('#modal section').hide();
            $('#formProduct').show(); 
        }

        $('#modal').iziModal('open');
    });

});