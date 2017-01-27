<?php
$path_admin = "/_a_d_m_i_n_";
$get_srv = Valida_utf8($_REQUEST['srv']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->

<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/flatly/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="<?php echo $url_server.$path_admin; ?>/css/estilos.css"> -->

<?php if($nojquery == "") { ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php } ?>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&region=mx&language=es&lang=es&libraries=places,geometry,visualization&key=AIzaSyDUZ-O40s1S67hTNXkYHqdNeSaf_CwjSj0"></script>
<!---<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDUZ-O40s1S67hTNXkYHqdNeSaf_CwjSj0"></script>-->

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.0.3/js/buttons.colVis.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.8/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.0.1/css/buttons.dataTables.min.css">

<script src="https://cdn.jsdelivr.net/select2/4.0.2/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/select2/4.0.2/js/i18n/es.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/select2/4.0.2/css/select2.min.css">

<!--
<link href="<?php echo $url_server; ?>/js/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php echo $url_server; ?>/js/datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $url_server; ?>/js/datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
-->

<script src="<?php echo $url_server; ?>/js/jquery.geocomplete.min.js"></script>
<script src="<?php echo $url_server; ?>/js/logger.js"></script>

<style>
body {
/* padding-top: 70px; */
}
.navbar-brand {
padding: 10px 15px;
}
.no_under{
text-decoration: none !important;
}
</style>

</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top_" role="navigation" style="top: 0;">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="<?php echo $url_server.$path_admin; ?>/">
<!-- <img height="40" src="../../../img_new/Logo.png" title="">-->
Inicio
</a>
</div>

<div class="collapse navbar-collapse" id="navbar">
<ul class="nav navbar-nav">
<li class="active"><a >Administraci&oacute;n</a></li>
</ul>

<ul class="nav navbar-nav navbar-right">
<li><a href="<?php echo $url_server.$path_admin; ?>/Usuarios.php">Usuarios</a></li>
<li><a href="<?php echo $url_server.$path_admin; ?>/forms/?srv=<?php echo $get_srv; ?>">[Forms]</a></li>
<li><a href="<?php echo $url_server.$path_admin; ?>/tablas/?srv=<?php echo $get_srv; ?>">[Tablas]</a></li>
</ul>

</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">

<script type="text/javascript" charset="ISO-8859-1">
jQuery(document).ready(function($) {
window.enable_datatable = function enable_table(target_div,columna,orden){
if(columna == null) { columna = 0; } if(orden == null) { orden = 'desc'; }
var data_table = $(target_div).DataTable({
"iDisplayLength": 25,
"aLengthMenu": [
[25, 50, 100, 1000, -1],
[25, 50, 100, 1000, "Todos"]
],
"aaSorting": [[columna, orden]],
"paging": true,
"dom": 'BT<"clear">lfrtip',
buttons: [
{extend: 'colvis', text: 'Admin. Columnas'},
{extend: 'copyHtml5', text: 'Copiar', exportOptions: {modifier: {page: 'current'}}},
{extend: 'excelHtml5', text: 'Excel', exportOptions: {modifier: {page: 'current'}}},
{extend: 'csvHtml5', text: 'CSV', charset: false, exportOptions: {modifier: {page: 'current', stripHtml: true}}}
],
"language": {
"url": "//cdn.datatables.net/plug-ins/1.10.8/i18n/Spanish.json",
buttons: {
copyTitle: 'Copiar al Portapapeles',
copyKeys: 'Presione <i>Control</i> o <i>\u2318</i> + <i>C</i> para copiar los datos de la tabla<br> a su portapapeles.<br><br>Para cancelar, click en este mensaje o pulse ESC.'
}
}
});
$(target_div).removeClass( 'display' ).addClass('table table-striped table-bordered');
}
});
</script>