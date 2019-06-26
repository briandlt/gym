$(document).ready(function() {
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

  // AGREGAMOS EL HISTORIAL DE MEMBRESIAS A LA TABLA INFERIOR
  function refreshTable(idMember) {
    return $.ajax({
      type: "post",
      data: {
        idMember
      },
      success: function(response) {
        let membresia = JSON.parse(response);
        if (membresia.length > 0) {
          let minDay = membresia[membresia.length - 1]["Vencimiento"];
          $(".der #comienzo").attr("min", minDay);
          if (minDay > today) {
            $(".der #comienzo").val(minDay);
          }
        } else {
          $(".der #comienzo").attr("min", "");
          $(".der #comienzo").val(today);
        }

        $(".tableMembers .historyMember>tr").remove();
        membresia.forEach(valor => {
          $(".tableMembers .historyMember").append(
            `<tr value=${valor.idSocioMembresia}>` +
              `<td>${valor.fechaInicioMembresia}</td>` +
              `<td>${valor.Vencimiento}</td>` +
              `<td>${valor.membresia}</td>` +
              `<td>$${formatNumber(valor.Precio, 2)}</td>` +
              "<td><a class='icon-delete' href=''></a></td>" +
              "</tr>"
          );
        });
      }
    });
  }

  $(".icon-calendar").click(function(e) {
    e.preventDefault();
    $("#modal3").iziModal("open");
    let row = $(this).parent();
    let idSoc = row.siblings("#id").text();
    let name = row.siblings(".nameMember").text();
    let apater = row.siblings(".apaterMember").text();
    let amater = row.siblings(".amaterMember").text();
    let tel = row.siblings(".tel").text();

    $.ajax({
      type: "post",
      data: { idSoc },
      success: function(response) {
        let socio = JSON.parse(response);
        if (socio.foto != null) {
          $(".infoSocio .divImg img").attr(
            "src",
            "./imgs/imgSocios/" + socio.foto
          );
        } else {
          $(".infoSocio .divImg img").attr(
            "src",
            "./imgs/imgSocios/Trainer-icon.jpg"
          );
        }
      }
    });

    $(".infoSocio .name span").text(name + " " + apater + " " + amater);
    $(".infoSocio .tel span").text(tel);
    $(".infoSocio .id span").text(idSoc);
    $(".infoSocio .divImg img").attr("src", "./imgs/imgUsuarios/");
    $(".historyMember>tr").remove();

    refreshTable(idSoc);
  });

  $("#membresia").change(function(e) {
    e.preventDefault();
    let idMemberS = $(this).val();
    $.ajax({
      type: "post",
      data: {
        idMemberS
      },
      success: function(response) {
        let membresia = JSON.parse(response);
        $(".infoMember .precio>span").text(
          "$" + formatNumber(membresia.Precio)
        );
        $(".infoMember .meses>span").text(membresia.meses);
        $(".infoMember .hInicio>span").text(membresia.horaInicio);
        $(".infoMember .hFinal>span").text(membresia.horaFinal);
      }
    });
  });

  $(".divBtn input").click(function(e) {
    e.preventDefault();
    let idSocio = $(".infoSocio .id>span").text();
    let idMembre = $(".izq #membresia").val();
    let precio = $(".izq .precio>span")
      .text()
      .replace("$", "")
      .replace(",", "");
    let idMember = $(".infoSocio .id>span").text();
    let fechaInicio = $(".der #comienzo").val();
    if (fechaInicio != "") {
      $.ajax({
        type: "post",
        data: {
          idSocio,
          idMembre,
          precio,
          fechaInicio
        },
        success: function(response) {
          toastr.success(response);
          refreshTable(idMember);
        }
      });
    } else {
      toastr.warning("Agrega una fecha de comienzo");
      $(".der #comienzo").focus();
    }
  });

  $(".historyMember").on("click", ".icon-delete", function(e) {
    e.preventDefault();
    let idSocMembre = $(this)
      .parents("tr")
      .attr("value");
    let idMember = $(this)
      .parents(".tableMembers")
      .siblings(".infoSocio")
      .find(".id>span")
      .text();
    let opc = confirm("Realmente deseas eliminar esta membresia?");
    if (opc) {
      $.ajax({
        type: "post",
        data: {
          idSocMembre
        },
        success: function(response) {
          toastr.success(response);
        }
      });
      console.log(idSocMembre);
      refreshTable(idMember);
    }
  });

  function formatNumber(num) {
    if (!num || num == "NaN") return "-";
    if (num == "Infinity") return "&#x221e;";
    num = num.toString().replace(/\$|\,/g, "");
    if (isNaN(num)) num = "0";
    sign = num == (num = Math.abs(num));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10) cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
      num =
        num.substring(0, num.length - (4 * i + 3)) +
        "," +
        num.substring(num.length - (4 * i + 3));
    return (sign ? "" : "-") + num + "." + cents;
  }
});
