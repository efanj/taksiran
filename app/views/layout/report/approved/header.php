<!doctype html>
<!--[if lt IE 8]><html class="no-js lt-ie8"> <![endif]-->
<html class="no-js">

<head>
  <meta charset="utf-8">
  <title><?=Config::get('WEBSITE_NAME');?></title>
  <!-- Mobile specific metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1 user-scalable=no">
  <!-- Force IE9 to render in normal mode -->
  <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
  <meta name="author" content="" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="application-name" content="" />
  <!-- Import google fonts - Heading first/ text second -->
  <link href='https://fonts.googleapis.com/css?family=Quattrocento+Sans:400,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,700,800,900' rel='stylesheet' type='text/css'>
  <!-- Css files -->
  <!-- Icons -->
  <link href="<?= PUBLIC_ROOT; ?>css/icons.css" rel="stylesheet" />
  <!-- Bootstrap stylesheets (included template modifications) -->
  <link href="<?= PUBLIC_ROOT; ?>css/bootstrap.css" rel="stylesheet" />
  <!-- Main stylesheets (template main css file) -->
  <link href="<?= PUBLIC_ROOT; ?>css/main.css" rel="stylesheet" />
  <!-- Plugins stylesheets (all plugin custom css) -->
  <link href="<?= PUBLIC_ROOT; ?>css/plugins.css" rel="stylesheet" />
  <!-- Custom stylesheets ( Put your own changes here ) -->
  <link href="<?= PUBLIC_ROOT; ?>css/custom.css" rel="stylesheet" />

  <link href="<?= PUBLIC_ROOT; ?>css/leaflet.css" rel="stylesheet" />
  <link href="<?= PUBLIC_ROOT; ?>css/L.Control.Locate.min.css" rel="stylesheet" />
  <link href="<?= PUBLIC_ROOT; ?>css/styledLayerControl.css" rel="stylesheet" />
  <!-- Fav and touch icons -->
  <link rel="icon" href="<?= PUBLIC_ROOT; ?>img/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="<?= PUBLIC_ROOT; ?>img/favicon.ico" type="image/x-icon">
  <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
  <meta name="msapplication-TileColor" content="#3399cc" />
</head>

<body>
  <?php require_once(Config::get('VIEWS_PATH') . "layout/default/navigation.php"); ?>