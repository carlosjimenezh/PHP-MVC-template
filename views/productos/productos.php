<?php 
	$section 		    = 'productos';
	$title 				= "";
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
        <h1>productos</h1>
        <p>Obtener los productos haciendo una petición a la api desde el servidor</p>
        <a href="productos/create" class="btn">Crear producto</a>
        <ul>
        <?php foreach ($productos as $producto) : ?>
            <li class="flex space-between">
                <?php echo $producto['producto']['nombre'] ?>
                <div>
                    <a href="productos/<?php echo $producto['producto']['idproducto'] ?>/edit" class="btn" style="width: max-content;">Editar</a>
                    <button data-action="delete" data-idproducto="<?php echo $producto['producto']['idproducto'] ?>" style="width: max-content;">Eliminar</button>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>


</body>
</html>