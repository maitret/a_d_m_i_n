<?php
include_once("../../funciones.php");
include_once("../header.php");

$get_id_form = Valida_utf8($_REQUEST['id_form']);
?>

<?php
$form_input = <<<EOF
<form class="form-inline_" action="save_new_field.php" method="post">
<input type="hidden" name="id_form" value="{$get_id_form}">
<table class="table table-bordered"><tr>
<td>
<div class="form-group"><label>LABEL</label><input class="form-control" name="form[Label]" value="{$Label}"></div>
</td><td>
<div class="form-group"><label>TYPE (text)</label><input class="form-control" name="form[Type]" value="text{$Type}"></div>
</td><td>
<div class="form-group"><label>VALUE</label>
<textarea class="form-control" name="form[Value]">{$Value}</textarea>
</div>
</td><td>
<div class="form-group"><label>REQUIRED</label><input class="form-control" name="form[Required]" value="{$Required}"></div>
</td><td>
<div class="form-group"><label>ORDER</label><input class="form-control" name="form[Order]" value="1{$Order}"></div>
</td><td>
<div class="form-group"><label>ID_FORM</label><input class="form-control" name="form[Id_Form]" value="{$get_id_form}"></div>
</td><td>
<div class="form-group"><label>CLASS</label><input class="form-control" name="form[class]" value="col-sm-6{$Class}"></div>
</td>
<td><div class="form-group"><label>Extra</label>
<textarea class="form-control" name="form[Extra]">{$Extra}</textarea>
</div></td>
<td><div class="form-group"><label>GetVals_Table</label>
<textarea class="form-control" name="form[GetVals_Table]">{$GetVals_Table}</textarea>
</div></td>
<td valign="middle"><button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i></button></td>
</tr></table>
</form>

EOF;
echo $form_input;
?>


<hr>Opciones para Estatus:<code>{ "Activo":"Activo", "Inactivo":"Inactivo" }</code>

<?php
//$nojquery = "1";
echo FormTarget_Ajax($target_id);
echo UrlTarget_Ajax($target_url, $target_id);
include_once("../footer.php");
?>