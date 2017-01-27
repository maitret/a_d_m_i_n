<?php
session_start();
date_default_timezone_set('America/Mexico_City');

error_reporting(E_ALL); ini_set('display_errors', '0');
$debug = ""; $title_final = "";
if($_REQUEST['debug'] == ":["){ error_reporting(E_ALL); ini_set('display_errors', '1'); $debug_mode = "1"; }
else {  }

include_once("db.php");
require_once("tools/Mobile_Detect.php");
$detect = new Mobile_Detect;

if($detect->isMobile() || $detect->isTablet()){
$movil = "1";
} else {
$movil = "";
}

header('Content-Type: text/html; charset=ISO-8859-1');
//$GetHeaders = apache_request_headers();
//$GetHeaders = getallheaders();

function Valida($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function Valida_utf8($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = utf8_decode($data);
    return $data;
}

$random = substr(md5(uniqid(rand())),0,6);

//include_once("app/lib/Encrypt_Decrypt.php");

function url_server() {
$isSecure = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
$isSecure = true;
}
$HTTP = $isSecure ? 'https:' : 'http:';
$server = $_SERVER["SERVER_NAME"];
$url_server = "//".$server."";
//$server_url = $HTTP."//".$server."";
return $url_server;
}

function ip() {
$pss =  $_SERVER['HTTP_X_FORWARDED_FOR'];
$alt_ip = $_SERVER['REMOTE_ADDR'];
if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) { $alt_ip = $_SERVER['HTTP_CF_CONNECTING_IP']; }
//else if (isset($_SERVER['HTTP_CLIENT_IP'])) { $alt_ip = $_SERVER['HTTP_CLIENT_IP']; }
else if (isset($_SERVER['REMOTE_ADDR'])) { $alt_ip = $_SERVER['REMOTE_ADDR']; }
//return $alt_ip;
if ($pss == "") { $IP = $alt_ip; } else { $IP = $pss; }
return $IP;
}

function user_agent() {
return $_SERVER['HTTP_USER_AGENT'];
}

function get_ip() {
if ($_SERVER['HTTP_CF_CONNECTING_IP'] != "") {
$IP = $_SERVER['HTTP_CF_CONNECTING_IP'];
$proxy = $_SERVER["REMOTE_ADDR"];
$host = @gethostbyaddr($_SERVER["HTTP_X_FORWARDED_FOR"]);
} else if ($_SERVER["HTTP_X_FORWARDED_FOR"] != "") {
$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
$proxy = $_SERVER["REMOTE_ADDR"];
$host = @gethostbyaddr($_SERVER["HTTP_X_FORWARDED_FOR"]);
} else {
$IP = $_SERVER["REMOTE_ADDR"];
$host = @gethostbyaddr($IP);
$proxy = "";
}
return array('ip'=>$IP, 'proxy'=>$proxy, 'host'=>$host);
}

$FechaHora = time();
$FechaHora2 = date("Y-m-d H:i:s");
$IP = ip();
$User_Agent = $_SERVER['HTTP_USER_AGENT'];
$self = $_SERVER['PHP_SELF'];
$title_page = "";
$Data_Id = $_SESSION['Data_id'];
$Check_Usuario = $_SESSION['Data_Usuario'];
$Data_Usuario = $_SESSION['Data_Usuario'];
$Data_Email = $_SESSION['Data_Email'];
$session_id = session_id();
//$movil = $_SESSION['Data_Movil'];
$Data_Movil = $_SESSION['Data_Movil'];

$static_server = "";
$server_static = "";
$uri = $_SERVER["REQUEST_URI"];
$return = Valida($_REQUEST['return']);
//$Nombre_Empresa = $client['Nombre'];
$Id_Empresa = $client['Id_Cliente'];
$Data_Cliente = $_SESSION['Data_Cliente'];

if($Data_Usuario == "")
{ /* $Data_Usuario = "Invitad@"; */ }
else{}
if($Data_Usuario == "")
{ $Check_Usuario = "Invitad@"; }
else{}
$isSecure = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
$isSecure = true;
}
$HTTP = $isSecure ? 'https:' : 'http:';
if($server == "") { $server = $_SERVER["SERVER_NAME"]; } else {  }
//$url_server = $HTTP."//".$server."";
//$server_url = $HTTP."//".$server."";..
$url_server = "//".$server."";
$server_url = "//".$server."";
$url_server_img = "//i2.wp.com/".$server."";
$server_url_img = "//i2.wp.com/".$server."";

