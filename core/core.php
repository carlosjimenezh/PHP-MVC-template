<?php 
    // ----------- PROD -------------
    $prod = false; 	//usar variables de producción o no


    

    // ----------- WEBSITE -------------
    define('HEAD', 'templates/head.php');
    define('HEAD_ADMIN', 'templates/admin/head.php');
    define('HEADER_ADMIN', 'templates/admin/header.php');
    define('HEADER', 'templates/header.php');
    define('FOOTER', 'templates/footer.php');
    define('WEBSITE', 'Estereo Visual');
    if ($prod === true) {
        define('BASE_URL', 'https://crateronfire.com.mx/pruebas/estereo-visual/');
    } else {
        define('BASE_URL', 'http://localhost/base/');
    }
    define('WEBSITE_DESCRIPTION', '');
    define('WEBSITE_KEYWORDS', '');
    define('WEBSITE_OG_IMAGE', 'assets/default.jpg');
    define('COPYRIGHT', '&copy; '. date('Y',time()) .' Estereo Visual');




    // ----------- CONTROLLERS -------------
    define('RUTA_CONTROLLER_DIR_DEFAULT','Controller.php');
	define('RUTA_CONTROLLER_DIR','./controllers');
    define('RUTA_ERROR_DIR','./controllers/error404Controller.php');
	define('RUTA_DEFAULT_DIR','./controllers/homeController.php');




    // ------------- DB -------------
    define('DB_HOST', 'localhost');
    if ($prod === true) {
        define('DB_NAME', '');
        define('DB_USER', '');
        define('DB_PASS', '');
        define('DB_ADMIN_USER', '');
        define('DB_ADMIN_PASS', '');
    } else {
        define('DB_NAME', 'estereo_visual'); //base de datos de pruebas
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_ADMIN_USER', 'root');
        define('DB_ADMIN_PASS', '');
    }
    
    // ------------- ADMIN -------------
    define('USER', 'SocalAdm');
    define('PASS', 'lk430/.,4s@-');


    
    // ------------- MAIL -------------
    define('EMAIL_CONTACT', '');
