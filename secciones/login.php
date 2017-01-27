<?php
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("../funciones.php");
$get_return = $mysqli->real_escape_string($_REQUEST['return']);

if($Data_Usuario == ""){ ?>

<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
<!-- widget options:
usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

data-widget-colorbutton="false"
data-widget-editbutton="false"
data-widget-togglebutton="false"
data-widget-deletebutton="false"
data-widget-fullscreenbutton="false"
data-widget-custombutton="false"
data-widget-collapsed="true"
data-widget-sortable="false"

-->
<header>
<span class="widget-icon"> <i class="fa fa-eye"></i> </span>
<h2>Conectarse</h2>
</header>
<!-- widget div-->
<div>

<!-- widget edit box -->
<div class="jarviswidget-editbox">
<!-- This area used as dropdown edit box -->

</div>
<!-- end widget edit box -->

<!-- widget content -->
<div class="widget-body">

<form role="form" action="<?php echo $url_server; ?>/ajax.process_form.php?action=login" data-parsley-validate="" novalidate="" class="mb-lg" id="source_form">

<fieldset>
<input name="authenticity_token" type="hidden">
<div class="form-group">
<label>Email</label>
<input class="form-control" name="email" placeholder="Su email" type="email" value="">
</div>
<div class="form-group">
<label>Password</label>
<input class="form-control" name="password" placeholder="Su password" type="password" value="">
</div>
</fieldset>

<div id="response_form" align="center"></div>

<input type="hidden" name="return" value="<?php echo $get_return; ?>">
<input type="hidden" name="Lat" class="User_Lat">
<input type="hidden" name="Lon" class="User_Lon">
<input type="hidden" name="key" class="User_Key">
<input type="hidden" name="Geo_Aprox" class="Geo_Aprox">

<div class="form-actions">
<button class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Ingresar</button>
</div>

</form>

</div>
</div>
</div>

<script>
jQuery(document).ready(function($) {
var get_User_Lat = localStorage.getItem('User_Lat');
var get_User_Lon = localStorage.getItem('User_Lon');
var get_Geo_Aprox = localStorage.getItem('Geo_Aprox');
$(".User_Lat").val(get_User_Lat); $(".User_Lon").val(get_User_Lon); $(".Geo_Aprox").val(get_Geo_Aprox); $(".User_Key").val(localStorage.getItem('key'));
if(get_User_Lat != "" && get_User_Lon != "") { $(".show_geo_button").show(); }
});
</script>
<?php
echo $Form_Default;
} else {  ?>
<?php }
?>