function CheckMovilSession($Data_Nombre){
if(isset($Data_Nombre))
{ $msg = ""; }
else
{
$msg = '<br><p style="text-align: center;">Sesi&oacute;n expirada, para ingresar solo da click en el logo o en Home (<i class="fa fa-home"></i>).</p><br> '.$Data_Nombre.'';
}
return $msg;
}

function UrlTarget_Ajax($target_url, $target_id){
if($target_url =="") { $target_url = "url-target"; } else {  }
if($target_id =="") { $target_id = ".ajax-content"; } else {  }
$url_server = url_server();
/* fa-cloud */
$print = <<<EOF
<script type="text/javascript">
function url_target(url){
$('{$target_id}').html('<div align="center"><br><br><h4><i class="fa fa-spinner fa-spin"></i> Cargando...</h4><br><br><br></div>');
history.pushState(null, "", "{$url_server}?load="+url);
$('{$target_id}').load('{$url_server}' + url);
}
</script>
EOF;
return $print;
}


function UrlTarget_Ajax2($target_url, $target_id){
if($target_url =="") { $target_url = "url-target"; } else {  }
if($target_id =="") { $target_id = ".ajax-content"; } else {  }
$url_server = url_server();
$print = <<<EOF
<script type="text/javascript">
function url_target(url){
$('{$target_id}').html('<div align="center"><br><br><h4><i class="fa fa-spinner fa-spin"></i> Cargando...</h4><br><br><br></div>');
/* $('{$target_id}').load('{$url_server}' + url); */
$.getJSON("{$url_server}"+url, { ajax: 'true' }, function (j) {
history.pushState(null, "", "{$url_server}?load="+url);
var data_html = j['html'];
$("{$target_id}").html(data_html);
});
}
</script>
EOF;
return $print;
}

function FormTarget_Ajax($target_id){
if($target_id =="") { $target_id = "form"; } else {  } 
$print = <<<EOF
<script type="text/javascript">
$(document).ready(function(){
$("#source_{$target_id}").submit(function(e) {
e.preventDefault();
$('#submit_{$target_id}').prop("disabled", true);
$("#response_{$target_id}").html("<div class='alert alert-info'><b><i class='fa fa-spinner fa-spin'></i> Un momento...</b></div>");
var postData_{$target_id} = $(this).serializeArray();
var formURL_{$target_id} = $(this).attr("action");
$.ajax({
url: formURL_{$target_id},
type: "POST",
data: postData_{$target_id}
}).done(function(data, textStatus, jqXHR) {
$("#response_{$target_id}").html("" + data);
}).fail(function(jqXHR, textStatus, errorThrown) {
$("#response_{$target_id}").html('Lo sentimos, pero sus datos no pudieron ser procesados.<br>' + jqXHR. statusText);
}).always(function() {
$('#submit_{$target_id}').prop("disabled", false);
});
});
});
</script>
EOF;
return $print;
}
$Form_Default = FormTarget_Ajax($target_id);

function FormTarget_Ajax2($target_id){
if($target_id =="") { $target_id = "form"; } else {  }
$print = <<<EOF
<script type="text/javascript">
$(document).ready(function(){
$(".source_{$target_id}").submit(function(e) {
e.preventDefault();
$('.submit_{$target_id}').prop("disabled", true);
$(".response_{$target_id}").html("<div class='alert alert-info'><b><i class='fa fa-spinner fa-spin'></i> Please wait...</b></div>");
var postData_{$target_id} = $(this).serializeArray();
var formURL_{$target_id} = $(this).attr("action");
$.ajax({
url: formURL_{$target_id},
type: "POST",
data: postData_{$target_id}
}).done(function(data, textStatus, jqXHR) {
$(".response_{$target_id}").html("" + data);
}).fail(function(jqXHR, textStatus, errorThrown) {
//$(".response_{$target_id}").html('Lo sentimos, pero sus datos no pudieron ser procesados.<br>' + jqXHR.statusText);
$(".response_{$target_id}").html('We are sorry, you request failed.<br>' + JSON.stringify(jqXHR));
}).always(function() {
$('.submit_{$target_id}').prop("disabled", false);
});
});
});
</script>
EOF;
return $print;
}

function urls__($input) {
	$input = utf8_encode($input);
    $input = mb_convert_case($input, MB_CASE_LOWER, "UTF-8");
    $a = array("ñ", "á", "é", "í", "ó", "ú", "ä", "ë", "ï", "ö", "ü");
    $b = array("n", "a", "e", "i", "o", "u", "a", "e", "i", "o", "u");
	$input = str_replace($a, $b, $input);
    $input = preg_replace("/[^a-zA-Z0-9]+/", "-", $input);
    $input = preg_replace("/(-){2,}/", "$1", $input);
    $input = trim($input, "-");
    return "".$input; // Url Amigable
}

