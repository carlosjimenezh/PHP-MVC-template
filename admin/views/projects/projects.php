<?php
    $section            = "admin";
    $title 				= "Admin";
    $description 		= "";
    $key 				= "";
	$og_image 			= "";
	$og_image_width 	= "500";
	$og_image_height 	= "490";

    include_once(HEAD);
    include_once(HEADER);
?>

<main>
    <div class="contenido" style="max-width: 1200px">
        <a class="btn" href="admin/projects/create">Create project</a>
        <table class="vistatabla">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>3Dtour</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
        <tbody>
            <?php foreach ($respuesta['projects'] as $project) : ?>
                <?php error_log(print_r($project, true)) ?>
            <tr>
                <td>
                    <img src="<?php echo $project['imagen'] ?>" alt="" loading="lazy" width="50px">
                </td>
                <td><?php echo $project['project']['orden'] ?></td>
                <td><?php echo $project['project']['nombre'] ?></td>
                <td><?php echo $project['project']['ubicacion'] ?></td>
                <td><?php echo $project['project']['3dtour'] ?></td>
                <td>
                    <a href="admin/project/<?php echo $project['project']['idproyecto'] ?>">ver</a>
                </td>
                <td>
                    <a href="admin/project/<?php echo $project['project']['idproyecto'] ?>/edit">editar</a>
                </td>
                <td>
                    <span data-action="eliminar" data-idproject="<?php echo $project['project']['idproyecto'] ?>">eliminar</span>
                </td>
            </tr>                            
            <?php endforeach; ?>
         </tbody>
        </table>
    </div>
</main>
</script>
</body>
</html>