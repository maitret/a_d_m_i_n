<?php
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("../funciones.php");
include_once("../../funciones.php");

$Id_Rand = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_rand']));
if($Id_Rand == ""){ $Id_Rand = substr(md5(uniqid(rand())),0,6); }
$Tipo = "categorias";
$Id_Form = "Productos_Categorias";
$id_table = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_table']));
$query_Cosa = "SELECT * FROM `".$Id_Form."` WHERE `id` = '$id_table' ORDER BY `id` DESC;";
$result_Cosa = $mysqli->query($query_Cosa);
$num_Cosa = $result_Cosa->num_rows;
$Input_Array = $result_Cosa->fetch_array(MYSQLI_ASSOC);
$Id_Categoria = $Input_Array['Id_Categoria'];

?>
<style>
.map_canvas {
width: 100%;
height: 300px;
}
</style>

<!-- Bread crumb is created dynamically -->
<!-- row -->
<div class="row">

<!-- col -->
<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><i class="fa-fw fa fa-home"></i>
 Categor&iacute;as <span> >Alta/Editar </span>
</h1>
</div>
<!-- end col -->

<!-- right side of the page with the sparkline graphs -->
<!-- col -->
<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">

</div>
<!-- end col -->

</div>
<!-- end row -->

<!-- widget grid -->
<section id="widget-grid" class="">

<!-- row -->
<div class="row">

<!-- NEW WIDGET ROW START -->
<div class="col-sm-12">

<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget" id="wid-id-sucursal" data-widget-colorbutton="false"	data-widget-editbutton="true" data-widget-togglebutton="true" data-widget-deletebutton="false" data-widget-fullscreenbutton="true">
<header>
<h2>Ingrese datos de la Categor&iacute;a </h2>
</header>

<!-- widget div-->

<div>
<!-- widget edit box -->
<div class="jarviswidget-editbox">
<!-- This area used as dropdown edit box -->
<input class="form-control" type="text">
</div>
<!-- end widget edit box -->

<!-- widget content -->
<div class="widget-body">

<form id="" class="source_form" method="post" action="_/productos_categorias_alta_procesa"
data-bv-message="Este valor es invalido" data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" accept-charset="ISO-8859-1">

<fieldset>
<?php echo PrintField($Id_Form, "Categoria", $Input_Array['Categoria']); ?>
<?php echo PrintField($Id_Form, "Estatus", $Input_Array['Estatus']); ?>
</fieldset>
<input type="hidden" name="Id_Categoria" value="<?php echo $Id_Categoria; ?>">

<input type="hidden" name="id_table" value="<?php echo $id_table; ?>">
<br>
<div class="response_form" align="center"></div>
<br>

<div class="form-actions">
<div class="row">
<div class="col-md-12 text-center">
<button class="btn btn-default submit_form" type="submit" id="">Guardar</button>
</div>
</div>
</div>

</form>
</div>
<!-- end widget content -->

</div>
<!-- end widget div -->

</div>
<!-- end widget -->

</div>
<!-- WIDGET ROW END -->
</div>

<!-- end row -->

</section>
<!-- end widget grid -->
<?php
echo FormTarget_Ajax2($target_id);
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
//window.enable_geocomplete("", "<?php echo $Input_Array['Lat']; ?>,<?php echo $Input_Array['Lon']; ?>", ".map_canvas");
//setTimeout(function(){ $(".Direccion").val("<?php echo $Input_Array['Direccion']; ?>"); },2000);
});

pageSetUp();

var pagefunction = function() {
$('#source_form').bootstrapValidator();
};
var pagedestroy = function() {
$('#source_form').bootstrapValidator('destroy');
$('button[data-toggle]').off();
if (debugState) {
root.console.log("✔ Bootstrap validator destroyed");
}
};

loadScript("js/plugin/bootstrapvalidator/bootstrapValidator.min.js", pagefunction);
</script>