function urls_nominus($input) {
	$input = utf8_encode($input);
    //$input = mb_convert_case($input, MB_CASE_LOWER, "UTF-8");
    $a = array("ñ", "á", "é", "í", "ó", "ú", "ä", "ë", "ï", "ö", "ü");
    $b = array("n", "a", "e", "i", "o", "u", "a", "e", "i", "o", "u");
	$input = str_replace($a, $b, $input);
    $input = preg_replace("/[^a-zA-Z0-9]+/", "_", $input);
    $input = preg_replace("/(-){2,}/", "$1", $input);
    $input = trim($input, "_");
    return "".$input; // Url Amigable
}

function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}

function get_curl($url, $post_body, $port="80", $method="POST"){
if($url !=""){
$ch = curl_init( );
curl_setopt ( $ch, CURLOPT_URL, $url );
curl_setopt ( $ch, CURLOPT_PORT, $port );
//curl_setopt ( $ch, CURLOPT_POST, 1 );
curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, $method );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
if($method == "POST") { curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body ); }
curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
$response_string = curl_exec( $ch );
$curl_info = curl_getinfo( $ch );
} else { $response_string = ""; }
return $response_string;
}

function GetValsFromTable($Tabla, $Valor, $Visible){
$mysqli = $GLOBALS['mysqli'];
$query_FormContact_Fields = "SELECT `".$Valor."`,`".$Visible."` FROM `".$Tabla."` ORDER BY `id` ASC;";
$result_FormContact_Fields = $mysqli->query($query_FormContact_Fields);
$num_FormContact_Fields = $result_FormContact_Fields->num_rows;
$values_array = array();
if($num_FormContact_Fields >= 1){
while($row_FormContact_Fields = $result_FormContact_Fields->fetch_array(MYSQLI_ASSOC)){
$values_array[$row_FormContact_Fields[$Valor]] = $row_FormContact_Fields[$Visible];
} }
return $values_array;
}

