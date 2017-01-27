Error 403 admin
<?php
$data_json = json_encode(array("Error 403 admin"=>array("req"=>$_REQUEST, "IP"=>$_SERVER['REMOTE_ADDR'])));
mail($email_debug, $_SERVER['PHP_SELF'], $data_json);
echo $data_json;
?>