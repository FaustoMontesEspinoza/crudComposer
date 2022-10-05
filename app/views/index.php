<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <!-- Eslilos bootstrap -->
    <link rel="stylesheet" href="<?php echo BOOTSTRAP . 'css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?php echo CSS . 'sweetalert2.min.css' ?>">
    <link rel="stylesheet" href="<?php echo CSS . 'dataTables.bootstrap4.min.css' ?>">


</head>

<body class="bg-info">

    <div class="container bg-light mt-4">
        <h1 class="text-center">CRUD con PHP, PDO, POO ,Ajax y Datatables.js</h1>
        <div class="row">
            <div class="col-2 offset-10">
                <div class="text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalUsuario" id="botonCrear">
                        <i class="bi bi-plus-circle-fill"></i> Crear
                    </button>
                </div>
            </div>
        </div>
        <br />
        <br />

        <div class="table-responsive">
            <table id="datos_usuario" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Imagen</th>
                        <th>Fecha Creación</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="<?php echo BOOTSTRAP . 'js/bootstrap.bundle.min.js' ?>"></script>
    <script src="<?php echo JS . 'jquery-3.6.0.min.js' ?>"></script>
    <script src="<?php echo JS . 'sweetalert2.all.min.js' ?>"></script>
    <script src="<?php echo JS . 'jquery.dataTables.min.js' ?>"></script>
    <script src="<?php echo JS . 'dataTables.bootstrap4.min.js' ?>"></script>
    <script src="<?php echo JS . 'main.js' ?>"></script>
</body>

</html>