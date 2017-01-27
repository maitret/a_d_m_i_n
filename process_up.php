<?php
//windows-1252
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("funciones.php");

//error_reporting(E_ALL); ini_set('display_errors', '1');

if($Data_Usuario == ""){ exit(); }
$FechaHora = time();
$ToUser = $_REQUEST['Usuario'];
$Uploader = $_REQUEST['Uploader'];
if($Uploader == ""){ $Uploader = $Data_Usuario; }

$Tipo = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Tipo']));
$Id_Tipo = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Id_Tipo']));
$Id_Sucursal = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Id_Sucursal']));
$Id_Tipo_Sub = $mysqli->real_escape_string(Valida_utf8($_REQUEST['Id_Visita']));

$ds = DIRECTORY_SEPARATOR;
$storeFolder = 'ups';
if (!empty($_FILES)) {

$Filesillo_name = $_FILES['file']['name'];
$tempFile = $_FILES['file']['tmp_name'];
$targetPath = dirname( __FILE__ ).$ds.$storeFolder.$ds;
$targetFile_n =  urls_dot($Id_Sucursal."_".$Filesillo_name);
$targetFile = $targetPath.$targetFile_n;
move_uploaded_file($tempFile,$targetFile);

$Tamano = filesize($targetFile);

$src_temp = file_get_contents($targetFile);
//$file = date('d_m_y_h_i_s', time())."_".$Uploader."_-_".strtolower($file);

$path_bucket = "ups/".$Id_Sucursal."";

$UploadGAE = UploadGAE($targetFile, $path_bucket);
$UploadGAE_array = json_decode($UploadGAE, true);
if(is_array($UploadGAE_array)){
foreach($UploadGAE_array as $GAE)
$Nombre_Img = $GAE['name'];
$Url_CDN = $GAE['original'];
$Img_Tipo = $GAE['type'];
$full_url = $GAE['full_url'];
}

$Url_S3 = Enviar_AWS_S3($src_temp, $targetFile_n, $path_bucket, "maitret", "Visita_Sucursal", $ToUser, "Pendiente");

$Insert_Img_GAE = "INSERT INTO `Imagenes_Adjuntas`
 (`Id_Img`, `Nombre_Img`, `Usuario`, `FechaHora`, `Tamano`, `Img_Tipo`, `Tipo`, `Id_Tipo`, `Id_Tipo_Sub`, `Url`, `Url_S3`, `Url_CDN`)
 VALUES ('".$random."', '$Nombre_Img', '$Data_Usuario', '$FechaHora', '$Tamano', '$Img_Tipo', '$Tipo', '$Id_Tipo', '$Id_Tipo_Sub', '$full_url', '$Url_S3', '$Url_CDN');";
$Result_Img_GAE = $mysqli->query($Insert_Img_GAE);

}
?>
<!--- <?php echo $UploadGAE; ?> --->
<!--- <?php echo $Enviar_AWS_S3; ?> --->
<!--- <?php echo $Insert_Img_GAE; ?> --->
