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

$Id_Form = "Usuarios_Puestos";
$Cosas = "Puestos/Permisos";
$Cosa = "Puesto/Permiso";

$id_table = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_table']));
$query_Cosa = "SELECT * FROM `".$Id_Form."` WHERE `id` = '$id_table' ORDER BY `id` DESC;";
$result_Cosa = $mysqli->query($query_Cosa);
$num_Cosa = $result_Cosa->num_rows;
$Input_Array = $result_Cosa->fetch_array(MYSQLI_ASSOC);
?>

<div class="row">

<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER -->
<i class="fa-fw fa fa-home"></i>
 <?php echo $Cosas; ?> <span> > Alta/Editar </span>
</h1>
</div>

<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">

</div>
</div>
<section id="widget-grid" class="">
<div class="row">
<div class="col-sm-12">

<form id="" class="source_form" method="post" action="_/usuarios_permisos_alta_procesa"
data-bv-message="Este valor es invalido" data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" accept-charset="ISO-8859-1">

<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget" id="wid-id-sucursal" data-widget-colorbutton="false"	data-widget-editbutton="true" data-widget-togglebutton="true" data-widget-deletebutton="false" data-widget-fullscreenbutton="true">
<header>
<h2>Ingrese datos del Puesto</h2>
</header>
<div>
<div class="jarviswidget-editbox">
<input class="form-control" type="text">
</div>
<div class="widget-body">

<fieldset>
<?php echo PrintField($Id_Form, "Puesto", $Input_Array['Puesto']); ?>
<?php echo PrintField($Id_Form, "Estatus", $Input_Array['Estatus']); ?>
</fieldset>

<input type="hidden" name="id_table" value="<?php echo $id_table; ?>">
<input type="hidden" name="Id_Puesto" value="<?php echo $Input_Array['Id_Puesto']; ?>">

<h2 align="center">Indique permisos del puesto asignados</h2>
<fieldset>
<?php
$query_Permisos = "SELECT * FROM `Permisos` WHERE `Estatus` = 'Activo' ORDER BY `Seccion` ASC;";
$result_Permisos = $mysqli->query($query_Permisos);
$num_Permisos = $result_Permisos->num_rows;
if ($num_Permisos >= 1) {
while($row_Permisos = $result_Permisos->fetch_array(MYSQLI_ASSOC)){
$id_permiso = $row_Permisos['id'];
$Permiso = $row_Permisos['Permiso'];
$Nombre_Visible = $row_Permisos['Nombre_Visible'];
$Descripcion = $row_Permisos['Descripcion'];
$Estatus = $row_Permisos['Estatus'];
$Seccion = $row_Permisos['Seccion'];
$Default = $row_Permisos['Default'];

$CheckPermisosRel = CheckPermisosRel($Input_Array['Id_Puesto'], $Permiso);
if ($CheckPermisosRel >= 1) { $selected_permiso = "selected"; } else { $selected_permiso = ""; }
$tr_permisos .= <<<EOF
<option value="{$Permiso}" {$selected_permiso}>{$Seccion} > {$Nombre_Visible}</option>
EOF;

}
}
?>
<select multiple="multiple" size="10" name="Permisos_Rel[]" id="initializeDuallistbox">
<?php echo $tr_permisos; ?>
</select>

</fieldset>

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

</form>

</div>

</div>

</section>

<?php
echo FormTarget_Ajax2($target_id);
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
window.enable_geocomplete("", "<?php echo $Input_Array['Lat']; ?>,<?php echo $Input_Array['Lon']; ?>", ".map_canvas");
setTimeout(function(){ $(".Direccion").val("<?php echo $Input_Array['Direccion']; ?>"); },2000);
});

pageSetUp();

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

var pagefunction = function() {
$('#source_form').bootstrapValidator();
};
var pagedestroy = function() {
$('#initializeDuallistbox').bootstrapDualListbox('destroy');
$('#source_form').bootstrapValidator('destroy');
$('button[data-toggle]').off();
if (debugState) {
root.console.log("✔ Bootstrap validator destroyed");
}
};
loadScript("js/plugin/bootstrapvalidator/bootstrapValidator.min.js", pagefunction);
</script>

