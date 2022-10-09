<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Crear Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form method="POST" id="formularioUsuario" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-body">
                <label for="nombre">Ingrese el nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control">
                <br />

                <label for="apellidos">Ingrese los apellidos</label>
                <input type="text" name="apellidos" id="apellidos" class="form-control">
                <br />

                <label for="telefono">Ingrese el teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control">
                <br />

                <label for="email">Ingrese el email</label>
                <input type="email" name="email" id="email" class="form-control">
                <br />

                <label for="imagen">Seleccione una imagen</label>
                <input type="file" name="imagen_usuario" id="imagen_usuario" class="form-control">
                <span id="imagen_subida"></span>
                <br />
            </div>

            <div class="modal-footer">
                <input type="button" name="crear" id="crear" class="btn btn-success" value="Crear">
            </div>
        </div>
    </form>
</div>