<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;
?>


<!Doctype php>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>AdoptaCan</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="/adoptacan/css/bootstrap.min.css">
    <link rel="stylesheet" href="/adoptacan/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/adoptacan/css/magnific-popup.css">
    <link rel="stylesheet" href="/adoptacan/css/font-awesome.min.css">
    <link rel="stylesheet" href="/adoptacan/css/themify-icons.css">
    <link rel="stylesheet" href="/adoptacan/css/nice-select.css">
    <link rel="stylesheet" href="/adoptacan/css/flaticon.css">
    <link rel="stylesheet" href="/adoptacan/css/gijgo.css">
    <link rel="stylesheet" href="/adoptacan/css/animate.css">
    <link rel="stylesheet" href="/adoptacan/css/slicknav.css">
    <link rel="stylesheet" href="/adoptacan/css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-3">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="img/logo2.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="/adoptacan/anuncios.php">Adopta</a></li>
                                        <!-- <li><a href="about.php">Acerca de Nosotros</a></li> -->
                                        <!-- <li><a href="service.php">Servicios</a></li> -->
                                        <li><a href="/adoptacan/admin/crud/crear.php">Poner en Adopción</a></li>
                                        <?php if ($auth) : ?>
                                            <li><a href="close.php">Cerrar Sesión</a></li>
                                        <?php else : ?>
                                            <li><a href="login.php">Ingresar</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>