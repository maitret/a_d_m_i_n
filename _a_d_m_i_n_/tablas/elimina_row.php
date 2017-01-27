<?php
include_once("../../funciones.php");
include_once("../funciones.admin.php");
//include_once("../header.php");
$get_id_row = Valida_utf8($_REQUEST['id']);
$get_tabla = Valida_utf8($_REQUEST['tabla']);
$get_inputs = $_REQUEST['input'];
?>

<?php
$Query_Row = "DELETE FROM `".$get_tabla."` WHERE `id` = '".$get_id_row."';";
if($result_Row = $mysqli_sys->query($Query_Row)){
$msg = <<<EOF
Fila Eliminada, regresando...
<script>
location = "./?tabla={$get_tabla}&last_id={$get_id_row}";
</script>
EOF;
} else {
//Error
$msg = $mysqli_sys->error;
}

echo $msg;
?>
?>