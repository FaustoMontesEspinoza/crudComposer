<?php
namespace Fausto\CrudComposer\lib;

class View{
    //Llama a la vista indicado por el $nombre y pasa los valores por $datos
    function render(string $nombre, array $datos = [])
    {
        //enviar informacion a la vista
        $this->d = $datos;
        //llamar al archivo vista
        require 'app/views/' . $nombre . '.php';
    }
}