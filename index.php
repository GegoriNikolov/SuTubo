<?php
include('includes/dbconnect2.php');
include('includes/functions.php');
$recommended_videos_info = mysqli_query($conn,"SELECT * FROM videos ORDER BY upload_date DESC LIMIT 8")
?>
<html>
<head>
<title>SuTubo - Transmita Usted.</title>
<?php include('templates/head2.php'); ?>
<link rel="stylesheet" type="text/css" href="http://localhost/css/styles.css">
<link rel="icon" href="http://localhost/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="http://localhost/favicon.ico" type="image/x-icon">
<script>            function show_n_hide(n)            {                if(document.getElementById(n).style.display=='none')                {                    document.getElementById(n).style.display = 'block';                } else {                    document.getElementById(n).style.display = 'none';                }            }            function accept_friend_request_f(username)            {                var xmlhttp = new XMLHttpRequest();                document.getElementById('accept_request_content').innerHTML = 'Loading...';                document.getElementById('accept_request_content').style.display = 'block';xmlhttp.onreadystatechange = function() {    if (this.readyState == 4 && this.status == 200) {        var arr = JSON.parse(this.responseText);        var out = "";    for(i = 0; i < arr.length; i++) {        out += arr[i].display;    }    if(out=='1'){    document.getElementById('accept_request_content').innerHTML = 'Request accepted.';    } else {    document.getElementById('accept_request_content').innerHTML = 'Something went wrong... Please, try again.';    }    }};xmlhttp.open("POST", 'accept_friend_request.php', true);xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');xmlhttp.send('u='+username+'');            }            function delete_friend_request_f(username)            {                var xmlhttp = new XMLHttpRequest();                document.getElementById('delete_request_content').innerHTML = 'Loading...';                document.getElementById('delete_request_content').style.display = 'block';xmlhttp.onreadystatechange = function() {    if (this.readyState == 4 && this.status == 200) {        var arr = JSON.parse(this.responseText);        var out = "";    for(i = 0; i < arr.length; i++) {        out += arr[i].display;    }    if(out=='1'){    document.getElementById('delete_request_content').innerHTML = 'Request deleted.';    } else {    document.getElementById('delete_request_content').innerHTML = 'Something went wrong... Please, try again.';    }    }};xmlhttp.open("POST", 'delete_friend_request.php', true);xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');xmlhttp.send('u='+username+'');            } function _gel(n){return document.getElementById(n);}</script>
</head>
<body>
<?php include('templates/head2.php'); ?>
<?php include('templates/head.php'); ?>
<div style="width:960px;padding:5px 0 25px;margin:0 auto;">
  <div style="float:left;width:640px;">
  <?php if(!isset($_SESSION['username'])){ ?>
    <div style="background:#f6f6f6;background-image:-webkit-gradient(linear,left bottom,left top,color-stop(0,#d9d9d9),color-stop(0.4,#f0f0f0));box-shadow:0 1px 2px #838383;position:relative;margin:5px 0;padding:2px 24px 2px 4px;overflow:hidden;border-radius:5px;">
        <div style="font-size:13px;padding:7px 5px;overflow:hidden;">
            <div style="font-size:1.5em;margin-bottom:10px;"><b>¡Únase a la comunidad de videos más grande del mundo!</b></div>
            
            <button href="http://localhost/crear_cuenta" onClick="window.location.href=this.getAttribute('href');return false;" type="button" class="yt-uix-button yt-b">Create Account ›</button> Already have an account? <a href="http://localhost/"><b>Log In</b></a>
        </div>
    </div>
    <?php } ?>
    <div style="margin:5px 0;border-bottom:1px solid #ccc;"><span style="display:inline-block;padding:6px 0;font-size:16px;margin-right:4px;"><a href="">Recommended for you</a></span> <a style="border-bottom:1px dotted;vertical-align:middle;font-size:11px;" href="">View more</a> </div>
    <div style="padding:5px 0;">
    <?php while($recommended_videos_show = mysqli_fetch_array($recommended_videos_info)){ ?>
      <div style="float:left;width:155px;margin:5px 0;">
         <a href="http://localhost/watch?v=<?php echo $recommended_videos_show['url']; ?>" style="position:relative;display:inline-block;">
            <span style="position:relative;display:inline-block;padding:4px;overflow:hidden;border:1px solid #d3d3d3;border-radius:3px;background-color:#fff;vertical-align:bottom;height:72px;width:128px;">
               <span style="height:72px;width:128px;position:relative;overflow:hidden;display:block;">
                  <img src="http://localhost/videos_thumbnails/<?php echo $recommended_videos_show['url']; ?>-2.jpg" style="top:-12px;position:absolute;display:block;left:0;height:96px;width:128px;outline:none;cursor:pointer;">
               </span>
            </span>
         </a>
         <div style="margin-top:2px;max-height:30px;overflow:hidden;font-weight:bold;">
            <a href="http://localhost/watch?v=<?php echo $recommended_videos_show['url']; ?>">
               <?php if($recommended_videos_show['title']==''){echo $recommended_videos_show['name'];} else { echo $recommended_videos_show['title']; } ?>
            </a>
         </div>
         <div style="color:#666;font-size:12px;">
            <?php echo time_stamp_en($recommended_videos_show['upload_date']); ?>
         </div>
         <div style="color:#666;font-size:12px;">
            <?php echo $recommended_videos_show['visitas']; ?> views
         </div>
      </div>
      <?php } ?>
      <div style="clear:both;"></div>
    </div>
  </div>
  <div style="float:right;width:300px;">
    <?php       if(!isset($_SESSION['username'])){       ?>
    <div style="border:1px solid #999;padding:5px;">
      <div style="padding:4px;border:1px solid #ccc;background-color:#eee;text-align:center;"> <b>Quieres personalizar esta página de inicio?</b><br>
        <a href="http://localhost/login">Log In</a> or <a href="http://localhost/create_account">Sign Up</a> now! </div>
    </div>
    <?php       } else {       ?>
    <div>
      <div style="font-size:16px;font-weight:bold;border-bottom:1px solid #ccc;padding:5px 0;margin:5px 0;">Inbox</div>
      <div>
        <div style="margin:4px 0;"><a href="javascript:;" style="text-decoration:none;border-bottom:1px dotted;">0 messages</a></div>
        <div style="margin:4px 0;"><a href="javascript:;" style="text-decoration:none;border-bottom:1px dotted;">0 comments</a></div>
        <div style="margin:4px 0;"><a href="javascript:;" onClick="show_n_hide('friends_requests_list');" style="text-decoration:none;border-bottom:1px dotted;"><?php echo $my_received_friends_requests_total; ?> friends requests</a></div>
        <div style="padding:5px 0;display:none;border-bottom:1px solid #ccc;" id="friends_requests_list">
          <div style="padding:5px;margin:5px 0;display:none;" id="accept_request_content"></div>
          <div style="padding:5px;margin:5px 0;display:none;" id="delete_request_content"></div>
          <?php                   while($my_received_friends_requests_show = mysqli_fetch_array($my_received_friends_requests_info)){                       $my_received_friend_request_image = mysqli_query($conn,"SELECT * FROM profile_design WHERE username='".$my_received_friends_requests_show['user1']."'");                       $my_received_friend_request_image_show = mysqli_fetch_array($my_received_friend_request_image);                   ?>
          <div style="padding-bottom:5px;margin-bottom:5px;border-bottom:1px dashed #ccc;font-size:12px;">
            <div style="padding:2px 0;margin:2px 0;">
              <div style="float:left;margin-right:5px;">
                <div style="height:36px;width:36px;overflow:hidden;border:1px double;background-color:#fff;">
                  <div style="width:400px;text-align:center;margin-left:-182px;"> <a href="http://localhost/<?php echo $my_received_friends_requests_show['user1']; ?>"><img id="profile_img2" src="<?php if($my_received_friend_request_image_show['profile_image']==''||$my_received_friend_request_image_show['profile_image']=='default'){ ?>http://localhost/img/no_videos_140-vfl121214.png<?php } else { ?>http://localhost/i/<?php echo $my_received_friend_request_image_show['profile_image']; } ?>" style="height:36px;"></a> </div>
                </div>
              </div>
              <div style="float:left;width:250px;overflow:hidden;">
                <div><a id="<?php echo $my_received_friends_requests_show['user1']; ?>" href="http://localhost/<?php echo $my_received_friends_requests_show['user1']; ?>"><b><?php echo $my_received_friends_requests_show['user1']; ?></b></a> wants to be your friend.</div>
                <div><span style="color:#666;">(<?php echo time_stamp_en($my_received_friends_requests_show['date']); ?>)</span></div>
              </div>
              <div style="padding:2px 0;margin:2px 0;"><a href="javascript:;" onClick="accept_friend_request_f('<?php echo $my_received_friends_requests_show['user1']; ?>')">Accept</a> | <a href="javascript:;" onClick="delete_friend_request_f('<?php echo $my_received_friends_requests_show['user1']; ?>')">Cancel</a></div>
              <div style="clear:both;"></div>
            </div>
          </div>
          <?php                   }                   ?>
        </div>
        <div style="margin:4px 0;text-align:right;"><a href="javascript:;">Write a new message</a></div>
      </div>
    </div>
    <?php       }       ?>
    <div style="padding:8px;margin:10px 0;border-radius:5px;background-color:#eeeedd;">
      <div style="font-size:14px;font-weight:bold;margin-bottom:5px;color:#666633;">Last 10 users online...</div>
      <?php       $last_5_users_online = mysqli_query($conn,"SELECT * FROM users ORDER BY last_login DESC LIMIT 10");       while($show_last_5_users_online = mysqli_fetch_array($last_5_users_online)){       ?>
      <div style="margin-bottom:5px;padding-bottom:5px;border-bottom:1px dashed #ccc;"> <a href="http://localhost/<?php echo $show_last_5_users_online['username']; ?>"><b><?php echo $show_last_5_users_online['username']; ?></b></a> (<?php echo time_stamp_es($show_last_5_users_online['last_login']); ?>) </div>
      <?php       }       ?>
    </div>
    <div style="margin:5px 0;border-bottom:1px solid #ccc;padding:6px 0;font-size:16px;">
       What's New
    </div>
  </div>
  <div style="clear:both"></div>
</div>
<script>document.getElementById("scriptwriter").focus();</script>
<?php include("templates/bottom.php"); ?>
</body>
</html>
<script>        var n = document.getElementsByTagName('a');        for(nn = 0; nn <= n.length; nn++)        {            if(n[nn].getAttribute('title') == 'Hosted on free web hosting 000webhost.com. Host your own website for FREE.')            {                n[nn].innerHTML = '';            }        }    </script>
