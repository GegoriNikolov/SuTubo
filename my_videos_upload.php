<?php
include('includes/dbconnect2.php');
include('includes/functions.php');
if(!isset($_SESSION['username']))
{
  header("location: login?n=my_videos_upload");
}
?>
<html>
    <head>
        
        <title>SuTubo - Upload</title>
        
        <link rel="stylesheet" type="text/css" href="http://www.sutubo.epizy.com/css/styles.css">
    <link rel="icon" href="http://www.sutubo.epizy.com/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://www.sutubo.epizy.com/favicon.ico" type="image/x-icon">
        
        <script>
function uploadFile(){

	var file = document.getElementById('file1').files[0];
	var vid_title = document.getElementById('vid_title').value;
	var vid_description = document.getElementById('vid_description').value;
	var vid_tag = document.getElementById('vid_tag').value;
	var vid_category = document.getElementById('vid_category').value;
	var vid_privacy = document.getElementById('vid_privacy').value;
	
	document.getElementById('vid_title').value = file.name;
	document.getElementById('vid_name').innerHTML = file.name;
	document.getElementById('vid_info_top_box').style.display = 'none';
	document.getElementById('vid_info_bottom_box').style.display = 'block';
	document.getElementById('uploading_message').style.display = 'block';
	document.getElementById('uploading_message').innerHTML = '<b>Tan pronto como se cargue el video puedes editar la información.</b>';
	
	var formdata = new FormData();
	
	formdata.append("file1", file);
	formdata.append("vid_title", vid_title);
	formdata.append("vid_description", vid_description);
	formdata.append("vid_tag", vid_tag);
	formdata.append("vid_category", vid_category);
	formdata.append("vid_privacy", vid_privacy);
	
	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
    if (ajax.readyState == 4 && ajax.status == 200) {
        var arr = JSON.parse(ajax.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out!=='2'){
    document.getElementById('vid_url').setAttribute('url',out);
    document.getElementById("vid_url").className = 'good_box';
    } else {
    document.getElementById('vid_url').innerHTML = 'Se ha producido un error (tal vez conexión a Internet), inténtalo de nuevo.';
    document.getElementById("vid_url").className = 'wrong_box'; 
    }
    }
};
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "upload_file.php");
	ajax.send(formdata);
}
function save_vid_info(){

	var vid_url = document.getElementById('vid_url').getAttribute('url');
	var vid_title = document.getElementById('vid_title').value;
	var vid_description = document.getElementById('vid_description').value;
	var vid_tag = document.getElementById('vid_tag').value;
	var vid_category = document.getElementById('vid_category').value;
	var vid_privacy = document.getElementById('vid_privacy').value;
	
	var najax = new XMLHttpRequest();
	najax.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr = JSON.parse(this.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out!=='2'){
    document.getElementById('uploading_message').style.display = 'block';
    document.getElementById('uploading_message').innerHTML = 'Changes saved correctly.';
    } else {
    document.getElementById("vid_url").className = 'wrong_box'; 
    }
    }
};
	najax.open("POST", "save_upload_file.php");
	najax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	najax.send('vid_title='+vid_title+'&vid_description='+vid_description+'&vid_tag='+vid_tag+'&vid_category='+vid_category+'&vid_privacy='+vid_privacy+'&vid_url='+vid_url+'');
}
function progressHandler(event){
	document.getElementById("vid_size").innerHTML = '('+formatBytes(event.total)+')';
	var percent = (event.loaded / event.total) * 100;
	document.getElementById("progressBar").style.width = Math.round(percent)+"%";
	document.getElementById("status").innerHTML = Math.round(percent)+"%";
}
function completeHandler(event){
	document.getElementById("vid_url").setAttribute('urla',event.target.responseText);
	document.getElementById('uploading_message').innerHTML = '';
	document.getElementById('uploading_message').style.display = 'none';
	document.getElementById('more_vid_info').style.display = 'block';
}
function errorHandler(event){
	document.getElementById("status").innerHTML = "Se ha producido un error, vuelva a intentarlo.";
}
function abortHandler(event){
	document.getElementById("status").innerHTML = "Se ha cancelado la subida.";
}
function formatBytes(bytes) {
    if(bytes < 1024) return bytes + " Bytes";
    else if(bytes < 1048576) return(bytes / 1024).toFixed(3) + " KB";
    else if(bytes < 1073741824) return(bytes / 1048576).toFixed(3) + " MB";
    else return(bytes / 1073741824).toFixed(3) + " GB";
};
        </script>
        <style>
input[type="file"] {
    display: none;
}
.custom-file-upload {
    display: inline-block;
    cursor: pointer;
}
</style>
    </head>
    <body>
        <?php include("templates/head.php"); ?>
        <?php include("templates/head2.php"); ?>
