<?php 
    //manejar request
    $request_method = $_SERVER['REQUEST_METHOD'];
    switch ($request_method) {
        case 'GET':
            //enviar a validar para cerrar la sesión
            cerrarSesion();
            break;
        default:
            respuestaDefault();
            break;
    }


    function cerrarSesion () : void 
    {
        $respuesta = [
            'ok' => false,
            'mensaje' => 'No eres administrador'
        ];
        if (isAdmin()) {
            session_destroy();
            $respuesta = [
                    'ok' => true,
                    'mensaje' => 'La sesión ha finalizado'
            ];
        }
        echo json_encode($respuesta);
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