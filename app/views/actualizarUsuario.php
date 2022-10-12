<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Actualizar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form method="POST" id="formularioUsuario" enctype="multipart/form-data">
        <div class="modal-content">
        <?php $usuarios =$this->d['usua']; ?>
            <div class="modal-body">
                <?php foreach ($usuarios as $usuario) { ?>
                <label for="nombre">Ingrese el nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $usuario['nombre']?>">
                <br />

                <label for="apellidos">Ingrese los apellidos</label>
                <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?php echo $usuario['apellidos']?>">
                <br />

                <label for="telefono">Ingrese el teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $usuario['telefono']?>">
                <br />

                <label for="email">Ingrese el email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $usuario['email']?>">
                <br />

                <label for="imagen">Seleccione una imagen</label>
                <input type="file" name="imagen_usuario" id="imagen_usuario" class="form-control">
                <span id="imagen_subida"></span>
                <img src="app/assets/img/<?php echo $usuario['imagen'] ?>" class="img-thumbnail" width="50" height="35">
                <br />
                <?php }?>
            </div>

            <div class="modal-footer">
                <input type="button" name="actualizar" id="actualizar" class="btn btn-success" value="Actualizar">
            </div>
        </div>
    </form>
</div>