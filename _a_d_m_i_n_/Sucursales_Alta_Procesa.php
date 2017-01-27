<?php
include_once("../funciones.php");
include_once("funciones.admin.php");

$id_proveedor = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_proveedor']));
$Empresa = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Empresa']));
$Telefono = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Telefono']));
$Email = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Email']));
$Direccion = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Direccion']));
$Calle = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Calle']));
$Numero = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Numero']));
$Colonia = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Colonia']));
$Municipio = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Municipio']));
$CP = $mysqli->real_escape_string(Valida_utf8($_REQUEST['CP']));
$Estado = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Estado']));
$Lat = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Lat']));
$Lon = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Lon']));
$Estatus = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Estatus']));
$Website = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Website']));

$query_Proveedores = "SELECT * FROM `Sucursales` WHERE `id` = '$id_proveedor' ORDER BY `id` DESC LIMIT 1;";
$result_Proveedores = $mysqli->query($query_Proveedores);
$num_Proveedores = $result_Proveedores->num_rows;
if($num_Proveedores >= 1){

$Q_Procesa = "UPDATE `Sucursales` SET `Id_Cliente` = '$Id_Cliente', `Empresa` = '$Empresa', `Telefono` = '$Telefono', `Email` = '$Email', `Direccion` = '$Direccion', `Calle` = '$Calle', `Numero` = '$Numero', `Colonia` = '$Colonia', `Municipio` = '$Municipio', `CP` = '$CP', `Estado` = '$Estado', `Lat` = '$Lat', `Lon` = '$Lon', `Estatus` = '$Estatus', `Website` = '$Website'
WHERE `id` = '".$id_proveedor."';";

} else {

$Q_Procesa = "INSERT INTO `Sucursales` (
`Id_Cliente`,`FechaRegistro`,  `Empresa`, `Telefono`, `Email`, `Direccion`, `Calle`, `Numero`, `Colonia`, `Municipio`, `CP`, `Estado`, `Lat`, `Lon`, `Estatus`, `Website`
) VALUES (
'$Id_Cliente', '".time()."', '$Empresa', '$Telefono', '$Email', '$Direccion', '$Calle', '$Numero', '$Colonia', '$Municipio', '$CP', '$Estado', '$Lat', '$Lon', '$Estatus', '$Website'
);";

}

$result_procesa_Proveedores = $mysqli->query($Q_Procesa);
if($result_procesa_Proveedores) {
$msg = <<<EOF
<script>
location = "Sucursales.php";
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