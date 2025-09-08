<?php 
	$section 		    = 'home';
	$title 				= "";
	$des 				= "";
	$key 				= "";
	$og_image 			= "";
	$og_image_width 	= "500";
	$og_image_height 	= "490";
	
	include_once(HEAD);
    include_once(HEADER); 
?>

<section class="relative" style="height: 100vh;">
    <h1 class="absolute center">home</h1>
</section>


<script>
document.addEventListener('DOMContentLoaded', () => {
	//solicitud GET de proyectos
	fetch('api/proyectos')
	.then(response => {
		if (response.ok) return response.json()
	})
	.then(data => {
		console.log('Solicitud GET de proyectos')
		console.log(data)
	})

	//solicitud POST de proyectos 
	const formData = new FormData();
	formData.append("username", "Chris");
	formData.append("age", 20);
	const options = {
		method: 'POST',
		body: formData,
	}
	fetch('api/proyectos', options)
	.then(response => {
		if (response.ok) return response.json()
	})
	.then(data => {
		console.log('Solicitud POST de proyectos para crear un proyecto, solo devuelve los valores')
		console.log(data)
	})


	//solicitud PUT de proyectos para  
	const params = new URLSearchParams();
	params.append("username", "Chris martines");
	params.append("age", 20);
	const optionsPut = {
		method: 'put',
		headers: {
		'Content-Type': 'application/x-www-form-urlencoded'
		},
		body: params
	}
	fetch('api/proyectos/1', optionsPut)
	.then(response => {
		if (response.ok) return response.json()
	})
	.then(data => {
		console.log('Solicitud PUT de proyectos para crear un proyecto, solo devuelve los valores')
		console.log(data)
	})


	//solicitud DELETE de proyectos para eliminar un proyecto
	const optionsDel = {
		method: 'delete',
	}
	fetch('api/proyectos/1', optionsDel)
	.then(response => {
		if (response.ok) return response.json()
	})
	.then(data => {
		console.log('Solicitud DELETE de proyectos para eliminar un proyecto, solo devuelve los valores')
		console.log(data)
	})

})
</script>

</body>
</html>
