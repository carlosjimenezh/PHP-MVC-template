<?php 
	$section 		    = 'editar-producto';
	$title 				= "Editar";
	$des 				= "";
	$key 				= "";
	$og_image 			= "";
	$og_image_width 	= "500";
	$og_image_height 	= "490";
	
	include_once(HEAD);
    include_once(HEADER); 
?>

<section class="relative">
    <div class="contenido">
        <h1>editar producto</h1>
        <p>Obtener producto a editar haciendo una petición a la api desde el servidor</p>
        <form name="editar-producto">
            <label for="nombre">Nombre
                <input type="text" name="nombre" required value="<?php echo $producto['producto']['nombre'] ?>">
            </label>
            <button>Editar</button>
        </form>
    </div>
</section>


</body>
</html>