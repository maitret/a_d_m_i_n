<?php
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=ISO-8859-1', true);
include_once("../funciones.php");

$Id_Rand = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_rand']));
if($Id_Rand == ""){ $Id_Rand = substr(md5(uniqid(rand())),0,6); }
$Tipo = "productos";
$Id_Form = "Productos";
$ajax_script = "productos_alta"; 

$id_table = $mysqli->real_escape_string(Valida_utf8($_REQUEST['id_table']));
$query_Cosa = "SELECT * FROM `".$Id_Form."` WHERE `id` = '$id_table' ORDER BY `id` DESC;";
$result_Cosa = $mysqli->query($query_Cosa);
$num_Cosa = $result_Cosa->num_rows;
if($num_Cosa){
$Input_Array = $result_Cosa->fetch_array(MYSQLI_ASSOC);
$Id_Producto = $Input_Array['Id_Producto'];
} else {
$Id_Producto = urls__($Id_Form."_".getGUID());
$Insert_Cosa = "INSERT INTO `".$Id_Form."` (`id`, `Id_Producto`, `Estatus`) VALUES ('NULL', '$Id_Producto', 'Inactivo');"; 
$result_Cosa_Insert = $mysqli->query($Insert_Cosa);
$id_table = $mysqli->insert_id;
$msg_new = <<<EOF
<div class="alert alert-info" align="center">Nuevo borrador creado, id: {$id_table}</div>
EOF;
}
?>
<style>
.map_canvas {
width: 100%;
height: 300px;
}
</style>

<?php 
echo $msg_new; 
?>

<!-- Bread crumb is created dynamically -->
<!-- row -->
<div class="row">

<!-- col -->
<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><i class="fa-fw fa fa-home"></i>
 Productos <span> >Alta/Editar </span>
</h1>
</div>
<!-- end col -->

<!-- right side of the page with the sparkline graphs -->
<!-- col -->
<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">

</div>
<!-- end col -->

</div>
<!-- end row -->

<!-- widget grid -->
<section id="widget-grid" class="">

<!-- row -->
<div class="row">

<!-- NEW WIDGET ROW START -->
<div class="col-sm-12">

<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget" id="wid-id-sucursal" data-widget-colorbutton="false"	data-widget-editbutton="true" data-widget-togglebutton="true" data-widget-deletebutton="false" data-widget-fullscreenbutton="true">
<header>
<h2>Ingrese datos del Producto </h2>
</header>

<!-- widget div-->

<div>
<!-- widget edit box -->
<div class="jarviswidget-editbox">
<!-- This area used as dropdown edit box -->
<input class="form-control" type="text">
</div>
<!-- end widget edit box -->

<!-- widget content -->
<div class="widget-body">

<form id="" class="source_form_" method="post" action="_/productos_alta_procesa"
data-bv-message="Este valor es invalido" data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" accept-charset="ISO-8859-1">

<fieldset>
<?php
//echo PrintField($Id_Form, "Id_Marca", $Input_Array['Id_Marca']);
?>
<?php echo PrintField($Id_Form, "Producto", $Input_Array['Producto']); ?>
<?php echo PrintField($Id_Form, "Precio", $Input_Array['Precio']); ?>
<?php echo PrintField($Id_Form, "Moneda", $Input_Array['Moneda']); ?>
<?php echo PrintField($Id_Form, "Id_Categoria", $Input_Array['Id_Categoria']); ?>
</fieldset>

<fieldset>
<?php echo PrintField($Id_Form, "Descripcion", $Input_Array['Descripcion']); ?>
</fieldset>

<fieldset>
<?php echo PrintField($Id_Form, "Estatus", $Input_Array['Estatus']); ?>
</fieldset>

