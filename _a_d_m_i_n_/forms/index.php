<?php
include_once("../../funciones.php");
include_once("../funciones.admin.php");
include_once("../header.php");
$get_id_form = Valida_utf8($_REQUEST['id']);
?>

<?php
$query_FormContact_Fields = "SELECT DISTINCT `Id_Form` FROM `FormContact_Fields` ORDER BY `id` DESC;";
$result_FormContact_Fields = $mysqli->query($query_FormContact_Fields);
$num_FormContact_Fields = $result_FormContact_Fields->num_rows;
if ($num_FormContact_Fields >= 1) {
while($row_FormContact_Fields = $result_FormContact_Fields->fetch_array(MYSQLI_ASSOC)){
$Id_Form = $row_FormContact_Fields['Id_Form'];
?>

<a href="edit_form.php?id_form=<?php echo $Id_Form; ?>"><?php echo $Id_Form; ?></a> <a href="new_field.php?id_form=<?php echo $Id_Form; ?>"> + </a><br>

<?php
}
} else {
}
?>


<?php
//$nojquery = "1";
echo FormTarget_Ajax($target_id);
echo UrlTarget_Ajax($target_url, $target_id);
include_once("../footer.php");
?>