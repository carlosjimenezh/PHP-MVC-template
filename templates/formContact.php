<form id="form-contact" class="relative">
    <label for="nombre"> 
        <input id="nombre" type="text" value="" name="nombre" placeholder="Name" >
        <p class="error w3-hide absolute">Add a valid name (letters and spaces only)</p>
    </label>
    <label for="email"> 
        <input id="email" type="email" value="" name="email" placeholder="E-mail" >
        <p class="error w3-hide absolute">Add a valid E-mail (example@gmail.com)</p>
    </label>
    <label for="tel"> 
        <input id="tel" type="tel" value="" name="tel" placeholder="Phone" >
        <p class="error w3-hide absolute">Add a valid Phone (10-12 numbers)</p>
    </label>
    <label for="mensaje" style="margin-bottom: 0">
        <textarea id="mensaje" name="mensaje" rows="7" placeholder="Message" ></textarea>
    </label>
    <button class="btn secondary absolute" style="right: 0; bottom: -67px">Send</button>
</form>


<script type="module">
    import { validarInput } from './js/forms.js';

    const form = document.querySelector('#form-contact')
    const nombre = document.querySelector('#nombre')
    const email = document.querySelector('#email')
    const tel = document.querySelector('#tel')

    form.addEventListener('submit', e => {
        e.preventDefault()

        //validar inputs
        const nombreValido = validarInput(nombre, /^[a-zA-ZÀ-ÿ\s]{3,80}$/)
        const emailValido = validarInput(email, /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/) 
        const telValido = validarInput(tel, /^\d{10,12}$/) 

        const formularioValido = nombreValido && emailValido && telValido

        //si los inputs son válidos
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
            fetch ('api/enviar-mail-contacto', {
                method: 'POST',
                body: new FormData(form)
            })      
            .then( response => {
                if  (response.ok) {
                    return response.json()
                } else {
                    throw new Error('Error en la respuesta del servidor')
                }
            })
            .then( data => {
                if (data.ok === true) {
                    Swal.fire({
                        title: '',
                        text: 'Your message has been sent successfully',
                        icon: 'success',
                    })
                    form.reset()
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
            //validar datos on keyup
            nombre.addEventListener('keyup', () => validarInput(nombre, /^[a-zA-ZÀ-ÿ\s]{3,80}$/))
            email.addEventListener('keyup', () => validarInput(email, /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/)) 
            tel.addEventListener('keyup', () => validarInput(tel, /^\d{10,12}$/))
            Swal.fire({
            title: '',
            text: 'Please make sure to enter valid data',
            icon: 'warning',
            })
        }
    })
</script>