<div style="width:960px;padding:10px 0;margin:0 auto;border-top:1px solid #ccc;">
   <div style="float:left;width:640px;">
       <div id="vid_url"></div>
	   <form id="upload_form" enctype="multipart/form-data" method="post" onSubmit="return false;">
      <div style="font-size:20px;font-weight:bold;padding-bottom:10px;border-bottom:1px solid #ccc;margin-bottom:10px;">Carga archivo de video</div>
      <div id="vid_info_top_box" style="border:1px solid #c6d1eb;background-color:#eff4fc;margin-bottom:10px;border-radius:3px;padding:10px;">
        <div style="border:1px solid #999;background-color:#fff;padding:15px 20px;"><div style="float:left;font-size:14px;font-weight:bold;margin-top:4px;">Presion "Subir video" para seleccionar un archivo y subirlo.</div> <div style="float:right;"><label class="custom-file-upload mb mb_g_y">
        <input type="file" name="file1" id="file1" onChange="uploadFile()">
        <b>Subir video</b> </label></div><div style="clear:both;"></div>
        </div>
      </div>
      <div id="vid_info_bottom_box" style="display:none;border:1px solid #c6d1eb;background-color:#eff4fc;margin-bottom:10px;border-radiusv:3px;padding:10px;">
          <div style="border:1px solid #999;background-color:#fff;padding:20px;">
              <div style="font-size:16px;margin-bottom:10px;"><span id="vid_name" style="font-weight:bold;"></span><span id="vid_size" style="font-size:11px;color:#666;"></span></div>
        <div style="float:left;margin-right:10px;">
            Proceso de carga:
        </div>
        <div id="progressBar_container" style="float:left;margin-right:10px;">
            <div style="border:1px solid #ccc;padding:2px;width:200px;height:15px;">
                <div id="progressBar" style="background-color:#6483dc;height:15px;"></div>
            </div>
        </div>
        <div style="float:left;margin-right:10px;">
            <span id="status" style="font-weight:bold;"></span>
        </div>
        <div style="clear:both;"></div>
        <div id="uploading_message" style="display:none;padding:5px 0;"></div>
        <div id="more_vid_info" style="display:none;border-top:1px solid #ccc;padding:10px 0;margin:10px 0;">
            <div style="padding-bottom:15px;font-size:14px;font-weight:bold;color:#666;">Información del video y configuración de privacidad</div>
            <div style="width:600px;margin:0 auto;">
                <div style="padding:5px 0;margin:5px 0;">
                    <div style="float:left;width:100px;text-align:right;margin-right:10px;">Título:</div>
                    <div style="float:left;width:400px;"><input id="vid_title" type="text" style="width:100%;box-sizing:border-box"></div>
                    <div style="clear:both;"></div>
                </div>
                <div style="padding:5px 0;margin:5px 0;">
                    <div style="float:left;width:100px;text-align:right;margin-right:10px;">Descripcion:</div>
                    <div style="float:left;width:400px;"><textarea id="vid_description" rows="3" style="width:100%;box-sizing:border-box"></textarea></div>
                    <div style="clear:both;"></div>
                </div>
                <div style="padding:5px 0;margin:5px 0;">
                    <div style="float:left;width:100px;text-align:right;margin-right:10px;">Etiquetas:</div>
                    <div style="float:left;width:400px;"><input id="vid_tag" type="text" style="width:100%;box-sizing:border-box"></div>
                    <div style="clear:both;"></div>
                </div>
                <div style="padding:5px 0;margin:5px 0;">
                    <div style="float:left;width:100px;text-align:right;margin-right:10px;">Categoría:</div>
                    <div style="float:left;width:400px;"><select id="vid_category" type="text" style="width:100%;box-sizing:border-box">
					<option value="1">Autos &amp; Vehicles</option>
					<option value="2">Comedy</option>
					<option value="3">Education</option>
					<option value="4">Entertainment</option>
					<option value="5">Film &amp; Animation</option>
					<option value="6">Gaming</option>
					<option value="7">Howto &amp; Style</option>
					<option value="8">Music</option>
					<option value="9">News &amp; Politics</option>
					<option value="10">Nonprofits &amp; Activism</option>
					<option value="11">People &amp; Blogs</option>
					<option value="12">Pets &amp; Animals</option>
					<option value="13">Science &amp; Technology</option>
					<option value="14">Sports</option>
					<option value="15">Travel &amp; Events</option></select></div>
                    <div style="clear:both;"></div>
                </div>
                <div style="padding:5px 0;margin:5px 0;">
                    <div style="float:left;width:100px;text-align:right;margin-right:10px;">Privacidad:</div>
                    <div style="float:left;width:400px;">

                            <select id="vid_privacy">
                                <option value="1">Publico (todos pueden buscar y ver el video - recomendado)</option>
                                <option value="2">No listado (cualquier persona que conozca el vínculo puede ver el video)</option>
                                <option value="3">Privado (solo los usuarios especificos de SuTubo pueden ver el video)</option>
                            </select>
                            
                        </div>
                    <div style="clear:both;"></div>
                </div>
                <div style="padding:5px 0;margin:5px 0;">
                    <button class="mb mb_g_w" id="save_changes_btn" onClick="save_vid_info()">Guardar cambios</button>
                </div>
            </div>
        </div>
        <div id="loaded_n_total"></div>
        </div>
      </div>
    </form>
   </div>
   <div style="float:right;width:280px;background-color:#f2f2f2;border-radius:5px;padding:8px;font-size:12px;margin-top:20px;">
       <b>Importante:</b> No cargue ningún programa de televisión, videos musicales, conciertos de música o comerciales sin permiso, a menos que se trate de contenido que haya creado usted mismo.

La página de Consejos sobre derechos de autor y las Normas de la comunidad pueden ayudarlo a determinar si su video infringe los derechos de autor de otra persona.

Al hacer clic en "Cargar video", usted representa que este video no viola los Términos de uso de YouTube y que posee todos los derechos de autor de este video o que tiene autorización para subirlo.
   </div>
   <div style="clear:both"></div>
</div>
        
        <?php include("templates/bottom.php"); ?>
        
    </body>
</html><script>
        var n = document.getElementsByTagName('a');
        for(nn = 0; nn <= n.length; nn++)
        {
            if(n[nn].getAttribute('title') == 'Hosted on free web hosting 000webhost.com. Host your own website for FREE.')
            {
                n[nn].innerHTML = '';
            }
        }
    </script>