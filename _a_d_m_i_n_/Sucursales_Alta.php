<?php
include_once("../funciones.php");
include_once("funciones.admin.php");
include_once("header.php");

$id_proveedor = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_proveedor']));
$query_Proveedores = "SELECT * FROM `Sucursales` WHERE `id` = '$id_proveedor' ORDER BY `id` DESC LIMIT 1;";
$result_Proveedores = $mysqli->query($query_Proveedores);
$num_Proveedores = $result_Proveedores->num_rows;
$Input_Array = $result_Proveedores->fetch_array(MYSQLI_ASSOC);
?>

<style>
.map_canvas {
width: 100%;
height: 300px;
}
</style>

<script>
jQuery(document).ready(function($) {
var default_loc = "<?php echo $Input_Array['Lat']; ?>,<?php echo $Input_Array['Lon']; ?>";
$(".Direccion").geocomplete({
map: ".map_canvas",
mapOptions: { scrollwheel: true },
markerOptions: { draggable: true, title: "Defina punto exacto" },
details: "form",
location: default_loc,
types: ["geocode", "establishment"],
detailsAttribute: "data-geo",
});

//$("#input_Direccion").trigger("geocode");

$(".Direccion").bind("geocode:dragged", function(event, latLng){
$("input[name=Lat]").val(latLng.lat());
$("input[name=Lon]").val(latLng.lng());
//$("#reset").show();
});

$("#reset").click(function(){
$(".Direccion").geocomplete("resetMarker");
$("#reset").hide();
return false;
});

//$("#find").click(function(){
//$(".Direccion").trigger("geocode");
//});
});
</script>

<form action="Sucursales_Alta_Procesa.php" id="source_form">

<div class="row">
<?php $Id_Form = "Sucursales";?>
<?php echo PrintField($Id_Form, "Empresa", $Input_Array['Empresa']); ?>
<?php echo PrintField($Id_Form, "Telefono", $Input_Array['Telefono']); ?>
<?php echo PrintField($Id_Form, "Email", $Input_Array['Email']); ?>
<?php echo PrintField($Id_Form, "Website", $Input_Array['Website']); ?>
<?php echo PrintField($Id_Form, "Direccion", $Input_Array['Direccion']); ?>
</div>

<div class="map_canvas"></div>

<div class="row">
<?php echo PrintField($Id_Form, "Calle", $Input_Array['Calle']); ?>
<?php echo PrintField($Id_Form, "Numero", $Input_Array['Numero']); ?>
<?php echo PrintField($Id_Form, "Colonia", $Input_Array['Colonia']); ?>
<?php echo PrintField($Id_Form, "Municipio", $Input_Array['Municipio']); ?>
<?php echo PrintField($Id_Form, "CP", $Input_Array['CP']); ?>
<?php echo PrintField($Id_Form, "Estado", $Input_Array['Estado']); ?>
<?php echo PrintField($Id_Form, "Lat", $Input_Array['Lat']); ?>
<?php echo PrintField($Id_Form, "Lon", $Input_Array['Lon']); ?>
</div>

<div class="row">

<?php echo PrintField($Id_Form, "Estatus", $Input_Array['Estatus']); ?>
</div>

<input type="hidden" name="id_proveedor" value="<?php echo $id_proveedor; ?>">

<div id="response_form" align="center"></div>
<br>
<div class=" text-center">
<button type="submit" class="btn btn-space btn-primary" id="submit_form">Guardar</button>
</div>

<br>
<?php
echo FormTarget_Ajax($target_id);
include_once("footer.php");
?>
