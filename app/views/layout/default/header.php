<!DOCTYPE html>
<html lang="en">

<head>

    <title><?= Config::get('WEBSITE_NAME'); ?></title>
    <meta charset="utf-8">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MD Kampar">
    <meta name="author" content="MD Kampar">
    <link rel="icon" href="<?= PUBLIC_ROOT; ?>img/icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?= PUBLIC_ROOT; ?>img/icons/favicon.ico" type="image/x-icon">

    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_ROOT; ?>css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_ROOT; ?>css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_ROOT; ?>css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_ROOT; ?>css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_ROOT; ?>css/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_ROOT; ?>css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_ROOT; ?>css/style.css">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_ROOT; ?>css/responsive.css">

    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_ROOT; ?>css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?= PUBLIC_ROOT; ?>css/customs.css">

    <link rel="stylesheet" href="<?= PUBLIC_ROOT; ?>v4.6.5/ol.css" type="text/css">
    <link rel="stylesheet" href="<?= PUBLIC_ROOT; ?>css/ol3-layerswitcher.css" type="text/css">
    <!--     <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script> -->
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <?php require_once(Config::get('VIEWS_PATH') . "layout/default/navigation.php"); ?>