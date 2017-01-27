<?php
include_once("../funciones.php");
include_once("funciones.admin.php");
include_once("header.php");


$query_Sucursales = "SELECT * FROM `Sucursales` ORDER BY `Cadena` ASC;";
$result_Sucursales = $mysqli->query($query_Sucursales);
$num_Sucursales = $result_Sucursales->num_rows;
if ($num_Sucursales >= 1) {
while($row_Sucursales = $result_Sucursales->fetch_array(MYSQLI_ASSOC)){
$id_table = $row_Sucursales['id'];
$Id_Sucursal = $row_Sucursales['Id_Sucursal'];
$Cadena = $row_Sucursales['Cadena'];
$Sucursal = $row_Sucursales['Sucursal'];
$Email = $row_Sucursales['Email'];
$Telefono = $row_Sucursales['Telefono'];
$Direccion = $row_Sucursales['Direccion'];
$Calle = $row_Sucursales['Calle'];
$Numero = $row_Sucursales['Numero'];
$Colonia = $row_Sucursales['Colonia'];
$Ciudad = $row_Sucursales['Ciudad'];
$Estado = $row_Sucursales['Estado'];
$Pais = $row_Sucursales['Pais'];
$Website = $row_Sucursales['Website'];
$Lat = $row_Sucursales['Lat'];
$Lon = $row_Sucursales['Lon'];
$Estatus = $row_Sucursales['Estatus'];
$tr_sucursal .= <<<EOF
<tr>
<td><a href="Sucursales_Alta.php?id_proveedor={$id_table}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ({$id_table})</a></td>
<td>{$Cadena}</td>
<td>{$Sucursal}</td>
<td>{$Direccion}</td>
<td><a href="https://www.google.com.mx/maps/?q={$Lat},{$Lon}" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i> Ver Mapa</a></td>
<td>{$Estatus}</td>
</tr>
EOF;
}
}
?>

<div class="text-center">
<h3>Sucursales registradas: <?php echo $num_Sucursales; ?></h3>
</div>

<div class="text-center"><a href="Sucursales_Alta.php" class="btn btn-success btn-sm">Alta Sucursal</a></div>
<br>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>Id</th>
			<th>Cadena</th>
			<th>Sucursal</th>
			<th>Direcci&oacute;n</th>
			<th>Ubicaci&oacute;n</th>
			<th>Estatus</th>
		</tr>
	</thead>
<tbody>
<?php echo $tr_sucursal; ?>
</tbody>
</table>


<?php
include_once("footer.php");
?>