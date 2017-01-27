<?php
include_once("../../funciones.php");
include_once("../funciones.admin.php");
//include_once("../header.php");
$get_id_row = Valida_utf8($_REQUEST['id']);
$get_tabla = Valida_utf8($_REQUEST['tabla']);
$get_inputs = $_REQUEST['input'];
?>

<?php
//echo json_encode($_REQUEST)."<hr>";
$array_up_cols = array();
$array_ins_1_cols = array();
$array_ins_2_cols = array();
foreach($get_inputs as $Columna => $Valor){
if($Valor['param'] == "16"){
if($Valor['valor'] == ""){ $Valor['valor'] = 0; }
$array_up_cols[] = " `".$Columna."` = b'".$Valor['valor']."' ";
} else {
$array_up_cols[] = " `".$Columna."` = '".$Valor['valor']."' ";
}
$array_ins_1_cols[] = " `".$Columna."` ";
$array_ins_2_cols[] = " '".$Valor['valor']."' ";
}

if($get_id_row != "") {
//UPDATE
$cols_up_comas = implode(",", $array_up_cols);
$Query_Row = "UPDATE `" . $get_tabla . "` SET ".$cols_up_comas." WHERE `id` = " . $get_id_row . ";";
} else {
//INSERT
/*
INSERT INTO `Redes_Paralelas_Cortes` (`id`, `Id_Cliente`, `Id_Corte`, `Nombre_Corte`, `Id_Eleccion`, `Id_Red`, `Usuario`, `Estatus`, `FechaHora`)
(1, 'demo', '1', '1', '5_de_junio', 'red-institucional_8ed00a', 'gestionapp', 'Activo', '1464984064'); */
$cols_int_1_comas = implode(",", $array_ins_1_cols);
$cols_int_2_comas = implode(",", $array_ins_2_cols);
$Query_Row = "INSERT INTO `".$get_tabla."` (".$cols_int_1_comas.") VALUES (".$cols_int_2_comas.");";
}
//echo $Query_Row;
if($result_Row = $mysqli_sys->query($Query_Row)){
$error = $mysqli_sys->error;
$msg = <<<EOF
Datos Procesados...
<hr>
{$Query_Row}
<hr>
{$error}
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