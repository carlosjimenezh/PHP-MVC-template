<?php
    $section            = "admin";
    $title 				= "Create Project";
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
        <form>
            <label for="nombre">Name
                <input type="text" id="nombre" value="" name="nombre">
            </label>
            <label for="ubicacion">Location
                <input type="text" id="ubicacion" value="" name="ubicacion">
            </label>
            <label for="3dtour">3Dtour
                <input type="text" id="3dtour" value="" name="3dtour">
            </label>
            <label for="orden">Order
                <input type="number" id="orden" value="" name="orden" min="1">
            </label>
            <button>Save</button>
        </form>
    </div>
</main>
</script>
</body>
</html>