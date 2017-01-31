<?php
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
//header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("funciones.php");

if($Data_Usuario == ""){
//include_once("login.php");
echo "Denegado!";
exit(); }

$return = $mysqli->real_escape_string($_REQUEST['return']);
if($return == ""){ $return = "../"; } else { $return = base64_decode($return); }

$id_img = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_img']));
$is_ajax = $mysqli->real_escape_string(Valida_utf8($_REQUEST['is_ajax']));

$query_Imagenes_Adjuntas = "SELECT * FROM `Imagenes_Adjuntas` WHERE `id` = '".$id_img."' ORDER BY `id` DESC;";
$result_Imagenes_Adjuntas = $mysqli->query($query_Imagenes_Adjuntas);
$num_Imagenes_Adjuntas = $result_Imagenes_Adjuntas->num_rows;
if ($num_Imagenes_Adjuntas >= 1) {

while($row_Imagenes_Adjuntas = $result_Imagenes_Adjuntas->fetch_array(MYSQLI_ASSOC)){

$id_alv = $row_Imagenes_Adjuntas['id'];
$Id_Img = $row_Imagenes_Adjuntas['Id_Img'];
$Nombre_Img = $row_Imagenes_Adjuntas['Nombre_Img'];
$Usuario = $row_Imagenes_Adjuntas['Usuario'];
$FechaHora = $row_Imagenes_Adjuntas['FechaHora'];
$Tamano = $row_Imagenes_Adjuntas['Tamano'];
$Img_Tipo = $row_Imagenes_Adjuntas['Img_Tipo'];
$Tipo = $row_Imagenes_Adjuntas['Tipo'];
$Id_Tipo = $row_Imagenes_Adjuntas['Id_Tipo'];
$Id_Tipo_Sub = $row_Imagenes_Adjuntas['Id_Tipo_Sub'];
$Url = $row_Imagenes_Adjuntas['Url'];
$Url_S3 = $row_Imagenes_Adjuntas['Url_S3'];
$Url_CDN = $row_Imagenes_Adjuntas['Url_CDN'];
$Path_Srv = $row_Imagenes_Adjuntas['Path_Srv'];
$Demo = $row_Imagenes_Adjuntas['Demo'];

$results .= "<li>Borrando <b>".$Nombre_Img." (".$Id_Img.")</b>";
if(unlink($Path_Srv)){
$Q_Procesa = "DELETE FROM `Imagenes_Adjuntas` WHERE `Id_Img` = '$Id_Img' ORDER BY `id` DESC LIMIT 1;";
$result_Procesa = $mysqli->query($Q_Procesa);
$results .= " OK</li>";
} else {
$results .= " ERROR</li>";
$error = 1;
}
}

$msg = <<<EOF
<hr>
<h4 class="text-success">Procesando:</h4>
<ul>{$results}</ul>
EOF;
if($error == 1){
$msg .= <<<EOF
Ocurrio un error al borrar el/los registro(s), mensaje enviado al administrador.
EOF;
mail($email_debug, $_SERVER['PHP_SELF'], $msg);
} else {
$msg .= <<<EOF
<script>
location = "{$return}";
</script>
EOF;
}

} else {
$msg = <<<EOF
<br>
<h1 class="text-danger">Registro NO borrado de la base de datos.</h1>
EOF;
}
if($is_ajax == ""){
echo $msg;
} else {

}
?>