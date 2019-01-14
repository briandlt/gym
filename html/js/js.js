$(document).ready( function () {
    //DATATABLE
    $('#myTable1, #myTable2').DataTable();

    //SUBMENU DE LAS OPCIONES DEL ASIDE
    var pagina = $('h2').text().toLowerCase();
    $('a[href="'+pagina+'"]').addClass('active');

    //TOMAR EL FOCO PARA EL INPUT EN EL REGISTRO
    $('#claveSocio').focus();

    // FUNCION PARA ACTUALIZAR REGISTROS DE LAS TABLAS
    $('.icon-update').click(function (e) { 
        e.preventDefault();
        var tabla = $(this).attr('class');

        if(tabla == 'icon-update updateUser'){ // USUARIOS
            $('#modal section').hide();
            $('#formUser').show();
            let usuario = $(this).parent().siblings('.usuario').text();
            let nombre = $(this).parent().siblings('.nameUser').text();
            let idUpdate = $(this).parent().siblings('#id').text();
            $('#formUser #user').val(usuario);
            $('#formUser #nameUser').val(nombre);

            var refreshRow = $(this).parent();
            function actualizarFila(usu, nom){
                refreshRow.siblings('.usuario').text(usu);
                refreshRow.siblings('.nameUser').text(nom);
            }

            $('#updateUserButton').click(function (e) { 
                e.preventDefault();
                let nNombre = $(this).parent().find('input#nameUser').val();
                let nUser = $(this).parent().find('input#user').val();
                let passUser = $(this).parent().find('input#passUser').val();
                $.ajax({
                    type: "POST",
                    data: {idUpdate, nUser, passUser, nNombre},
                    success: function (response) {
                        if(!response.error) {
                            let respuesta = (response);
                            if(respuesta == "Actualización exitosa"){
                                actualizarFila(nUser, nNombre);
                                $('input#passUser').val('');
                                $('.iziModal-button-close').click();
                            }
                        }
                    },
                    error : function(xhr, status) {
                        
                    },
                });
            });

        }else if(tabla == 'icon-update updateMember'){ // SOCIOS
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
            function actualizarFila(nom, apater, amater, tel){
                refreshRow.siblings('.nameMember').text(nom);
                refreshRow.siblings('.apaterMember').text(apater);
                refreshRow.siblings('.amaterMember').text(amater);
                refreshRow.siblings('.tel').text(tel);
            }

            $('#updateMemberButton').click(function (e) { 
                e.preventDefault();
                let nNombre = $(this).parent().find('input#nameMember').val();
                let nApaterno = $(this).parent().find('input#apaterMember').val();
                let nAmaterno = $(this).parent().find('input#amaterMember').val();
                let nTel = $(this).parent().find('input#telMember').val();
                $.ajax({
                    type: "POST",
                    data: {idUpdate, nNombre, nApaterno, nAmaterno, nTel},
                    success: function (response) {
                        if(!response.error) {
                            let respuesta = (response);
                            if(respuesta == "Actualización exitosa"){
                                actualizarFila(nNombre, nApaterno, nAmaterno, nTel);
                                $('.iziModal-button-close').click();
                            }
                        }
                    },
                    error : function(xhr, status) {
                        
                    },
                });
            });

        }else if(tabla == 'icon-update updateMembership'){ // MEMBRESIAS
            $('#modal section').hide();
            $('#formMembership').show();
            let idUpdate = $(this).parent().siblings('#id').text();
            let nameMship = $(this).parent().siblings('.nameMship').text();
            let priceMship = $(this).parent().siblings('.priceMship').text();
            let monthMship = $(this).parent().siblings('.monthMship').text();
            let hInicio = $(this).parent().siblings('.horaInicio').text().substr(0,5);
            let hFin = $(this).parent().siblings('.horaFin').text().substr(0,5);
            $('#formMembership #nameMship').val(nameMship);
            $('#formMembership #priceMship').val(priceMship);
            $('#formMembership #monthMship').val(monthMship);
            $('#formMembership #hInicio').val(hInicio);
            $('#formMembership #hFin').val(hFin);

            var refreshRow = $(this).parent();
            function actualizarFila(nombre, precio, meses, hInicio, hFin){
                refreshRow.siblings('.nameMship').text(nombre);
                refreshRow.siblings('.priceMship').text(precio);
                refreshRow.siblings('.monthMship').text(meses);
                refreshRow.siblings('.horaInicio').text(hInicio);
                refreshRow.siblings('.horaFin').text(hFin);
            }

            $('#updateMshipButton').click(function (e) { 
                e.preventDefault();
                let nNombre = $(this).parent().find('input#nameMship').val();
                let nPriceMS = $(this).parent().find('input#priceMship').val();
                let nMonth = $(this).parent().find('select#monthMship').val();
                let nHinicio = $(this).parent().find('input#hInicio').val();
                let nHfin = $(this).parent().find('input#hFin').val();
                $.ajax({
                    type: "POST",
                    data: {idUpdate, nNombre, nPriceMS, nMonth, nHinicio, nHfin},
                    success: function (response) {
                        if(!response.error) {
                            let respuesta = (response);
                            if(respuesta == "Actualización exitosa"){
                                actualizarFila(nNombre, nPriceMS, nMonth, nHinicio, nHfin);
                                $('.iziModal-button-close').click();
                            }
                        }
                    },
                    error : function(xhr, status) {
                        
                    },
                });
            });

        }else if(tabla == 'icon-update updateProduct'){ // PRODUCTOS
            $('#modal section').hide();
            $('#formProduct').show();
            let nameProduct = $(this).parent().siblings('.nameProduct').text();
            let descripcion = $(this).parent().siblings('.descripcion').text();
            let costoProduct = $(this).parent().siblings('.costoProduct').text();
            let priceProduct = $(this).parent().siblings('.priceProduct').text();
            $('#formProduct #nameProduct').val(nameProduct);
            $('#formProduct #descripcion').val(descripcion);
            $('#formProduct #costoProduct').val(costoProduct);
            $('#formProduct #priceProduct').val(priceProduct);
        }

    });


    //MODAL
    $('.icon-update').click(function (e) { 
        e.preventDefault();
        $('#modal').iziModal('open');
    });

    $("#modal").iziModal({
        title: 'Sport City',
        subtitle: '',
        headerColor: '#2d095c',
        background: null,
        theme: '',  // light
        icon: null,
        iconText: null,
        iconColor: '',
        rtl: false,
        width: 540,
        top: 80,
        bottom: null,
        borderBottom: true,
        padding: 0,
        radius: null,
        zindex: 999,
        iframe: false,
        iframeHeight: 400,
        iframeURL: null,
        focusInput: true,
        group: '',
        loop: false,
        arrowKeys: true,
        navigateCaption: true,
        navigateArrows: true, // Boolean, 'closeToModal', 'closeScreenEdge'
        history: false,
        restoreDefaultContent: false,
        autoOpen: 0, // Boolean, Number
        bodyOverflow: false,
        fullscreen: false,
        openFullscreen: false, //abrir el modal avarcando el tamaño total de la pantalla
        closeOnEscape: true,
        closeButton: true,
        appendTo: 'body', // or false
        appendToOverlay: 'body', // or false
        overlay: true,
        overlayClose: true,
        overlayColor: 'rgba(0, 0, 0, .7)',
        timeout: false, //tiempo en milisegundos para que se cierre automaticamente el modal
        timeoutProgressbar: false, //barra de progreso de tiempo restante para cerrar el modal
        pauseOnHover: false,
        timeoutProgressbarColor: 'rgba(255,255,255,0.5)',
        transitionIn: 'comingIn',   // comingIn, bounceInDown, bounceInUp, fadeInDown, fadeInUp, fadeInLeft, fadeInRight, flipInX
        transitionOut: 'fadeOutUp', // comingOut, bounceOutDown, bounceOutUp, fadeOutDown, fadeOutUp, , fadeOutLeft, fadeOutRight, flipOutX
        transitionInOverlay: 'fadeIn',
        transitionOutOverlay: 'fadeOut',
        onFullscreen: function(){},
        onResize: function(){},
        onOpening: function(){},
        onOpened: function(){},
        onClosing: function(){},
        onClosed: function(){},
        afterRender: function(){}
    });

    //FUNCION PARA ACTULIZAR EL ESTADO DE LOS DIFERENTES REGISTROS EN DISTINTAS TABLAS
    $('#myTable1 select').change(function (e) { 
        e.preventDefault();
        let estado = $(this).val();
        let id = $(this).parent().siblings('#id').text();

        $.ajax({
            type: "POST",
            // url: "",
            data: {id, estado},
            success: function (response) {
                if(!response.error) {
                    let state = (response);
                    console.log(state);                    
                }else{
                    console.log('Error en la actualizacion de el estado');
                }
            },
            error : function(xhr, status) {
                alert('Disculpe, hubo un problema');
            },  
        });
    });

    //FUNCION PARA BORRAR REGISTROS DE LAS DISTINTAS TABLAS
    $('#myTable1 .icon-delete').click(function (e) { 
        e.preventDefault();
        let opc = confirm("Realmente deseas eliminar este registro?");
        if(opc){
            let idDelete = $(this).parent().siblings('#id').text();
            var rowDelete = $(this).parents('tr');
            $.ajax({
                type: "POST",
                // url: "",
                data: {idDelete},
                success: function (response) {
                    if(!response.error) {
                        let state = (response);
                        console.log(state);
                        $(rowDelete).remove();
                    }else{
                        console.log('Error en la actualizacion de el estado');
                    }
                },
                error : function(xhr, status) {
                    alert('Disculpe, hubo un problema');
                },  
            });
        }
    });

    //ACTUALIZAR EL RELOJ DEL REGISTRO
    function ActualizarHora(){
        var fecha = new Date();
        var segundos = fecha.getSeconds();
        var minutos = fecha.getMinutes();
        var hora = fecha.getHours();
        var turno = (horas<13)? 'a.m.': 'p.m.';
        var arrayHoras = [0,1,2,3,4,5,6,7,8,9,10,11,12,1,2,3,4,5,6,7,8,9,10,11,12];
        var horas = arrayHoras[hora];

        (segundos<10)? segundos='0'+segundos: segundos=segundos;
        (horas<10)? horas='0'+horas: horas=horas;
        (minutos<10)? minutos='0'+minutos: minutos=minutos;
     
        $('#horas').text(horas + ':');
        $('#minutos').text(minutos + ':');
        $('#segundos').text(segundos + ' ' + turno);
        
    }
    setInterval(ActualizarHora,1000);

});



