<?php

/* INICIA EL GENERADOR DE INPUTS */

function MuestraInput($id_input){
$mysqli = $GLOBALS['mysqli']; $input_template = "";
$query_FormContact_Fields = "SELECT * FROM `FormContact_Fields` WHERE `id` = '$id_input' ORDER BY `id` DESC LIMIT 1;";
$result_FormContact_Fields = $mysqli->query($query_FormContact_Fields);
$num_FormContact_Fields = $result_FormContact_Fields->num_rows;
if ($num_FormContact_Fields >= 1) {
$row_FormContact_Fields = $result_FormContact_Fields->fetch_array(MYSQLI_ASSOC);
$id = $row_FormContact_Fields['id'];
$Slug = $row_FormContact_Fields['Slug'];
$Label = $row_FormContact_Fields['Label'];
$Type = $row_FormContact_Fields['Type'];
$Value = $row_FormContact_Fields['Value'];
$Required = $row_FormContact_Fields['Required'];
$Order = $row_FormContact_Fields['Order'];
$Id_Form = $row_FormContact_Fields['Id_Form'];
$class = $row_FormContact_Fields['class'];

if($Required != ""){ $Required_l = "*"; $Required_tag = "required"; }
if($Type == "text"){
$input_template .= <<<EOF
<input type="text" name="form[{$Slug}]" value="{$Value}" id="input-form-{$Slug}" class="form-control" {$Required_tag} />
EOF;
}
else if($Type == "number"){
$input_template .= <<<EOF
<input type="number" name="form[{$Slug}]" value="{$Value}" id="input-form-{$Slug}" class="form-control" {$Required_tag} />
EOF;
} else if($Type == "textarea"){
$input_template .= <<<EOF
<textarea name="form[{$Slug}]" id="input-form-{$Slug}" class="form-control" {$Required_tag} />{$Value}</textarea>
EOF;
} else if($Type == "select"){
if($Value){
$options = ""; $Value_array = json_decode($Value, true);
foreach($Value_array as $key => $value){
$options .= "<option value=\"".$value['value']."\">".$value['visible']."</option>";
} }
$input_template .= <<<EOF
<select name="form[{$Slug}]" id="input-form-{$Slug}" class="form-control {$Required_tag}">
<option value=""> - Select - </option>
{$options}
</select>
EOF;
} else {

}

if($Type != "subtitle"){
$input_template2 = <<<EOF
<div class="{$class}">
<div class="form-group required">
<label class="control-label" for="input-form-{$Slug}"><b>{$Label} {$Required_l}</b></label>
{$input_template}
</div>
</div>
EOF;
} else {
$input_template2 = <<<EOF
<div class="{$class}">
<label class="control-label" for="input-form-{$Slug}">{$Label}</label>
</div>
EOF;
}
} else {

}

return $input_template2;
}

function MuestraTodosInputs($id_form, $order = "DESC"){
$mysqli = $GLOBALS['mysqli'];
$query_FormContact_Fields = "SELECT * FROM `FormContact_Fields` WHERE `Id_Form` = '$id_form' ORDER BY `id` ".$order.";";
$result_FormContact_Fields = $mysqli->query($query_FormContact_Fields);
$num_FormContact_Fields = $result_FormContact_Fields->num_rows;
if ($num_FormContact_Fields >= 1) {
$all_inputs = "";
while($row_FormContact_Fields = $result_FormContact_Fields->fetch_array(MYSQLI_ASSOC)){
$id = $row_FormContact_Fields['id'];
$all_inputs .= "".MuestraInput($id)."";
}
}
return $all_inputs;
}

function GetLabel($Slug, $id_form, $contact_value){
$mysqli = $GLOBALS['mysqli'];
$query_FormContact_Fields = "SELECT * FROM `FormContact_Fields` WHERE `Id_Form` = '$id_form' AND `Slug` = '$Slug' ORDER BY `id` DESC LIMIT 1;";
$result_FormContact_Fields = $mysqli->query($query_FormContact_Fields);
//$num_FormContact_Fields = $result_FormContact_Fields->num_rows;
$row_FormContact_Fields = $result_FormContact_Fields->fetch_array(MYSQLI_ASSOC);
if($row_FormContact_Fields['Type'] == "select"){
$value_array = json_decode($row_FormContact_Fields['Value'], true);
foreach($value_array as $item => $value){
if($value['value'] == $contact_value){
return $row_FormContact_Fields['Label'].": ".$value['visible'];
}
}
} else {
return $row_FormContact_Fields['Label'].": ".$contact_value;
}
}

