<?php 
    //manejar request
    $request_method = $_SERVER['REQUEST_METHOD'];
    switch ($request_method) {
        case 'GET':
            //enviar la consulta post a validar usuario
            getLastOrden();
            break;
        default:
            respuestaDefault();
            break;
    }


    function getLastOrden() : void
    {
        require_once './models/proyectosModel.php';
        $proyectosModels = new ProyectosModel();
        
        try {
            $respuesta = $proyectosModels->getLastOrden();
        } catch (\Throwable $th) {
            error_log("Fallo al obtener el orden ".$th->getMessage());
            $respuesta = [
                'ok' => false,
                'mensaje' => 'Hubo un error al obtener el orden',
            ];
        }
        echo json_encode($respuesta);
        exit();
    }

    function respuestaDefault () :void
    {
        $respuesta = [
            'ok' => false,
            'mensaje' => 'No se ha encontrado el recurso',
        ];
        echo json_encode($respuesta);
    }