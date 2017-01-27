<?php
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("../funciones.php");

if($Data_Usuario == ""){
include_once("login.php");
exit(); }

$Tipo = "categorias";
$Id_Form = "Productos_Categorias";

$id_table = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_table']));
$Id_Categoria = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Id_Categoria']));
$Categoria = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Categoria']));
$Estatus = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Estatus']));

$query_Productos_Categorias = "SELECT * FROM `Productos_Categorias` WHERE `id` = '$id_table' ORDER BY `id` DESC;";
$result_Productos_Categorias = $mysqli->query($query_Productos_Categorias);
$num_Productos_Categorias = $result_Productos_Categorias->num_rows;
if ($num_Productos_Categorias >= 1) {
$Q_Procesa = "UPDATE `Productos_Categorias` SET `Categoria` = '$Categoria', `Estatus` = '$Estatus' WHERE `id` = '$id_table';";
} else {
$Id_Categoria = urls__($Categoria."_".getGUID());
$Q_Procesa = "INSERT INTO `Productos_Categorias`
 (`Id_Categoria`, `Categoria`, `Estatus`) VALUES ('$Id_Categoria', '$Categoria', '$Estatus');";
}

$result_Q_procesa = $mysqli->query($Q_Procesa);
if($result_Q_procesa) {

$msg = <<<EOF
<div class="alert alert-success">Datos procesados, regresando...</div>
<script>
location = "{$url_server}/#productos_categorias";
</script>
EOF;
} else {
$error = $mysqli->error;
$msg = <<<EOF
Ocurrio un error al ingresar datos: "{$error}"
EOF;
}
echo $msg;
?>