<?php
    //ver si la accion es crear
    if (isset($_GET['form']) && $_GET['form'] === 'create') {
        //hacer llamada a la api para obtener el último orden de los proyectos
        try {
            $respuesta = callAPi('GET', "api/last-orden-proyectos");
        } catch (\Throwable $th) {
            $respuesta = ['ok' => false];
            error_log("Fallo al obtener el ultimo orden ".$th->getMessage());
        }
        include_once 'views/proyectos/crearProyecto.php';
        exit();
    }

    //ver si la accion es editar
    if (isset($_GET['form']) && $_GET['form'] === 'edit') {
        //verificar si es un id válido
        if (!isset($_GET['id']) || !is_numeric($_GET['id']) || $_GET['id'] < 1) {
            include_once 'views/error.php';
            exit();
        }

        $id = $_GET['id'];

        //hacer llamada a la api para obtener el proyecto
        try {
            $respuesta = callAPi('GET', "api/proyectos/$id");
        } catch (\Throwable $th) {
            $respuesta = ['ok' => false];
            error_log("Fallo al obtener los projects ".$th->getMessage());
        }

        //verificar si la respuesta es exitosa
        if ( !$respuesta['ok'] ) {
            include_once 'views/error.php';
            exit();
        }   


        //si no hay resultados
        if (!count($respuesta['proyectos']) > 0) {
            include_once 'views/sinResultados.php';
            exit();
        }

        //hacer llamada a la api para obtener el último orden de los proyectos
        try {
            $respuesta_orden = callAPi('GET', "api/last-orden-proyectos");
        } catch (\Throwable $th) {
            $respuesta_orden = ['ok' => false];
            error_log("Fallo al obtener el ultimo orden ".$th->getMessage());
        }

        //obtener el proyecto
        $proyectos = $respuesta['proyectos'];


        include_once 'views/proyectos/editarProyecto.php';
        exit();
    }



    //obtener pagina
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;


    //hacer una llamada a la api para obtener los projects
    try {
        $respuesta = callAPi('GET', 'api/proyectos', ['page' => $page, 'limit' => 10]);
    } catch (\Throwable $th) {
        $respuesta = ['ok' => false];
        error_log("Fallo al obtener los projects ".$th->getMessage());
    }


    //verificar si la respuesta es exitosa
    if ( !$respuesta['ok'] ) {
        include_once 'views/error.php';
        exit();
    }   


    //si no hay resultados
    if (!count($respuesta['proyectos']) > 0) {
        include_once 'views/sinResultados.php';
        exit();
    }

    //obtener proyectos
    $proyectos = $respuesta['proyectos'];


    include_once 'views/proyectos/proyectos.php';