<?php
    $section            = "login";
    $title 				= "Login";
    $description 		= "";
    $key 				= "";
	$og_image 			= "";
	$og_image_width 	= "500";
	$og_image_height 	= "490";

    include_once(HEAD);
?>

<section>
    <div class="contenido w3-center" style="max-width: 500px">
        <a href="<?php echo BASE_URL ?>">
            <img src="assets/logo.png" alt="<?php echo WEBSITE ?>" class="logo" width="100px"><br>
        </a>
        <div class="w3-row w3-round w3-padding">
        <br>
            <form id="formLogin" name="login" method="post">
                <label for="user">
                    <input id="user" type="text" name="nm" placeholder="User">
                    <p class="error w3-hide absolute">4-20 Letters and numbers</p>
                </label>
                <label for="pass">
                    <input id="pass" type="password" name="ps" placeholder="Password">
                    <p class="error w3-hide absolute">8 or more characters</p>
                </label>
                <button>Login</button>
            </form>
        </div>
    </div>
</section>

<script type="module">
    import { validarInput } from './js/forms.js'
    const form = document.querySelector('#formLogin')
    const user = document.querySelector('#user')
    const pass = document.querySelector('#pass')


    form.addEventListener('submit', (e) => {
        e.preventDefault()

        //validar inputs
        const userValido = validarInput(user, /^[a-zA-Z0-9_]{4,20}$/);
        const passValido = validarInput(pass, /^.{8,}$/);

        const formularioValido = userValido && passValido 

        if (formularioValido) {
            Swal.fire({
                title: "Loading...",
                text: "Please wait a moment",
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });  
            fetch('api/login', {
                method: 'POST',
                body: new FormData(form)
            }) 
            .then (response => {
                return response.json()
            })
            .then( data => {
                if (data.ok === true) {
                    window.location.href = 'admin/'
                } else {
                    console.log(data)
                    Swal.fire({
                        title: '',
                        text: data.mensaje,
                        icon: 'error',
                    })
                } 
            })

        } else {
            Swal.fire({
            title: '',
            text: 'Please make sure to enter valid data',
            icon: 'warning',
            })
        }
    })
</script>

</body>
</html>