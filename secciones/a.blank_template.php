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

?>
<div class="row">
<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
<h1 class="page-title txt-color-blueDark">
<i class="fa fa-table fa-fw "></i>
En construcci&oacute;n
<span>>

</span>
</h1>
</div>
<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">

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






</div>
<!-- end widget content -->
</div>
<!-- end widget div -->

</div>
<!-- end widget -->
</article>
<!-- WIDGET END -->
</div>
<!-- end row -->
<!-- end row -->
</section>

<script type="text/javascript">

/* DO NOT REMOVE : GLOBAL FUNCTIONS!
*
* pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
*
* // activate tooltips
* $("[rel=tooltip]").tooltip();
*
* // activate popovers
* $("[rel=popover]").popover();
*
* // activate popovers with hover states
* $("[rel=popover-hover]").popover({ trigger: "hover" });
*
* // activate inline charts
* runAllCharts();
*
* // setup widgets
* setup_widgets_desktop();
*
* // run form elements
* runAllForms();
*
********************************
*
* pageSetUp() is needed whenever you load a page.
* It initializes and checks for all basic elements of the page
* and makes rendering easier.
*
*/
pageSetUp();
/*
* ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
* eg alert("my home function");
*
* var pagefunction = function() {
*   ...
* }
* loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
*
*/
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
