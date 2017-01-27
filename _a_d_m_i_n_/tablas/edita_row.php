<?php
include_once("../../funciones.php");
include_once("../funciones.admin.php");
include_once("../header.php");
$get_id_row = Valida_utf8($_REQUEST['id']);
$get_tabla = Valida_utf8($_REQUEST['tabla']);
?>

<?php
$query_Row = "SELECT * FROM `".$get_tabla."` WHERE `id` = '".$get_id_row."' ORDER BY `id` DESC LIMIT 1;";
$result_Row = $mysqli_sys->query($query_Row);
$num_Row = $result_Row->num_rows;
$row_Row = $result_Row->fetch_array(MYSQLI_ASSOC);

$GetColumnas = GetColumnas($get_tabla);
//echo json_encode($GetColumnas);
foreach($GetColumnas as $Columna => $Param){
$Param_print = ""; $input_type_print = "";
if($Columna == "id"){ } else {
if($Param == "12"){
$Param_print = <<<EOF
<script type="text/javascript">
$(".input_{$Columna}").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});
</script>
EOF;
$input_type_print = <<<EOF
<input type="text" name="input[{$Columna}][valor]" class="form-control input_{$Columna}" id="input_{$Columna}" placeholder="{$Columna}" value="{$row_Row[$Columna]}">
EOF;
} else if($Param == "16"){
if($row_Row[$Columna] == 1){ $checked_bit = "checked"; } else { $checked_bit = ""; }
$input_type_print = <<<EOF
<input type="checkbox" name="input[{$Columna}][valor]" class="form-control input_{$Columna}" id="input_{$Columna}" placeholder="{$Columna}" value="1" {$checked_bit}>
EOF;
} else {
$input_type_print = <<<EOF
<input type="text" name="input[{$Columna}][valor]" class="form-control input_{$Columna}" id="input_{$Columna}" placeholder="{$Columna}" value="{$row_Row[$Columna]}">
EOF;
}

$input_form .= <<<EOF
<div class="col-sm-6"><div class="form-group">
<label for="input_{$Columna}" title="Columna (Param)">{$Columna} ({$Param})</label>
<input type="hidden" name="input[{$Columna}][param]" value="{$Param}">
{$input_type_print}
</div>
{$Param_print}
</div>
EOF;
}
}
?>

<form role="form" method="post" id="source_form_" action="guarda_row.php">

<input type="hidden" name="id" value="<?php echo $get_id_row; ?>">
<input type="hidden" name="tabla" value="<?php echo $get_tabla; ?>">

<div class="row">
<?php echo $input_form; ?>
</div>

<div id="response_form_" align="center"></div>
<br>

<div id="submit_form_" align="center">
<button type="submit" class="btn btn-success" id="submit_form_">Guardar</button>
</div>
</form>


<?php
//$nojquery = "1";
echo FormTarget_Ajax($target_id);
echo UrlTarget_Ajax($target_url, $target_id);
include_once("../footer.php");
?>