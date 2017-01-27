<?php
include_once("../../funciones.php");
include_once("../header.php");

$get_id_form = Valida_utf8($_REQUEST['id_form']);
$get_order = Valida_utf8($_REQUEST['order']);

if($get_order == ""){
$get_order = "DESC";
}
?>

<a href="../tablas/?tabla=<?php echo $get_id_form; ?>">[Tablas]</a> - <a href="../tablas/Genera_Variables_DB.php?tabla=<?php echo $get_id_form; ?>">[Genera_Variables_DB]</a> |
 <a href="?id_form=<?php echo $get_id_form; ?>&order=">DESC</a> - <a href="?id_form=<?php echo $get_id_form; ?>&order=ASC">ASC</a>

<h1 align="center">
Campos de <?php echo $get_id_form; ?> | <a href="new_field.php?id_form=<?php echo $get_id_form; ?>" class="btn btn-primary btn-sm_"> + </a>
</h1>

<?php
$query_FormContact_Fields = "SELECT * FROM `FormContact_Fields` WHERE `Id_Form` = '$get_id_form' ORDER BY `id` ".$get_order.";";
$result_FormContact_Fields = $mysqli->query($query_FormContact_Fields);
$num_FormContact_Fields = $result_FormContact_Fields->num_rows;
if ($num_FormContact_Fields >= 1) { ?>

<?php
while($row_FormContact_Fields = $result_FormContact_Fields->fetch_array(MYSQLI_ASSOC)){
$id_input = $row_FormContact_Fields['id'];
$Slug = $row_FormContact_Fields['Slug'];
$Label = $row_FormContact_Fields['Label'];
$Placeholder = $row_FormContact_Fields['Placeholder'];
$Type = $row_FormContact_Fields['Type'];
$Value = $row_FormContact_Fields['Value'];
$Required = $row_FormContact_Fields['Required'];
$Order = $row_FormContact_Fields['Order'];
$Id_Form = $row_FormContact_Fields['Id_Form'];
$class = $row_FormContact_Fields['class'];
$Extra = $row_FormContact_Fields['Extra'];
$GetVals_Table = $row_FormContact_Fields['GetVals_Table'];
$Slug_sug = urls__($Label);

$query_FormContact_Fields_check = "SELECT * FROM `FormContact_Fields` WHERE `Id_Form` = '$get_id_form' AND `Slug` = '$Slug' AND `id` != '$id_input' ORDER BY `id` DESC;";
$result_FormContact_Fields_check = $mysqli->query($query_FormContact_Fields_check);
$num_FormContact_Fields_check = $result_FormContact_Fields_check->num_rows;

if($num_FormContact_Fields_check >=1){
$tr_color = "danger";
$table_color = "#FF0000";
$alert_msg = <<<EOF
<script>alert("Error en '{$Slug}' del id {$id_input}");</script>
EOF;
} else {
$tr_color = "success";
$table_color = "#18bc9c";
$alert_msg = <<<EOF

EOF;
}

$signo = "$";

$genera_vars .= <<<EOF
<pre>
&lt;?php echo PrintField({$signo}Id_Form, &quot;{$Slug}&quot;, {$signo}Input_Array[&#39;{$Slug}&#39;]); ?&gt;
</pre>
EOF;

$form_input = <<<EOF
<form class="form-inline_" action="save_fields.php" method="post">
<input type="hidden" name="id_input" value="{$id_input}">
<input type="hidden" name="order" value="{$get_order}">
{$alert_msg}
<table class="table table-bordered" id="id_{$id_input}" style="border: 2px solid {$table_color}"><tr class=""><td>
<div class="form-group"><label>SLUG</label><input class="form-control" name="form[$id_input][Slug]" value="{$Slug}"></div>
</td><td>
<div class="form-group"><label title="{$Slug_sug}">LABEL</label><input class="form-control" name="form[$id_input][Label]" value="{$Label}"></div>
</td><td>
<div class="form-group"><label title="">PLACEHOLDER</label><input class="form-control" name="form[$id_input][Placeholder]" value="{$Placeholder}"></div>
</td><td>
<div class="form-group"><label>TYPE</label><input class="form-control" name="form[$id_input][Type]" value="{$Type}"></div>
</td><td>
<div class="form-group"><label>VALUE</label>
<textarea class="form-control" name="form[$id_input][Value]">{$Value}</textarea>
</div>
</td><td>
<div class="form-group"><label>REQUIRED</label><input class="form-control" name="form[$id_input][Required]" value="{$Required}"></div>
</td><td>
<div class="form-group"><label>ORDER</label><input class="form-control" name="form[$id_input][Order]" value="{$Order}"></div>
</td><td>
<div class="form-group"><label>ID_FORM</label><input class="form-control" name="form[$id_input][Id_Form]" value="{$Id_Form}"></div>
</td><td>
<div class="form-group"><label>CLASS</label><input class="form-control" name="form[$id_input][class]" value="{$class}"></div>
</td>
<td><div class="form-group"><label>Extra</label>
<textarea class="form-control" name="form[$id_input][Extra]">{$Extra}</textarea>
</div></td>
<td><div class="form-group"><label>GetVals_Table</label>
<textarea class="form-control" name="form[$id_input][GetVals_Table]">{$GetVals_Table}</textarea>
</div></td>
<td valign="middle"><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i></button></td>
</tr></table>
</form>


EOF;
echo $form_input;
?>

<?php } ?>

<?php
echo $genera_vars;

} else {
}
?>

<hr>Opciones para Estatus:<code>{ "Activo":"Activo", "Inactivo":"Inactivo" }</code>

<?php
//$nojquery = "1";
echo FormTarget_Ajax($target_id);
echo UrlTarget_Ajax($target_url, $target_id);
include_once("../footer.php");
?>