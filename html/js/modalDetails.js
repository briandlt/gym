$(document).ready(function() {
  $("#myTable1").on("click", ".icon-info", function(e) {
    e.preventDefault();
    const idDetails = $(this)
      .parent()
      .siblings("#id")
      .text();
    let action = $(this).attr("title");
    let total = $(this)
      .parent()
      .prev()
      .text();
    if (action == "Detalles de compra") {
      $(".detallesCompra tr").remove();
      $("#modal2 section").hide();
      $("#detallesCompra").show();
      $("#detallesCompra .divTotal")
        .find("span")
        .text(total);

      $.ajax({
        type: "post",
        data: {
          idDetails
        },
        success: function(response) {
          if (!response.error) {
            let detCompra = JSON.parse(response);
            detCompra.forEach(function(valor) {
              $(".detallesCompra").append(
                "<tr><td id='id'>" +
                  valor.idEntrada +
                  "</td><td class='producto'>" +
                  valor.Nombre +
                  "</td><td class='cantidad'>" +
                  valor.cantidad +
                  "</td><td class='precioU'>$" +
                  valor.CostoUnitario +
                  "</td><td class='total'>$" +
                  valor.total +
                  "</td></tr>"
              );
            });
          }
        }
      });
    } else if (action == "Detalles de venta") {
      $(".detallesVenta tr").remove();
      $("#modal2 section").hide();
      $("#detallesVenta").show();
      $("#detallesVenta .divTotal")
        .find("span")
        .text(total);

      $.ajax({
        type: "post",
        data: {
          idDetails
        },
        success: function(response) {
          if (!response.error) {
            let detVenta = JSON.parse(response);
            console.log(detVenta);
            detVenta.forEach(function(valor) {
              let prod = $(
                ".detallesVenta tr td.producto:contains(" + valor.Nombre + ")"
              );
              if (valor.Nombre == prod.text()) {
                let contador = parseInt(prod.siblings(".cantidad").text());
                prod.siblings(".cantidad").text(contador + 1);
              } else {
                $(".detallesVenta").append(
                  "<tr><td id='id'>" +
                    valor.idSalida +
                    "</td><td class='producto'>" +
                    valor.Nombre +
                    "</td><td class='cantidad'>" +
                    valor.cantidad +
                    "</td><td class='precioU'>$" +
                    valor.precioUnitario +
                    "</td><td class='total'>$" +
                    valor.Total +
                    "</td></tr>"
                );
              }
            });
          }
        }
      });
    }
    $("#modal2").iziModal("open");
  });
});
