$(document).ready(function () {
  let dataTable = $("#datos_usuario").DataTable({
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: "usuarios",
      type: "POST",
    },
    columnsDefs: [
      {
        targets: [0, 3, 4],
        orderable: false,
      },
    ],
    language: {
      decimal: "",
      emptyTable: "No hay registros",
      info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
      infoFiltered: "(Filtrado de _MAX_ total entradas)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Entradas",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscar:",
      zeroRecords: "Sin resultados encontrados",
      paginate: {
        first: "Primero",
        last: "Ultimo",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
  });

  $("#crearUsuario").click(function (e) {
    e.preventDefault();
    $(".modal-dialog").load("usuarios", function () {
      $("#mi-modal").modal();
      $("#crear").click(function (e) {
        e.preventDefault();
        /* var nombre = $("#nombre").val();
        var apellido = $("#apellidos").val();
        var telefono = $("#telefono").val();
        var email = $("#email").val();
        var extension = $("#imagen_usuario").val().split(".").pop().toLowerCase(); */
        let form = $("#formularioUsuario");
        let data = new FormData(form.get(0));
        let extension = $("#imagen_usuario")
          .val()
          .split(".")
          .pop()
          .toLowerCase();
        let erros = 0;

        for (const [key, value] of data) {
          if (value == "") {
            erros++;
          }
        }
        if (extension != "") {
          if (jQuery.inArray(extension, ["gif", "png", "jpg", "jpeg"]) == -1) {
            console.log("formato invalido");
          }
        }
        if (erros > 0) {
          console.log("Campos incompletos");
        } else {
          $.ajax({
            type: "post",
            url: "usuarios/crear",
            data: data,
            contentType: false,
            processData: false,
            success: function (response) {
              console.log(response);
            },
          });
        }
      });
    });
  });
});
