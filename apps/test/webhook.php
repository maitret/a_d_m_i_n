<?php
include_once("../../funciones.php");

$data_json = json_encode($_REQUEST);

$uniqueId = $mysqli->real_escape_string($_REQUEST['uniqueId']);
$deviceId = $mysqli->real_escape_string($_REQUEST['deviceId']);
$valid = $mysqli->real_escape_string($_REQUEST['valid']);
$fixTime = $mysqli->real_escape_string($_REQUEST['fixTime']);
$deviceTime = $mysqli->real_escape_string($_REQUEST['deviceTime']);
$protocol = $mysqli->real_escape_string($_REQUEST['protocol']);
$name = $mysqli->real_escape_string($_REQUEST['name']);
$latitude = $mysqli->real_escape_string($_REQUEST['latitude']);
$longitude = $mysqli->real_escape_string($_REQUEST['longitude']);
$altitude = $mysqli->real_escape_string($_REQUEST['altitude']);
$speed = $mysqli->real_escape_string($_REQUEST['speed']);
$course = $mysqli->real_escape_string($_REQUEST['course']);
$statusCode = $mysqli->real_escape_string($_REQUEST['statusCode']);
$address = $mysqli->real_escape_string($_REQUEST['address']);
$gprmc = $mysqli->real_escape_string($_REQUEST['gprmc']);
$attributes = $_REQUEST['attributes'];

/*
{
  "id": "868683022725968",
  "deviceId": "1",
  "valid": "true",
  "fixTime": "1480792453000",
  "deviceTime": "1480792453000",
  "protocol": "gps103",
  "name": "U171",
  "latitude": "22.223115",
  "longitude": "-97.86443",
  "altitude": "0.0",
  "speed": "0.0",
  "course": "0.0",
  "statusCode": "0xF020",
  "address": "SN-S ESTACIONAMIENTO ARTELI Plutarco Elias Calles, Tampico, Tamps., MX",
  "gprmc": "$GPRMC,191413.000,A,2213.3869,N,09751.8658,W,0.00,0.00,031216,,*16",
  "attributes": "{\"ip\":\"201.166.178.29\",\"distance\":0.0,\"totalDistance\":46050.47}"
}
$signo = "$";
$data_json_ = "";
foreach($_REQUEST as $item=>$value){
$data_json__ .= <<<EOF
{$signo}{$item} = {$signo}mysqli->real_escape_string(Valida_utf8({$signo}_REQUEST['{$item}']));\n
EOF;
$data_json_ .= <<<EOF
"{$item}"=>{$signo}{$item},
EOF;
}
*/

$Status_array = array("0xF020"=>"STATUS_LOCATION","0xF841"=>"STATUS_PANIC_ON","0xF11C"=>"STATUS_MOTION_MOVING");
$Status = $Status_array[$statusCode];
if($address == "{address}"){ $address = ""; }

$Max_Speed = 80;
if(floatval($speed) >= $Max_Speed){ $alerta = 1; } else { $alerta = 0; }

$data_json_fb = array("uniqueId"=>$uniqueId,"deviceId"=>$deviceId,"valid"=>$valid,"fixTime"=>$fixTime,"deviceTime"=>$deviceTime,"protocol"=>$protocol,"name"=>$name,"latitude"=>$latitude,"longitude"=>$longitude,"altitude"=>$altitude,"speed"=>$speed,"course"=>$course,"statusCode"=>$statusCode,"address"=>$address,"gprmc"=>$gprmc,"attributes"=>$attributes,"alerta"=>$alerta,"status"=>$Status);
$data_json_fb = json_encode($data_json_fb);
$result_FireBase = PostFireBase("PUT","/gps/".$deviceId.".json","", $data_json_fb);

if($alerta == 1){
mail($email_debug, "Velocidad superada por ".$name.": ".$speed." km/h (max: ".$Max_Speed.") ",$_SERVER['PHP_SELF']."\n\n".$Status."\n\n".$data_json."\n\nFB:\n".$data_json_fb);
}

//mail($email_debug, $_SERVER['PHP_SELF'], $Status."\n\n".$data_json."\n\nFB:\n".$data_json_fb);

echo $data_json;

?>