<?php
$Id_Tipo = $Id_Producto; /* 
$query_Imagenes_Adjuntas = "SELECT * FROM `Imagenes_Adjuntas` WHERE `Tipo` = '$Tipo' AND `Id_Tipo` = '$Id_Producto' ORDER BY `id` DESC;";
$result_Imagenes_Adjuntas = $mysqli->query($query_Imagenes_Adjuntas);
$num_Imagenes_Adjuntas = $result_Imagenes_Adjuntas->num_rows;
if ($num_Imagenes_Adjuntas >= 1) {
while($row_Imagenes_Adjuntas = $result_Imagenes_Adjuntas->fetch_array(MYSQLI_ASSOC)) {
$id_track = $row_Imagenes_Adjuntas['id'];
$Nombre_Img = $row_Imagenes_Adjuntas['Nombre_Img'];
$FechaHora_Img = date('d/m/Y H:i:s', $row_Imagenes_Adjuntas['FechaHora']);
$Tamano = $row_Imagenes_Adjuntas['Tamano'];
$Url = $row_Imagenes_Adjuntas['Url'];
$Demo = $row_Imagenes_Adjuntas['Demo'];
$uri_64 = base64_encode($url_server."/#productos_alta?id_table=".$id_table);

if($Demo == 1){ $Demo_print = <<<EOF
<i class="fa fa-check" aria-hidden="true"></i>
EOF;
} else { $Demo_print = ""; }

$tr_tracks .= <<<EOF
<tr>
<td data-order="{$id_track}" align="center">
<a href="javascript:;" onclick='return confirm_delete("Desea borrar este archivo de manera permanente?", "{$url_server}/borrar_adjunto.php?id_img={$id_track}&return={$uri_64}")' title="Borrar este archivo de forma permanente"><i class="fa fa-trash" aria-hidden="true"></i></a>
</td>
<td><a href="{$Url}" target="_blank">{$Nombre_Img}</a></td>
<td align="center">
<a href="{$Url}" target="_blank">Abrir</a>
</td>
<td>{$FechaHora_Img}</td>
EOF;
}
?>
<div class="text-center">
<h4>Adjuntos cargados previamente: </h4>
</div>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
<th>Opc</th>
<th>Nombre</th>
<th>Vista previa</th>
<th>Fecha de carga</th>
</tr>
</thead>
<tbody><?php echo $tr_tracks; ?></tbody>
</table>
</div>
<?php } */ ?>

<div class="div_update_uploads"></div>

<script type="text/javascript">
var tipo = "<?php echo $Tipo; ?>";
var id_tipo = "<?php echo $Id_Tipo; ?>";
var id_table = "<?php echo $id_table; ?>";
var ajax_script = "<?php echo $ajax_script; ?>";

$(".div_update_uploads").load("list_uploads.php?id_table="+id_table+"&is_ajax=1&ajax_script="+ajax_script+"&tipo="+tipo+"&id_tipo="+id_tipo+"&filename=");

function confirm_delete(question, url) {
if(confirm(question)){
$(".div_update_uploads").html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>');
$(".div_update_uploads").load(url); 
$(".div_update_uploads").load("list_uploads.php?id_table="+id_table+"&is_ajax=1&ajax_script="+ajax_script+"&tipo="+tipo+"&id_tipo="+id_tipo+"&filename=");
} else {
return false;  
}
}
</script>

<?php
if($Id_Producto != ""){
?>
<hr>
<div class="text-justify" align="center">
<span class="btn btn-success fileinput-button">
<i class="glyphicon glyphicon-plus"></i>
<span>Agregar Ajuntos</span>
<input class="fileupload" type="file" name="files[]" multiple>
</span>
</div>
<br>
<div id="progress" class="progress">
<div class="progress-bar progress-striped active"></div>
</div>
<div id="files" class="files row"></div>
<?php } else { ?>
<div class="alert alert-info">
<i class="fa fa-info-circle" aria-hidden="true"></i> Nota: <ul>
<li>Para habilitar el funci&oacute;n de <b>Agregar Ajuntos</b>, primero guarde este nuevo registro y regrese a editarlo.</li>
</ul>
</div>
<?php } ?>

<input type="hidden" name="id_table" value="<?php echo $id_table; ?>">

<div class="response_form" align="center"></div>
<br>

<div class="form-actions">
<div class="row">
<div class="col-md-12 text-center">
<button class="btn btn-default submit_form" type="submit" id="">Guardar</button>
</div>
</div>
</div>

</form>
</div>
<!-- end widget content -->

</div>
<!-- end widget div -->

</div>
<!-- end widget -->

</div>
<!-- WIDGET ROW END -->
</div>

<!-- end row -->

</section>
<!-- end widget grid -->
<?php
echo FormTarget_Ajax2($target_id);
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
//window.enable_geocomplete("", "<?php echo $Input_Array['Lat']; ?>,<?php echo $Input_Array['Lon']; ?>", ".map_canvas");
//setTimeout(function(){ $(".Direccion").val("<?php echo $Input_Array['Direccion']; ?>"); },2000);
});

