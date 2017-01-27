<?php
header('Content-type: application/json');

function get_server_var($param){
return $_SERVER[$param];
}

if($GLOBALS['id_cosa_sub'] != "") {
$script_url_src = $GLOBALS['url_server']."/img_".$GLOBALS['cosa']."/".$GLOBALS['id_cosa']."/".$GLOBALS['id_cosa_sub'];
$upload_dir = dirname(get_server_var('SCRIPT_FILENAME'))."/files/".$GLOBALS['cosa']."/".$GLOBALS['id_cosa']."/".$GLOBALS['id_cosa_sub']."/";
$upload_url = $GLOBALS['url_server']."/img_adjunta/".$GLOBALS['cosa']."/".$GLOBALS['id_cosa']."/".$GLOBALS['id_cosa_sub']."/";
} else {
$script_url_src = $GLOBALS['url_server']."/img_".$GLOBALS['cosa']."/".$GLOBALS['id_cosa'];
$upload_dir = dirname(get_server_var('SCRIPT_FILENAME'))."/files/".$GLOBALS['cosa']."/".$GLOBALS['id_cosa']."/";
$upload_url = $GLOBALS['url_server']."/img_adjunta/".$GLOBALS['cosa']."/".$GLOBALS['id_cosa']."/";
}

$deleteType = "DELETE";

$method = $_SERVER['REQUEST_METHOD'];
$file_arrays = array();

if($method == "POST"){

$Url = $upload_url."";

$file_arrays[] = array("name"=>$Nombre_Img, "size"=>$Tamano,"type"=>$Tipo,"file_path_srv"=>$file_path_srv,"url"=>$Url,"error"=>$Error,"deleteUrl"=>$deleteUrl,"deleteType"=>$deleteType);

$query_insert = "
INSERT INTO `Imagenes_Adjuntas` (
`Id_Img`, `Nombre_Img`, `Usuario`, `FechaHora`, `Tamano`, `Img_Tipo`, `Url`, `Tipo`, `Id_Tipo`, `Id_Tipo_Sub`, `Url_S3`, `Url_CDN`) VALUES (
'$Id_Img', '".utf8_decode($Nombre_Img)."', '$Usuario', '$FechaHora', '$Tamano', '$Tipo', '$Url', '".$GLOBALS['cosa']."', '".$GLOBALS['id_cosa']."', '".$GLOBALS['id_cosa_sub']."', '$Url_S3', '$Url_CDN');";
//$result_insert = $mysqli->query($query_insert);
} else if ($method == "DELETE"){
//$query_del = "DELETE FROM `Imagenes_Adjuntas` WHERE `Nombre_Img` = '".$file_name."' AND `Tipo` = '".$GLOBALS['cosa']."' AND `Id_Tipo` = '".$GLOBALS['id_cosa']."';";
//$result_del = $mysqli->query($query_del);
} else {

}
//echo $method;
$all_arrays = array("files"=>$file_arrays);

echo json_encode($all_arrays);
/*
{
  "files": [
    {
      "name": "240_F_55774465_rYM3C4B2eROfNQcVUpHlx9EOPDSYJw20.jpg",
      "size": 22749,
      "type": "image/jpeg",
      "file_path_srv": "/home/panel/public_html/lib/files/Visita_Sucursal/ibarra-tampico-1-de-mayo-6fbe12d2-207e-7946-e847-aedd55adc79a/04fc3d/240_F_55774465_rYM3C4B2eROfNQcVUpHlx9EOPDSYJw20.jpg",
      "url": "https://server/img_adjunta/Visita_Sucursal/ibarra-tampico-1-de-mayo-6fbe12d2-207e-7946-e847-aedd55adc79a/04fc3d/240_F_55774465_rYM3C4B2eROfNQcVUpHlx9EOPDSYJw20.jpg",
      "error": "Failed to resize image (original, thumbnail)",
      "deleteUrl": "https://server/img_Visita_Sucursal/ibarra-tampico-1-de-mayo-6fbe12d2-207e-7946-e847-aedd55adc79a/04fc3d?file=240_F_55774465_rYM3C4B2eROfNQcVUpHlx9EOPDSYJw20.jpg",
      "deleteType": "DELETE"
    }
  ]
}
*/

?>