<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
include_once("../funciones.php");
?>

<script>
location = "<?php echo $url_server; ?>/";
</script>

<a href="<?php echo $url_server; ?>/">Regresar</a>