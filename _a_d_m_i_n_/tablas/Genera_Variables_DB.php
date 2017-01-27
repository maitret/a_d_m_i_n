<?php
include_once("../../funciones.php");
include_once("../funciones.admin.php");
include_once("../header.php");

if($Data_Admin <= "1" && $Data_Admin != "")
{ }
else {
//echo ":)"; exit();
}
$get_id_row = Valida_utf8($_REQUEST['id']);
$get_last_id = Valida_utf8($_REQUEST['last_id']);
$get_tabla = Valida_utf8($_REQUEST['tabla']);
$get_srv = Valida_utf8($_REQUEST['srv']);

$signo = "$";
$row_name = $get_tabla;

if($get_srv == ""){ $mysqli_sys = $mysqli; $db_name_sys = $GLOBALS['db_name_sys_db']; } else { $mysqli_sys = $mysqli_gps; $db_name_sys = $GLOBALS['db_name_gps_db']; }

?>

<a href="../forms/edit_form.php?id_form=<?php echo $get_tabla; ?>">[Forms]</a>
<br>

<?php
if($get_tabla != ""){
$query_Tabla = "SELECT * FROM `".$get_tabla."` ORDER BY `id` DESC LIMIT 1;";
$result_Tabla = $mysqli_sys->query($query_Tabla);
$num_Tabla = $result_Tabla->num_rows;
if ($num_Tabla >= 1) {
$count = 0; $tr_tabla = "";
while($row_Tabla = $result_Tabla->fetch_array(MYSQLI_ASSOC)){
$tr_tabla_body = "";
foreach($row_Tabla as $columna => $valor){
$name = $columna;
if($columna == "id"){
$columnas_array_0[] = $columna;
$columnas_array_up_0[] = "`".$columna."` = '".$signo."".$columna."'";
} else {
$columnas_array[] = $columna;
$columnas_array_up[] = "`".$columna."` = '".$signo."".$columna."'";
$columnas_array_up_0[] = "`".$columna."` = '".$signo."".$columna."'";
}

$All_Requests_realscape .= "$"."".$columna." = $"."mysqli->real_escape_string(Valida_utf8($"."_REQUEST['".$columna."'])); \n";
$All_Requests .= "$"."".$name." = "."Valida_utf8($"."_REQUEST['".$name."']); \n";
$All_RowsDB .= "$"."".$name." = "."$"."row_".$row_name."['".$name."']; \n";
$All_RowsDB2 .= "$"."".$name." = "."$"."row_".$row_name."['".$name."']; \n";
$All_RowsDB_echo .= "".$name.": <?php echo"." $"."row_".$row_name."['".$name."']; ?> \n";
$All_RowsDB_echo2 .= "echo"." $"."row_".$row_name."['".$name."']; \n";


if($count == 0){
$tr_tabla_init .= <<<EOF
<th>{$columna}</th>
EOF;
} else {
//Trash
$tr_tabla_body .= <<<EOF
<td>{$valor}</td>
EOF;
}

}

if($columna != ""){
$sql_i  = "INSERT INTO `".$get_tabla."` \n";
$sql_i .= " (`".implode("`, `", $columnas_array)."`)\n";
$sql_i .= " VALUES ('$".implode("', '$", $columnas_array)."');\n";
$sql_u = "UPDATE `".$get_tabla."` SET \n";
$sql_u .= "".implode(", ", $columnas_array_up)." \n";
$sql_u .= " WHERE `id` = '{$signo}id';";
$sql_q .= "".implode(" AND ", $columnas_array_up_0)." \n";

$Query_AllFields = "SELECT * FROM `".$get_tabla."` WHERE ".$sql_q." ORDER BY `id` DESC;";
$contruye_query =  "$"."query_".$row_name." = \"".$Query_AllFields."\";\n";
$contruye_query .= "$"."result_".$row_name." = $"."mysqli->query($"."query_".$row_name.");
$"."num_".$row_name." = $"."result_".$row_name."->num_rows;
if ($"."num_".$row_name." >= 1) {
while($"."row_".$row_name." = $"."result_".$row_name."->fetch_array(MYSQLI_ASSOC)){\n
".$All_RowsDB2."
}
} else {
}
";

$Insert_Q = <<<EOF
<pre>{$All_Requests_realscape}</pre>
<pre>{$contruye_query}</pre>
<pre>{$sql_i}</pre>
<pre>{$sql_u}</pre>
EOF;
}

//echo json_encode($row_Tabla);
$count++;

}
}
?>

<?php echo $Insert_Q; ?>
<?php
echo "<pre>".$All_Requests."</pre>";
echo "<pre>".$All_RowsDB."</pre>";
echo "<pre>".$All_RowsDB_echo2."</pre>";
echo "<textarea rows='3' class='form-control'>".$All_RowsDB_echo."</textarea>";
?>
<hr>

<?php } ?>

<?php
//$nojquery = "1";
echo FormTarget_Ajax($target_id);
echo UrlTarget_Ajax($target_url, $target_id);
include_once("../footer.php");
?>