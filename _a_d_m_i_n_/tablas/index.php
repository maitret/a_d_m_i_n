<?php
include_once("../../funciones.php");
include_once("../funciones.admin.php");
include_once("../header.php");

if($Data_Admin <= "1" && $Data_Admin != "")
{ }
else {
//echo ":)"; exit();
}

$get_id_row = Valida_utf8($_REQUEST['id']);
$get_last_id = Valida_utf8($_REQUEST['last_id']);
$get_tabla = Valida_utf8($_REQUEST['tabla']);
$get_srv = Valida_utf8($_REQUEST['srv']);

if($get_srv == ""){
$mysqli_db = $mysqli;
} else {
$mysqli_db = $mysqli_gps;
}

$GetTablas = GetTablas($get_srv);
//echo json_encode($GetTablas);
foreach($GetTablas as $GetTabla){
$list_tablas .= <<<EOF
<div class="list-group-item">
<a href="./?srv={$get_srv}&tabla={$GetTabla}"><b>{$GetTabla}</b></a>
<a class="pull-right btn btn-success btn-xs" href="./edita_row.php?srv={$get_srv}&tabla={$GetTabla}" title="Agregar nuevo registro a esta tabla"><i class="fa fa-plus" aria-hidden="true"></i></a>
</div>
EOF;
}

?>
<div class="row">
<div class="col-sm-3">

<div class="list-group">
<?php echo $list_tablas; ?>
</div>
</div>
<div class="col-sm-9">

<?php

if($get_tabla != ""){
$query_Tabla = "SELECT * FROM `".$get_tabla."` ORDER BY `id` DESC LIMIT 10;";
$result_Tabla = $mysqli_db->query($query_Tabla);
$num_Tabla = $result_Tabla->num_rows;
if ($num_Tabla >= 1) {
$count = 0; $tr_tabla = "";
while($row_Tabla = $result_Tabla->fetch_array(MYSQLI_ASSOC)){
$tr_tabla_body = "";
foreach($row_Tabla as $columna => $valor){
$GetInfoColumna_type = GetInfoColumna($get_tabla, $columna, $get_srv);
if($count == 0){
$tr_tabla_init .= <<<EOF
<th>{$columna}</th>
EOF;
} else {
if($GetInfoColumna_type == "16"){
if($valor == 1){ $checked_bit = '<i class="fa fa-check-square-o" aria-hidden="true"></i>'; } else { $checked_bit = '<i class="fa fa-square-o" aria-hidden="true"></i>'; }
$tr_tabla_body .= <<<EOF
<td title="Valor actual: {$valor}">{$checked_bit}</td>
EOF;
} else {
$tr_tabla_body .= <<<EOF
<td>{$valor}</td>
EOF;
}

}
}
if($tr_tabla_body != "") {
$tr_tabla .= <<<EOF
\n<tr>
<td>
<a href="./edita_row.php?srv={$get_srv}&tabla={$get_tabla}&id={$row_Tabla['id']}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
 | <a class="text-danger" href="./elimina_row.php?srv={$get_srv}&tabla={$get_tabla}&id={$row_Tabla['id']}" onclick = "if (!confirm('Esta seguro de eliminar por completo este registro?')) { return false; }"><i class="fa fa-times" aria-hidden="true"></i></a>
</td>
{$tr_tabla_body}
</tr>\n
EOF;
}
//echo json_encode($row_Tabla);
$count++;
}
}

?>

Extras:
<a href="../forms/edit_form.php?srv=<?php echo $get_srv; ?>&id_form=<?php echo $get_tabla; ?>">[Forms]</a>
<a href="Genera_Variables_DB.php?srv=<?php echo $get_srv; ?>&tabla=<?php echo $get_tabla; ?>&debug=">[Genera_Variables_DB]</a>
<hr>

<table id="Lista_Rows" class="table table-hover display table-bordered table-condensed" cellspacing="0" width="100%">
<thead>
<tr>
<th>Opc.</th>
<?php echo $tr_tabla_init; ?>
</tr>
</thead>
<tfoot>
<tr>
<th>Opc.</th>
<?php echo $tr_tabla_init; ?>
</tr>
</tfoot>
<tbody>
<?php echo $tr_tabla; ?>
</tbody>
</table>

<script type="text/javascript">
jQuery(document).ready(function($){
window.enable_datatable("#Lista_Rows", '1', 'desc');
});
</script>
<?php } else { ?>

<h3 class="" align="center"><i class="fa fa-arrow-left" aria-hidden="true"></i> Seleccione una tabla</h3>

<?php } ?>

</div>
</div>
<?php
//$nojquery = "1";
echo FormTarget_Ajax($target_id);
echo UrlTarget_Ajax($target_url, $target_id);
include_once("../footer.php");
?>
