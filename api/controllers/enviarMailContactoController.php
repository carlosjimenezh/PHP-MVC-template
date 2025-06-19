<?php
    //manejar request
    $request_method = $_SERVER['REQUEST_METHOD'];
    switch ($request_method) {
        case 'POST':
            //enviar la consulta post a validar usuario
            enviarMail($_POST);
            break;
        default:
            respuestaDefault();
            break;
    }


    function enviarMail (array $data) : void
    {
        if ( !isset($data['nombre']) || !isset($data['email']) || !isset($data['tel']) || empty($data['nombre']) || empty($data['email']) || empty($data['tel']) || !filter_var($data['email'],FILTER_VALIDATE_EMAIL) ) {
            echo json_encode([
                'ok' => false,
                'mensaje' => 'No se capturaron los datos obligatorios',
            ]);
            exit();
        } 


        $from = $data['email'];

        //llamar a la api para mandar el mail de contacto

        try {
            sendMail($from, EMAIL_CONTACT, 'mailContacto', $data);
            $respuesta = [
                'ok' => true,
                'mensaje' => 'El mail se envió con éxito',
            ];
        } catch (\Throwable $th) {
            error_log("Error al enviar mail de contacto ".$th->getMessage());
            $respuesta = [
                'ok' => false,
                'mensaje' => 'Hubo un error al enviar mail de contacto',
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
