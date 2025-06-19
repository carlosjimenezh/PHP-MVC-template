<header>
    <div class="contenido flex space-between">
        <a href="<?php echo BASE_URL ?>" class="relative" style="z-index: 2">
            <img src="assets/logo_blanco.png" class="logo" alt="Logo <?php echo WEBSITE ?>" style="margin: 0; width: 40px" >
        </a>
        <?php if (isAdmin()) : ?>
        <div>
            Welcome admin
            <span id="logout" aria-label="cerrar sesión" style="display: inline-block; width: 35px; cursor:pointer"></span>
        </div>
        <?php else : ?>
            <a href="admin/">Login</a>
        <?php endif; ?>
    </div>
</header>

<?php if (isAdmin()) : ?>
<nav class="flex contenido admin">
    <a href="admin/projects">PROJECTS</a>
</nav>
<?php endif; ?>




<script>
    document.querySelector('#logout')?.addEventListener('click', e => {
        Swal.fire({
            title: "Loading...",
            text: "Please wait a moment",
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });  
        fetch ('api/login')
        .then(response => {
            if (response.ok) {
                return response.json()
            } else {
                throw new Error("Error en la consulta");
            }
        })
        .then (data => {
            window.location.reload()
        })
    })
</script>
<script type="module">
    import { hamburger, close, logout } from "./js/icons.js";
    import { show, hide } from "./js/common.js";
    let logoutElement = document.querySelector('#logout')
    if (logoutElement) {
        logoutElement.innerHTML = logout('white');
    }
</script>