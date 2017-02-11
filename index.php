<?php
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("funciones.php");
?>
<!DOCTYPE html>
<html lang="es-mx" class="smart-style-<?php echo $smart_style;?>">
<head>
<meta charset="ISO-8859-1">
<title><?php echo $sys_name; ?></title>
<meta name="description" content="AdminPanel desarrollado por myhostmx.com">
<meta name="author" content="MyHostMX.com">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- #CSS Links -->
<!-- Basic Styles -->
<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">

<!-- <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css"> -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >

<!-- No cambies este orden nunca! -->
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production-plugins.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-rtl.min.css">

<link rel="stylesheet" href="<?php echo $url_server; ?>/js/plugin/jquery-file-upload/css/jquery.fileupload.css">

<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

<!-- #GOOGLE FONT -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

<!-- #APP SCREEN / ICONS -->
<!-- Specifying a Webpage Icon for Web Clip
Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
<link rel="apple-touch-icon" href="img/splash/sptouch-icon-iphone.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/splash/touch-icon-ipad.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/splash/touch-icon-iphone-retina.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/splash/touch-icon-ipad-retina.png">

<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Startup image for web apps -->
<link rel="apple-touch-startup-image" href="img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
<link rel="apple-touch-startup-image" href="img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
<link rel="apple-touch-startup-image" href="img/splash/iphone.png" media="screen and (max-device-width: 320px)">

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
if (!window.jQuery) {
document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&region=mx&language=es&lang=es&libraries=places,geometry,visualization&key=<?php echo $google_maps_key; ?>"></script>
<script src="<?php echo $url_server; ?>/js/jquery.are-you-sure.js"></script>
<script src="<?php echo $url_server; ?>/js/jquery.geocomplete.min.js"></script>
<script src="<?php echo $url_server; ?>/js/logger.js"></script>
<script src="<?php echo $url_server; ?>/js/polygon.min.js"></script>

<script src="https://www.gstatic.com/firebasejs/3.6.6/firebase.js"></script>
<script src="<?php echo $url_server; ?>/js/header_web.php?<?php echo time(); ?>"></script>
</head>

<body class="smart-style-<?php echo $smart_style;?>">

<!-- #HEADER -->
<header id="header">
<div id="logo-group">

<!-- PLACE YOUR LOGO HERE -->
<span id="logo"> <a href="./">
<!--<img src="img/logo.png" alt="Logo" style="width: 60px;">-->
</a></span>
<!-- END LOGO PLACEHOLDER -->

<?php if($Data_Usuario != "") { ?>
<!-- Note: The activity badge color changes when clicked and resets the number to 0
Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
<!-- <span id="activity" class="activity-dropdown"><i class="fa fa-user"></i><b class="badge">0</b></span> -->

<!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
<div class="ajax-dropdown">
<!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
<div class="btn-group btn-group-justified" data-toggle="buttons">
<label class="btn btn-default">
<input type="radio" name="activity" id="notificaciones">
Notificaciones (0) </label>
<label class="btn btn-default">
<input type="radio" name="activity" id="tareas">
Tareas (0) </label>
</div>
<!-- notification content -->
<div class="ajax-notifications custom-scroll">
<div class="alert alert-transparent">
<h4>Elija una opcion</h4>
</div>
<i class="fa fa-lock fa-4x fa-border"></i>
</div>
<!-- end notification content -->
<!-- footer: refresh area -->
<span>Actualizacion: <?php echo date('d/m/Y H:i'); ?>
<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Cargando..." class="btn btn-xs btn-default pull-right">
<i class="fa fa-refresh"></i>
</button> </span>
<!-- end footer -->
</div>
<!-- END AJAX-DROPDOWN -->
<?php } ?>


</div>

<!-- #TOGGLE LAYOUT BUTTONS -->
<!-- pulled right: nav area -->
<div class="pull-right">

<!-- collapse menu button -->
<div id="hide-menu" class="btn-header pull-right">
<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
</div>
<!-- end collapse menu -->

<!-- #MOBILE -->
<?php if($Data_Usuario != "") { ?>
<!-- logout button -->
<div id="logout" class="btn-header transparent pull-right">
<span> <a href="salir.php" title="Salir" data-action="userLogout" data-logout-msg="Por seguridad es mejor cerrar todas las ventanas del navegador"><i class="fa fa-sign-out"></i></a> </span>
</div>
<!-- end logout button -->

<!-- search mobile button (this is hidden till mobile view port)
<div id="search-mobile" class="btn-header transparent pull-right">
<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
</div> -->
<!-- end search mobile button -->

<!-- #SEARCH -->
<!-- input: search field -->
<!--
<form action="#buscador" class="header-search pull-right">
<input id="search-fld" type="text" name="param" placeholder="Buscar">
<button type="submit">
<i class="fa fa-search"></i>
</button>
<a href="javascript:void(0);" id="cancel-search-js" title="Cancelar Busqueda"><i class="fa fa-times"></i></a>
</form> -->
<!-- end input: search field -->

<!-- fullscreen button -->
<div id="fullscreen" class="btn-header transparent pull-right">
<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Pantalla completa"><i class="fa fa-arrows-alt"></i></a> </span>
</div>
<!-- end fullscreen button -->

<!-- #Voice Command: Start Speech -->
<!-- NOTE: Voice command button will only show in browsers that support it. Currently it is hidden under mobile browsers.
You can take off the "hidden-sm" and "hidden-xs" class to display inside mobile browser-->
<!-- <div id="speech-btn" class="btn-header transparent pull-right hidden-sm hidden-xs">
<div>
<a href="javascript:void(0)" title="Voice Command" data-action="voiceCommand"><i class="fa fa-microphone"></i></a>
<div class="popover bottom"><div class="arrow"></div>
<div class="popover-content">
<h4 class="vc-title">Comando de voz activado <br><small></small></h4>
<h4 class="vc-title-error text-center">
<i class="fa fa-microphone-slash"></i> Comando de voz no activado
<br><small class="txt-color-red"<strong>"Permitir"</strong> Microfono</small>
<br><small class="txt-color-red">Debe tener <strong>Conexion a internet</strong></small>
</h4>
<a href="javascript:void(0);" class="btn btn-success" onclick="commands.help()">Ver comandos</a>
<a href="javascript:void(0);" class="btn bg-color-purple txt-color-white" onclick="$('#speech-btn .popover').fadeOut(50);">Cerar Info</a>
</div>
</div>
</div>
</div>-->
<?php } ?>

</div>
<!-- end pulled right: nav area -->

</header>
<!-- END HEADER -->

<!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
<aside id="left-panel">

<?php if($Data_Usuario != "") { ?>
<!-- User info -->
<div class="login-info">
<span> <!-- User image size is adjusted inside CSS, it should stay as is -->
<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
<!--<img src="img/avatars/sunny.png" alt="Yo" class="online" />-->
<span>
<?php echo Nombre_Usuario($Data_Usuario, "2"); ?>
</span>
<i class="fa fa-angle-down"></i>
</a>

</span>
</div>
<?php } ?>
<nav>
<ul>
<?php if($Data_Usuario != "") { ?>
<li class="">
<a><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Tablero</span></a>
<ul>
<li class=""><a href="index" title="Inicio"><span class="menu-item-parent">Inicio</span></a></li>
</ul>
</li>
<?php if(in_array("Listar_Productos", $Permisos['Permisos'])) { ?><?php } ?>
<li class="">
<a><i class="fa fa-lg fa-fw fa-th-list"></i> <span class="menu-item-parent">Productos</span></a>
<ul>
<li class=""><a href="productos" title="Listado"><span class="menu-item-parent">Listado</span></a></li>
<li class=""><a href="productos_categorias"><span class="menu-item-parent">Categor&iacute;as</span></a></li>
</ul>
</li>

<?php if(in_array("Listar_Usuarios", $Permisos['Permisos'])) { ?><?php } ?>
<li class="">
<a><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">Usuarios</span></a>
<ul>
<li class=""><a href="usuarios"><span class="menu-item-parent">Listado</span></a></li>
<li class=""><a href="usuarios_permisos"><span class="menu-item-parent">Permisos</span></a></li>
</ul>
</li>


<?php } else { ?>
<li><a><i class="fa fa-lock" aria-hidden="true"></i></a></li>
<?php } ?>
</ul>
</nav>

<!-- <a href="#" class="btn btn-primary nav-demo-btn"><i class="fa fa-info-circle"></i> Extras</a>-->

<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>
<!-- END NAVIGATION -->

<!-- #MAIN PANEL -->
<div id="main" role="main">


<div id="ribbon">
<!-- RIBBON
<span class="ribbon-button-alignment">
<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Espera! Esto puede eliminar la configuracion de LocalStorage." data-html="true" data-reset-msg="Reiniciar LocalStorage?"><i class="fa fa-refresh"></i></span>
</span>
 -->
<!-- breadcrumb -->
<ol class="breadcrumb">
<!-- This is auto generated -->
</ol>
<!-- end breadcrumb -->

<!-- You can also add more buttons to the
ribbon for further usability

Example below:

<span class="ribbon-button-alignment pull-right" style="margin-right:25px">
<a href="#" id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa fa-grid"></i> Change Grid</a>
<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa fa-plus"></i> Add</span>
<button id="search" class="btn btn-ribbon" data-title="search"><i class="fa fa-search"></i> <span class="hidden-mobile">Search</span></button>
</span> -->

</div>
<!-- END RIBBON -->

<!-- #MAIN CONTENT -->
<div id="content">

</div>

<!-- END #MAIN CONTENT -->

</div>
<!-- END #MAIN PANEL -->

<!-- #PAGE FOOTER -->
<div class="page-footer">
<div class="row">
<div class="col-xs-12 col-sm-6">
<span class="txt-color-white"><span class="hidden-xs">Panel</span> &copy; <?php echo date('Y'); ?></span>
</div>

<div class="col-xs-6 col-sm-6 text-right hidden-xs">
<div class="txt-color-white inline-block">
<a href="#acerca_de" class="txt-color-white">Acerca de</a>
 | <a href="<?php echo $url_adminer; ?>" target="_blank" class="txt-color-white">*</a> -
<a href="/_a_d_m_i_n_" target="_blank" class="txt-color-white">*</a>
</div>
</div>
<!-- end col -->
</div>
<!-- end row -->
</div>
<!-- END FOOTER -->

<!-- #SHORTCUT AREA : With large tiles (activated via clicking user name tag)
Note: These tiles are completely responsive, you can add as many as you like -->
<div id="shortcut">
<?php if($Data_Usuario != "") { ?>
<ul>

<?php if(in_array("Listar_Mapas", $Permisos['Permisos'])) { ?>
<li><a href="#mapas" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Mapas</span> </span> </a></li>
<!--<li><a href="#calendario" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendario</span> </span> </a></li>-->
<!--
<li><a href="#galeria" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Galeria </span> </span> </a></li>
<li><a href="#mi_perfil" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Perfil </span> </span> </a></li>
-->
<?php } ?>
</ul>
<?php } ?>
</div>
<!-- END SHORTCUT AREA -->

<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)
<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->
<!-- #PLUGINS -->


