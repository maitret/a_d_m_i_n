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

$Tipo = $mysqli->real_escape_string(Valida_utf8($_REQUEST['tipo']));
$Id_Tipo = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_tipo']));
$id_table = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_table']));
$ajax_script = $mysqli->real_escape_string(Valida_utf8($_REQUEST['ajax_script']));

$query_Imagenes_Adjuntas = "SELECT * FROM `Imagenes_Adjuntas` WHERE `Tipo` = '$Tipo' AND `Id_Tipo` = '$Id_Tipo' ORDER BY `id` DESC;";
$result_Imagenes_Adjuntas = $mysqli->query($query_Imagenes_Adjuntas);
$num_Imagenes_Adjuntas = $result_Imagenes_Adjuntas->num_rows;
if ($num_Imagenes_Adjuntas >= 1) {
while($row_Imagenes_Adjuntas = $result_Imagenes_Adjuntas->fetch_array(MYSQLI_ASSOC)) {
$id_track = $row_Imagenes_Adjuntas['id'];
$Nombre_Img = $row_Imagenes_Adjuntas['Nombre_Img'];
$FechaHora_Img = date('d/m/Y H:i:s', $row_Imagenes_Adjuntas['FechaHora']);
$Tamano = $row_Imagenes_Adjuntas['Tamano'];
$Url = $row_Imagenes_Adjuntas['Url'];
$Demo = $row_Imagenes_Adjuntas['Demo'];
$uri_64 = base64_encode($url_server."/#".$ajax_script."?id_table=".$id_table);

if($Demo == 1){ $Demo_print = <<<EOF
<i class="fa fa-check" aria-hidden="true"></i>
EOF;
} else { $Demo_print = ""; }

$tr_tracks .= <<<EOF
<tr>
<td data-order="{$id_track}" align="center">
<a href="javscript:;" onclick='return confirm_delete("Desea borrar este archivo de manera permanente?","{$url_server}/borrar_adjunto.php?is_ajax=1&id_img={$id_track}&return={$uri_64}")' title="Borrar este archivo de forma permanente"><i class="fa fa-trash" aria-hidden="true"></i></a>
</td>
<td><a href="{$Url}" target="_blank">{$Nombre_Img}</a></td>
<td align="center">
<a href="{$Url}" target="_blank">Abrir</a>
</td>
<td>{$FechaHora_Img}</td>
EOF;
}
?>
<hr>
<div class="text-center">
<h4>Adjuntos cargados previamente: </h4>
</div>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>Opc</th>
<th>Nombre</th>
<th>Vista previa</th>
<th>Fecha de carga</th>
</tr>
</thead>
<tbody><?php echo $tr_tracks; ?></tbody>
</table>
</div>
<?php } ?>