<header class="fixed top">
    <div class="contenido">
        <nav class="flex absolute center">
            <a class="w3-hide-small" href="home">HOME</a>
            <a class="w3-hide-small" href="productos">PRODUCTOS</a>
            <span id="hamburger" class="w3-hide-large w3-hide-medium" style="margin-right: 10px;width: 40px;"></span>
        </nav>
        <div id="collapsing-menu" class="w3-hide w3-hide-large w3-hide-medium fixed top" style="height: 100%"> 
            <span id="close" class="absolute right-top" style="width: 40px; right: 10px; top: 25px"></span>
            <a href="<?php echo BASE_URL ?>" class="absolute" style="z-index: 2; top: 15px; left: 15px">
                <img src="assets/logo_blanco.png" class="logo" alt="Logo <?php echo WEBSITE ?>"  >
            </a>
            <div class="w3-center">   
                <a class="w3-hide-large w3-hide-medium" href="home">HOME</a>
                <a class="w3-hide-large w3-hide-medium" href="productos">PRODUCTOS</a>
            </div>
        </div>
    </div>
</header>




<script>
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header')
        if (window.scrollY > 100) {
            header.classList.add('scrolled')
        } else {
            header.classList.remove('scrolled')
        }
    })
</script>