<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
if (!window.jQuery.ui) {
document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
}
</script>

<!-- IMPORTANT: APP CONFIG -->
<script src="js/app.config.js?<?php echo time(); ?>"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="js/bootstrap/bootstrap.min.js"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="js/notification/SmartNotification.min.js"></script>

<!-- JARVIS WIDGETS -->
<script src="js/smartwidgets/jarvis.widget.min.js"></script>

<!-- EASY PIE CHARTS -->
<script src="js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

<!-- SPARKLINES -->
<script src="js/plugin/sparkline/jquery.sparkline.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="js/plugin/select2/select2.min.js"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

<!-- browser msie issue fix -->
<script src="js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

<!-- FastClick: For mobile devices: you can disable this in app.js -->
<script src="js/plugin/fastclick/fastclick.min.js"></script>

<!--[if IE 8]>
<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->

<!-- Demo purpose only
<script src="js/demo.min.js?<?php echo time(); ?>"></script> -->

<!-- MAIN APP JS FILE -->
<script src="js/app.min.js?<?php echo time(); ?>"></script>

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
<script src="js/speech/voicecommand.min.js?1"></script>

<!-- SmartChat UI : plugin -->
<script src="js/smart-chat-ui/smart.chat.ui.min.js"></script>
<script src="js/smart-chat-ui/smart.chat.manager.min.js"></script>

<?php
//echo FormTarget_Ajax2($target_id);
?>

</body>
</html>