<?php
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("../funciones.php");

$Id_Form = "Usuarios";
$Cosas = "Usuarios";
$Cosa = "Usuario";

$id_table = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_table']));
$FechaRegistro = $mysqli->real_escape_string(Valida_utf8($_REQUEST['FechaRegistro']));
$Usuario = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Usuario']));
$Usuario_Login = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Usuario_Login']));
$Password = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Password']));
$Nombre = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Nombre']));
$Apellido_Paterno = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Apellido_Paterno']));
$Apellido_Materno = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Apellido_Materno']));
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
$Validacion = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Validacion']));
$User_Agent = $mysqli->real_escape_string(Valida_utf8($_REQUEST['User_Agent']));
$IP = $mysqli->real_escape_string(Valida_utf8($_REQUEST['IP']));
$Fecha_LastSession = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Fecha_LastSession']));
$Token = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Token']));
$Website = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Website']));
$Permisos = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Permisos']));


$Usuarios_Sucursales_Rel = $_REQUEST['Usuarios_Sucursales_Rel'];
//echo json_encode($_REQUEST);

$query_Usuarios = "SELECT * FROM `Usuarios` WHERE `id` = '".$id_table."' ORDER BY `id` DESC;";
$result_Usuarios = $mysqli->query($query_Usuarios);
$num_Usuarios = $result_Usuarios->num_rows;
if($num_Usuarios >= 1) {
//`Usuario_Login` = '$Usuario_Login',
$Q_Procesa = "UPDATE `Usuarios` SET `Password` = '$Password', `Nombre` = '$Nombre', `Apellido_Paterno` = '$Apellido_Paterno', `Apellido_Materno` = '$Apellido_Materno', `Telefono` = '$Telefono', `Email` = '$Email', `Direccion` = '$Direccion', `Calle` = '$Calle', `Numero` = '$Numero', `Colonia` = '$Colonia', `Municipio` = '$Municipio', `CP` = '$CP', `Estado` = '$Estado', `Lat` = '$Lat', `Lon` = '$Lon', `Website` = '$Website', `Permisos` = '$Permisos'
 WHERE `id` = '".$id_table."';";
} else {
if($Usuario == "") { $Usuario = urls__($Nombre."_".$Apellido_Paterno."_".getGUID()); }
$Q_Procesa = "INSERT INTO `Usuarios`
 (`FechaRegistro`, `Usuario`, `Usuario_Login`, `Password`, `Nombre`, `Apellido_Paterno`, `Apellido_Materno`, `Telefono`, `Email`, `Direccion`, `Calle`, `Numero`, `Colonia`, `Municipio`, `CP`, `Estado`, `Lat`, `Lon`, `Validacion`, `Website`, `Permisos`)
 VALUES ('".time()."', '$Usuario', '$Usuario_Login', '$Password', '$Nombre', '$Apellido_Paterno', '$Apellido_Materno', '$Telefono', '$Email', '$Direccion', '$Calle', '$Numero', '$Colonia', '$Municipio', '$CP', '$Estado', '$Lat', '$Lon', 'OK', '$Website', '$Permisos');";
}

$result_Q_procesa = $mysqli->query($Q_Procesa);
if($result_Q_procesa) {

$Del_Suc_Rel = "DELETE FROM `Usuarios_Sucursales_Rel` WHERE `Id_Usuario` = '".$Usuario."';";
$result_Del_Suc_Rel = $mysqli->query($Del_Suc_Rel);

foreach($Usuarios_Sucursales_Rel as $Id_Sucursal){
//echo $Id_Sucursal."<br>";
$Q_InsertSucRel = "INSERT INTO `Usuarios_Sucursales_Rel`
 (`Id_Usuario`, `Id_Sucursal`, `FechaHora`, `Estatus`)
 VALUES ('".$Usuario."', '$Id_Sucursal', '".time()."', 'Activo');";
$result_InsertSucRel = $mysqli->query($Q_InsertSucRel);
}

$msg = <<<EOF
<div class="alert alert-success">Datos procesados, regresando...</div>
<script>
location = "{$url_server}/#usuarios";
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