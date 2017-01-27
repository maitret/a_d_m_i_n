<?php
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("../funciones.php");

if($Data_Usuario == ""){
include_once("login.php");
exit();
}

if(!in_array("Administrar_Permisos", $Permisos['Permisos'])) {
//echo PermisoDenegado($Data_Usuario,"Administrar_Permisos");
//exit();
}

$query_Usuarios_Puestos = "SELECT * FROM `Usuarios_Puestos` WHERE `Estatus` = 'Activo' ORDER BY `id` DESC;";
$result_Usuarios_Puestos = $mysqli->query($query_Usuarios_Puestos);
$num_Usuarios_Puestos = $result_Usuarios_Puestos->num_rows;
if ($num_Usuarios_Puestos >= 1) {
while($row_Usuarios_Puestos = $result_Usuarios_Puestos->fetch_array(MYSQLI_ASSOC)){
$id_table = $row_Usuarios_Puestos['id'];
$Id_Puesto = $row_Usuarios_Puestos['Id_Puesto'];
$Puesto = $row_Usuarios_Puestos['Puesto'];
$Estatus = $row_Usuarios_Puestos['Estatus'];
$Id_Perfil = $Id_Puesto;

$usuarios_list = "";
$GetUsuariosPermisos = GetUsuariosPermisos($Id_Puesto);
//$GetUsuariosPermisos_json = json_encode($GetUsuariosPermisos);
foreach($GetUsuariosPermisos as $item_perm){
$Nombre_Usuario = Nombre_Usuario($item_perm, "");
$usuarios_list .= <<<EOF
 <span class="label label-default">{$Nombre_Usuario}</span>
EOF;
}
$permisos_list = "";
$query_Permisos_Perfiles = "SELECT Permisos_Perfiles.Permiso,Permisos.Permiso,Permisos.Nombre_Visible,Permisos.Descripcion FROM Permisos_Perfiles INNER JOIN Permisos ON Permisos_Perfiles.Permiso = Permisos.Permiso WHERE Permisos_Perfiles.Id_Perfil = '$Id_Perfil' ORDER BY Permisos_Perfiles.id DESC;";
$result_Permisos_Perfiles = $mysqli->query($query_Permisos_Perfiles);
$num_Permisos_Perfiles = $result_Permisos_Perfiles->num_rows;
if ($num_Permisos_Perfiles >= 1) {
while($row_Permisos_Perfiles = $result_Permisos_Perfiles->fetch_array(MYSQLI_ASSOC)){
$Permiso = $row_Permisos_Perfiles['Permiso'];
$Nombre_Visible = $row_Permisos_Perfiles['Nombre_Visible'];
$Descripcion = $row_Permisos_Perfiles['Descripcion'];
$permisos_list .= <<<EOF
 <span class="label label-default" title="{$Descripcion}">{$Nombre_Visible}</span>
EOF;

}
} else {
}

$tr_permisos .= <<<EOF
<tr>
<td data-order="{$id_table}"><a href="#usuarios_permisos_alta?id_table={$id_table}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
<td>{$Puesto}</td>
<td>{$usuarios_list}</td>
<td>{$permisos_list}</td>
</tr>
EOF;
}
}
?>
<div class="row">
<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
<h1 class="page-title txt-color-blueDark">
<i class="fa fa-table fa-fw "></i>
Permisos / Puestos
<span> > Listado</span>
</h1>
</div>
<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8" align="right">
<a href="#usuarios_permisos_alta" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</a>
</div>
</div>

<section id="widget-grid" class="">
<div class="row">
<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-colorbutton="false"	data-widget-editbutton="true" data-widget-togglebutton="true" data-widget-deletebutton="false" data-widget-fullscreenbutton="true">
<header>
<span class="widget-icon"> <i class="fa fa-table"></i> </span>
<h2>Listado</h2>
</header>
<!-- widget div-->
<div>
<!-- widget edit box -->
<div class="jarviswidget-editbox">

</div>

<!-- widget content -->
<div class="widget-body no-padding">

<table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
<thead>
<tr>
<th data-hide="phone">Opc.</th>
<th data-class="expand">Puesto</th>
<th data-hide="phone">Usuarios</th>
<th data-hide="phone">Permisos</th>
</tr>
</thead>
<tbody>
<?php echo $tr_permisos; ?>
</tbody>
</table>


</div>

</div>

</div>

</article>

</div>
</section>

<script type="text/javascript">
pageSetUp();
var pagefunction = function() {
var responsiveHelper_dt_basic = undefined;
var responsiveHelper_datatable_fixed_column = undefined;
var responsiveHelper_datatable_col_reorder = undefined;
var responsiveHelper_datatable_tabletools = undefined;

var breakpointDefinition = {
tablet : 1024,
phone : 480
};

/* TABLETOOLS */
$('#datatable_tabletools').dataTable({
"language": { "url": "js/plugin/datatables/Spanish.json" },
"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
"pageLength": -1,
"order": [[ 0, "asc" ]],
"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-4'f><'col-sm-4 col-xs-4 hidden-xs'T><'col-sm-4 col-xs-4 hidden-xs'l>r>"+
"t"+
"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
"oTableTools": {
"aButtons": [
"copy",
"csv",
"xls",
{
"sExtends": "pdf",
"sTitle": "Reporte de Listado",
"sPdfMessage": "Reporte de Listado",
"sPdfSize": "letter"
},
{
"sExtends": "print",
"sButtonText": "Imprimir",
"sMessage": "Pulsa CONTROL+P<i>(para salir, pulsa ESC)</i>"
}
],
"sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
},
"autoWidth" : true,
"preDrawCallback" : function() {
// Initialize the responsive datatables helper once.
if (!responsiveHelper_datatable_tabletools) {
responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
}
},
"rowCallback" : function(nRow) {
responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
},
"drawCallback" : function(oSettings) {
responsiveHelper_datatable_tabletools.respond();
}
});
/* END TABLETOOLS */
};
loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
});
});
});
});
</script>
