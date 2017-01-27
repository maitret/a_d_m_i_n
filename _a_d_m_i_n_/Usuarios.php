<?php
include_once("../funciones.php");
include_once("funciones.admin.php");
include_once("header.php");

$query_Usuarios = "SELECT * FROM `Usuarios` ORDER BY `id` DESC;";
$result_Usuarios = $mysqli->query($query_Usuarios);
$num_Usuarios = $result_Usuarios->num_rows;
if ($num_Usuarios >= 1) {
while($row_Usuarios = $result_Usuarios->fetch_array(MYSQLI_ASSOC)) {

$tr_usuario .= <<<EOF
<tr>
<td>{$row_Usuarios['id']}</td>
<td>{$row_Usuarios['Nombre']} {$row_Usuarios['Apellido_Paterno']} {$row_Usuarios['Apellido_Materno']}</td>
<td>{$row_Usuarios['Email']}</td>
<td>{$row_Usuarios['Telefono']}</td>
<td>{$row_Usuarios['Direccion']}</td>
<td>{$row_Usuarios['Validacion']}</td>
</tr>
EOF;

}
}

?>
<div class="text-center">
<h3>Usuarios registrados: <?php echo $num_Usuarios; ?></h3>
</div>

<!-- <div class="text-center"><a href="Usuarios_Alta.php" class="btn btn-success btn-sm">Alta Usuario</a></div>-->
<table class="table table-bordered">
<thead>
<tr>
<th>Id</th>
<th>Nombre y Apellidos</th>
<th>Email</th>
<th>Tel&eacute;fono</th>
<th>Direcci&oacute;n</th>
<th>Validaci&oacute;n</th>
</tr>
</thead>
<tbody>
<?php echo $tr_usuario; ?>
</tbody>
</table>


<?php
include_once("footer.php");
?>
