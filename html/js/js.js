$(document).ready(function() {
  //DATATABLE
  $("#myTable1, #myTable2").DataTable();

  //SUBMENU DE LAS OPCIONES DEL ASIDE
  var pagina = $("h2")
    .text()
    .toLowerCase();
  $('a[href="' + pagina + '"]').addClass("active");

  //TOMAR EL FOCO PARA EL INPUT EN EL REGISTRO
  $("#claveSocio").focus();

  //FUNCION PARA ACTULIZAR EL ESTADO DE LOS DIFERENTES REGISTROS EN DISTINTAS TABLAS
  $("#myTable1").on("change", "select", function(e) {
    e.preventDefault();
    let estado = $(this).val();
    let id = $(this)
      .parent()
      .siblings("#id")
      .text();

    $.ajax({
      type: "POST",
      // url: "",
      data: {
        id,
        estado
      },
      success: function(response) {
        if (!response.error) {
          let state = response;
          toastr.success(state);
        } else {
          console.log("Error en la actualizacion de el estado");
        }
      },
      error: function(xhr, status) {
        alert("Disculpe, hubo un problema");
      }
    });
  });

  //FUNCION PARA BORRAR REGISTROS DE LAS DISTINTAS TABLAS
  $("#myTable1").on("click", ".icon-delete", function(e) {
    e.preventDefault();
    let title;
    if (e.target.title == "Eliminar usuario") {
      title = "este usuario?";
    } else if (e.target.title == "Eliminar socio") {
      title = "este socio?";
    } else if (e.target.title == "Eliminar membresia") {
      title = "esta membresia?";
    } else if (e.target.title == "Eliminar producto") {
      title = "este producto?";
    }
    let opc = confirm("Realmente deseas eliminar " + title);
    if (opc) {
      let idDelete = $(this)
        .parent()
        .siblings("#id")
        .text();
      var rowDelete = $(this).parents("tr");
      $.ajax({
        type: "POST",
        // url: "",
        data: {
          idDelete
        },
        success: function(response) {
          if (!response.error) {
            let state = response;
            $(rowDelete).remove();
            toastr.success(state);
          } else {
            console.log("Error en la actualizacion de el estado");
          }
        },
        error: function(xhr, status) {
          alert("Disculpe, hubo un problema");
        }
      });
    }
  });

  //ACTUALIZAR EL RELOJ DEL REGISTRO
  function ActualizarHora() {
    var fecha = new Date();
    var segundos = fecha.getSeconds();
    var minutos = fecha.getMinutes();
    var hora = fecha.getHours();
    var turno = hora < 13 ? "a.m." : "p.m.";
    var arrayHoras = [
      12,
      1,
      2,
      3,
      4,
      5,
      6,
      7,
      8,
      9,
      10,
      11,
      12,
      1,
      2,
      3,
      4,
      5,
      6,
      7,
      8,
      9,
      10,
      11,
      12
    ];
    var horas = arrayHoras[hora];

    segundos < 10 ? (segundos = "0" + segundos) : (segundos = segundos);
    horas < 10 ? (horas = "0" + horas) : (horas = horas);
    minutos < 10 ? (minutos = "0" + minutos) : (minutos = minutos);

    $("#horas").text(horas + ":");
    $("#minutos").text(minutos + ":");
    $("#segundos").text(segundos + " " + turno);
  }
  setInterval(ActualizarHora, 1000);

  // LOGIN
  $("#ingresar").click(function(e) {
    e.preventDefault();
    let user = $(this)
      .siblings("#user")
      .val();
    let pass = $(this)
      .siblings("#pass")
      .val();
    // console.log("el usuario es " + user + " y el password es " + pass);
    $.ajax({
      type: "POST",
      data: {
        user,
        pass
      },
      success: function(response) {
        if (response == "Bienvenido") {
          window.location = "home";
        } else {
          toastr.error("Usuario o contraseña incorrectos");
        }
      }
    });
  });

  // CERRAR SESION
  $("#salir").click(function(e) {
    e.preventDefault();
    let salir = true;
    $.ajax({
      type: "POST",
      data: {
        salir
      },
      success: function(response) {
        window.location = "login";
      }
    });
  });

  // REGISTRO DE ASISTENCIA
  $("#claveSocio").keypress(function(e) {
    if (e.which == 13) {
      // si la tecla que se preciono es un enter entonses ejecuta la accion.
      e.preventDefault();
      let clave = $(this).val();
      $.ajax({
        type: "POST",
        data: {
          clave
        },
        success: function(response) {
          if (response != "No hay registros con esa clave!!!") {
            let socio = JSON.parse(response);
            $("#datosPerSocio > .name > span").text(socio.Nombre);
            $("#datosPerSocio > .apater > span").text(socio.Paterno);
            $("#datosPerSocio > .amater > span").text(socio.Materno);
            if (socio.foto != null) {
              $("#imgSilueta > img").attr(
                "src",
                "./imgs/imgSocios/" + socio.foto
              );
            } else {
              $("#imgSilueta > img").attr(
                "src",
                "./imgs/imgSocios/Trainer-icon.jpg"
              );
            }
            if (socio.Vencimiento <= fechaActual()) {
              $("#datosPerSocio #vencimiento span").css("color", "red");
              alert("Tu membresia a terminado");
            } else {
              $("#datosPerSocio #vencimiento span").css(
                "color",
                "rgb(19, 13, 83)"
              );
              let vencimiento = new Date(socio.Vencimiento).getTime();
              let today = new Date(fechaActual()).getTime();
              let diff = (vencimiento - today) / (1000 * 60 * 60 * 24);
              console.log(diff);
              if (diff == 1) {
                alert("Tu membresia terminara al final del dia");
              } else if (diff > 1 && diff < 4) {
                alert("Tu membresia termina en " + diff + " dias");
              }
            }
            $("#datosPerSocio > #vencimiento > span").text(socio.Vencimiento);
          } else {
            console.log(response);
            // meter un modal para imprimir la  respuesta de que no hay usuarios con esa clave.
          }
        }
      });
      $(this).val("");
    }
  });

  let abierto = false;
  $(".navbar .icon-menu").click(function(e) {
    e.preventDefault();
    $("aside").slideToggle();
  });

  // NOTIFICACIONES CON EL TOAST PLUGGIN

  toastr.options = {
    closeButton: false,
    debug: false,
    newestOnTop: false,
    progressBar: false,
    positionClass: "toast-top-right",
    preventDuplicates: true,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "3000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "show",
    hideMethod: "fadeOut"
  };

  // PROPIEDADES DEL MODAL
  $("#modal, #modal2, #modal3").iziModal({
    title: "Sport City",
    subtitle: "",
    headerColor: "#2d095c",
    background: null,
    theme: "", // light
    icon: null,
    iconText: null,
    iconColor: "",
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
    group: "",
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
    appendTo: "body", // or false
    appendToOverlay: "body", // or false
    overlay: true,
    overlayClose: true,
    overlayColor: "rgba(0, 0, 0, .7)",
    timeout: false, //tiempo en milisegundos para que se cierre automaticamente el modal
    timeoutProgressbar: false, //barra de progreso de tiempo restante para cerrar el modal
    pauseOnHover: false,
    timeoutProgressbarColor: "rgba(255,255,255,0.5)",
    transitionIn: "comingIn", // comingIn, bounceInDown, bounceInUp, fadeInDown, fadeInUp, fadeInLeft, fadeInRight, flipInX
    transitionOut: "fadeOutUp", // comingOut, bounceOutDown, bounceOutUp, fadeOutDown, fadeOutUp, , fadeOutLeft, fadeOutRight, flipOutX
    transitionInOverlay: "fadeIn",
    transitionOutOverlay: "fadeOut",
    onFullscreen: function() {},
    onResize: function() {},
    onOpening: function() {},
    onOpened: function() {},
    onClosing: function() {},
    onClosed: function() {},
    afterRender: function() {}
  });

  function fechaActual() {
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth() + 1;
    var yyyy = hoy.getFullYear();
    if (dd < 10) {
      dd = "0" + dd;
    }
    if (mm < 10) {
      mm = "0" + mm;
    }
    var today = `${yyyy}-${mm}-${dd}`;
    return today;
  }
});
