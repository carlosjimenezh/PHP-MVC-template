<?php 
    //verificar si existe el id
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


    //obtener el proyecto
    $proyectos = $respuesta['proyectos'];


    //mostrar proyecto
    include_once 'views/proyectos/proyecto.php'; 