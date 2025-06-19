<?php 
	$section 		    = 'crear-producto';
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
        <h1>productos</h1>
        <p>Obtener los productos haciendo una petición a la api desde el servidor</p>
        <form id="form-crear-producto" name="crear-producto">
            <label for="nombre">Nombre
                <input type="text" name="nombre" required>
            </label>
            <button>Crear</button>
        </form>
    </div>
</section>


<script>
    const form = document.querySelector('#form-crear-producto')
    form.addEventListener('submit', (e) => {
        e.preventDefault()
        console.log('bien')
        const formData = new FormData(form)
        const options = {
            method: 'POST',
            body: formData,
        }
        fetch('api/productos', options)
        .then(response => {
            if (response.ok) return response.json()
            Swal.fire({
                title: "Error!",
                text: "No se creo",
                icon: "error"
            })
        })
        .then(data => {
            console.log(data)
            if (data.ok) {
                Swal.fire({
                    title: "¡Exito!",
                    text: "Se ha creado correctamente",
                    icon: "success"
                }).then(function() {
                    window.location = `productos`;
                });
            } else {
                Swal.fire({
                title: "Error!",
                text: "No se creo",
                icon: "error"
                })
            }
        })
    })
    
</script>

</body>
</html>