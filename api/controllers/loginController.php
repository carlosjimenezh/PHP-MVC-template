<?php 
    //manejar request
    $request_method = $_SERVER['REQUEST_METHOD'];
    switch ($request_method) {
        case 'POST':
            //enviar la consulta post a validar usuario
            validarUsuario($_POST);
            break;
        default:
            respuestaDefault();
            break;
    }


    function validarUsuario (array $post) : void
    {
        if (empty($post['nm'] || empty($post['ps']))) {
            echo json_encode([
                'ok' => false,
                'mensaje' => "No se capturaron los datos",
            ]);
            exit();
        }

        $usuario = $post['nm'];
        $contrasena = $post['ps'];

        $respuesta = [
            'ok' => false,
            'mensaje' => 'Las credenciales son incorrectas',
        ];
        if ($usuario === 'admin' && $contrasena === 'adminadmin') {
            $_SESSION['sflag'] = 3;
            $respuesta = [
                'ok' => true,
                'mensaje' => 'Es admin',
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