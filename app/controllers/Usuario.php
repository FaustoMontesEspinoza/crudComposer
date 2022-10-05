<?php 
namespace Fausto\CrudComposer\controllers;

use Fausto\CrudComposer\lib\View;

class Usuario extends View{
    public function index(){
        $this->render('index');
    }
}