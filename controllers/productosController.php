<?php 

    //ver si tiene $_GET['form'] existe, para saber si se solicita un formulario
    if (isset($_GET['form']) && !empty($_GET['form'])) {
        $form = $_GET['form'];
        switch ($form) {
            case 'create':
                //enviar al formulario de creación
                include_once 'views/productos/crearProducto.php';
                break;
            case 'edit':
                //verificar si existe el $_GET['id'] del elemento a editar
                if (isset($_GET['id']) || is_numeric($_GET['id'])) {
                    $id = $_GET['id'];
                    //hacer llamada a la api para ver si existe el elemento
                    try {
                        $respuesta = callAPi('GET', "api/productos/$id");
                    } catch (\Throwable $th) {
                        $respuesta = ['ok' => false];
                        error_log("Fallo al obtener los productos ".$th->getMessage());
                    }

                    //verificar si la respuesta es exitosa
                    if ( !$respuesta['ok'] ) {
                        include_once 'views/error.php';
                        exit();
                    }   

                    //si no hay resultados
                    if (!count($respuesta['producto']) > 0) {
                        include_once 'views/sinResultados.php';
                        exit();
                    }

                    //obtener productos
                    $producto = $respuesta['producto'];
                    
                    
                    include_once 'views/productos/editarProducto.php';
                    break;
                }
                //enviar pagina de error
                include_once 'views/error.php';
                break;
            default:
                //enviar pagina de error
                include_once 'views/error.php';
                break;
        }
        exit();
    }

    //obtener pagina
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;


    //hacer una llamada a la api para obtener los projects
    try {
        $respuesta = callAPi('GET', 'api/productos', ['page' => $page, 'limit' => 10]);
    } catch (\Throwable $th) {
        $respuesta = ['ok' => false];
        error_log("Fallo al obtener los productos ".$th->getMessage());
    }


    //verificar si la respuesta es exitosa
    if ( !$respuesta['ok'] ) {
        include_once 'views/error.php';
        exit();
    }   


    //si no hay resultados
    if (!count($respuesta['productos']) > 0) {
        include_once 'views/sinResultados.php';
        exit();
    }


    //obtener productos
    $productos = $respuesta['productos'];



    include_once 'views/productos/productos.php';