function GetTablas($srv){
$mysqli = $GLOBALS['mysqli'];
$mysqli_gps = $GLOBALS['mysqli_gps'];
if($srv == ""){ $mysqli_sys = $mysqli; $db_name_sys = $GLOBALS['db_name_sys_db']; } else { $mysqli_sys = $mysqli_gps; $db_name_sys = $GLOBALS['db_name_gps_db']; }
//$def_ = "Tables_in_".$GLOBALS['db_name_sys_db'];
$def_ = "Tables_in_".$db_name_sys;
$array_tables = array();
$query_All_Tables = "SHOW TABLES;";
$result_All_Tables = $mysqli_sys->query($query_All_Tables);
$num_All_Tables = $result_All_Tables->num_rows;
if ($num_All_Tables >= 1) {
while($row_All_Tables = $result_All_Tables->fetch_array(MYSQLI_ASSOC)){
//echo json_encode($row_All_Tables);
$array_tables[] = $row_All_Tables[$def_];
}
}
return $array_tables;
}


function GetColumnas($Tabla, $srv){
//$mysqli_sys = $GLOBALS['mysqli'];

$mysqli = $GLOBALS['mysqli'];
$mysqli_gps = $GLOBALS['mysqli_gps'];
if($srv == ""){ $mysqli_sys = $mysqli; $db_name_sys = $GLOBALS['db_name_sys_db']; } else { $mysqli_sys = $mysqli_gps; $db_name_sys = $GLOBALS['db_name_gps_db']; }

$array_tables = array();
$query_All_Tables = "SELECT * FROM `".$Tabla."` ORDER BY `id` DESC LIMIT 1;";
$result_All_Tables = $mysqli_sys->query($query_All_Tables);
//$num_All_Tables = $result_All_Tables->num_rows;
$info_campo = $result_All_Tables->fetch_fields();
//echo json_encode($info_campo)."<hr>";
/*
numerics
-------------
BIT: 16
TINYINT: 1
BOOL: 1
SMALLINT: 2
MEDIUMINT: 9
INTEGER: 3
BIGINT: 8
SERIAL: 8
FLOAT: 4
DOUBLE: 5
DECIMAL: 246
NUMERIC: 246
FIXED: 246

dates
------------
DATE: 10
DATETIME: 12
TIMESTAMP: 7
TIME: 11
YEAR: 13

strings & binary
------------
CHAR: 254
VARCHAR: 253
ENUM: 254
SET: 254
BINARY: 254
VARBINARY: 253
TINYBLOB: 252
BLOB: 252
MEDIUMBLOB: 252
TINYTEXT: 252
TEXT: 252
MEDIUMTEXT: 252
LONGTEXT: 252
*/
foreach ($info_campo as $row_All_Tables) {
$array_tables[$row_All_Tables->name] = $row_All_Tables->type;
}
return $array_tables;
}

function GetInfoColumna($Tabla, $Columna, $srv) {
//$mysqli_sys = $GLOBALS['mysqli'];
$mysqli = $GLOBALS['mysqli']; $mysqli_gps = $GLOBALS['mysqli_gps'];
if($srv == ""){ $mysqli_sys = $mysqli; $db_name_sys = $GLOBALS['db_name_sys_db']; } else { $mysqli_sys = $mysqli_gps; $db_name_sys = $GLOBALS['db_name_gps_db']; }

$array_tables = array();
$query_All_Tables = "SELECT `".$Columna."` FROM `".$Tabla."` ORDER BY `".$Columna."` DESC LIMIT 1;";
$result_All_Tables = $mysqli_sys->query($query_All_Tables);
$info_campo = $result_All_Tables->fetch_fields();
//$array_tables = $info_campo->type;
return $info_campo[0]->type;
}

?>