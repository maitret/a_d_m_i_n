<?php
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("../../funciones.php");

$Table = "Usuarios_Puestos";
echo $Table."<hr>";

$query_Fix = "SELECT * FROM `".$Table."` ORDER BY `id` DESC;";
$result_Fix = $mysqli->query($query_Fix);
$num_Fix = $result_Fix->num_rows;
if ($num_Fix >= 1) {
while($row_Fix = $result_Fix->fetch_array(MYSQLI_ASSOC)){
extract($row_Fix);

if($Id_Puesto == "") {
$Id_Fixed = urls__($Puesto."_".getGUID());
$Q_Procesa = "UPDATE `".$Table."` SET `Id_Puesto` = '$Id_Fixed' WHERE `id` = '" . $id . "';";
//$Q_Procesa = "UPDATE `".$Table."` SET `Estatus` = 'Activo' WHERE `id` = '" . $id . "';";
//$result_Q_procesa = $mysqli->query($Q_Procesa);
}

$tr_fixes .= <<<EOF
<tr>
<td>{$id}</td>
<td>{$Id_Puesto}</td>
<td>{$Puesto}</td>
<td>{$Q_Procesa}</td>
</tr>
EOF;
}
}
?>

<table class="table table-striped table-bordered table-hover" width="100%">
<thead>
<tr>
<th>Id</th>
<th>Id_Cosa</th>
<th>Cosa</th>
<th>Q_Procesa</th>
</tr>
</thead>
<tbody>
<?php echo $tr_fixes; ?>
</tbody>
</table>



