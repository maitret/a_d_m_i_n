<?php
header('Access-Control-Allow-Origin: *');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
//error_reporting(E_ALL | E_STRICT);
//require('UploadHandlerS3.php');
include_once("../funciones.php");
//error_reporting(E_ALL); ini_set('display_errors', '1');

$cosa = Valida_utf8($_REQUEST['cosa']);
$id_cosa = Valida_utf8($_REQUEST['id_cosa']);
$id_cosa_sub = Valida_utf8($_REQUEST['id_cosa_sub']);

$CheckMovilSession = CheckMovilSession($Data_Nombre);
if($CheckMovilSession != "") {

require('UploadHandler.php');
$upload_handler = new UploadHandler();

//require('UploadHandler_Simple.php');

unlink("error_log");
} else {
echo "Permiso denegado";
exit();
}

/*
'script_url' => $GLOBALS['url_server']."/img_".$GLOBALS['cosa']."/".$GLOBALS['id_cosa'],
'upload_dir' => dirname($this->get_server_var('SCRIPT_FILENAME')).'/files/'.$GLOBALS['id_cosa'].'/',
'upload_url' => $this->get_full_url().'/files/'.$GLOBALS['id_cosa'].'/',
*/
?>