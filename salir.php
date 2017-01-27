<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("funciones.php");

$_SESSION["Data_Usuario"] = "";
unset($_SESSION["Data_Usuario"]);
session_destroy();
$html['cerrar_sesion'] = <<<EOF
<p class="text-success" align="center"><b>Te esperamos de vuelta muy pronto, adios...</b></p>
<script type="text/javascript"> setTimeout(function(){ location = "./?"; }, 1000);
window.localStorage.setItem("usuario", "");
window.localStorage.removeItem("usuario");
window.localStorage.removeItem("Usuario");
//window.localStorage.clear();
</script>
EOF;
echo $html['cerrar_sesion'];
?>