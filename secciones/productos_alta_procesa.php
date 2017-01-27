<?php
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("../funciones.php");

if($Data_Usuario == ""){
include_once("login.php");
exit(); }

$Id_Form = "Productos";

$id_table = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_table']));
$Id_Marca = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Id_Marca']));
$Id_Categoria = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Id_Categoria']));
$Id_CategoriaSub = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Id_CategoriaSub']));
$Id_Producto = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Id_Producto']));
$Producto = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Producto']));
$Precio = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Precio']));
$Moneda = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Moneda']));
$Estatus = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Estatus']));

$query_Productos = "SELECT * FROM `Productos` WHERE `id` = '".$id_table."' ORDER BY `id` DESC;";
$result_Productos = $mysqli->query($query_Productos);
$num_Productos = $result_Productos->num_rows;
if ($num_Productos >= 1) {
$Q_Procesa = "UPDATE `Productos` SET `Id_Marca` = '$Id_Marca', `Id_Categoria` = '$Id_Categoria', `Producto` = '$Producto', `Estatus` = '$Estatus', `Precio` = '$Precio', `Moneda` = '$Moneda', `Id_CategoriaSub` = '$Id_CategoriaSub' WHERE `id` = '".$id_table."';";
} else {
$Id_Producto = urls__($Producto."_".getGUID());
$Q_Procesa = "INSERT INTO `Productos` (
`Id_Marca`, `Id_Categoria`, `Id_Producto`, `Producto`, `Estatus`, `Precio`, `Moneda`, `Id_CategoriaSub`
) VALUES (
'$Id_Marca', '$Id_Categoria', '$Id_Producto', '$Producto', '$Estatus', '$Precio', '$Moneda', '$Id_CategoriaSub'
);";
}

$result_Q_procesa = $mysqli->query($Q_Procesa);
if($result_Q_procesa) {
$msg = <<<EOF
<div class="alert alert-success">Datos procesados, regresando...</div>
<script>
location = "{$url_server}/#productos";
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