function PrintField($Id_Form, $Slug, $Valor){
$mysqli = $GLOBALS['mysqli'];
$movil = $GLOBALS['movil'];
$query_FormContact_Fields = "SELECT * FROM `FormContact_Fields` WHERE (`id` = '$Slug' OR `Slug` = '$Slug') AND `Id_Form` = '$Id_Form' ORDER BY `id` DESC LIMIT 1;";
$result_FormContact_Fields = $mysqli->query($query_FormContact_Fields);
$num_FormContact_Fields = $result_FormContact_Fields->num_rows;
if ($num_FormContact_Fields >= 1) {
$row_FormContact_Fields = $result_FormContact_Fields->fetch_array(MYSQLI_ASSOC);
$id_input = $row_FormContact_Fields['id'];
$Slug = $row_FormContact_Fields['Slug'];
$Label = $row_FormContact_Fields['Label'];
$Placeholder = $row_FormContact_Fields['Placeholder'];
$Type = $row_FormContact_Fields['Type'];
$Value = strval($row_FormContact_Fields['Value']);
$Required = $row_FormContact_Fields['Required'];
$Order = $row_FormContact_Fields['Order'];
$class = $row_FormContact_Fields['class'];
$Extra = $row_FormContact_Fields['Extra'];
$GetVals_Table = $row_FormContact_Fields['GetVals_Table'];
if($Valor != ""){ $Value = $Valor; }

if($Required == "1") { $Required_print = "required data-bv-notempty=\"true\" data-bv-notempty-message=\"Este campo es requerido\"";
//$Required_hidden = "<input type='hidden' name='input_req[".$Slug."]' value='1'>";
$Required_label = "*"; } else {
//$Required_hidden = "<input type='hidden' name='input_req[".$Slug."]' value=''>";
}

if($Type == "text" || $Type == "email" || $Type == "number" || $Type == "tel") {
$input = <<<EOF
<input class="form-control {$Slug}" type="{$Type}" placeholder="{$Placeholder}" name="{$Slug}" id="input_{$Slug}" value="{$Value}" {$Extra} {$Required_print} />
EOF;
} else if($Type == "textarea") {
$input = <<<EOF
<textarea class="form-control {$Slug}" rows="3" placeholder="{$Placeholder}" name="{$Slug}" id="input_{$Slug}" {$Extra} {$Required_print}>{$Value}</textarea>
EOF;
} else if($Type == "select") {
$input_options = "";
$input_options = "<option value=''> - Seleccione - </option>\n";
if($GetVals_Table != ""){
$GetVals_DB_array = json_decode($GetVals_Table, true);
$GetVals_DB_Tabla = $GetVals_DB_array['Tabla']; $GetVals_DB_Valor = $GetVals_DB_array['Valor']; $GetVals_DB_Visible = $GetVals_DB_array['Visible'];
$Value_Array = GetValsFromTable($GetVals_DB_Tabla, $GetVals_DB_Valor, $GetVals_DB_Visible);
} else {
$Value_Array = json_decode($row_FormContact_Fields['Value'], true);
}
foreach($Value_Array as $item => $value){
if($item == $Value){
$input_options .= "<option value='".$item."' selected>".$value."</option>\n";
} else {
$input_options .= "<option value='".$item."'>".$value."</option>\n";
}
}
$input = <<<EOF
<select class="form-control {$Slug}" name="{$Slug}" id="input_{$Slug}" placeholder="{$Placeholder}" {$Extra} {$Required_print}>
{$input_options}</select>
EOF;
} else if($Type == "date") {
if($movil == 1) {
$input = <<<EOF
<input type="date" class="form-control {$Slug}" data-dateformat="yy-mm-dd" placeholder="{$Placeholder}" name="{$Slug}" id="input_{$Slug}" value="{$Value}" {$Extra} {$Required_print} />
EOF;
} else {
$input = <<<EOF
<input type="text" class="form-control {$Slug} datepicker" data-dateformat="yy-mm-dd" placeholder="{$Placeholder}" name="{$Slug}" id="input_{$Slug}" value="{$Value}" {$Extra} {$Required_print} />
EOF;
}
} else {
$input = <<<EOF
<input class="form-control {$Slug}" type="{$Type}" placeholder="{$Placeholder}" name="{$Slug}" id="input_{$Slug}" value="{$Value}" {$Extra} {$Required_print} />
EOF;
}

$full_input = <<<EOF
<div class="{$class} form-group">
<label for="input_{$Slug}" class="label_input_{$Slug} control-label">{$Required_label} {$Label}</label>
{$Required_hidden}
{$input}
</div>
\n
EOF;
} else { $full_input = ""; }
return $full_input;
}

function GetValFromRow($Tabla, $Columna, $Valor, $Visible){
$mysqli = $GLOBALS['mysqli'];
$query_FormContact_Fields = "SELECT * FROM `".$Tabla."` WHERE `".$Columna."` = '".$Valor."' ORDER BY `id` DESC LIMIT 1;";
$result_FormContact_Fields = $mysqli->query($query_FormContact_Fields);
//$num_FormContact_Fields = $result_FormContact_Fields->num_rows;
$row_FormContact_Fields = $result_FormContact_Fields->fetch_array(MYSQLI_ASSOC);
$resultillo = $row_FormContact_Fields[$Visible];
//return $query_FormContact_Fields;
return $resultillo;
}

function Nombre_Usuario($get_current_user, $w) {
GLOBAL $mysqli;
$query_Nombre_Usuario = "SELECT * FROM `Usuarios` where `Usuario` = '".$get_current_user."' ORDER BY id DESC LIMIT 1";
$result_Nombre_Usuario = $mysqli->query($query_Nombre_Usuario);
if($result_Nombre_Usuario->num_rows >=1) {
while($row_Nombre_Usuario=$result_Nombre_Usuario->fetch_array(MYSQLI_ASSOC)) {
$GetNombre = ucwords(strtolower($row_Nombre_Usuario['Nombre']));
$GetPaterno = ucwords(strtolower($row_Nombre_Usuario['Apellido_Paterno']));
$GetMaterno = ucwords(strtolower($row_Nombre_Usuario['Apellido_Materno']));
}
if($w == ""){
return "".$GetNombre." ".$GetPaterno." ".$GetMaterno.""; } else if($w == "2"){
return "".$GetNombre." ".$GetPaterno.""; }
else if($w == "1"){ return "".$GetNombre.""; } else { return ""; }
} else { return $get_current_user; }
}

$adb_url = "https://".$firebase_app.".firebaseio.com";
$adb_option_defaults = array(
    CURLOPT_HEADER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 2
);

