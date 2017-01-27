<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("funciones.php");

$Get_Action = $mysqli->real_escape_string($_REQUEST['action']);

$Get_Aplicativo = $mysqli->real_escape_string($_REQUEST['aplicativo']);
$Get_IdCliente = $mysqli->real_escape_string($_REQUEST['id_cliente']);
if($Id_Cliente == ""){ $Id_Cliente = "adminpanel"; }

if($Get_Aplicativo != "") { $Get_IdCliente = $Get_Aplicativo; }
if($Get_IdCliente != "") { $Get_Aplicativo = $Get_IdCliente; }

$Get_Key = $mysqli->real_escape_string($_REQUEST['key']);
$Get_Lat = $mysqli->real_escape_string($_REQUEST['Lat']);
$Get_Lon = $mysqli->real_escape_string($_REQUEST['Lon']);
$Geo_Aprox = $mysqli->real_escape_string($_REQUEST['Geo_Aprox']);

$Get_Nombre = $mysqli->real_escape_string($_REQUEST['nombre']);
$Get_Usuario = $mysqli->real_escape_string($_REQUEST['email']);
$Get_Password = $mysqli->real_escape_string($_REQUEST['password']);
$Get_Password2 = $mysqli->real_escape_string($_REQUEST['password2']);
$Get_Acepta_Terminos = $mysqli->real_escape_string($_REQUEST['Acepta_Terminos']);
$movil = $mysqli->real_escape_string($_REQUEST['movil']);
$get_return = $mysqli->real_escape_string($_REQUEST['return']);
$User_Agent = user_agent();
$IP = ip();

