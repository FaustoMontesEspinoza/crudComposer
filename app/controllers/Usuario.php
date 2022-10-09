<?php

namespace Fausto\CrudComposer\controllers;

use Fausto\CrudComposer\lib\View;
use Fausto\CrudComposer\models\Usuario as ModelsUsuario;

class Usuario extends View
{
    public function index()
    {
        $this->render('index');
    }

    public function getAll()
    {
        $usu = new ModelsUsuario();
        $data = [];
        $datos = [];
        //si la varible es nula o no esta definida
        if (!isset($_POST["search"]["value"])) {
            $data = $usu->obtenerUsuarios();
        } else {
            $data = $usu->obtenerXnombreApellido($_POST["search"]["value"]);
        }

        foreach ($data as $usuario) {
            $imagen = '';
            //si imagen es diferente a vacio
            if ($usuario['imagen'] != '') {
                $imagen = '<img src="imagen/' . $usuario['imagen'] . '"  class="img-thumbnail" width="50" height="35" />';
            } else {
                $imagen = '';
            }

            $sub_datos = [];
            $sub_datos[] = $usuario["id"];
            $sub_datos[] = $usuario["nombre"];
            $sub_datos[] = $usuario["apellidos"];
            $sub_datos[] = $usuario["telefono"];
            $sub_datos[] = $usuario["email"];
            $sub_datos[] = $imagen;
            $sub_datos[] = $usuario["fecha_creacion"];
            $sub_datos[] = '<button type="button" name="editar" id="' . $usuario["id"] . '" class="btn btn-warning btn-xs editar">Editar</button>';
            $sub_datos[] = '<button type="button" name="borrar" id="' . $usuario["id"] . '" class="btn btn-danger btn-xs borrar">Borrar</button>';
            $datos[] = $sub_datos;
        }

        $salida = array(
            "draw"               => intval($_POST["draw"]),
            "recordsTotal"       => count($data),
            "recordsFiltered"    => count($data),
            "data"               => $datos
        );

        /*  var_dump($datos); */
        echo json_encode($salida);
    }

    public function create()
    {
        $this->render('agregarUsuario');
    }

    public function store()
    {
        
    }
}
