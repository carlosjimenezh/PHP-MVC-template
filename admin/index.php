<?php
session_start();
date_default_timezone_set("America/Mexico_City");


// crear una constate base para llamar todos los archivos de forma absoluta
define('BASE', dirname(__DIR__));
//llamar variables globales
require_once BASE.'/core/core.php';
//llamar funciones comunes
require_once BASE . '/core/functions.php';



// ----------------- llamadas a un controlador ----------------
if(isset($_GET['controller']) && !empty($_GET['controller']))
{
    $controlador = kebapCaseToCamelCase($_GET['controller']);

    if(file_exists(RUTA_CONTROLLER_DIR.'/' . $controlador . RUTA_CONTROLLER_DIR_DEFAULT))
    {
        if (!isAdmin())
        {
            include(RUTA_CONTROLLER_DIR. '/login' . RUTA_CONTROLLER_DIR_DEFAULT);
            exit();
        }
        include(RUTA_CONTROLLER_DIR.'/' . $controlador . RUTA_CONTROLLER_DIR_DEFAULT);
    }else 
    {
        require_once(RUTA_ERROR_DIR);
    }
}
else
{ 
    if (!isAdmin()) 
    {
        include(RUTA_CONTROLLER_DIR. '/login' . RUTA_CONTROLLER_DIR_DEFAULT);
        exit();
    }
    include(RUTA_DEFAULT_DIR);
}



