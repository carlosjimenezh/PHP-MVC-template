<?php 
    //manejar request
    $request_method = $_SERVER['REQUEST_METHOD'];
    
    //ver si tiene permisos de admin
    if (!isAdmin() && ($request_method === 'POST' || $request_method === 'PUT' || $request_method === 'DELETE')) {
        echo json_encode([
            'ok' => false,
            'mensaje' => 'Usted no es administrador',
        ]);
        exit();
    }

    //manejar la consulta
    switch ($request_method) {
        case 'GET':
            obtenerElementos($_GET);
            break;
        case 'POST':
            // se capaturan las imágenes
            $imagenes = $_FILES['images'] ?? [];
            if (!empty($_GET['id'])) {
                // si existe un id en la url, la acción es editar
                editarElemento($_GET, $_POST, $imagenes);
                break;
            }
            crearElemento($_POST, $imagenes);
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
        require_once './models/proyectosModel.php';
        $proyectosModels = new ProyectosModel();
        //verificar si hay un id a buscar
        if ( !empty($request['id']) ) {
            try {
                $respuesta = $proyectosModels->getProyectoById($request['id']);
            } catch (\Throwable $th) {
                error_log("Fallo al obtener el elemento idproyecto ".$request['id']." ".$th->getMessage());
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
            $respuesta = $proyectosModels->getProyectos($page, $limit);
        } catch (\Throwable $th) {
            error_log("Fallo al obtener elementos".$th->getMessage());
            $respuesta = [
                'ok' => false,
                'mensaje' => 'Hubo un error al obtener los elementos',
            ];
        }
        echo json_encode($respuesta);
    }
    

    function crearElemento(array $request = [], array $images = []) : void
    {
        require_once './models/proyectosModel.php';
        $proyectosModels = new ProyectosModel();
        //verificar si existen los valores requeridos
        if ( !empty($request['nombre']) && !empty($request['ubicacion']) && !empty($request['orden']) ) {
            $nombre = $request['nombre'];
            $ubicacion = $request['ubicacion'];
            $orden = $request['orden'];
            $tour = $request['3dtour'] ?? '';
            try {
                $respuesta = $proyectosModels->crearProyecto($nombre, $ubicacion, $tour, $orden);
                //guardar imágenes
                $raiz = str_replace('api', '', dirname(__DIR__));
                $rutaImagen = $raiz.'assets/proyectos/';
                $rutaImagenSmall = $raiz.'assets/proyectos_s/';
                $ext = '.jpg';
                for ($i = 0; $i < count($images['name']); $i++) {
                    if ($images['error'][$i] === 0 && file_exists($images['tmp_name'][$i]) && $images['type'][$i] === 'image/jpeg') {
                        $id = $proyectosModels->getInsertedId();
                        $ruta_orig = $rutaImagen.$id.'_'.($i + 1).$ext;
                        $ruta_small = $rutaImagenSmall.$id.'_'.($i + 1).$ext;
                        $rutas=array($ruta_orig, $ruta_small);
                        if(move_uploaded_file($images['tmp_name'][$i], $ruta_orig))
                        {
                            @resizer($ruta_orig, $rutas, array(1900,600), array(1000,600), 2, 0, "",array(0,0),array(0,1));
                        }
                    }
                }
            } catch (\Throwable $th) {
                error_log("Fallo al crear el proyecto ".$th->getMessage());
                $respuesta = [
                    'ok' => false,
                    'mensaje' => 'Hubo un error al crear el elemento',
                ];
            }
            echo json_encode($respuesta);
            exit();
        }
        $respuesta = [
            'ok' => false,
            'mensaje' => 'Llene los datos obligatorios',
        ];
        echo json_encode($respuesta);
    }



    function editarElemento (array $request = [], array $data = [], array $images = []) : void
    {
        //validar id del elemento
        if (!array_key_exists('id', $request) || !is_numeric($request['id']) || $request['id'] < 1) {
            echo json_encode([
                'ok' => false,
                'mensaje' => 'No se encontró el elemento',
            ]);
            exit();
        }

        //validar datos necesarios para la edición
        if ( empty($data['nombre']) || empty($data['ubicacion']) || empty($data['orden']) ) { 
            echo json_encode([
                'ok' => false,
                'mensaje' => 'Los valores no se capturaron',
            ]);
            exit();
        }

        $nombre = $data['nombre'];
        $ubicacion = $data['ubicacion'];
        $orden = $data['orden'];
        $tour = $data['tour'] ?? '';

        $id = $request['id'];
        require_once './models/proyectosModel.php';
        $proyectosModels = new ProyectosModel();


        try {
            $respuesta = $proyectosModels->editarProyecto($id, $nombre, $ubicacion, $orden, $tour);
            //guardar imágenes
            $raiz = str_replace('api', '', dirname(__DIR__));
            $rutaImagen = $raiz.'assets/proyectos/';
            $rutaImagenSmall = $raiz.'assets/proyectos_s/';
            $ext = '.jpg';
            for ($i = 0; $i < count($images['name']); $i++) {
                if ($images['error'][$i] === 0 && file_exists($images['tmp_name'][$i]) && $images['type'][$i] === 'image/jpeg') {
                    $ruta_orig = $rutaImagen.$id.'_'.($i + 1).$ext;
                    $ruta_small = $rutaImagenSmall.$id.'_'.($i + 1).$ext;
                    $rutas=array($ruta_orig, $ruta_small);
                    if(move_uploaded_file($images['tmp_name'][$i], $ruta_orig))
                    {
                        @resizer($ruta_orig, $rutas, array(1900,600), array(1000,600), 2, 0, "",array(0,0),array(0,1));
                    }
                }
            }
        } catch (\Throwable $th) {
            error_log("Fallo al editar el proyecto ".$th->getMessage());
            $respuesta = [
                'ok' => false,
                'mensaje' => 'Error al editar',
                'request' => $request,
            ];
        }
        
        echo json_encode($respuesta);
        
    }

    function eliminarElemento (array $request = []) : void
    {
        //validar id del elemento
        if (!array_key_exists('id', $request) || !is_numeric($request['id']) || $request['id'] < 1) {
            echo json_encode([
                'ok' => false,
                'mensaje' => 'No se encontró el elemento',
            ]);
            exit();
        }


        $id = $request['id'];
        require_once './models/proyectosModel.php';
        $proyectosModels = new ProyectosModel();

        try {
            $respuesta = $proyectosModels->eliminarProyecto($id);
            //eliminar imágenes
            $raiz = str_replace('api', '', dirname(__DIR__));
            $total_imagenes = glob($raiz."assets/proyectos/".$request['id']."_*.jpg");
            $total_imagenes_s = glob($raiz."assets/proyectos_s/".$request['id']."_*.jpg");
            foreach ($total_imagenes as $imagen) {
                if (file_exists($imagen)) {
                    unlink($imagen);
                }
            }
            foreach ($total_imagenes_s as $imagen) {
                if (file_exists($imagen)) {
                    unlink($imagen);
                }
            }
        } catch (\Throwable $th) {
            error_log("Fallo al eliminar el proyecto ".$th->getMessage());
            $respuesta = [
                'ok' => false,
                'mensaje' => 'Error al eliminar',
                'request' => $request,
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
    }