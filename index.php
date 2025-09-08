<?php
	session_start();
	date_default_timezone_set("America/Mexico_City");
	mb_internal_encoding("UTF-8");
	mb_http_output("UTF-8");

	//llamar variables globales
	require_once('./core/core.php');
	//llamar funciones comunes
	require_once('./core/functions.php');



	//este archivo se ejecuta en cada petición, esta parte se podría aprovechar como middleware



	// ----------------- llamadas a un controlador ----------------
	if(isset($_GET['controller']) && !empty($_GET['controller']))
	{
		//rutas que redirigen a un controlador, para evitar cambiar el nombre del controlador
		$rutas = [
			// 'inicio' => 'home',
			// nombre-de-la-ruta => controlador-al-que-es-dirigido
		];

		if (array_key_exists($_GET['controller'], $rutas)) {
			$controlador = kebapCaseToCamelCase($rutas[$_GET['controller']]);
		} else {	
			$controlador = kebapCaseToCamelCase($_GET['controller']);
		}

		if(file_exists(RUTA_CONTROLLER_DIR.'/' . $controlador . RUTA_CONTROLLER_DIR_DEFAULT))
		{
			include(RUTA_CONTROLLER_DIR.'/' . $controlador . RUTA_CONTROLLER_DIR_DEFAULT);
		}else 
        {
			require_once(RUTA_ERROR_DIR);
		}
	}
    else
    { 
		include(RUTA_DEFAULT_DIR);
    }
