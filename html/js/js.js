$(document).ready( function () {
    //DATATABLE
    $('#myTable1, #myTable2').DataTable();

    //SUBMENU DE LAS OPCIONES DEL ASIDE
    var pagina = $('h2').text().toLowerCase();
    $('a[href="'+pagina+'"]').addClass('active');

    //TOMAR EL FOCO PARA EL INPUT EN EL REGISTRO
    $('#claveSocio').focus();

    //FUNCION PARA ACTULIZAR EL ESTADO DE LOS DIFERENTES REGISTROS EN DISTINTAS TABLAS
    $('#myTable1').on("change", "select",function (e) {
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
    $('#myTable1').on("click", ".icon-delete", function (e) { 
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

    // PROPIEDADES DEL MODAL
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

});



