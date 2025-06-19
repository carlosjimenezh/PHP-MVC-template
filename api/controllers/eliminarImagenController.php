<?php 
    //manejar request
    $request_method = $_SERVER['REQUEST_METHOD'];

    //ver si es admin 
    if (!isAdmin()) {
        echo json_encode([
            'ok' => false,
            'mensaje' => 'Usted no es administrador',
        ]);
        exit();
    }
    switch ($request_method) {
        case 'POST':
            //enviar la consulta post a eliminar imagen
            eliminarImagen($_POST);
            break;
        default:
            respuestaDefault();
            break;
    }


    function eliminarImagen (array $post) : void
    {
        if (empty($post['idproyecto'] || empty($post['idimagen']))) {
            echo json_encode([
                'ok' => false,
                'mensaje' => "No se capturaron los datos",
            ]);
            exit();
        }

        $idproyecto = $post['idproyecto'];
        $idimagen = $post['idimagen'];

        $respuesta = [
            'ok' => false,
            'mensaje' => 'There was an error',
        ];

        $raiz = str_replace('api', '', dirname(__DIR__));
        $imagen = $raiz.'assets/proyectos/'.$idproyecto.'_'.$idimagen.'.jpg';
        $imagen_s = $raiz.'assets/proyectos_s/'.$idproyecto.'_'.$idimagen.'.jpg';
        if (file_exists($imagen) && file_exists($imagen_s) && unlink($imagen) && unlink($imagen_s)) {
            $respuesta = [
                'ok' => true,
                'mensaje' => 'Se eliminó correctamente',
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