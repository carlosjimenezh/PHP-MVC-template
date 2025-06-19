<?php
    $section            = "admin";
    $title 				= "Edit Project";
    $description 		= "";
    $key 				= "";
	$og_image 			= "";
	$og_image_width 	= "500";
	$og_image_height 	= "490";

    include_once(HEAD);
    include_once(HEADER);
?>

<main>
    <div class="contenido" style="max-width: 1200px;">
        <?php foreach ($respuesta['projects'] as $project) : ?>
        <form>
            <label for="nombre">Name
                <input type="text" id="nombre" value="<?php echo $project['project']['nombre'] ?>" name="nombre">
            </label>
            <label for="ubicacion">Location
                <input type="text" id="ubicacion" value="<?php echo $project['project']['ubicacion'] ?>" name="ubicacion">
            </label>
            <label for="3dtour">3Dtour
                <input type="text" id="3dtour" value="<?php echo $project['project']['3dtour'] ?>" name="3dtour">
            </label>
            <label for="orden">Order
                <input type="number" id="orden" value="<?php echo $project['project']['orden'] ?>" name="orden" min="1">
            </label>
            <button>Save</button>
        </form>
        <?php endforeach; ?>
    </div>
</main>
</script>
</body>
</html>