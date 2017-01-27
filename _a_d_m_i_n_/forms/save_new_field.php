<?php
include_once("../../funciones.php");
include_once("../header.php");

$get_id_form = Valida_utf8($_REQUEST['id_form']);
$get_order = Valida_utf8($_REQUEST['order']);

$form = $_REQUEST['form'];

foreach($form[$get_id_input] as $key => $value) {
$value = $mysqli->real_escape_string($value);
echo "<div>" . $key . ": <b>" . $value . "</b></div><br>";
}

extract($form);

$Slug = urls_nominus($Label);

$query_insert = "INSERT INTO `FormContact_Fields` (
`Slug`, `Label`, `Placeholder`, `Type`, `Value`, `Required`, `Order`, `Id_Form`, `class`, `Extra`, `GetVals_Table`
) VALUES (
'$Slug', '$Label', '$Placeholder', '$Type', '$Value', '$Required', '$Order', '$Id_Form', '$class', '$Extra', '$GetVals_Table'
)";
echo $query_insert."<hr>";
if($mysqli->query($query_insert)){
echo "<a href='edit_form.php?id_form=".$Id_Form."'>Back ".$Id_Form."</a>
<script>
location = 'edit_form.php?id_form=".$Id_Form."&order=".$get_order."#last_slug_-_".$Slug."';
</script>
"; ?>
<?php
} else {
echo $mysqli->error;
}
?>

<?php
//$nojquery = "1";
echo FormTarget_Ajax($target_id);
echo UrlTarget_Ajax($target_url, $target_id);
include_once("../footer.php");
?>