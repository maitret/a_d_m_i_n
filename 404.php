<?php
$data_json = json_encode(array("Error 404"=>array("req"=>$_REQUEST, "IP"=>$_SERVER['REMOTE_ADDR'])));
mail($email_debug, $_SERVER['PHP_SELF'], $data_json);
echo $data_json;
?>
Error 404
