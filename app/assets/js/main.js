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
            $(".modal-header").after(`<div class="text-center text-danger" id="notis">
            <h5>Formato de imagen invalido</h5>
            </div>`)
            setTimeout(function(){
              $('#notis').remove();
            },2000);
          }
        }
        if (erros > 0) {
          $(".modal-header").after(`<div class="text-center text-danger" id="noti">
          <h5>Datos incompletos</h5>
          </div>`)
          setTimeout(function(){
            $('#noti').remove();
          },2000);
        } else {
          $.ajax({
            type: "post",
            url: "usuarios/crear",
            data: data,
            contentType: false,
            processData: false,
            success: function (response) {
              $("#formularioUsuario")[0].reset();
              $("#mi-modal").modal("hide");
              Swal.fire({
                icon: "success",
                title: "Usuario creado",
                showConfirmButton: false,
                timer: 1500,
              });
              dataTable.ajax.reload();
            },
          });
        }
      });
    });
  });

  $("#datos_usuario").on("click", ".editar", function (e) {
    e.preventDefault();
    let id = this.id;
    $(".modal-dialog").load("usuarios/" + id, function () {
      $("#mi-modal").modal();
      $("#actualizar").click(function (e) {
        e.preventDefault();
        let form = $("#formularioUsuActualizar");
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
            $(".modal-header").after(`<div class="text-center text-danger" id="notis">
            <h5>Formato de imagen invalido</h5>
            </div>`)
            setTimeout(function(){
              $('#notis').remove();
            },2000);
          }
        }
        if (erros > 0) {
          $(".modal-header").after(`<div class="text-center text-danger" id="noti">
          <h5>Datos incompletos</h5>
          </div>`)
          setTimeout(function(){
            $('#noti').remove();
          },2000);
        } else {
          $.ajax({
            type: "post",
            url: "usuarios/actualizar/" + id,
            data: data,
            contentType: false,
            processData: false,
            success: function (response) {
              $("#mi-modal").modal("hide");
              Swal.fire({
                icon: "success",
                title: "Actualizado correctamente",
                showConfirmButton: false,
                timer: 1500,
              });
              dataTable.ajax.reload();
            },
          });
        }
      });
    });
  });

  $("#datos_usuario").on("click", ".borrar", function (e) {
    e.preventDefault();
    let id = this.id;
    Swal.fire({
      title: "¿Está seguro?",
      text: "¡No podrás revertir esto!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "DELETE",
          url: "usuarios/eliminar/" + id,
          success: function (response) {
            dataTable.ajax.reload();
          },
        });
        Swal.fire("¡Eliminado!", "Su usuario ha sido eliminado.", "success");
      }
    });
  });
});
