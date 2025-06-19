<?php
	session_start();
	date_default_timezone_set("America/Mexico_City");

	//llamar variables globales
	require_once('./core/core.php');
	//llamar funciones comunes
	require_once('./core/functions.php');



	//este archivo se ejecuta en cada petición, esta parte se podría aprovechar como middleware



	// ----------------- llamadas a un controlador ----------------
	if(isset($_GET['controller']) && !empty($_GET['controller']))
	{
		$controlador = kebapCaseToCamelCase($_GET['controller']);

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
