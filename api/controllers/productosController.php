<?php 
//manejar request
    $request_method = $_SERVER['REQUEST_METHOD'];
    switch ($request_method) {
        //verificar que tenga los permisos necesarios
        case 'GET':
            obtenerElementos($_GET);
            break;
        case 'POST':
            crearElemento($_POST);
            break;
        case 'PUT':
            parse_str(file_get_contents("php://input"), $put_vars);
            editarElemento($put_vars);
            break;  
        case 'DELETE':
            eliminarElemento($_GET);
            break;
        default:
            respuestaDefault();
            break;
    }


    function obtenerElementos (array $request = []) : void
    {
        require_once './models/productosModel.php';
        $productosModels = new ProjectsModel();
        //verificar si hay un id a buscar
        if ( !empty($request['id']) ) {
            try {
                $respuesta = $productosModels->getProductoById($request['id']);
            } catch (\Throwable $th) {
                error_log("Fallo al obtener el elemento idproject ".$request['id']." ".$th->getMessage());
                $respuesta = [
                    'ok' => false,
                    'mensaje' => 'Hubo un error al obtener los elementos',
                ];
            }
            echo json_encode($respuesta);
            exit();
        }
        //obtener projects
        $page = isset($request['page']) && is_numeric($request['page']) ?(int)$request['page'] : 1;
        $limit = isset($request['limit']) && is_numeric($request['limit']) ?(int)$request['limit'] : 10;
        try {
            $respuesta = $productosModels->getProductos($page, $limit);
        } catch (\Throwable $th) {
            error_log("Fallo al obtener elementos".$th->getMessage());
            $respuesta = [
                'ok' => false,
                'mensaje' => 'Hubo un error al obtener los elementos',
            ];
        }
        echo json_encode($respuesta);
    }
    

    function crearElemento(array $request = []) : void
    {
        echo json_encode($request);
        exit();
    }



    function editarElemento (array $request = []) : void
    {
        $respuesta = [
            'ok' => false,
            'mensaje' => 'Ha ocurrido un error',
        ];
        // if (isset($request['nombre']) && !empty($request['nombre'])) {
        //     require_once './models/productosModel.php';
        //     $productosModels = new ProjectsModel();
        // } 
        echo json_encode($respuesta);
        exit();
    }

    function eliminarElemento (array $request = []) : void
    {
        echo json_encode($request);
        exit();
    }



    function respuestaDefault () :void
    {
        $respuesta = [
            'ok' => false,
            'mensaje' => 'No se ha encontrado el recurso',
        ];
        echo json_encode($respuesta);
        exit();
    }