if($Get_Action == "") {
$msg = <<<EOF
<p class="text-danger"><b>Par&aacute;metros incompletos</b></p>
EOF;
} else if($Get_Action == "login") {
if($Get_Usuario != "" && $Get_Password != ""){
$query_Usuarios = "SELECT * FROM `Usuarios` WHERE `Email` = '".$Get_Usuario."' OR `Usuario_Login` = '".$Get_Usuario."' ORDER BY `id` LIMIT 1;";
$result_Usuarios = $mysqli->query($query_Usuarios);
$num_Usuarios = $result_Usuarios->num_rows;
if ($num_Usuarios >= 1) {
$row_Usuarios = $result_Usuarios->fetch_array(MYSQLI_ASSOC);
$Data_Validacion = $row_Usuarios['Validacion'];

if(($row_Usuarios["Password"] == $Get_Password)&&($Data_Validacion == "OK")) {
$mysqli->query("UPDATE `Usuarios` SET `Lat` = '$Get_Lat', `Lon` = '$Get_Lon', `User_Agent` = '$User_Agent', `IP` = '$IP', `Fecha_LastSession` = '".time()."' WHERE `Usuario` = '{$row_Usuarios["Usuario"]}';");
if ($row_Usuarios["Token"] == "") {
$token = bin2hex(openssl_random_pseudo_bytes(25));
$mysqli->query("UPDATE `Usuarios` SET `Token` = '$token' WHERE `Usuario` = '{$row_Usuarios["Usuario"]}';");
$row_Usuarios["Token"] = $token;
}

$query_Info_Moviles_2FA = "SELECT * FROM `Info_Moviles_2FA` WHERE `Usuario` = '".$row_Usuarios["Usuario"]."' AND `Key_Movil` = '".$Get_Key."' ORDER BY `id` DESC;";
$result_Info_Moviles_2FA = $mysqli->query($query_Info_Moviles_2FA);
$num_Info_Moviles_2FA = $result_Info_Moviles_2FA->num_rows;
if ($num_Info_Moviles_2FA >= 1) {
$Insert_Info_Moviles_2FA = "UPDATE `Info_Moviles_2FA` SET
 `session_id` = '".session_id()."', `Lat` = '$Get_Lat', `Lon` = '$Get_Lon', `Geo_Aprox` = '$Geo_Aprox', `User_Agent` = '$User_Agent', `IP` = '$IP', `FechaHora_Last` = '".time()."', `Token_Firebase` = '$Token_Firebase', `Token_Firebase_Last` = '$Token_Firebase_Last', `Token_Firebase_Expira` = '$Token_Firebase_Expira'
 WHERE `Key_Movil` = '".$Get_Key."';";
} else {
$Insert_Info_Moviles_2FA = "INSERT INTO `Info_Moviles_2FA` (
`Usuario`, `session_id`, `Key_Movil`, `Token_Push`, `Lat`, `Lon`, `Geo_Aprox`, `Handle_Url`, `User_Agent`, `IP`, `FechaHora_Last`, `platform`, `version`, `uuid`, `cordova`, `model`, `Device_json`, `Header_json`, `Push_json`, `Estatus_2FA`, `Metodo_2FA`, `FechaHora_Last_2FA`
) VALUES (
'".$row_Usuarios["Usuario"]."', '".session_id()."', '$Get_Key', '$Token_Push', '$Get_Lat', '$Get_Lon', '$Geo_Aprox', '$Handle_Url', '$User_Agent', '$IP', '".time()."', '$platform', '$version', '$uuid', '$cordova', '$model', '$Device_json', '$Header_json', '$Push_json', '$Estatus_2FA', '$Metodo_2FA', '$FechaHora_Last_2FA'
);";
}
$result_Insert_Info_Moviles_2FA = $mysqli->query($Insert_Info_Moviles_2FA);
echo $mysqli->error;

$_SESSION['Data_Token'] =$row_Usuarios['Token'];
$_SESSION['Data_id'] = $row_Usuarios['id'];
$_SESSION['Data_Nombre'] = $row_Usuarios['Nombre'];
$_SESSION['Data_Paterno'] = $row_Usuarios['Apellido_Paterno'];
$_SESSION['Data_Materno'] = $row_Usuarios['Apellido_Materno'];
$_SESSION['Data_Usuario'] = $row_Usuarios['Usuario'];
$_SESSION['Data_Email'] = $row_Usuarios['Email'];
$_SESSION['Data_Admin'] = $row_Usuarios['Admin'];
$_SESSION['Data_Movil'] = $movil;
$session = base64_encode($_SESSION["Data_Usuario"]);
session_name($session);
setcookie("token_sess", $_SESSION['Data_Token'], time()+86400);
$Data_Usuario = $_SESSION['Data_Usuario'];
$Data_Nombre = $_SESSION['Data_Nombre'];

$msg = <<<EOF
<p class="text-success"><b>Bienvenid@ de vuelta <em>{$row_Usuarios['Nombre']}</em> :)</b></p>
<script type="text/javascript">
localStorage.setItem('usuario', "{$Data_Usuario}");
setTimeout(function(){ location = "{$get_return}"; }, 1000);
</script>
EOF;

mail($email_debug, "Login ".$server."", "http://maps.google.com/?q=".$Get_Lat.",".$Get_Lon."\n\n".$Get_Lat.",".$Get_Lon."\n\n".json_encode($_REQUEST));

} else {
$msg = <<<EOF
<p class="text-danger"><b>Password incorrecto</b></p>
EOF;
}

} else {
$msg = <<<EOF
<p class="text-danger"><b>Email no encontrado</b></p>
EOF;
}
} else {
$msg = <<<EOF
<p class="text-danger"><b>Datos incompletos</b></p>
EOF;
}

} else if($Get_Action == "registro") {

if($Get_Nombre != "" && $Get_Usuario != "" && $Get_Password != "" && $Get_Password2 != "" && $Get_Acepta_Terminos != ""){
$query_Usuarios_Check = "SELECT * FROM `Usuarios` WHERE `Email` = '".$Get_Usuario."' ORDER BY `id` DESC;";
$result_Usuarios = $mysqli->query($query_Usuarios_Check);
$num_Usuarios = $result_Usuarios->num_rows;
if ($num_Usuarios >= 1) {
$msg = <<<EOF
<p class="text-danger"><b>Este email ya fue dado de alta!</b></p>
EOF;
} else {

$Insert_User = "INSERT INTO `Usuarios` (
`Id_Cliente`, `FechaRegistro`, `Usuario`, `Usuario_Login`, `Password`, `Nombre`, `Apellido_Paterno`, `Apellido_Materno`, `Telefono`, `Email`, `Direccion`, `Calle`, `Numero`, `Colonia`, `Municipio`, `CP`, `Estado`, `Lat`, `Lon`, `Validacion`, `User_Agent`, `IP`, `Fecha_LastSession`, `Token`
) VALUES (
'".$Id_Cliente."', '$FechaHora', '".urls__($Get_Nombre.time())."', '', '".$Get_Password."', '$Get_Nombre', '$Get_Paterno', '$Get_Materno', '$Telefono', '$Get_Usuario', '$Direccion', '$Calle', '$Numero', '$Colonia', '$Municipio', '$CP', '$Estado', '$Get_Lat', '$Get_Lon', '".$random."', '".$User_Agent."', '$IP', '$Fecha_LastSession', '$Token');";
$result_Insert_User = $mysqli->query($Insert_User);

$Link_activa = $url_server."/?html=activa_cuenta&k=".$random."&t=".$FechaHora."&u=".$Get_Usuario;
$HTML_Message = <<<EOF
<p style="text-align: center;"><span style="font-size:16px"><span style="font-family:Arial,Helvetica,sans-serif">Click&nbsp;en el siguiente vinculo para activar su cuenta:&nbsp;</span></span></p>
<p style="text-align: center;"><span style="font-size:16px"><span style="font-family:Arial,Helvetica,sans-serif"><a href="{$Link_activa}">{$Link_activa}</a></span></span></p>
EOF;
$email_admin = $email_debug;
$response_id = "<" . sha1(microtime(true)) . "@myhostmx.com>";
$no_reply = "No Responder <no.reply@myhostmx.com>";
$reply = "myhostmx.com <contacto@myhostmx.com>";
$headers = "From: " . $reply . " \n";
$headers .= "X-MAILER: MyHostMX \n";
//$headers .= "CC: ".$Email." \n";
$headers .= "BCC: maitret@myhostmx.com \n";
$headers .= "Reply-To: " . $email_admin . " \n";
$headers .= "Return-Path: " . $reply . " \n";
$headers .= "MIME-Version: 1.0 \n";
$headers .= "Date: " . date('r') . " \n";
$headers .= "Message-Id: " . $response_id . " \n";
//$headers .= "Content-Type: text/html; charset=windows-1252 \n";
$headers .= "Content-Type: text/html; charset=iso-8859-1 \n";
$headers .= "Content-Transfer-Encoding: 7bit \n";
$FechaEnvio = date('d/m/Y H:i', time());
mail($Get_Usuario, "Activa tu cuenta", $HTML_Message, $headers);
$msg = <<<EOF
<div class="alert alert-success"><b>Sus datos fueron registrados, en breve recibir&aacute; un mensaje en su email para activar su cuenta.</b></div>
<script type="text/javascript">
$(".div_boton_crear_cuenta").hide();
</script>
EOF;

}

} else {
$msg = <<<EOF
<p class="text-danger"><b>Datos incompletos</b></p>
EOF;
}
} else if($Get_Action == "recupera_password") {

$query_Usuarios = "SELECT * FROM `Usuarios` WHERE `Email` = '".$Get_Usuario."' OR `Usuario_Login` = '".$Get_Usuario."' ORDER BY `id` LIMIT 1;";
$result_Usuarios = $mysqli->query($query_Usuarios);
$num_Usuarios = $result_Usuarios->num_rows;
if ($num_Usuarios >= 1) {
$row_Usuarios = $result_Usuarios->fetch_array(MYSQLI_ASSOC);

$Link_Login = $url_server."/?html=login&e=".$row_Usuarios['Email'];
$HTML_Message = <<<EOF
<p style="text-align:center"><span style="font-size:16px">Acabamos de recibir la solicitud de recuperaci&oacute;n de password, a continuaci&oacute;n le brindamos los siguientes datos:</span></p>
<p style="text-align:center"><span style="font-size:16px">Email: {$row_Usuarios['Email']}<br />
Password: {$row_Usuarios['Password']}</span></p>
<p style="text-align:center"><span style="font-size:16px"><span style="font-family:Arial,Helvetica,sans-serif"><a href="{$Link_Login}">Ingresar v&iacute;a web</a></span></span></p>
<p style="text-align:center">&nbsp;</p>
EOF;
$email_admin = $email_debug;
$response_id = "<" . sha1(microtime(true)) . "@myhostmx.com>";
$no_reply = "No Responder <no.reply@myhostmx.com>";
$reply = "myhostmx.com <contacto@myhostmx.com>";
$headers = "From: " . $reply . " \n";
$headers .= "X-MAILER: MyHostMX \n";
//$headers .= "CC: ".$Email." \n";
$headers .= "BCC: maitret@myhostmx.com \n";
$headers .= "Reply-To: " . $email_admin . " \n";
$headers .= "Return-Path: " . $reply . " \n";
$headers .= "MIME-Version: 1.0 \n";
$headers .= "Date: " . date('r') . " \n";
$headers .= "Message-Id: " . $response_id . " \n";
//$headers .= "Content-Type: text/html; charset=windows-1252 \n";
$headers .= "Content-Type: text/html; charset=iso-8859-1 \n";
$headers .= "Content-Transfer-Encoding: 7bit \n";
$FechaEnvio = date('d/m/Y H:i', time());
mail($Get_Usuario, "Su Password", $HTML_Message, $headers);
$msg = <<<EOF
<div class="alert alert-success"><b>En breve recibir&aacute; un mensaje en su email con los datos de su cuenta.</b></div>
<script type="text/javascript">
$(".div_boton_recupera_password").hide();
</script>
EOF;

} else {
$msg = <<<EOF
<p class="text-danger"><b>Email no encontrado</b></p>
EOF;
}

} else {
$msg = <<<EOF
<p class="text-danger"><b>Acci&oacute;n no reconocida: {$Get_Action}</b></p>
EOF;
}

//mail($email_debug, $_SERVER['PHP_SELF']." ".$Get_Aplicativo." ".$Get_Action, json_encode($_REQUEST)."\n\nK: ".$Get_Key."\n\nQuerys: ".$query_Clientes_App."\n\n".$query_Usuarios."\n\nJson_Clientes_App: ".$json_Clientes_App."\n\nHeaders: ".json_encode($GetHeaders)."\n\nUser_Agent: ".$User_Agent);
echo $msg;

?>