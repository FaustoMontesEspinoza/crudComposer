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
        $row = [];


        if (isset($_POST["search"]["value"]) || isset($_POST["order"]) && $_POST["length"] != -1) {
            $valores = [$_POST["search"]["value"], isset($_POST['order']['0']['column']) ? $_POST['order']['0']['column'] + 1 : '1', isset($_POST["order"]['0']['dir']) ? $_POST["order"]['0']['dir'] : 'ASC', $_POST["start"], $_POST["length"]];

            $data = $usu->obtenerUsuariosDatatables($valores);
            $row = $usu->obtenerUsuarios();
        }

        foreach ($data as $usuario) {
            $imagen = '';
            //si imagen es diferente a vacio
            if ($usuario['imagen'] != '') {
                $imagen = '<img src="app/assets/img/' . $usuario['imagen'] . '"  class="img-thumbnail" width="50" height="35" />';
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
            "recordsFiltered"    => count($row),
            "data"               => $datos
        );


        echo json_encode($salida);
    }

    public function create()
    {
        $this->render('agregarUsuario');
    }

    public function store()
    {
        $usu = new ModelsUsuario();
        $usu->setNombre($_POST["nombre"]);
        $usu->setApellidos($_POST["apellidos"]);
        if ($_FILES["imagen_usuario"]["name"]!='') {
            $imagen = $this->storeImage($_FILES['imagen_usuario']);
            $usu->setImagen($imagen);
        }else {
            $usu->setImagen('');
        }
        $usu->setTelefono($_POST['telefono']);
        $usu->setEmail($_POST['email']);
        if ($usu->agregarUsuario()) {
            echo 'exito';
        }
    }

    public function viewUsuario($id){
        $usu = new ModelsUsuario();
        $usu->setId(intval($id));
        $usuar = $usu->obtenerXId();
        $this->render('actualizarUsuario',['usua'=>$usuar]);
    }

    public function actualizar($id){
        
        $usu = new ModelsUsuario();
        $usu->setId(intval($id));
        $usu->setNombre($_POST["nombre"]);
        $usu->setApellidos($_POST["apellidos"]);
        if ($_FILES["imagen_usuario"]["name"]!='') {
            $imagen = $this->storeImage($_FILES['imagen_usuario']);
            $usu->setImagen($imagen);
        }
        $usu->setTelefono($_POST['telefono']);
        $usu->setEmail($_POST['email']);
        if ($usu->update()) {
            echo 'exito';
        }
    }

    public function eliminar($id){
        $usu = new ModelsUsuario();
        $usu->setId(intval($id));
        $usu->eliminar();
    }

    private function storeImage(array $photo)
    {
        $urlCarpeta = 'app/assets/img/';
        //eliminamos el punto de name y obtenermos un array con el nombre y la extencion
        $extarr = explode('.', $photo["name"]);
        //obtenemos solo el nombre de la imagen
        $filename = $extarr[0];
        //obtenemos la extencion
        $ext = $extarr[sizeof($extarr) - 1];
        //Creamos un hash con la fecha mas el nombre del archivo y luego concatenamos la ruta
        $hash = md5(Date('Ymdgis') . $filename) . '.' . $ext;
        //Unimos la urlCarpeta con el nuevo nombre del archivo
        $urlStore = $urlCarpeta . $hash;

        //obtenemos el tamaño de solo archivos tipo imagen
        $check = getimagesize($photo["tmp_name"]);
        //validamos si el archivo es una imagen
        $uploadOk = ($check !== false) ? 1 : 0;

        if ($uploadOk == 0) {
            return NULL;
        } else {
            //si el archivo fue enviado a la carpeta destino retorna el nombre del archivo
            if (move_uploaded_file($photo["tmp_name"], $urlStore)) {
                return $hash;
            } else {
                return 'Imagen no guardada';
            }
        }
    }
}
