<?php

//saber si estas en servidor local
define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], ['localhost', '::1']));

//URL Absoluta
define('URL', (IS_LOCAL ? 'http://localhost/proyectosphp/crudComposer/' : 'LA URL DE SU SERVIDOR EN PRODUCCION'));

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', getcwd() . DS);



define('VIEWS', ROOT.'app\views'.DS);
define('INCLUDES',VIEWS.'includes'.DS);


//Para archivos que vayamos a incluir en header o footer (css o js)
define('CSS', URL . 'app/assets/css/');
define('IMG', URL . 'app/assets/img/');
define('JS', URL . 'app/assets/js/');
define('BOOTSTRAP',URL.'vendor/twbs/bootstrap/dist/');