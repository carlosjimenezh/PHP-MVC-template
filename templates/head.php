<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<base href="<?php echo BASE_URL ?>">
<title><?php echo WEBSITE .' - '.$title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/ico" sizes="16x16" href="assets/favicon.ico" />
<meta name="description" content="<?php echo isset($des) && trim($des) !== '' ? $des : WEBSITE_DESCRIPTION; ?>">
<meta name="keywords" content="<?php echo isset($key) && trim($key) !== '' ? $key : WEBSITE_KEYWORDS; ?>"> 
<meta name="author" content="Crateronfire">
<meta name="googlebot" content="index, follow" />
<meta name="robots" content="index, follow"/>
<meta name="geo.region" content="MX" />
<meta name="geo.placename" content="Mexico"/>
<meta name="geo.region" content="Mexico"/>
<meta name="mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="distribution" content="global"/>
<meta name="revisit-after" content="1 days"/>
<meta name="referrer" content="origin"/>

<!-- open graph SEO -->
<meta property="og:title" content="<?php echo WEBSITE .' - '.$title ?>">
<meta property="og:description" content="<?php echo isset($des) && trim($des) !== '' ? $des : WEBSITE_DESCRIPTION; ?>">
<meta property="og:image" content="<?php echo isset($og_image) && trim($og_image) ? BASE_URL.$og_image : BASE_URL.WEBSITE_OG_IMAGE ?>">
<meta property="og:url" content="<?php echo BASE_URL ?>" />
<meta property="og:type" content="website"/>

<!-- Twitter Cards (Para compartir en Twitter) -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo WEBSITE .' - '.$title ?>">
<meta name="twitter:description" content="<?php echo isset($des) && trim($des) !== '' ? $des : WEBSITE_DESCRIPTION; ?>">
<meta name="twitter:image" content="<?PHP echo isset($og_image) && trim($og_image) ? BASE_URL.$og_image : BASE_URL.WEBSITE_OG_IMAGE ?>">

<!-- Seguridad y Privacidad -->
<meta name="referrer" content="strict-origin-when-cross-origin">

<!-- Canonical (Evita contenido duplicado) -->
<link rel="canonical" href="<?php echo BASE_URL ?>">


<link rel="stylesheet" href="css/w3pro.css">
<link rel="stylesheet" href="css/estilo.css">

<!-- biblioteca de notificaciones -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body id="<?php echo $section ?>">
    