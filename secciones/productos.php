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

$query_Productos = "SELECT * FROM `Productos` ORDER BY `id` DESC;";
$result_Productos = $mysqli->query($query_Productos);
$num_Productos = $result_Productos->num_rows;
if ($num_Productos >= 1) {
while($row_Productos = $result_Productos->fetch_array(MYSQLI_ASSOC)){
$id_table = $row_Productos['id'];
$Id_Producto = $row_Productos['Id_Producto'];
$Producto = $row_Productos['Producto'];
$Id_Marca = $row_Productos['Id_Marca'];
$Id_Categoria = $row_Productos['Id_Categoria'];
$Precio = $row_Productos['Precio'];
$Moneda = $row_Productos['Moneda'];
$Descargas = $row_Productos['Descargas'];
$Estatus = $row_Productos['Estatus'];

//$GetValFromRow_Marca = GetValFromRow("Productos_Marcas", "Id_Marca", $Id_Marca, "Marca");
$GetValFromRow_Categoria = GetValFromRow("Productos_Categorias", "Id_Categoria", $Id_Categoria, "Categoria");

$tr_producto .= <<<EOF
<tr>
<td data-order="{$id_table}"><a href="#productos_alta?id_table={$id_table}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
<td>{$GetValFromRow_Categoria}</td>
<td>{$Producto}</td>
<td>{$Precio} {$Moneda}</td>
<td>{$Descargas}</td>
<td>{$Estatus}</td>
</tr>
EOF;

}
}
?>
<div class="row">
<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
<h1 class="page-title txt-color-blueDark">
<i class="fa fa-table fa-fw "></i>
Productos
<span> > Listado</span>
</h1>
</div>
<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8" align="right">
<a href="#productos_alta" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</a>
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
<div>

<div class="jarviswidget-editbox">

</div>

<div class="widget-body no-padding">

<table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
<thead>
<tr>
<th data-hide="phone">Opc.</th>
<th>Categor&iacute;a</th>
<th data-class="expand">Producto</th>
<th>Precio</th>
<th data-hide="phone">Descargas</th>
<th data-hide="phone">Estatus</th>
</tr>
</thead>
<tbody>
<?php echo $tr_producto; ?>
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
"order": [[ 0, "desc" ]],
// Tabletools options:
//   https://datatables.net/extensions/tabletools/button_options
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
"sTitle": "Listado",
"sPdfMessage": "Listado",
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
