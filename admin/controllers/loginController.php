<?php 

    // si ya es admin ir hacia el home de admin
    if (isAdmin()) {
        // header("location:home");
        header("location:projects");
        exit();
    }


    // ver si llegaron datos post de formulario login
    // llamar api para logearse


    include_once 'views/login.php';