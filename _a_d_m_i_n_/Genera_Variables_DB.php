<?php
header('Access-Control-Allow-Origin: *');
//header("content-type: application/javascript");
include_once("../funciones.php");

if($Data_Admin <= "1" && $Data_Admin != "")
{ }
else {
//echo ":)"; exit();
}
echo "A: ".$Data_Admin."\n\n";

$Table = $_REQUEST['table'];
$get_order = $_REQUEST['order'];
$get_orderby = $_REQUEST['orderby'];
if($get_order == "")
$order = "ORDER BY id DESC";
else { $order = "ORDER BY ".$get_order
." ".$get_orderby.""; }

$suma_total_resultados = "";
$Num = "1";
/* `Validacion` = 'OK'  $query_client = "SELECT * FROM `Usuarios` WHERE `Validacion` != '' ".$order.""; */

if($Table == ""){
$Table = "FormContact_Fields";
} else {  }

echo "<br>\n".$Table."\n<br>\n";
//$row_name = "row_UserEvent";
$row_name = $Table;
$query_client = "SELECT * FROM `".$Table."` LIMIT 1";
$result_client= $mysqli->query($query_client);
if($result_client->num_rows >=1)
{
$cnt = 0;
while ($row = $result_client->fetch_array(MYSQLI_ASSOC)) {
if ($cnt == 0) {
$columns = array_keys($row);
foreach ($row as $name => $value) {
if ( $value == "" ) $value = "";

/*
<div class="form-group">
<label for="Usuario">{$name}</label>
<div class="input-group">
<input type="text" class="form-control" name="" id="validate-text" placeholder="Ingrese su {$name}" required>
<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
</div>
</div>
*/

$form_RowsDB_echo = "<?php echo"." $"."".$row_name."['".$name."']; ?>";
$form_RowsDB_eof = '{$'.$row_name.'[\''.$name.'\']}';

$form_req .= <<<EOF
<div id="{$name}" class="col-sm-6 form-group_val" title="{$name}">
<div class="form-group form-group_v has-error_">
<label for="{$name}">{$name}</label>
<div class="input-group input-group_val" >
<input type="text" class="form-control {$name}" name="{$name}" id="validate-text" placeholder="{$name}" value="{$form_RowsDB_echo}" required>
<span class="input-group-addon warning"><i class="fa fa-times"></i></span>
</div>
</div>
</div>
EOF;
$form_req .= "\n\n";

$form .= <<<EOF
<div id="{$name}" class="col-sm-6" title="{$name}">
<div class="form-group">
<label for="{$name}">{$name}</label>
<div class="input-group">
<input type="text" class="form-control {$name}" name="{$name}" placeholder="{$name}" value="{$form_RowsDB_echo}" required>
<span class="input-group-addon"><i class="fa fa-info"></i></span>
</div>
</div>
</div>
EOF;
$form .= "\n\n";

$form2 .= <<<EOF
<div class="form-group required">
<label class="control-label" for="input-payment-{$name}">{$name}</label>
<input type="text" name="{$name}" value="{$form_RowsDB_echo}" placeholder="{$name}" id="input-payment-{$name}" class="form-control" />
</div>
<!-- --->
<div class="form-group required">
<label class="control-label" for="input-payment-{$name}">{$name}</label>
<input type="text" name="{$name}" value="{$form_RowsDB_eof}" placeholder="{$name}" id="input-payment-{$name}" class="form-control" />
</div>
EOF;
$form2 .= "\n\n";

$new_table = <<<EOF
 `{$name}` varchar(1000) collate latin1_swedish_ci NOT NULL, <br>
EOF;
//echo $new_table;

$insert_table = <<<EOF
INSERT INTO `Eventos` ( Nombre_Interno, Nombre_Visible, Descripcion, Requerido, Visible, Id_Form ) VALUES ( '{$name}', '{$name}', '{$name}', '1', '1', 'Admin' ); <br>
EOF;
//echo $insert_table;
//echo("$".$name." = "."Valida_utf8($"."_REQUEST['".$name."']); <br> \n ");
$All_Requests_realscape .= "$"."".$name." = $"."mysqli->real_escape_string(Valida_utf8($"."_REQUEST['".$name."'])); \n";
$All_Requests .= "$"."".$name." = "."Valida_utf8($"."_REQUEST['".$name."']); \n";
$All_RowsDB .= "$"."".$name." = "."$"."row_".$row_name."['".$name."']; \n";
$All_RowsDB2 .= "$"."".$name." = "."$"."row_".$row_name."['".$name."']; \n";
$All_RowsDB_echo .= " | ".$name.": <?php echo"." $"."row_".$row_name."['".$name."']; ?> \n";
$All_RowsDB_echo2 .= "echo"." $"."row_".$row_name."['".$name."']; \n";
$Insert_1 .= "`".$name."`, ";
$Insert_2 .= "'$".$name."', ";
$Update_1 .= "`".$name."` = '$".$name."', ";
$Query_1 .= "`".$name."` = '$".$name."' AND ";

}
echo "<pre>\n\n".$All_Requests_realscape."\n</pre>";
echo "<pre>\n\n".$All_Requests."\n</pre>";
echo "<pre>\n\n".$All_RowsDB."\n</pre>";
echo "<pre>\n\n".$All_RowsDB_echo."\n</pre>";
echo "<pre>\n\n".$All_RowsDB_echo2."\n</pre>";

$Insert_AllFields = "INSERT INTO `".$Table."` (
".$Insert_1."
) VALUES (
".$Insert_2."
)";
echo "<pre>\n\n".$Insert_AllFields."\n\n</pre>\n\n";
echo "<hr>\n";

$Update_AllFields = "UPDATE  `".$Table."` SET
".$Update_1."
WHERE `id` =1;";
echo "<pre>\n\n".$Update_AllFields."\n\n</pre>\n\n";

$Query_AllFields = "SELECT * FROM `".$Table."` WHERE
".$Query_1."
ORDER BY `id` DESC;";
echo "<pre>\n\n$"."query_".$row_name." = \"\n".$Query_AllFields."\n\";\n";

$contruye_query = "$"."result_".$row_name." = $"."mysqli->query($"."query_".$row_name.");
$"."num_".$row_name." = $"."result_".$row_name."->num_rows;
if ($"."num_".$row_name." >= 1) {
while($"."row_".$row_name." = $"."result_".$row_name."->fetch_array(MYSQLI_ASSOC)){

".$All_RowsDB2."
}
} else {
}
";

echo "\n".$contruye_query."\n\n</pre>\n\n";

echo "<pre>\n\n".$form2."\n\n</pre>\n\n";
echo "<hr>\n";
echo "<pre>\n\n".$form."\n\n</pre>\n\n";
echo "<hr>\n";
echo "<pre>\n\n".$form_req."\n\n</pre>\n\n";

}
}
?>

<?php
}
else { ?>
<div class="alert alert-danger text-center" role="alert"><b>No existen datos registrados</b></div>
<?php }
echo $mysqli->error;
?>