function PostFireBase($method="GET",$uri,$querry=NULL,$json=NULL,$options=NULL){
global $adb_url,$adb_handle,$adb_option_defaults;
if(!isset($adb_handle)) $adb_handle = curl_init();
$options = array(
CURLOPT_URL => $adb_url.$uri."?print=pretty&".$querry,
CURLOPT_CUSTOMREQUEST => $method, // GET POST PUT PATCH DELETE HEAD OPTIONS
CURLOPT_POSTFIELDS => $json,
);
curl_setopt_array($adb_handle,($options + $adb_option_defaults));
//$response =  json_decode(curl_exec($adb_handle),true);
$response =  curl_exec($adb_handle);
return $response;
}

function GetEpochFromDate($Date){
$FechaHora_Evento = $Date;
$GetFechaHora_Evento = date_create_from_format('Y-m-d H:i:s', $FechaHora_Evento);
$GetFechaHora_Evento = strtotime(date_format($GetFechaHora_Evento, 'Y/m/d H:i:s'));
return $GetFechaHora_Evento;
}

function Enviar_AWS_S3($bin, $nombre, $path_bucket, $Cliente, $Tag, $ToUser, $Estatus) {
$Data_Usuario = $GLOBALS['Data_Usuario']; $Id_Cliente = $GLOBALS['Id_Cliente']; $mysqli = $GLOBALS['mysqli'];
$email_admin = $GLOBALS['email_admin']; $email_debug = $GLOBALS['email_debug']; 
$aws_s3_key = $GLOBALS['aws_s3_key']; $aws_s3_secret = $GLOBALS['aws_s3_secret']; $aws_s3_bucket = $GLOBALS['aws_s3_bucket']; $aws_s3_region = $GLOBALS['aws_s3_region'];
if($aws_s3_key != "" && $aws_s3_secret != "" && $aws_s3_bucket != ""){
if($ToUser == "") { $ToUser = $Data_Usuario; }
if($Estatus == "") { $Estatus = "Pendiente"; }
if($nombre !="" && $path_bucket != "") {
$FechaHora = time();
$IP = ip();
$User_Agent = $_SERVER['HTTP_USER_AGENT'];
if($Cliente == "") { $Cliente = "default"; } else {  }
$date = date('d_m_Y_-_H_i');
if($nombre == ""){ $nombre = $Cliente."_".$ToUser."_".time(); } else {  }

require __DIR__.'/apps/aws/vendor/autoload.php';
$s3Client = new Aws\S3\S3Client([ 'version' => 'latest', 'region' => $aws_s3_region, 'credentials' => ['key' => $aws_s3_key,'secret' => $aws_s3_secret] ]);
$bucket = $aws_s3_bucket;

$temp_file =  __DIR__."/ups/".$nombre."";
file_put_contents($temp_file, $bin);
//if($path_bucket == "") { $path_bucket = ""; } else { $path_bucket_ = "/".$path_bucket; }
$result_upload = $s3Client->putObject(array(
'Bucket'     => $bucket,
'Key'        => $path_bucket."/".$nombre,
'SourceFile' => $temp_file,
'ACL'    => 'public-read',
));
//$result_json = json_encode($result_upload->getAll());
$result_url = $result_upload['ObjectURL'];
$nombre_source = $mysqli->real_escape_string($GLOBALS['Filesillo_name']);
$query_insert = "INSERT INTO `Temp_Uploads` (
`Data_Usuario`, `Usuario`, `Archivo`, `Archivo_Source`, `FechaHora`, `IP`, `User_Agent`, `Tag`, `result`, `result_url`, `Estatus`, `Path`
) VALUES (
'$Data_Usuario', '$ToUser', '$nombre', '$nombre_source', '$FechaHora', '$IP', '$User_Agent', '$Tag', '$result_json', '$result_url', '$Estatus', '$path_bucket'
)";

if($mysqli->query($query_insert)){  } else {
mail($email_debug, $_SERVER['PHP_SELF'], "\n\n".$mysqli->error."\n\n".$result_json."\n");
}
//$result_s3 = "1";
$result_s3 = $result_url;
unlink($temp_file);
} else { $result_s3 = "0"; }
return $result_s3;
}
}