var fileupload_jq = function() {

$(function () {
'use strict';
//var url = '<?php echo $url_server; ?>/img_<?php echo $Tipo; ?>/<?php echo $Id_Producto; ?>/<?php echo $Id_Rand; ?>',
var url = '<?php echo $url_server; ?>/img_<?php echo $Tipo; ?>/<?php echo $Id_Producto; ?>',
uploadButton = $('<button/>').addClass('btn btn-primary').prop('disabled', true).html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>').on('click', function () {
var $this = $(this), data = $this.data();
$this.off('click').text('Cancelar').on('click', function () {
$this.remove();
data.abort();
});
data.submit().always(function () {
$this.remove();
});
});

$(".fileupload").fileupload({

url: url, dataType: 'json', autoUpload: true,
//acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
acceptFileTypes: /(\.|\/)(gif|jpe?g|png|mp4|mp3)$/i,
maxFileSize: 10000000, limitMultiFileUploads: 2, maxNumberOfFiles: 2,
disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent), previewMaxWidth: 100, previewMaxHeight: 100, previewCrop: true

}).on('fileuploadadd', function (e, data) {

$('#progress .progress-bar').removeClass('progress-bar-success');
$('#progress .progress-bar').addClass('progress-striped');
$('#progress .progress-bar').addClass('active');

data.context = $('<div class="col-sm-3" align="center" /> ').appendTo('#files');
$.each(data.files, function (index, file) {
//var node = $('<p/>').append($('<span/><br>').text(file.name+''));
var node = $('<p/>').append($('<span/><br>'));
if (!index) { node.append('').append(uploadButton.clone(true).data(data)); }
node.appendTo(data.context);
});

}).on('fileuploadprocessalways', function (e, data) {

var index = data.index, file = data.files[index], node = $(data.context.children()[index]);
if (file.preview) {
node.prepend('<br>').prepend(file.preview);
}
if (file.error) {
node.append('<br>').append($('<span class="text-danger"/>').text(file.error));
}
if (index + 1 === data.files.length) {
//data.context.find('button').text('Cargar').prop('disabled', !!data.files.error);
}

}).on('fileuploadprogressall', function (e, data) {

$('#progress .progress-bar').removeClass('progress-bar-success');
$('#progress .progress-bar').addClass('progress-striped');
$('#progress .progress-bar').addClass('active');

var progress = parseInt(data.loaded / data.total * 100, 10);
$('#progress .progress-bar').css('width', progress + '%');

}).on('fileuploaddone', function (e, data) {

//$('#progress .progress-bar').css('width', 0 + '%');
$('#progress .progress-bar').removeClass('progress-striped');
$('#progress .progress-bar').removeClass('active');
$('#progress .progress-bar').addClass('progress-bar-success');

$.each(data.result.files, function (index, file) {
if (file.url) {
var link = $('<a>').attr('target', '_blank').prop('href', file.url).prop('title', file.name);
$(data.context.children()[index]).wrap(link);
data.context.find('button').html('<i class="fa fa-check" aria-hidden="true"></i>').removeClass('btn-primary').addClass('btn-success').prop('disabled');
$(".div_update_uploads").load("list_uploads.php?id_table="+id_table+"&ajax_script="+ajax_script+"&tipo="+tipo+"&id_tipo="+id_tipo+"&filename="+file.name);
} else if (file.error) {
var error = $('<span class="text-danger"/>').text(file.error);
$(data.context.children()[index]).append('<br>').append(error);
}
});

}).on('fileuploadfail', function (e, data) {

$.each(data.files, function (index) {
var error = $('<span class="text-danger"/>').text('Error'+JSON.stringify(e));
$(data.context.children()[index])
.append('Error: ').append(error);
});

}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

});
};

pageSetUp();

var ckeditor = function() {
CKEDITOR.replace( 'Descripcion', { height: '380px', startupFocus : true} );
};

var pagefunction = function() {
$('#source_form').bootstrapValidator();
};
var pagedestroy = function() {
$('#source_form').bootstrapValidator('destroy');
$('button[data-toggle]').off();
if (debugState) {
root.console.log("✔ Bootstrap validator destroyed");
}
};

loadScript("js/plugin/jquery-file-upload/js/jquery.fileupload.js", function(){
loadScript("js/plugin/jquery-file-upload/js/vendor/jquery.ui.widget.js", function(){
loadScript("js/plugin/jquery-file-upload/js/load-image.all.min.js", function(){
loadScript("js/plugin/jquery-file-upload/js/canvas-to-blob.min.js", function(){
loadScript("js/plugin/jquery-file-upload/js/jquery.iframe-transport.js", function(){
loadScript("js/plugin/jquery-file-upload/js/jquery.fileupload-process.js", function(){
loadScript("js/plugin/jquery-file-upload/js/jquery.fileupload-image.js", function(){
loadScript("js/plugin/jquery-file-upload/js/jquery.fileupload-audio.js", function(){
loadScript("js/plugin/jquery-file-upload/js/jquery.fileupload-video.js", function(){
loadScript("js/plugin/jquery-file-upload/js/jquery.fileupload-validate.js", fileupload_jq);
});
});
});
});
});
});
});
});
});

loadScript("js/plugin/bootstrapvalidator/bootstrapValidator.min.js", pagefunction);
loadScript("js/plugin/ckeditor/ckeditor.js", ckeditor); 
</script>
