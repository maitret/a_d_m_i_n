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

$Id_Puesto = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Id_Puesto']));
$Puesto = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Puesto']));
$Estatus = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Estatus']));

$Nombre = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Nombre']));
$Permiso = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Permiso']));
$Asignado_Por = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Asignado_Por']));
$Tipo = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Tipo']));
$Nivel = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Nivel']));

$Permisos_Rel = $_REQUEST['Permisos_Rel'];

if($Id_Puesto == "") { $Id_Puesto = urls__($Puesto."_".getGUID()); }
$Id_Perfil = $Id_Puesto;

$query_Usuarios_Puestos = "SELECT * FROM `Usuarios_Puestos` WHERE `id` = '$id_table' ORDER BY `id` DESC;";
$result_Usuarios_Puestos = $mysqli->query($query_Usuarios_Puestos);
$num_Usuarios_Puestos = $result_Usuarios_Puestos->num_rows;
if ($num_Usuarios_Puestos >= 1) {
$Q_Procesa = "UPDATE `Usuarios_Puestos` SET `Puesto` = '$Puesto', `Estatus` = '$Estatus' WHERE `id` = '$id_table';";
} else {
$Q_Procesa = "INSERT INTO `Usuarios_Puestos`
 (`Id_Puesto`, `Puesto`, `Estatus`)
 VALUES ('$Id_Puesto', '$Puesto', '$Estatus');";
}

$result_Q_procesa = $mysqli->query($Q_Procesa);
if($result_Q_procesa) {

$Del_Suc_Rel = "DELETE FROM `Permisos_Perfiles` WHERE `Id_Perfil` = '".$Id_Perfil."';";
$result_Del_Suc_Rel = $mysqli->query($Del_Suc_Rel);

echo json_encode($Permisos_Rel);
if (is_array($Permisos_Rel)) {
foreach ($Permisos_Rel as $Permiso) {

$query_Permisos_Perfiles = "SELECT * FROM `Permisos_Perfiles` WHERE `Id_Perfil` = '$Id_Perfil' AND `Permiso` = '$Permiso' ORDER BY `id` DESC;";
$result_Permisos_Perfiles = $mysqli->query($query_Permisos_Perfiles);
$num_Permisos_Perfiles = $result_Permisos_Perfiles->num_rows;
if ($num_Permisos_Perfiles == 0) {
$Q_InsertPermisoRel = "INSERT INTO `Permisos_Perfiles`
 (`Id_Perfil`, `Nombre`, `Permiso`, `Asignado_Por`, `Tipo`, `Nivel`)
 VALUES ('$Id_Perfil', '$Permiso', '$Permiso', '$Data_Usuario', 'Global', '1');";
$result_InsertPermisoRel = $mysqli->query($Q_InsertPermisoRel);
}

}
}

$msg = <<<EOF
<div class="alert alert-success">Datos procesados, regresando...</div>
<script>
location = "{$url_server}/#usuarios_permisos";
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