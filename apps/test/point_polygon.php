<?php
include_once("../../funciones.php");
//$mysqli_gps
/*
OK: 22.3052972,-97.8891446
BAD: 22.3029089 -97.8892565
SET @myPointgps =  ST_geometryFromText('POINT(22.3029089 -97.8892565)');
SET @myPolygongps = ST_geometryFromText('POLYGON((22.306019812458672 -97.88954803984953, 22.305607883033787 -97.8885127071698, 22.304669870533047 -97.88870582621885, 22.305056987566658 -97.88985917609527, 22.306019812458672 -97.88954803984953))');
SELECT ST_Intersects(@myPointgps, @myPolygongps);
//Other
set @r = GeomFromText('POLYGON((22.306019812458672 -97.88954803984953, 22.305607883033787 -97.8885127071698, 22.304669870533047 -97.88870582621885, 22.305056987566658 -97.88985917609527, 22.306019812458672 -97.88954803984953))');
set @p = GeomFromText('POINT(22.3029089 -97.8892565)');
select if(contains(@r, @p), 'yes', 'no');
//Other
SELECT * FROM geofences WHERE MBRContains(GeomFromText(area), GeomFromText('Point(22.2341016 -97.9134104)')) = 1
//Other
//$Q_Point_Polygon = "SELECT * FROM geofences WHERE ST_Intersects(ST_geometryFromText('POINT(22.3052972 -97.8891446)'), ST_geometryFromText('POLYGON((22.306019812458672 -97.88954803984953, 22.305607883033787 -97.8885127071698, 22.304669870533047 -97.88870582621885, 22.305056987566658 -97.88985917609527, 22.306019812458672 -97.88954803984953))'));";
*/

$query_positions = "SELECT devices.id,devices.name,devices.uniqueid,positions.deviceid,positions.fixtime,positions.fixtime,positions.latitude,positions.longitude,positions.speed,positions.course,positions.address,positions.attributes FROM `devices` INNER JOIN `positions` ON devices.positionid = positions.id WHERE positions.valid = 1 ORDER BY positions.id DESC;";
//echo $query_positions."<hr>";
$result_positions = $mysqli_gps->query($query_positions);
$num_positions = $result_positions->num_rows;
if ($num_positions >= 1) {
while($row_positions = $result_positions->fetch_array(MYSQLI_ASSOC)){
//echo "".json_encode($row_positions)."<br>";
$name = $row_positions['name'];
$uniqueid = $row_positions['uniqueid'];
$deviceid = $row_positions['deviceid'];
$fixtime = $row_positions['fixtime'];
$latitude = $row_positions['latitude'];
$longitude = $row_positions['longitude'];
$speed = $row_positions['speed'];
$course = $row_positions['course'];
$address = $row_positions['address'];
$attributes = $row_positions['attributes'];

//$fecha = date_create($fixtime, timezone_open('America/Mexico_City'));
//$fecha = date_format($fecha, 'Y-m-d H:i:s') . "\n";
$fixtime_epoch = (GetEpochFromDate($fixtime)-21600);
$fecha = date('Y-m-d H:i:s', $fixtime_epoch);
echo "<hr>";

$Q_Point_Polygon = "SELECT * FROM `geofences` WHERE ST_Intersects(ST_geometryFromText('POINT(".$latitude." ".$longitude.")'), ST_geometryFromText(area)) AND `area` LIKE '%POLYGON%';";
//echo $Q_Point_Polygon."<hr>";
$R_Point_Polygon = $mysqli_gps->query($Q_Point_Polygon);
$num_Point_Polygon = $R_Point_Polygon->num_rows;
if ($num_Point_Polygon >= 1) {
while($row_Point_Polygon = $R_Point_Polygon->fetch_array(MYSQLI_ASSOC)) {
$geocerca_nombre = $row_Point_Polygon['name'];
//echo $name." (".$uniqueid."): ".json_encode($row_Point_Polygon);
echo $name." (".$uniqueid."), esta en la geocerca: <b>".$geocerca_nombre."</b> a las ".$fecha." en <b>".$address."</b>(".$latitude.",".$longitude.")<br>".$attributes."";
}
}

}
}

?>