function UploadGAE($Filesillos, $path){
$url_gae = $GLOBALS['url_gae']; if($url_gae != ""){
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36");
curl_setopt($ch, CURLOPT_URL, $url_gae."/upload_handler.php?modo=json&path=".$path);
curl_setopt($ch, CURLOPT_POST, true);
//same as <input type="file" name="file_box">
$post = array();
$post[] = array("modo"=>"json");
if(is_array($Filesillos)){
foreach($Filesillos as $Filesillo){
if(file_exists($Filesillo)){
$type_file = get_mimetype($Filesillo);
$post[] = array("userfile[]"=>"@".$Filesillo.";type=".$type_file);
}
}
} else {
if(file_exists($Filesillos)){
$type_file = get_mimetype($Filesillos);
$post = array("userfile[]"=>"@".$Filesillos.";type=".$type_file);
}
}
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$response = curl_exec($ch);
return $response;
}
}

function get_mimetype($file){
if (function_exists("finfo_file")){
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime  = finfo_file($finfo, $file);
finfo_close($finfo);
return $mime;
}
if (function_exists("mime_content_type")){
return mime_content_type($file);
}
if (!strncasecmp(PHP_OS, 'WIN', 3) == 0 && !stristr(ini_get("disable_functions"), "shell_exec")){
$file = escapeshellarg($file);
$mime = shell_exec("file -b --mime-type " . $file);
return trim($mime);
}
return false;
}

function urls_dot($input) {
$input = utf8_encode($input);
$input = mb_convert_case($input, MB_CASE_LOWER, "UTF-8");
$a = array("ñ", "á", "é", "í", "ó", "ú", "ä", "ë", "ï", "ö", "ü");
$b = array("n", "a", "e", "i", "o", "u", "a", "e", "i", "o", "u");
$input = str_replace($a, $b, $input);
//$input = preg_replace("/[^a-zA-Z0-9]+/", "-", $input); ^([a-zA-Z0-9_\-\.]+)$
$input = preg_replace("/[^a-zA-Z0-9.]+/", "-", $input);
$input = preg_replace("/(-){2,}/", "$1", $input);
$input = trim($input, "-");
return "" . $input; // Url Amigable
}

function Permisos($Data_Usuario){
$mysqli = $GLOBALS['mysqli'];
$query_perms_user = "SELECT Usuarios.Permisos,Permisos_Perfiles.Id_Perfil,Permisos_Perfiles.Permiso FROM Usuarios INNER JOIN Permisos_Perfiles ON Usuarios.Permisos = Permisos_Perfiles.Id_Perfil WHERE Usuarios.Usuario = '".$Data_Usuario."' ORDER BY Usuarios.id DESC;";
//echo $query_perms_user;
$result_perms_user = $mysqli->query($query_perms_user);
$num_perms_users = $result_perms_user->num_rows;
$Permisos = array(); $Id_Perfil = "";
if($num_perms_users >= 1){
while ($row_perms_user = $result_perms_user->fetch_assoc()) {
$Permisos[] = $row_perms_user['Permiso'];
$Id_Perfil = $row_perms_user['Id_Perfil'];
}
$AllPermisos = array("Perfil" => $Id_Perfil, "Permisos" => $Permisos);
} else { $AllPermisos = ""; }
return $AllPermisos;
}
$Permisos = Permisos($Data_Usuario);

function GetUsuariosPermisos($Puesto){
$mysqli = $GLOBALS['mysqli'];
$query_Usuarios = "SELECT * FROM `Usuarios` WHERE `Permisos` = '".$Puesto."' ORDER BY `id` DESC;";
$result_Usuarios = $mysqli->query($query_Usuarios);
$Usuarios = array();
while($row_Usuarios = $result_Usuarios->fetch_array(MYSQLI_ASSOC)){
$Usuarios[] = $row_Usuarios['Usuario'];
}
return $Usuarios;
}

function  CheckPermisosRel($Id_Puesto, $Permiso){
$mysqli = $GLOBALS['mysqli'];
$query_Permisos_Perfiles = "SELECT * FROM `Permisos_Perfiles` WHERE `Id_Perfil` = '$Id_Puesto' AND `Permiso` = '$Permiso' ORDER BY `id` DESC;";
$result_Permisos_Perfiles = $mysqli->query($query_Permisos_Perfiles);
$num_Permisos_Perfiles = $result_Permisos_Perfiles->num_rows;
return $num_Permisos_Perfiles;
}

function PermisoDenegado($Usuario, $Permiso){
$mysqli = $GLOBALS['mysqli'];
$HTML = <<<EOF
<div class="alert alert-danger text-center">
<i class="fa fa-info-circle" aria-hidden="true"></i> Lo sentimos, pero no tiene permiso para acceder a esta &aacute;rea.<br><span class="label label-default">({$Permiso})</span>
</div>
EOF;
return $HTML;
}
?>