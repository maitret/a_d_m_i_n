<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header("content-type: application/javascript");
header("content-type: application/javascript; charset=ISO-8859-1", true);
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("../funciones.php");
$is_included = 1;
$User_Agent = user_agent();
$IP = ip();
?>
var key = "<?php echo $Get_Key; ?>";
var key_dev = "<?php echo $Get_Key; ?>";
var id_cliente = "<?php echo $Get_IdCliente; ?>";
var lat = "<?php echo $Get_Lat; ?>";
var lon = "<?php echo $Get_Lon; ?>";
var session_id = "<?php echo session_id(); ?>";
var user_agent = "<?php echo $User_Agent; ?>";
var Usuario = "<?php echo $Data_Usuario; ?>";
var ip = "<?php echo $IP; ?>";
<?php
//echo "var div_usuario_sesion = ".json_encode($div_usuario_sesion).";";
include_once("header_web.js");
?>

