<?php
include_once("../../funciones.php");
include_once("../header.php");

$get_id_input = Valida_utf8($_REQUEST['id_input']);
//$get_Id_Form = Valida_utf8($_REQUEST['id_form']);
$get_order = Valida_utf8($_REQUEST['order']);

$form = $_REQUEST['form'];

foreach($form[$get_id_input] as $key => $value){

$value = $mysqli->real_escape_string($value);

$query_update = "UPDATE `FormContact_Fields` SET `".$key."` = '".$value."' WHERE `id` = '".$get_id_input."';";
if($mysqli->query($query_update)){
echo "<div>".$key.": <b>".$value."</b></div><br>";
}
}

$get_Id_Form = $form[$get_id_input]['Id_Form'];
$get_Slug = $form[$get_id_input]['Slug'];

echo "<a href='./edit_form.php?id_form=".$get_Id_Form."&order=".$get_order."#last_id_".$get_id_input."'>Regresar a editar (".$get_id_input.")</a>";
echo " - <a href='./'>Regresar al Inicio</a>";
?>
<script>
location = "edit_form.php?id_form=<?php echo $get_Id_Form."&order=".$get_order."#last_id_".$get_id_input."_".$get_Slug; ?>";
</script>

<?php
//$nojquery = "1";
echo FormTarget_Ajax($target_id);
echo UrlTarget_Ajax($target_url, $target_id);
include_once("../footer.php");
?>