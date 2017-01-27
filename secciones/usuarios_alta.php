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

$Id_Form = "Usuarios";
$Cosas = "Usuarios";
$Cosa = "Usuario";

$id_table = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_table']));
$query_Cosa = "SELECT * FROM `".$Id_Form."` WHERE `id` = '$id_table' ORDER BY `id` DESC;";
$result_Cosa = $mysqli->query($query_Cosa);
$num_Cosa = $result_Cosa->num_rows;
$Input_Array = $result_Cosa->fetch_array(MYSQLI_ASSOC);
?>
<style>
.map_canvas {
width: 100%;
height: 300px;
}
</style>

<div class="row">

<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER -->
<i class="fa-fw fa fa-home"></i>
 <?php echo $Cosas; ?> <span> > Alta/Editar </span>
</h1>
</div>
<!-- end col -->
<!-- right side of the page with the sparkline graphs -->
<!-- col -->
<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">

</div>
</div>
<section id="widget-grid" class="">
<div class="row">
<div class="col-sm-12">

<form id="" class="source_form" method="post" action="_/usuarios_alta_procesa"
data-bv-message="Este valor es invalido" data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" accept-charset="ISO-8859-1">

<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget" id="wid-id-sucursal" data-widget-colorbutton="false"	data-widget-editbutton="true" data-widget-togglebutton="true" data-widget-deletebutton="false" data-widget-fullscreenbutton="true">
<header>
<h2>Ingrese datos del Usuario </h2>
</header>
<div>
<div class="jarviswidget-editbox">
<input class="form-control" type="text">
</div>
<div class="widget-body">

<fieldset>
<?php echo PrintField($Id_Form, "Email", $Input_Array['Email']); ?>
<!-- <?php echo PrintField($Id_Form, "Usuario", $Input_Array['Usuario']); ?> -->
<?php echo PrintField($Id_Form, "Password", $Input_Array['Password']); ?>
<?php echo PrintField($Id_Form, "Nombre", $Input_Array['Nombre']); ?>
<?php echo PrintField($Id_Form, "Apellido_Paterno", $Input_Array['Apellido_Paterno']); ?>
<?php echo PrintField($Id_Form, "Apellido_Materno", $Input_Array['Apellido_Materno']); ?>
<?php echo PrintField($Id_Form, "Telefono", $Input_Array['Telefono']); ?>
<?php echo PrintField($Id_Form, "Direccion", $Input_Array['Direccion']); ?>
</fieldset>
<fieldset>
<div class="map_canvas"></div>
</fieldset>
<fieldset>

<div style="display: none;">
<?php echo PrintField($Id_Form, "Calle", $Input_Array['Calle']); ?>
<?php echo PrintField($Id_Form, "Numero", $Input_Array['Numero']); ?>
<?php echo PrintField($Id_Form, "Colonia", $Input_Array['Colonia']); ?>
<?php echo PrintField($Id_Form, "Municipio", $Input_Array['Municipio']); ?>
<?php echo PrintField($Id_Form, "CP", $Input_Array['CP']); ?>
<?php echo PrintField($Id_Form, "Estado", $Input_Array['Estado']); ?>
<?php echo PrintField($Id_Form, "Lat", $Input_Array['Lat']); ?>
<?php echo PrintField($Id_Form, "Lon", $Input_Array['Lon']); ?>
</div>

<?php echo PrintField($Id_Form, "Website", $Input_Array['Website']); ?>
<?php echo PrintField($Id_Form, "Permisos", $Input_Array['Permisos']); ?>
</fieldset>
<input type="hidden" name="id_table" value="<?php echo $id_table; ?>">
<input type="hidden" name="Usuario" value="<?php echo $Input_Array['Usuario']; ?>">

<div class="response_form" align="center"></div>
<br>
<div class="form-actions">
<div class="row">
<div class="col-md-12 text-center">
<button class="btn btn-default submit_form" type="submit" id="">Guardar</button>
</div>
</div>
</div>

</div>
</div>
</div>

<!-- end widget -->

</form>

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
window.enable_geocomplete("", "<?php echo $Input_Array['Lat']; ?>,<?php echo $Input_Array['Lon']; ?>", ".map_canvas");
setTimeout(function(){ $(".Direccion").val("<?php echo $Input_Array['Direccion']; ?>"); },2000);
});
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
* TO LOAD A SCRIPT:
* var pagefunction = function (){
*  loadScript(".../plugin.js", run_after_loaded);
* }
*
* OR you can load chain scripts by doing
*
* loadScript(".../plugin.js", function(){
* 	 loadScript("../plugin.js", function(){
* 	   ...
*   })
* });
*/

loadScript("js/plugin/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js", initializeDuallistbox);
function initializeDuallistbox(){
var initializeDuallistbox = $('#initializeDuallistbox').bootstrapDualListbox({
nonSelectedListLabel: 'Disponibles',
selectedListLabel: 'Seleccionadas',
preserveSelectionOnMove: 'moved',
moveOnSelect: false
//nonSelectedFilter: 'ion ([7-9]|[1][0-2])'
});
}

// pagefunction

var pagefunction = function() {
$('#source_form').bootstrapValidator();
};
// end pagefunction
// destroy generated instances
// pagedestroy is called automatically before loading a new page
// only usable in AJAX version!
var pagedestroy = function() {
/*
Example below:
$("#calednar").fullCalendar( 'destroy' );
if (debugState){
root.console.log("✔ Calendar destroyed");
}
For common instances, such as Jarviswidgets, Google maps, and Datatables, are automatically destroyed through the app.js loadURL mechanic
*/
$('#initializeDuallistbox').bootstrapDualListbox('destroy');

$('#source_form').bootstrapValidator('destroy');
$('button[data-toggle]').off();
if (debugState) {
root.console.log("✔ Bootstrap validator destroyed");
}
};
// end destroy
// run pagefunction
loadScript("js/plugin/bootstrapvalidator/bootstrapValidator.min.js", pagefunction);
</script>
