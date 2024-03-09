<?php
include("includes/dbconnect.php");
include("includes/functions.php");
$messages_info = mysqli_query($conn,"SELECT * FROM messages WHERE user2='".$my_info_show['username']."'");
?>
<html>
<head>
<title>SuTubo - Transmita Usted.</title>
<link rel="stylesheet" type="text/css" href="http://www.sutubo.epizy.com/css/styles.css">
<link rel="icon" href="http://www.sutubo.epizy.com/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="http://www.sutubo.epizy.com/favicon.ico" type="image/x-icon">
<style>.personal-msg-box{font-size:12px;padding:4px 5px;}.compose_header{text-align: right;
    color: #333;
    width: 100px;
    padding-right: 1em;
    vertical-align: top;
    padding-top: 1.25em;}.compose_body{text-align: left;
    padding: 0;
    padding-top: 1em;
    color: #666;}#compose_from{padding-top:0.25em;}.compose_input{width: 90%;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 10pt;}.tab-messages-title-selected{background-color:#444;color:#fff;}</style>
<script>            function show_n_hide(n)            {                if(document.getElementById(n).style.display=='none')                {                    document.getElementById(n).style.display = 'block';                } else {                    document.getElementById(n).style.display = 'none';                }            }            function accept_friend_request_f(username)            {                var xmlhttp = new XMLHttpRequest();                document.getElementById('accept_request_content').innerHTML = 'Loading...';                document.getElementById('accept_request_content').style.display = 'block';xmlhttp.onreadystatechange = function() {    if (this.readyState == 4 && this.status == 200) {        var arr = JSON.parse(this.responseText);        var out = "";    for(i = 0; i < arr.length; i++) {        out += arr[i].display;    }    if(out=='1'){    document.getElementById('accept_request_content').innerHTML = 'Request accepted.';    } else {    document.getElementById('accept_request_content').innerHTML = 'Something went wrong... Please, try again.';    }    }};xmlhttp.open("POST", 'accept_friend_request.php', true);xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');xmlhttp.send('u='+username+'');            }            function delete_friend_request_f(username)            {                var xmlhttp = new XMLHttpRequest();                document.getElementById('delete_request_content').innerHTML = 'Loading...';                document.getElementById('delete_request_content').style.display = 'block';xmlhttp.onreadystatechange = function() {    if (this.readyState == 4 && this.status == 200) {        var arr = JSON.parse(this.responseText);        var out = "";    for(i = 0; i < arr.length; i++) {        out += arr[i].display;    }    if(out=='1'){    document.getElementById('delete_request_content').innerHTML = 'Request deleted.';    } else {    document.getElementById('delete_request_content').innerHTML = 'Something went wrong... Please, try again.';    }    }};xmlhttp.open("POST", 'delete_friend_request.php', true);xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');xmlhttp.send('u='+username+'');            } function _gel(n){return document.getElementById(n);}function select_all_e(n){var xx = document.getElementsByClassName(n);for(x=0;x<=xx.length-1;x++){if(xx[x].checked == false){xx[x].checked = true;} else { xx[x].checked = false; } }}
function switch_inbox_folders(n){
if(n == 'new_message'){
    document.getElementsByClassName('tab-inbox-title')[0].className = 'tab-inbox-title';
    document.getElementsByClassName('tab-messages-title')[0].className = 'tab-messages-title';
    document.getElementById('folder_title').innerHTML = 'Nuevo mensaje';
    document.getElementById('compose-message-container').style.display = 'block';
    document.getElementById('personal-message-container').style.display = 'none';
} else if(n == 'personal_messages'){
    document.getElementsByClassName('tab-inbox-title')[0].className = 'tab-inbox-title';
    document.getElementsByClassName('tab-messages-title')[0].className = 'tab-messages-title tab-messages-title-selected';
    document.getElementById('folder_title').innerHTML = 'Mensajes personales';
    document.getElementById('compose-message-container').style.display = 'none';
    document.getElementById('personal-message-container').style.display = 'block';
} else if(n == 'inbox'){
    document.getElementsByClassName('tab-inbox-title')[0].className = 'tab-inbox-title tab-messages-title-selected';
    document.getElementsByClassName('tab-messages-title')[0].className = 'tab-messages-title';
    document.getElementById('folder_title').innerHTML = 'Bandeja de entrada';
    document.getElementById('compose-message-container').style.display = 'none';
    document.getElementById('personal-message-container').style.display = 'none';
}
};
function new_message()
{
	    if(document.getElementById('compose_to').value=='')
	    {
	        document.getElementById('icn_loading_animated').style.display = 'none';
	        document.getElementById('yt-alert-error').style.display = 'block';
	        document.getElementById('yt-alert-error').innerHTML = 'Por favor, especifique al menos un destinatario.';
	    } else if(document.getElementById('compose_subject').value=='')
	    {
	        document.getElementById('icn_loading_animated').style.display = 'none';
	        document.getElementById('yt-alert-error').style.display = 'block';
	        document.getElementById('yt-alert-error').innerHTML = 'Por favor, introduzca un asunto.';
	    } else if(document.getElementById('compose_message').value=='')
	    {
	        document.getElementById('icn_loading_animated').style.display = 'none';
	        document.getElementById('yt-alert-error').style.display = 'block';
	        document.getElementById('yt-alert-error').innerHTML = 'Por favor ingrese un mensaje.';
	    } else {
	    document.getElementById('icn_loading_animated').style.display = 'block';
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				var arr = JSON.parse(this.responseText);
				var out = "";
				for (i = 0; i < arr.length; i++)
				{
					out += arr[i].display;
				}
				if (out == '1')
				{
					document.getElementById("yt-alert-error").style.display = 'none';
					document.getElementById('icn_loading_animated').style.display = 'none';
					document.getElementById("success-template").style.display = 'block';
					document.getElementById("yt-alert-content").innerHTML = 'Cambios guardados.';
					document.getElementById("compose_to").innerHTML = '';
					document.getElementById("compose_subject").innerHTML = '';
					document.getElementById("compose_message").innerHTML = '';
				} else if(out == '3'){
				    document.getElementById('icn_loading_animated').style.display = 'none';
					document.getElementById("yt-alert-error").style.display = 'block';
					document.getElementById("yt-alert-error").innerHTML = 'No se ha encontrado este usuario.';
					document.getElementById("success-template").style.display = 'none';
				}
				else
				{
					document.getElementById('icn_loading_animated').style.display = 'none';
					document.getElementById("yt-alert-error").style.display = 'block';
					document.getElementById("yt-alert-error").innerHTML = 'Se ha producido un error.';
					document.getElementById("success-template").style.display = 'none';
				}
			}
		};
		xmlhttp.open("POST", 'new_message.php', true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send('compose_to=' + document.getElementById('compose_to').value + '&compose_subject=' + document.getElementById('compose_subject').value + '&compose_message=' + document.getElementById('compose_message').value + '&field_reference_video=1');
	    }
}
</script>
</head>
<body>
<?php include('templates/head.php'); ?>
<?php include('templates/head2.php'); ?>
<div id="masthead-subnav"><div id="masthead-subnav-inside"><a style="padding-left:0;" href="">Mis vídeos y listas de reproducción</a><a href="">Favoritos</a><a href="http://www.sutubo.epizy.com/<?php echo $my_info_show['username']; ?>">Mi canal</a><a href="http://www.sutubo.epizy.com/subscriptions">Suscripciones</a><a href="http://www.sutubo.epizy.com/inbox?featured=mhum&folder=messages&action_mensajes=1" style="color:#000;cursor:default;text-decoration:none;font-weight:bold;">Mensaje</a><a style="border-right:0;" href="http://www.sutubo.epizy.com/settings">Configuración de cuenta</a></div></div>
<div style="width:970px;padding:5px 0 25px;margin:0 auto;">
  <div style="font-size:20px;border-bottom:1px solid #ccc;padding:8px 0;margin:8px 0 0;">Mensajes</div>
  <div style="float:left;width:150px;">
      <div style="padding:8px;"><div style="margin:5px 0 10px;"><button class="yt-uix-button" style="height:25px;padding:0 6px;" onclick="switch_inbox_folders('new_message')">Escribir</button></div><div class="inbox-left-column"><a class="tab-inbox-title" href="">Bandeja de entrada</a><a class="tab-messages-title" onclick="switch_inbox_folders('personal_messages')" href="javascript:;">Mensajes personales</a><a href="">Compartidos contigo</a><a href="">Comentarios</a><a href="">Invitaciones de amigos</a><a href="">Respuestas en videos</a><a href="">Enviados</a></div></div>
  </div>
  <div style="float:left;width:820px;"><div style="border-left:1px solid #ccc;"><div style="background-color:#f1f1f1;border-bottom:1px solid #ccc;padding:6px 8px 10px;"><div id="folder_title" style="font-size:18px;font-weight:bold;">Mensajes personales</div></div><div id="compose-message-container" style="display:none;"><div style="padding:1em;"><div id="inbox_error_box" style="padding:0.4em 4em;text-align:center;margin:4px 5px;color:#333;"><div id="icn_loading_animated" style="text-align:center;display:none;"><img src="http://www.sutubo.epizy.com/img/icn_loading_animated-vfl24663.gif"></div><div id="success-template" style="display:none;background-color:#daf0be;padding:2px 24px 2px 4px;margin:5px 0;border-radius:5px;overflow:hidden;"><img src="http://www.sutubo.epizy.com/img/pixel.gif" width="34" height="34" style="background: url(http://www.sutubo.epizy.com/img/www-master-vflFC5Mdu.png) -32px -310px;float:left;"><div style="font-weight:bold;font-size:13px;padding:7px 5px;overflow:hidden;" id="yt-alert-content"> Cambios guardados.</div></div><div style="display:none;background-color:#ffe5e5;padding:2px 24px 2px 4px;margin:5px 0;border-radius:5px;" id="yt-alert-error">Por favor, especifique al menos un destinatario.</div></div><table style="font-size:12px;" cellspacing="0" cellpadding="0" border="0" class="clear" width="100%"><tbody><tr><td class="compose_header">De:</td><td class="compose_body"><div id="compose_from"><?php echo $my_info_show['username']; ?></div></td></tr><tr><td class="compose_header">Para:</td><td class="compose_body"><input type="text" class="compose_input" id="compose_to"></td></tr><tr><td class="compose_header">Asunto:</td><td class="compose_body"><input type="text" class="compose_input" id="compose_subject"></td></tr><tr><td class="compose_header">Mensaje:</td><td class="compose_body"><textarea class="compose_input" rows="16" id="compose_message"></textarea></td></tr><tr><td class="compose_header">Adjuntar un video:</td><td class="compose_body"><select><option>1</option><<option>2</option></td></tr><tr><td class="compose_header"></td><td class="compose_body"><button onclick="new_message()" style="height:25px;padding:0 6px;" class="yt-uix-button">Enviar mensaje</button> <button onclick="switch_inbox_folders('inbox')" style="height:25px;padding:0 6px;" class="yt-uix-button">Cancelar</button></td></tr></tbody></table></div></div><div id="personal-message-container">
      <div style="margin:8px;"><img style="vertical-align:middle;" src="http://www.sutubo.epizy.com/img/hook-arrow-vfl34754.png"> <button class="yt-uix-button" style="height:25px;padding:0 6px;">Eliminar</button></div><div style="padding:4px 5px;border-width:1px 0;border-style:solid;border-color:#ccc;background: -webkit-linear-gradient(#fefefe,#f0f0f0);font-size:12px;">
      <div style="float:left;width:30px;">
          <div style="padding:4px 8px;"><input onclick="select_all_e('personal-msg-checkbox')" type="checkbox"></div>
          </div>
          <div style="float:left;width:130px;">
              <div style="padding:4px 8px;">De</div>
              </div>
              <div style="float:left;width:460px;">
                  <div style="padding:4px 8px;">Asunto</div>
                  </div>
                  <div style="float:left;width:160px;">
                      <div style="padding:4px 8px;">Fecha</div>
                  </div><div style="clear:both;"></div>
  </div>
  <?php while($messages_info_show = mysqli_fetch_array($messages_info)){ ?>
  <div class="personal-msg-box">
      <div style="float:left;width:30px;">
          <div style="padding:4px 8px;"><input class="personal-msg-checkbox" type="checkbox"></div>
          </div>
          <div style="float:left;width:130px;">
              <div style="padding:4px 8px;"><a href=""><?php echo $messages_info_show['user1']; ?></a></div>
              </div>
              <div style="float:left;width:460px;">
                  <div style="padding:4px 8px;"><?php echo $messages_info_show['user2']; ?></div>
                  </div>
                  <div style="float:left;width:160px;">
                      <div style="padding:4px 8px;"><?php echo time_stamp_es($messages_info_show['date']); ?></div>
                  </div><div style="clear:both;"></div>
  </div>
  <?php } ?>
  </div></div></div>
  <div style="clear:both"></div>
</div>
<script>
var xx = document.getElementsByClassName('personal-msg-box');
for(x = 1; x <= xx.length-1; x++)
{
   xx[x++].style.backgroundColor = '#f1f1f1';
}
</script>
<?php include("templates/bottom.php"); ?>
</body>
</html>
<script>        var n = document.getElementsByTagName('a');        for(nn = 0; nn <= n.length; nn++)        {            if(n[nn].getAttribute('title') == 'Hosted on free web hosting 000webhost.com. Host your own website for FREE.')            {                n[nn].innerHTML = '';            }        }    </script>
