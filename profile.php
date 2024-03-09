<?php
include('includes/dbconnect2.php');
include('includes/functions.php');
$user_info = mysqli_query($conn,"SELECT * FROM users WHERE username='".$_GET['user']."'");
$user_info_show = mysqli_fetch_array($user_info);

$user_info2 = mysqli_query($conn,"SELECT * FROM users WHERE username='".$_GET['user']."'");
$user_total = mysqli_num_rows($user_info2);
if($user_total!==0){

$user_design_info = mysqli_query($conn,"SELECT * FROM profile_design WHERE username='".$user_info_show['username']."'");
$user_design_info_show = mysqli_fetch_array($user_design_info);
$user_comments_info = mysqli_query($conn,"SELECT * FROM profile_comments WHERE user2='".$user_info_show['username']."' ORDER BY date DESC LIMIT 10");
$user_comments_total = mysqli_num_rows($user_comments_info);
$user_comments_info2 = mysqli_query($conn,"SELECT * FROM profile_comments WHERE user2='".$user_info_show['username']."'");
$user_comments_total2 = mysqli_num_rows($user_comments_info2);

$user_subscribers_info = mysqli_query($conn,"SELECT * FROM profile_subscribers WHERE user2='".$user_info_show['username']."' LIMIT 18");
$user_subscribers_info2 = mysqli_query($conn,"SELECT * FROM profile_subscribers WHERE user2='".$user_info_show['username']."'");
$user_subscribers_total = mysqli_num_rows($user_subscribers_info);

$user_subscribers_infoo = mysqli_query($conn,"SELECT * FROM profile_subscribers WHERE user2='".$user_info_show['username']."'");
$user_subscribers_info_showw = mysqli_fetch_array($user_subscribers_infoo);
$user_subscribers_check1 = mysqli_query($conn,"SELECT * FROM profile_subscribers WHERE user2='".$user_info_show['username']."' AND user1='".$my_info_show['username']."'");
$user_subscribers_check1_total = mysqli_num_rows($user_subscribers_check1);

$user_subscriptions_info = mysqli_query($conn,"SELECT * FROM profile_subscribers WHERE user1='".$user_info_show['username']."' LIMIT 18");

$user_subscriptions_info2 = mysqli_query($conn,"SELECT * FROM profile_subscribers WHERE user1='".$user_info_show['username']."'");
$user_subscriptions_total2 = mysqli_num_rows($user_subscriptions_info2);

$user_videos = mysqli_query($conn,"SELECT * FROM videos WHERE username='".$user_info_show['username']."' ORDER BY upload_date DESC LIMIT 5");
$user_videoss = mysqli_query($conn,"SELECT * FROM videos WHERE username='".$user_info_show['username']."'ORDER BY upload_date DESC LIMIT 5");
$user_videos_show = mysqli_fetch_array($user_videos);
$user_videos_total = mysqli_num_rows($user_videos);
$my_friends_requests_info = mysqli_query($conn,"SELECT * FROM friends_requests WHERE user1='".$my_info_show['username']."'");
$my_friends_requests_info_show = mysqli_fetch_array($my_friends_requests_info);

$my_friends_info = mysqli_query($conn, "SELECT * FROM friends WHERE user2='".$my_info_show['username']."'");
$my_friends_total = mysqli_num_rows($my_friends_info);


$user_friends_info1 = mysqli_query($conn,"SELECT * FROM friends WHERE user2='".$user_info_show['username']."'");
$user_friends_info_show1 = mysqli_fetch_array($user_friends_info1);

$user_friends_info = mysqli_query($conn, "SELECT * FROM friends WHERE user1='".$user_friends_info_show1['user1']."' AND user2='".$user_info_show['username']."' OR user2='".$user_friends_info_show1['user2']."' LIMIT 18");
$user_friends_total = mysqli_num_rows($user_friends_info);
$user_friends_info2 = mysqli_query($conn, "SELECT * FROM friends WHERE user1='".$user_friends_info_show1['user1']."' AND user2='".$user_info_show['username']."' OR user2='".$user_friends_info_show1['user2']."' LIMIT 18");
$user_friends_info3 = mysqli_query($conn,"SELECT * FROM friends WHERE user1='".$user_friends_info_show1['user1']."' AND user2='".$user_info_show['username']."' OR user2='".$user_friends_info_show1['user2']."'");
$user_friends_total3 = mysqli_num_rows($user_friends_info3);

$my_friends_info2 = mysqli_query($conn, "SELECT * FROM friends WHERE user1='".$user_info_show['username']."' AND user2='".$my_info_show['username']."'");
$my_friends_check = mysqli_num_rows($my_friends_info2);

?>
<html>
    <head>
        
        <title>SuTubo - Canal de <?php echo $user_info_show['username']; ?></title>
        
        <link rel="stylesheet" type="text/css" href="http://localhost/css/styles.css">
    <link rel="icon" href="http://localhost/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://localhost/favicon.ico" type="image/x-icon">
        
        <script>
        var username = '<?php echo $user_info_show['username']; ?>';
            function post_comment()
            {
                if(document.getElementById('comment_box').value.length > 0){
                document.getElementById('comment_box_txt').style.display = 'block';
                document.getElementById('comment_box_txt').innerHTML = 'Loading...';
                var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr = JSON.parse(this.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out!=='2'){
        
    let node = document.createElement('div');
    
  node.innerHTML = '<div style="padding-bottom:10px;"><div style="float:left;margin-right:10px;"><div style="height:46px;width:46px;overflow:hidden;background-color:#fff;"><div style="width:400px;text-align:center;margin-left:-177px;background-color:#fff;"><a href="http://localhost/<?php echo $my_info_show['username']; ?>"><img src="<?php if($comment_image_info_show['profile_image']==''||$comment_image_info_show['profile_image']=='default'){ ?>http://localhost/img/no_videos_140-vfl121214.png<?php } else { ?>http://localhost/pi/<?php echo $comment_image_info_show['profile_image']; } ?>" style="height:46px;"></a></div></div></div><div style="float:left;"><a href="http://localhost/<?php echo $my_info_show['username']; ?>"><b><?php echo $my_info_show['username']; ?></b></a> (0 seconds ago)</div><div style="text-align:right;"><a href="javascript:;">Delete</a> &nbsp;</div><div style="margin-top:5px;" class="c6">'+document.getElementById('comment_box').value+'</div><div style="clear:both;"></div></div>';
  
  var list = document.getElementById('new_comment_list');
  list.insertBefore(node, list.childNodes[0]);
    
    document.getElementById('comment_box_txt').innerHTML = '';
    document.getElementById('comment_box_txt').style.display = 'none';
    } else {
    document.getElementById('comment_box_txt').innerHTML = '<?php echo $please_check_every_field_and_try_again; ?>';
    }
    }
};
xmlhttp.open("POST", 'profile_comment.php', true);
xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xmlhttp.send('c='+document.getElementById('comment_box').value+'&u='+username+'');
} else {
    document.getElementById('comment_box_txt').innerHTML = 'Please, insert a comment.';
}
            }
   function s_h(n){
      if(document.getElementById(n).style.display=='none')
      {
          document.getElementById(n).style.display='block';
      } else {
          document.getElementById(n).style.display='none';
      }
   }
   function save_profile_design()
   {
          var xmlhttp = new XMLHttpRequest();

          xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          var arr = JSON.parse(this.responseText);
          var out = "";
          for(i = 0; i < arr.length; i++) {
             out += arr[i].display;
          }
          if(out=='1'){
             document.getElementById('save_changes_box').innerHTML = 'Changes saved.';
          } else {
             document.getElementById('save_changes_box').innerHTML = '<?php echo $please_check_every_field_and_try_again; ?>';
          }
          }
          };
          xmlhttp.open("POST", 'save_profile_design.php', true);
          xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xmlhttp.send('background_color='+document.getElementById('background_color').value+'&wrapper_color='+document.getElementById('wrapper_color').value+'&inner_color='+document.getElementById('inner_color').value+'&links_color='+document.getElementById('links_color').value+'&font='+document.getElementById('font').value+'&title_color='+document.getElementById('title_color').value+'&text_color='+document.getElementById('text_color').value+'&background_image='+document.getElementById('background_image').value+'&profile_image='+document.getElementById('profile_image_hidden').value+'&wrapper_box_opacity='+document.getElementById('wrapper_box_opacity').getAttribute('rgba')+'&inner_box_opacity='+document.getElementById('inner_box_opacity').getAttribute('rgba')+'');
   }
   function save_profile_info()
   {
          var xmlhttp = new XMLHttpRequest();

          xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          var arr = JSON.parse(this.responseText);
          var out = "";
          for(i = 0; i < arr.length; i++) {
             out += arr[i].display;
          }
          if(out=='1'){
             document.getElementById('save_changes_info_box').style.display = 'block';
             document.getElementById('save_changes_info_box').innerHTML = 'Changes saved.';
          } else {
             document.getElementById('save_changes_info_box').innerHTML = '<?php echo $please_check_every_field_and_try_again; ?>';
          }
          }
          };
          xmlhttp.open("POST", 'save_profile_info.php', true);
          xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xmlhttp.send('c_name='+document.getElementById('c_name').getAttribute('check_mode')+'&c_last_sign_in='+document.getElementById('c_last_sign_in').getAttribute('check_mode')+'&c_subscribers='+document.getElementById('c_subscribers').getAttribute('check_mode')+'&c_about='+document.getElementById('c_about').getAttribute('check_mode')+'&c_country='+document.getElementById('c_country').getAttribute('check_mode')+'&c_name_info='+document.getElementById('c_name_info').value+'&c_about_info='+document.getElementById('c_about_info').value+'&c_country_info='+document.getElementById('c_country_info').value+'');
   }
            function subscribe_f()
            {
                var xmlhttp = new XMLHttpRequest();
                document.getElementById('subscribe_btn').innerHTML = '<b>Subscribed</b>';
                document.getElementById('subscribe_btn').setAttribute('onclick','unsubscribe_f()');

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr = JSON.parse(this.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out=='1'){
    document.getElementById('subscribe_btn').innerHTML = '<b>Subscribed</b>';
    document.getElementById('subscribe_btn').setAttribute('onclick','unsubscribe_f()');
    document.getElementById('subscribe_btn').className = 'mb mb_g_b';
    } else {
    document.getElementById('subscribe_btn').innerHTML = '<b>Subscribe</b>';
    document.getElementById('subscribe_btn').setAttribute('onclick','subscribe_f()');
    }
    }
};
xmlhttp.open("POST", 'subscribe_file.php', true);
xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xmlhttp.send('u='+username+'');
            }
            function unsubscribe_f()
            {
                var xmlhttp = new XMLHttpRequest();
                document.getElementById('subscribe_btn').innerHTML = '<b>Subscribe</b>';
                document.getElementById('subscribe_btn').setAttribute('onclick','subscribe_f()');

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr = JSON.parse(this.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out=='1'){
    document.getElementById('subscribe_btn').innerHTML = '<b>Subscribe</b>';
    document.getElementById('subscribe_btn').setAttribute('onclick','subscribe_f()');
    document.getElementById('subscribe_btn').className = 'mb mb_g_y';
    } else {
    document.getElementById('subscribe_btn').innerHTML = '<b>Subscribed</b>';
    document.getElementById('subscribe_btn').setAttribute('onclick','unsubscribe_f()');
    }
    }
};
xmlhttp.open("POST", 'unsubscribe_file.php', true);
xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xmlhttp.send('u='+username+'');
            }
            function add_as_friend_f()
            {
                var xmlhttp = new XMLHttpRequest();
                document.getElementById('add_as_friend_btn').innerHTML = 'Cancel friend request';
                document.getElementById('add_as_friend_btn').setAttribute('onclick','delete_friend_request_f()');

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr = JSON.parse(this.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out=='1'){
    document.getElementById('add_as_friend_btn').innerHTML = 'Cancel friend request';
    document.getElementById('add_as_friend_btn').setAttribute('onclick','delete_friend_request_f()');
    } else {
    document.getElementById('add_as_friend_btn').innerHTML = 'Add as Friend';
    document.getElementById('add_as_friend_btn').setAttribute('onclick','add_as_friend_f()');
    }
    }
};
xmlhttp.open("POST", 'friends_requests_file.php', true);
xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xmlhttp.send('u='+username+'');
            }
            function delete_friend_request_f()
            {
                var xmlhttp = new XMLHttpRequest();
                document.getElementById('add_as_friend_btn').innerHTML = 'Add as Friend';
                document.getElementById('add_as_friend_btn').setAttribute('onclick','add_as_friend_f()');

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr = JSON.parse(this.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out=='1'){
    document.getElementById('add_as_friend_btn').innerHTML = 'Add as Friend';
    document.getElementById('add_as_friend_btn').setAttribute('onclick','add_as_friend_f()');
    } else {
    document.getElementById('add_as_friend_btn').innerHTML = 'Cancel friend request';
    document.getElementById('add_as_friend_btn').setAttribute('onclick','delete_friend_request()');
    }
    }
};
xmlhttp.open("POST", 'delete_friend_request_file.php', true);
xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xmlhttp.send('u='+username+'');
            }
            function delete_friend_f()
            {
                var xmlhttp = new XMLHttpRequest();
                document.getElementById('add_as_friend_btn').innerHTML = 'Add as Friend';
                document.getElementById('add_as_friend_btn').setAttribute('onclick','add_as_friend_f()');

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr = JSON.parse(this.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out=='1'){
    document.getElementById('add_as_friend_btn').innerHTML = 'Add as Friend';
    document.getElementById('add_as_friend_btn').setAttribute('onclick','add_as_friend_f()');
    } else {
    document.getElementById('add_as_friend_btn').innerHTML = 'Delete Friend';
    document.getElementById('add_as_friend_btn').setAttribute('onclick','delete_friend()');
    }
    }
};
xmlhttp.open("POST", 'delete_friend_file.php', true);
xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xmlhttp.send('u='+username+'');
            }
            function delete_background()
            {
                var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr = JSON.parse(this.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out=='1'){
    document.getElementById('save_changes_box').innerHTML = 'Background removed.';
    } else {
    document.getElementById('save_changes_box').innerHTML = '<?php echo $please_check_every_field_and_try_again; ?>';
    }
    }
};
xmlhttp.open("POST", 'delete_background_image.php', true);
xmlhttp.send();
            }
            function delete_channel_comment(url,u)
            {
                var xmlhttp = new XMLHttpRequest();
                document.getElementById(url).style.display='none';

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr = JSON.parse(this.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out=='1'){
    document.getElementById('comment_box_txt').innerHTML = 'Comment removed.';
    } else {
    document.getElementById('comment_box_txt').innerHTML = '<?php echo $please_check_every_field_and_try_again; ?>';
    }
    }
};
xmlhttp.open("POST", 'delete_channel_comment.php', true);
xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xmlhttp.send('v_u='+url+'&username='+u+'');
            }
            function delete_profile_image()
            {
                var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr = JSON.parse(this.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out=='1'){
    document.getElementById('save_changes_box').innerHTML = 'Profile image removed.';
    } else {
    document.getElementById('save_changes_box').innerHTML = '<?php echo $please_check_every_field_and_try_again; ?>';
    }
    }
};
xmlhttp.open("POST", 'delete_profile_image.php', true);
xmlhttp.send();
            }
            function pagination(n)
            {
                document.getElementById('comment_box_txt').style.display = 'block';
                document.getElementById('comment_box_txt').innerHTML = 'Loading...';
                var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var arr = JSON.parse(this.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += '<div style="padding-bottom:10px;" id="'+arr[i].c_comment_url+'"><div style="float:left;margin-right:10px;"><div style="height:46px;width:46px;overflow:hidden;background-color:#fff;"><div style="width:400px;text-align:center;margin-left:-177px;background-color:#fff;"><a href="http://localhost/'+arr[i].c_user1+'"><img src="http://localhost/pi/'+arr[i].c_image+'" style="height:46px;"></a></div></div></div><div style="float:left;"><a href="http://localhost/'+arr[i].c_user1+'"><b>'+arr[i].c_user1+'</b></a> '+arr[i].c_date+'</div><div style="text-align:right;">&nbsp;</div><div style="margin-top:5px;overflow:hidden;" class="c6">'+arr[i].c_comment+'</div><div style="clear:both;"></div></div>';
    }
    document.getElementById('comments_pagination_box').style.display = 'block';
    document.getElementById('comment_box_txt').style.display = 'none';
    document.getElementById('actual_comment_list').style.display = 'none';
    document.getElementById('comments_pagination_box').innerHTML = out;
    }
};
xmlhttp.open("POST", 'channel_comments_pagination2.php', true);
xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xmlhttp.send('n='+n+'&u='+username+'');
            }
            function change_b_color(n,c){
                var x = document.getElementsByClassName(n);
                
                for (i = 0; i < x.length; i++) {
                  if(n=='c4'){
                  x[i].style.color = c;
                  document.getElementById('c4_l').style.backgroundColor = c;
                  } else if(n=='c5') {
                  x[i].style.color = c;
                  document.getElementById('c5_l').style.backgroundColor = c;
                  } else if(n=='c6') {
                  x[i].style.color = c;
                  document.getElementById('c6_l').style.backgroundColor = c;
                  } else {
                  x[i].style.backgroundColor = c;
                  }
                }
                
                if(n=='c1')
                {
                    document.getElementById('background_color').value = c;
                } else if(n=='c2')
                {
                    document.getElementById('wrapper_color').value = c;
                    document.getElementById('right_arrow').style.borderLeftColor = c;
                } else if(n=='c3')
                {
                    document.getElementById('inner_color').value = c;
                } else if(n=='c4')
                {
                    document.getElementById('links_color').value = c;
                } else if(n=='c5')
                {
                    document.getElementById('title_color').value = c;
                } else if(n=='c6')
                {
                    document.getElementById('text_color').value = c;
                }
            }
            function change_color(n,c){
                var x = document.getElementsByClassName(n);
                var i;
                for (i = 0; i < x.length; i++) {
                  x[i].style.color = c;
                }
            }
            function sh(n)
{
   var x = document.getElementsByClassName('channel_tab_box');
   for(xx = 0; xx < x.length; xx++)
   {	 
	   if(x[xx].getAttribute('id')==n){
	      document.getElementById(n).className = 'channel_tab_box channel_tab_active';
	      document.getElementById(n).setAttribute('onclick','sh_b(\''+n+'\')');
	      document.getElementById(n+'_box').style.display = 'block';
	   } else {
	      x[xx].className = 'channel_tab_box channel_tab_normal';
	      x[xx].setAttribute('onclick','sh(\''+x[xx].getAttribute('id')+'\')');
	      document.getElementById(x[xx].getAttribute('id')+'_box').style.display = 'none';
	   }
	   
   }
}
function change_font(n,c){
    document.getElementById(n).style.fontFamily = c;
}
function sh_b(n)
{
   document.getElementById(n).className = 'channel_tab_box channel_tab_normal';
   document.getElementById(n+'_box').style.display = 'none';
   document.getElementById(n).setAttribute('onclick','sh(\''+n+'\')');
}
function show_n_hide_class(n)
{
   var c = document.getElementsByClassName(n);
   for(x = 0; x < c.length; x++)
   {	 
	  if(c[x].style.display=='none')
	  {
	  c[x].style.display="block";
	  } else {
	  c[x].style.display="none";
	  }
   }
}
function uploadFile(event){

	document.getElementById('save_changes_box').style.display = 'block';
	document.getElementById('save_changes_box').innerHTML = 'Loading...';
	
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('channel_body');
      output.style.backgroundImage = 'url('+reader.result+')';
    };
    reader.readAsDataURL(event.target.files[0]);
	
	var file = document.getElementById('file1').files[0];

	var formdata = new FormData();
	
	formdata.append("file1", file);

	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
    if (ajax.readyState == 4 && ajax.status == 200) {
        var arr = JSON.parse(ajax.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out!=='2'){
    document.getElementById('background_image').value = out;
    document.getElementById('save_changes_box').style.display = 'none';
    document.getElementById('save_changes_box').value = '';
    } else {
    document.getElementById('background_image').value = '';
    }
    }
};
	ajax.open("POST", "save_background_image.php");
	ajax.send(formdata);
}
function uploadFile2(event){

	document.getElementById('save_changes_box').style.display = 'block';
	document.getElementById('save_changes_box').innerHTML = 'Loading your profile image, please wait...';
	
	var file = document.getElementById('file2').files[0];

	var formdata = new FormData();
	
	formdata.append("file2", file);

	var ajax = new XMLHttpRequest();
	ajax.onreadystatechange = function() {
    if (ajax.readyState == 4 && ajax.status == 200) {
        var arr = JSON.parse(ajax.responseText);
        var out = "";
    for(i = 0; i < arr.length; i++) {
        out += arr[i].display;
    }
    if(out!=='2'){
    document.getElementById('profile_image_hidden').value = out;
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('profile_img');
      output.src = reader.result;
      var output2 = document.getElementById('profile_img2');
      output2.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
    document.getElementById('save_changes_box').style.display = 'none';
    document.getElementById('save_changes_box').value = '';
    } else {
    document.getElementById('profile_image_box').value = '';
    }
    }
};
	ajax.open("POST", "save_profile_image.php");
	ajax.send(formdata);
}
function hexToRGB(h,o) {
  let r = 0, g = 0, b = 0;

  if (h.length == 4) {
    r = "0x" + h[1] + h[1];
    g = "0x" + h[2] + h[2];
    b = "0x" + h[3] + h[3];

  } else if (h.length == 7) {
    r = "0x" + h[1] + h[2];
    g = "0x" + h[3] + h[4];
    b = "0x" + h[5] + h[6];
  }
  
  return "rgba("+ +r + "," + +g + "," + +b + "," + +o + ")";
}
function change_wrapper_opacity(o)
{
    document.getElementById('wrapper_box').style.backgroundColor = hexToRGB(document.getElementById('wrapper_color').value,o);
    document.getElementById('wrapper_box2').style.backgroundColor = hexToRGB(document.getElementById('wrapper_color').value,o);
    document.getElementById('wrapper_box_opacity').setAttribute('rgba',hexToRGB(document.getElementById('wrapper_color').value,o));
}
function change_inner_box_opacity(o)
{
    var div_name = document.getElementsByClassName('inner-box');
    for(xx=0; xx < div_name.length; xx++){
        div_name[xx].style.backgroundColor = hexToRGB(document.getElementById('inner_color').value,o);
    }
    document.getElementById('inner_box_opacity').setAttribute('rgba',hexToRGB(document.getElementById('inner_color').value,o));
}
        </script>
    <style>.channel_body a{color:<?php echo $user_design_info_show['links_color']; ?>;}.inner-box{<?php if(strpos($user_design_info_show['inner_box_opacity']==',0)') || $user_design_info_show['inner_box_opacity']==''){ ?>background-color:<?php echo $user_design_info_show['inner_color']; ?>;<?php } else { echo "background:".$user_design_info_show['inner_box_opacity']; } ?>}.c6{color:<?php echo $user_design_info_show['text_color']; ?>}</style>    
    </head>
    <body>
        <?php include('templates/head2.php'); ?>
<?php include('templates/head.php'); ?>
        <div id="save_changes_box"></div>
        <?php if(isset($_SESSION['username']) && $user_info_show['username'] == $my_info_show['username']){ ?><div style="border-top:2px solid <?php echo $user_design_info_show['wrapper_color']; ?>;background-color:#efefef;">
            <div style="width:960px;padding:5px;margin:0 auto;">
            <div style="float:left;border-bottom:0;margin-right:10px;" id="post_bulletin" class="channel_tab_box channel_tab_normal" onClick="sh('post_bulletin')">
                Post bulletin
            </div>
            <div style="float:left;border-bottom:0;" id="settings" class="channel_tab_box channel_tab_normal hidded" onClick="sh('settings')">
                Settings
            </div>
            <div style="float:left;border-left:0;border-bottom:0;" id="themes_and_colors" class="channel_tab_box channel_tab_normal hidded" onClick="sh('themes_and_colors')">
                Themes and colors
            </div>
            <div style="float:left;border-left:0;border-bottom:0;" id="modules" class="channel_tab_box channel_tab_normal hidded" onClick="sh('modules')">
                Modules
            </div>
            <div style="float:left;border-left:0;border-bottom:0;" id="videos_and_playlists" class="channel_tab_box channel_tab_normal hidded" onClick="sh('videos_and_playlists')">
                Videos and playlists
            </div>
            <div style="clear:both"></div>
            <div id="post_bulletin_box" class="hidded" style="display:none;border:1px solid #aaa;background-color:#fff;padding:8px;"></div>
            <div id="settings_box" class="hidded" style="display:none;border:1px solid #aaa;background-color:#fff;padding:8px;"></div>
            <div id="themes_and_colors_box" class="hidded" style="display:none;border:1px solid #aaa;background-color:#fff;padding:11px;">
                <div style="float:left;width:400px;">
                    <div style="border-bottom:1px dotted #aaa;margin:4px 0;padding:4px 0;">
                        <div style="float:left;">
                            Font:
                        </div>
                        <div style="float:right;"><select id="font" onChange="change_font('channel_body', this.value);">
                        <option value="Times New Roman" <?php if($user_design_info_show['font']=='Times New Roman'){ ?>Selected<?php } ?>>Times New Roman</option>
                        <option value="Arial" <?php if($user_design_info_show['font']=='Arial'){ ?>Selected<?php } ?>>Arial</option>
                        <option value="Verdana" <?php if($user_design_info_show['font']=='Verdana'){ ?>Selected<?php } ?>>Verdana</option>
                        <option value="Georgia" <?php if($user_design_info_show['font']=='Georgia'){ ?>Selected<?php } ?>>Georgia</option>
                        <option value="Courier New" <?php if($user_design_info_show['font']=='Courier New'){ ?>Selected<?php } ?>>Courier New</option>
                        </select>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <div style="border-bottom:1px dotted #aaa;margin:4px 0;padding:4px 0;">
                    <div style="float:left;">Background color</div>
                    <div style="float:right;"><span onClick="show_n_hide_class('color_picker')" style="cursor:pointer;position:relative;border:1px solid #ccc;display:inline-block;vertical-align:middle;padding:2px;margin-right:2px;width:13px;height:13px;"><span class="c1" style="display:inline-block;width:13px;height:13px;background-color:<?php echo $user_design_info_show['background_color']; ?>"><span class="color_picker" style="z-index:1000;display:none;position:absolute;background-color:#fff;padding:2px;border:1px solid #ccc;top:100%;width:160px;"> <span onClick="change_b_color('c1','#000000')" style="display:inline-block;background-color:#000000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#444444')" style="display:inline-block;background-color:#444444;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#666666')" style="display:inline-block;background-color:#666666;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#999999')" style="display:inline-block;background-color:#999999;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#CCCCCC')" style="display:inline-block;background-color:#CCCCCC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#EEEEEE')" style="display:inline-block;background-color:#EEEEEE;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#F3F3F3')" style="display:inline-block;background-color:#F3F3F3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#FFFFFF')" style="display:inline-block;background-color:#FFFFFF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#FF0000')" style="display:inline-block;background-color:#FF0000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#FF9900')" style="display:inline-block;background-color:#FF9900;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#FFFF00')" style="display:inline-block;background-color:#FFFF00;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#00FF00')" style="display:inline-block;background-color:#00FF00;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#00FFFF')" style="display:inline-block;background-color:#00FFFF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#0000FF')" style="display:inline-block;background-color:#0000FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#9900FF')" style="display:inline-block;background-color:#9900FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#FF00FF')" style="display:inline-block;background-color:#FF00FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#FFCCCC')" style="display:inline-block;background-color:#FFCCCC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#FCE5CD')" style="display:inline-block;background-color:#FCE5CD;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#FFF2CC')" style="display:inline-block;background-color:#FFF2CC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#D9EAD3')" style="display:inline-block;background-color:#D9EAD3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#D0E0E3')" style="display:inline-block;background-color:#D0E0E3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#CFE2F3')" style="display:inline-block;background-color:#CFE2F3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#D9D2E9')" style="display:inline-block;background-color:#D9D2E9;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#EAD1DC')" style="display:inline-block;background-color:#EAD1DC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#EA9999')" style="display:inline-block;background-color:#EA9999;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#F9CB9C')" style="display:inline-block;background-color:#F9CB9C;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#FFE599')" style="display:inline-block;background-color:#FFE599;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#B6D7A8')" style="display:inline-block;background-color:#B6D7A8;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#A2C4C9')" style="display:inline-block;background-color:#A2C4C9;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#9FC5E8')" style="display:inline-block;background-color:#9FC5E8;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#B4A7D6')" style="display:inline-block;background-color:#B4A7D6;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#D5A6BD')" style="display:inline-block;background-color:#D5A6BD;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#E06666')" style="display:inline-block;background-color:#E06666;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#F6B26B')" style="display:inline-block;background-color:#F6B26B;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#FFD966')" style="display:inline-block;background-color:#FFD966;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#93C47D')" style="display:inline-block;background-color:#93C47D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#76A5AF')" style="display:inline-block;background-color:#76A5AF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#6FA8DC')" style="display:inline-block;background-color:#6FA8DC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#8E7CC3')" style="display:inline-block;background-color:#8E7CC3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#C27BA0')" style="display:inline-block;background-color:#C27BA0;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#CC0000')" style="display:inline-block;background-color:#CC0000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#E69138')" style="display:inline-block;background-color:#E69138;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#F1C232')" style="display:inline-block;background-color:#F1C232;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#6AA84F')" style="display:inline-block;background-color:#6AA84F;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#45818E')" style="display:inline-block;background-color:#45818E;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#3D85C6')" style="display:inline-block;background-color:#3D85C6;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#674EA7')" style="display:inline-block;background-color:#674EA7;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#A64D79')" style="display:inline-block;background-color:#A64D79;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#990000')" style="display:inline-block;background-color:#990000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#B45F06')" style="display:inline-block;background-color:#B45F06;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#BF9000')" style="display:inline-block;background-color:#BF9000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#38761D')" style="display:inline-block;background-color:#38761D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#134F5C')" style="display:inline-block;background-color:#134F5C;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#0B5394')" style="display:inline-block;background-color:#0B5394;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#351C75')" style="display:inline-block;background-color:#351C75;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#741B47')" style="display:inline-block;background-color:#741B47;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#660000')" style="display:inline-block;background-color:#660000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#783F04')" style="display:inline-block;background-color:#783F04;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#7F6000')" style="display:inline-block;background-color:#7F6000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#274E13')" style="display:inline-block;background-color:#274E13;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#0C343D')" style="display:inline-block;background-color:#0C343D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#073763')" style="display:inline-block;background-color:#073763;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#20124D')" style="display:inline-block;background-color:#20124D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c1','#4C1130')" style="display:inline-block;background-color:#4C1130;margin:2px;width:12px;height:12px;cursor:pointer;"></span> </span> </span></span><input id="background_color" onKeyUp="change_b_color('c1',this.value)" type="text" style="width:50px;font-size:11px;" value="<?php echo $user_design_info_show['background_color']; ?>"></div>
                    <div style="clear:both;"></div>
                </div>
                <div style="border-bottom:1px dotted #aaa;margin:4px 0;padding:4px 0;">
                    <div style="float:left;">Wrapper color</div>
                    <div style="float:right;"><span onClick="show_n_hide_class('color_picker2')" style="cursor:pointer;position:relative;border:1px solid #ccc;display:inline-block;vertical-align:middle;padding:2px;margin-right:2px;width:13px;height:13px;"><span class="c2" style="display:inline-block;width:13px;height:13px;background-color:<?php echo $user_design_info_show['wrapper_color']; ?>"><span class="color_picker2" style="z-index:1000;display:none;position:absolute;background-color:#fff;padding:2px;border:1px solid #ccc;top:100%;width:160px;"> <span onClick="change_b_color('c2','#000000')" style="display:inline-block;background-color:#000000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#444444')" style="display:inline-block;background-color:#444444;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#666666')" style="display:inline-block;background-color:#666666;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#999999')" style="display:inline-block;background-color:#999999;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#CCCCCC')" style="display:inline-block;background-color:#CCCCCC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#EEEEEE')" style="display:inline-block;background-color:#EEEEEE;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#F3F3F3')" style="display:inline-block;background-color:#F3F3F3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#FFFFFF')" style="display:inline-block;background-color:#FFFFFF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#FF0000')" style="display:inline-block;background-color:#FF0000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#FF9900')" style="display:inline-block;background-color:#FF9900;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#FFFF00')" style="display:inline-block;background-color:#FFFF00;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#00FF00')" style="display:inline-block;background-color:#00FF00;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#00FFFF')" style="display:inline-block;background-color:#00FFFF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#0000FF')" style="display:inline-block;background-color:#0000FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#9900FF')" style="display:inline-block;background-color:#9900FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#FF00FF')" style="display:inline-block;background-color:#FF00FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#FFCCCC')" style="display:inline-block;background-color:#FFCCCC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#FCE5CD')" style="display:inline-block;background-color:#FCE5CD;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#FFF2CC')" style="display:inline-block;background-color:#FFF2CC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#D9EAD3')" style="display:inline-block;background-color:#D9EAD3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#D0E0E3')" style="display:inline-block;background-color:#D0E0E3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#CFE2F3')" style="display:inline-block;background-color:#CFE2F3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#D9D2E9')" style="display:inline-block;background-color:#D9D2E9;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#EAD1DC')" style="display:inline-block;background-color:#EAD1DC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#EA9999')" style="display:inline-block;background-color:#EA9999;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#F9CB9C')" style="display:inline-block;background-color:#F9CB9C;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#FFE599')" style="display:inline-block;background-color:#FFE599;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#B6D7A8')" style="display:inline-block;background-color:#B6D7A8;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#A2C4C9')" style="display:inline-block;background-color:#A2C4C9;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#9FC5E8')" style="display:inline-block;background-color:#9FC5E8;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#B4A7D6')" style="display:inline-block;background-color:#B4A7D6;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#D5A6BD')" style="display:inline-block;background-color:#D5A6BD;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#E06666')" style="display:inline-block;background-color:#E06666;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#F6B26B')" style="display:inline-block;background-color:#F6B26B;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#FFD966')" style="display:inline-block;background-color:#FFD966;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#93C47D')" style="display:inline-block;background-color:#93C47D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#76A5AF')" style="display:inline-block;background-color:#76A5AF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#6FA8DC')" style="display:inline-block;background-color:#6FA8DC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#8E7CC3')" style="display:inline-block;background-color:#8E7CC3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#C27BA0')" style="display:inline-block;background-color:#C27BA0;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#CC0000')" style="display:inline-block;background-color:#CC0000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#E69138')" style="display:inline-block;background-color:#E69138;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#F1C232')" style="display:inline-block;background-color:#F1C232;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#6AA84F')" style="display:inline-block;background-color:#6AA84F;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#45818E')" style="display:inline-block;background-color:#45818E;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#3D85C6')" style="display:inline-block;background-color:#3D85C6;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#674EA7')" style="display:inline-block;background-color:#674EA7;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#A64D79')" style="display:inline-block;background-color:#A64D79;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#990000')" style="display:inline-block;background-color:#990000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#B45F06')" style="display:inline-block;background-color:#B45F06;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#BF9000')" style="display:inline-block;background-color:#BF9000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#38761D')" style="display:inline-block;background-color:#38761D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#134F5C')" style="display:inline-block;background-color:#134F5C;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#0B5394')" style="display:inline-block;background-color:#0B5394;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#351C75')" style="display:inline-block;background-color:#351C75;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#741B47')" style="display:inline-block;background-color:#741B47;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#660000')" style="display:inline-block;background-color:#660000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#783F04')" style="display:inline-block;background-color:#783F04;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#7F6000')" style="display:inline-block;background-color:#7F6000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#274E13')" style="display:inline-block;background-color:#274E13;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#0C343D')" style="display:inline-block;background-color:#0C343D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#073763')" style="display:inline-block;background-color:#073763;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#20124D')" style="display:inline-block;background-color:#20124D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c2','#4C1130')" style="display:inline-block;background-color:#4C1130;margin:2px;width:12px;height:12px;cursor:pointer;"></span> </span> </span></span><input id="wrapper_color" onKeyUp="change_b_color('c2',this.value)" type="text" style="width:50px;font-size:11px;" value="<?php echo $user_design_info_show['wrapper_color']; ?>"></div>
                    <div style="clear:both;"></div>
                </div>
                <div style="border-bottom:1px dotted #aaa;margin:2px 0;padding:2px 0;">
                    <div style="float:left;">Inside box color</div>
                    <div style="float:right;"><span onClick="show_n_hide_class('color_picker3')" style="cursor:pointer;position:relative;border:1px solid #ccc;display:inline-block;vertical-align:middle;padding:2px;margin-right:2px;width:13px;height:13px;"><span class="c3" style="display:inline-block;width:13px;height:13px;background-color:<?php echo $user_design_info_show['inner_color']; ?>"><span class="color_picker3" style="z-index:1000;display:none;position:absolute;background-color:#fff;padding:2px;border:1px solid #ccc;top:100%;width:160px;"> <span onClick="change_b_color('c3','#000000')" style="display:inline-block;background-color:#000000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#444444')" style="display:inline-block;background-color:#444444;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#666666')" style="display:inline-block;background-color:#666666;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#999999')" style="display:inline-block;background-color:#999999;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#CCCCCC')" style="display:inline-block;background-color:#CCCCCC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#EEEEEE')" style="display:inline-block;background-color:#EEEEEE;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#F3F3F3')" style="display:inline-block;background-color:#F3F3F3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#FFFFFF')" style="display:inline-block;background-color:#FFFFFF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#FF0000')" style="display:inline-block;background-color:#FF0000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#FF9900')" style="display:inline-block;background-color:#FF9900;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#FFFF00')" style="display:inline-block;background-color:#FFFF00;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#00FF00')" style="display:inline-block;background-color:#00FF00;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#00FFFF')" style="display:inline-block;background-color:#00FFFF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#0000FF')" style="display:inline-block;background-color:#0000FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#9900FF')" style="display:inline-block;background-color:#9900FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#FF00FF')" style="display:inline-block;background-color:#FF00FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#FFCCCC')" style="display:inline-block;background-color:#FFCCCC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#FCE5CD')" style="display:inline-block;background-color:#FCE5CD;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#FFF2CC')" style="display:inline-block;background-color:#FFF2CC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#D9EAD3')" style="display:inline-block;background-color:#D9EAD3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#D0E0E3')" style="display:inline-block;background-color:#D0E0E3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#CFE2F3')" style="display:inline-block;background-color:#CFE2F3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#D9D2E9')" style="display:inline-block;background-color:#D9D2E9;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#EAD1DC')" style="display:inline-block;background-color:#EAD1DC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#EA9999')" style="display:inline-block;background-color:#EA9999;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#F9CB9C')" style="display:inline-block;background-color:#F9CB9C;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#FFE599')" style="display:inline-block;background-color:#FFE599;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#B6D7A8')" style="display:inline-block;background-color:#B6D7A8;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#A2C4C9')" style="display:inline-block;background-color:#A2C4C9;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#9FC5E8')" style="display:inline-block;background-color:#9FC5E8;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#B4A7D6')" style="display:inline-block;background-color:#B4A7D6;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#D5A6BD')" style="display:inline-block;background-color:#D5A6BD;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#E06666')" style="display:inline-block;background-color:#E06666;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#F6B26B')" style="display:inline-block;background-color:#F6B26B;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#FFD966')" style="display:inline-block;background-color:#FFD966;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#93C47D')" style="display:inline-block;background-color:#93C47D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#76A5AF')" style="display:inline-block;background-color:#76A5AF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#6FA8DC')" style="display:inline-block;background-color:#6FA8DC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#8E7CC3')" style="display:inline-block;background-color:#8E7CC3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#C27BA0')" style="display:inline-block;background-color:#C27BA0;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#CC0000')" style="display:inline-block;background-color:#CC0000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#E69138')" style="display:inline-block;background-color:#E69138;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#F1C232')" style="display:inline-block;background-color:#F1C232;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#6AA84F')" style="display:inline-block;background-color:#6AA84F;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#45818E')" style="display:inline-block;background-color:#45818E;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#3D85C6')" style="display:inline-block;background-color:#3D85C6;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#674EA7')" style="display:inline-block;background-color:#674EA7;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#A64D79')" style="display:inline-block;background-color:#A64D79;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#990000')" style="display:inline-block;background-color:#990000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#B45F06')" style="display:inline-block;background-color:#B45F06;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#BF9000')" style="display:inline-block;background-color:#BF9000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#38761D')" style="display:inline-block;background-color:#38761D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#134F5C')" style="display:inline-block;background-color:#134F5C;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#0B5394')" style="display:inline-block;background-color:#0B5394;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#351C75')" style="display:inline-block;background-color:#351C75;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#741B47')" style="display:inline-block;background-color:#741B47;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#660000')" style="display:inline-block;background-color:#660000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#783F04')" style="display:inline-block;background-color:#783F04;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#7F6000')" style="display:inline-block;background-color:#7F6000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#274E13')" style="display:inline-block;background-color:#274E13;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#0C343D')" style="display:inline-block;background-color:#0C343D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#073763')" style="display:inline-block;background-color:#073763;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#20124D')" style="display:inline-block;background-color:#20124D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c3','#4C1130')" style="display:inline-block;background-color:#4C1130;margin:2px;width:12px;height:12px;cursor:pointer;"></span> </span> </span></span><input id="inner_color" onKeyUp="change_b_color('c3',this.value)" type="text" style="width:50px;font-size:11px;" value="<?php echo $user_design_info_show['inner_color']; ?>"></div>
                    <div style="clear:both;"></div>
                </div>
                <div style="border-bottom:1px dotted #aaa;margin:4px 0;padding:4px 0;">
                    <div style="float:left;">
                        Background Image:
                    </div>
                    <div style="float:right;">
                        
                        <?php if($user_design_info_show['background_image']=='' || $user_design_info_show['background_image']=='default'){ ?>
                        <input style="font-size:11px;" type="file" id="file1" name="file1" onChange="uploadFile(event)">
                        <input type="hidden" value="default" id="background_image">
                        <?php } else { ?>
                        <a href="javascript:;" onClick="delete_background()">Delete background image</a>
                        <input type="hidden" value="<?php echo $user_design_info_show['background_image']; ?>" id="background_image">
                        <?php } ?>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div style="border-bottom:1px dotted #aaa;margin:4px 0;padding:4px 0;">
                    <div style="float:left;">
                        Profile Image:
                    </div>
                    <div style="float:right;">
                        
                        <?php if($user_design_info_show['profile_image']=='' || $user_design_info_show['profile_image']=='default'){ ?>
                        <input style="font-size:11px;" type="file" id="file2" name="file2" onChange="uploadFile2(event)">
                        <input type="hidden" value="default" id="profile_image_hidden">
                        <?php } else { ?>
                        <a href="javascript:;" onClick="delete_profile_image()">Delete profile image</a>
                        <input type="hidden" value="<?php echo $user_design_info_show['profile_image']; ?>" id="profile_image_hidden">
                        <?php } ?>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                </div>
                <div style="float:right;width:300px;">
                    <div style="border-bottom:1px dotted #aaa;margin:4px 0;padding:4px 0;">
                    <div style="float:left;">Links color</div>
                    <div style="float:right;"><span onClick="show_n_hide_class('color_picker4')" style="cursor:pointer;position:relative;border:1px solid #ccc;display:inline-block;vertical-align:middle;padding:2px;margin-right:2px;width:13px;height:13px;"><span id="c4_l" style="display:inline-block;width:13px;height:13px;background-color:<?php echo $user_design_info_show['links_color']; ?>"><span class="color_picker4" style="z-index:1000;display:none;position:absolute;background-color:#fff;padding:2px;border:1px solid #ccc;top:100%;width:160px;"> <span onClick="change_b_color('c4','#000000')" style="display:inline-block;background-color:#000000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#444444')" style="display:inline-block;background-color:#444444;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#666666')" style="display:inline-block;background-color:#666666;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#999999')" style="display:inline-block;background-color:#999999;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#CCCCCC')" style="display:inline-block;background-color:#CCCCCC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#EEEEEE')" style="display:inline-block;background-color:#EEEEEE;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#F3F3F3')" style="display:inline-block;background-color:#F3F3F3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#FFFFFF')" style="display:inline-block;background-color:#FFFFFF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#FF0000')" style="display:inline-block;background-color:#FF0000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#FF9900')" style="display:inline-block;background-color:#FF9900;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#FFFF00')" style="display:inline-block;background-color:#FFFF00;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#00FF00')" style="display:inline-block;background-color:#00FF00;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#00FFFF')" style="display:inline-block;background-color:#00FFFF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#0000FF')" style="display:inline-block;background-color:#0000FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#9900FF')" style="display:inline-block;background-color:#9900FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#FF00FF')" style="display:inline-block;background-color:#FF00FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#FFCCCC')" style="display:inline-block;background-color:#FFCCCC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#FCE5CD')" style="display:inline-block;background-color:#FCE5CD;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#FFF2CC')" style="display:inline-block;background-color:#FFF2CC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#D9EAD3')" style="display:inline-block;background-color:#D9EAD3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#D0E0E3')" style="display:inline-block;background-color:#D0E0E3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#CFE2F3')" style="display:inline-block;background-color:#CFE2F3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#D9D2E9')" style="display:inline-block;background-color:#D9D2E9;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#EAD1DC')" style="display:inline-block;background-color:#EAD1DC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#EA9999')" style="display:inline-block;background-color:#EA9999;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#F9CB9C')" style="display:inline-block;background-color:#F9CB9C;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#FFE599')" style="display:inline-block;background-color:#FFE599;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#B6D7A8')" style="display:inline-block;background-color:#B6D7A8;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#A2C4C9')" style="display:inline-block;background-color:#A2C4C9;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#9FC5E8')" style="display:inline-block;background-color:#9FC5E8;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#B4A7D6')" style="display:inline-block;background-color:#B4A7D6;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#D5A6BD')" style="display:inline-block;background-color:#D5A6BD;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#E06666')" style="display:inline-block;background-color:#E06666;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#F6B26B')" style="display:inline-block;background-color:#F6B26B;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#FFD966')" style="display:inline-block;background-color:#FFD966;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#93C47D')" style="display:inline-block;background-color:#93C47D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#76A5AF')" style="display:inline-block;background-color:#76A5AF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#6FA8DC')" style="display:inline-block;background-color:#6FA8DC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#8E7CC3')" style="display:inline-block;background-color:#8E7CC3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#C27BA0')" style="display:inline-block;background-color:#C27BA0;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#CC0000')" style="display:inline-block;background-color:#CC0000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#E69138')" style="display:inline-block;background-color:#E69138;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#F1C232')" style="display:inline-block;background-color:#F1C232;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#6AA84F')" style="display:inline-block;background-color:#6AA84F;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#45818E')" style="display:inline-block;background-color:#45818E;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#3D85C6')" style="display:inline-block;background-color:#3D85C6;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#674EA7')" style="display:inline-block;background-color:#674EA7;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#A64D79')" style="display:inline-block;background-color:#A64D79;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#990000')" style="display:inline-block;background-color:#990000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#B45F06')" style="display:inline-block;background-color:#B45F06;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#BF9000')" style="display:inline-block;background-color:#BF9000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#38761D')" style="display:inline-block;background-color:#38761D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#134F5C')" style="display:inline-block;background-color:#134F5C;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#0B5394')" style="display:inline-block;background-color:#0B5394;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#351C75')" style="display:inline-block;background-color:#351C75;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#741B47')" style="display:inline-block;background-color:#741B47;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#660000')" style="display:inline-block;background-color:#660000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#783F04')" style="display:inline-block;background-color:#783F04;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#7F6000')" style="display:inline-block;background-color:#7F6000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#274E13')" style="display:inline-block;background-color:#274E13;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#0C343D')" style="display:inline-block;background-color:#0C343D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#073763')" style="display:inline-block;background-color:#073763;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#20124D')" style="display:inline-block;background-color:#20124D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c4','#4C1130')" style="display:inline-block;background-color:#4C1130;margin:2px;width:12px;height:12px;cursor:pointer;"></span> </span> </span></span><input id="links_color" onKeyUp="change_b_color('c4',this.value)" type="text" style="width:50px;font-size:11px;" value="<?php echo $user_design_info_show['links_color']; ?>"></div>
                    <div style="clear:both;"></div>
                </div>
                <div style="border-bottom:1px dotted #aaa;margin:4px 0;padding:4px 0;">
                    <div style="float:left;">Title color</div>
                    <div style="float:right;"><span onClick="show_n_hide_class('color_picker5')" style="cursor:pointer;position:relative;border:1px solid #ccc;display:inline-block;vertical-align:middle;padding:2px;margin-right:2px;width:13px;height:13px;"><span id="c5_l" style="display:inline-block;width:13px;height:13px;background-color:<?php echo $user_design_info_show['background_color']; ?>"><span class="color_picker5" style="z-index:1000;display:none;position:absolute;background-color:#fff;padding:2px;border:1px solid #ccc;top:100%;width:160px;"> <span onClick="change_b_color('c5','#000000')" style="display:inline-block;background-color:#000000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#444444')" style="display:inline-block;background-color:#444444;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#666666')" style="display:inline-block;background-color:#666666;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#999999')" style="display:inline-block;background-color:#999999;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#CCCCCC')" style="display:inline-block;background-color:#CCCCCC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#EEEEEE')" style="display:inline-block;background-color:#EEEEEE;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#F3F3F3')" style="display:inline-block;background-color:#F3F3F3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#FFFFFF')" style="display:inline-block;background-color:#FFFFFF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#FF0000')" style="display:inline-block;background-color:#FF0000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#FF9900')" style="display:inline-block;background-color:#FF9900;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#FFFF00')" style="display:inline-block;background-color:#FFFF00;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#00FF00')" style="display:inline-block;background-color:#00FF00;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#00FFFF')" style="display:inline-block;background-color:#00FFFF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#0000FF')" style="display:inline-block;background-color:#0000FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#9900FF')" style="display:inline-block;background-color:#9900FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#FF00FF')" style="display:inline-block;background-color:#FF00FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#FFCCCC')" style="display:inline-block;background-color:#FFCCCC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#FCE5CD')" style="display:inline-block;background-color:#FCE5CD;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#FFF2CC')" style="display:inline-block;background-color:#FFF2CC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#D9EAD3')" style="display:inline-block;background-color:#D9EAD3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#D0E0E3')" style="display:inline-block;background-color:#D0E0E3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#CFE2F3')" style="display:inline-block;background-color:#CFE2F3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#D9D2E9')" style="display:inline-block;background-color:#D9D2E9;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#EAD1DC')" style="display:inline-block;background-color:#EAD1DC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#EA9999')" style="display:inline-block;background-color:#EA9999;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#F9CB9C')" style="display:inline-block;background-color:#F9CB9C;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#FFE599')" style="display:inline-block;background-color:#FFE599;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#B6D7A8')" style="display:inline-block;background-color:#B6D7A8;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#A2C4C9')" style="display:inline-block;background-color:#A2C4C9;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#9FC5E8')" style="display:inline-block;background-color:#9FC5E8;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#B4A7D6')" style="display:inline-block;background-color:#B4A7D6;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#D5A6BD')" style="display:inline-block;background-color:#D5A6BD;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#E06666')" style="display:inline-block;background-color:#E06666;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#F6B26B')" style="display:inline-block;background-color:#F6B26B;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#FFD966')" style="display:inline-block;background-color:#FFD966;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#93C47D')" style="display:inline-block;background-color:#93C47D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#76A5AF')" style="display:inline-block;background-color:#76A5AF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#6FA8DC')" style="display:inline-block;background-color:#6FA8DC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#8E7CC3')" style="display:inline-block;background-color:#8E7CC3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#C27BA0')" style="display:inline-block;background-color:#C27BA0;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#CC0000')" style="display:inline-block;background-color:#CC0000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#E69138')" style="display:inline-block;background-color:#E69138;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#F1C232')" style="display:inline-block;background-color:#F1C232;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#6AA84F')" style="display:inline-block;background-color:#6AA84F;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#45818E')" style="display:inline-block;background-color:#45818E;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#3D85C6')" style="display:inline-block;background-color:#3D85C6;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#674EA7')" style="display:inline-block;background-color:#674EA7;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#A64D79')" style="display:inline-block;background-color:#A64D79;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#990000')" style="display:inline-block;background-color:#990000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#B45F06')" style="display:inline-block;background-color:#B45F06;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#BF9000')" style="display:inline-block;background-color:#BF9000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#38761D')" style="display:inline-block;background-color:#38761D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#134F5C')" style="display:inline-block;background-color:#134F5C;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#0B5394')" style="display:inline-block;background-color:#0B5394;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#351C75')" style="display:inline-block;background-color:#351C75;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#741B47')" style="display:inline-block;background-color:#741B47;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#660000')" style="display:inline-block;background-color:#660000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#783F04')" style="display:inline-block;background-color:#783F04;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#7F6000')" style="display:inline-block;background-color:#7F6000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#274E13')" style="display:inline-block;background-color:#274E13;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#0C343D')" style="display:inline-block;background-color:#0C343D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#073763')" style="display:inline-block;background-color:#073763;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#20124D')" style="display:inline-block;background-color:#20124D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c5','#4C1130')" style="display:inline-block;background-color:#4C1130;margin:2px;width:12px;height:12px;cursor:pointer;"></span> </span> </span></span><input id="title_color" onKeyUp="change_b_color('c5',this.value)" type="text" style="width:50px;font-size:11px;" value="<?php echo $user_design_info_show['title_color']; ?>"></div>
                    <div style="clear:both;"></div>
                </div>
                <div style="border-bottom:1px dotted #aaa;margin:4px 0;padding:4px 0;">
                    <div style="float:left;">Text color</div>
                    <div style="float:right;"><span onClick="show_n_hide_class('color_picker6')" style="cursor:pointer;position:relative;border:1px solid #ccc;display:inline-block;vertical-align:middle;padding:2px;margin-right:2px;width:13px;height:13px;"><span id="c6_l" style="display:inline-block;width:13px;height:13px;background-color:<?php echo $user_design_info_show['text_color']; ?>"><span class="color_picker6" style="z-index:1000;display:none;position:absolute;background-color:#fff;padding:2px;border:1px solid #ccc;top:100%;width:160px;"> <span onClick="change_b_color('c6','#000000')" style="display:inline-block;background-color:#000000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#444444')" style="display:inline-block;background-color:#444444;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#666666')" style="display:inline-block;background-color:#666666;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#999999')" style="display:inline-block;background-color:#999999;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#CCCCCC')" style="display:inline-block;background-color:#CCCCCC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#EEEEEE')" style="display:inline-block;background-color:#EEEEEE;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#F3F3F3')" style="display:inline-block;background-color:#F3F3F3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#FFFFFF')" style="display:inline-block;background-color:#FFFFFF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#FF0000')" style="display:inline-block;background-color:#FF0000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#FF9900')" style="display:inline-block;background-color:#FF9900;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#FFFF00')" style="display:inline-block;background-color:#FFFF00;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#00FF00')" style="display:inline-block;background-color:#00FF00;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#00FFFF')" style="display:inline-block;background-color:#00FFFF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#0000FF')" style="display:inline-block;background-color:#0000FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#9900FF')" style="display:inline-block;background-color:#9900FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#FF00FF')" style="display:inline-block;background-color:#FF00FF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#FFCCCC')" style="display:inline-block;background-color:#FFCCCC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#FCE5CD')" style="display:inline-block;background-color:#FCE5CD;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#FFF2CC')" style="display:inline-block;background-color:#FFF2CC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#D9EAD3')" style="display:inline-block;background-color:#D9EAD3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#D0E0E3')" style="display:inline-block;background-color:#D0E0E3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#CFE2F3')" style="display:inline-block;background-color:#CFE2F3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#D9D2E9')" style="display:inline-block;background-color:#D9D2E9;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#EAD1DC')" style="display:inline-block;background-color:#EAD1DC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#EA9999')" style="display:inline-block;background-color:#EA9999;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#F9CB9C')" style="display:inline-block;background-color:#F9CB9C;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#FFE599')" style="display:inline-block;background-color:#FFE599;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#B6D7A8')" style="display:inline-block;background-color:#B6D7A8;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#A2C4C9')" style="display:inline-block;background-color:#A2C4C9;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#9FC5E8')" style="display:inline-block;background-color:#9FC5E8;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#B4A7D6')" style="display:inline-block;background-color:#B4A7D6;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#D5A6BD')" style="display:inline-block;background-color:#D5A6BD;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#E06666')" style="display:inline-block;background-color:#E06666;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#F6B26B')" style="display:inline-block;background-color:#F6B26B;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#FFD966')" style="display:inline-block;background-color:#FFD966;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#93C47D')" style="display:inline-block;background-color:#93C47D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#76A5AF')" style="display:inline-block;background-color:#76A5AF;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#6FA8DC')" style="display:inline-block;background-color:#6FA8DC;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#8E7CC3')" style="display:inline-block;background-color:#8E7CC3;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#C27BA0')" style="display:inline-block;background-color:#C27BA0;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#CC0000')" style="display:inline-block;background-color:#CC0000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#E69138')" style="display:inline-block;background-color:#E69138;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#F1C232')" style="display:inline-block;background-color:#F1C232;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#6AA84F')" style="display:inline-block;background-color:#6AA84F;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#45818E')" style="display:inline-block;background-color:#45818E;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#3D85C6')" style="display:inline-block;background-color:#3D85C6;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#674EA7')" style="display:inline-block;background-color:#674EA7;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#A64D79')" style="display:inline-block;background-color:#A64D79;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#990000')" style="display:inline-block;background-color:#990000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#B45F06')" style="display:inline-block;background-color:#B45F06;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#BF9000')" style="display:inline-block;background-color:#BF9000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#38761D')" style="display:inline-block;background-color:#38761D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#134F5C')" style="display:inline-block;background-color:#134F5C;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#0B5394')" style="display:inline-block;background-color:#0B5394;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#351C75')" style="display:inline-block;background-color:#351C75;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#741B47')" style="display:inline-block;background-color:#741B47;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#660000')" style="display:inline-block;background-color:#660000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#783F04')" style="display:inline-block;background-color:#783F04;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#7F6000')" style="display:inline-block;background-color:#7F6000;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#274E13')" style="display:inline-block;background-color:#274E13;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#0C343D')" style="display:inline-block;background-color:#0C343D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#073763')" style="display:inline-block;background-color:#073763;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#20124D')" style="display:inline-block;background-color:#20124D;margin:2px;width:12px;height:12px;cursor:pointer;"></span> <span onClick="change_b_color('c6','#4C1130')" style="display:inline-block;background-color:#4C1130;margin:2px;width:12px;height:12px;cursor:pointer;"></span> </span> </span></span><input id="text_color" onKeyUp="change_b_color('c6',this.value)" type="text" style="width:50px;font-size:11px;" value="<?php echo $user_design_info_show['text_color']; ?>"></div>
                    <div style="clear:both;"></div>
                </div>
                <div style="border-bottom:1px dotted #aaa;margin:4px 0;padding:4px 0;">
                    <div style="float:left;">
                        Wrapper opacity:
                    </div>
                    <div style="float:right;">
                        <select id="wrapper_box_opacity" <?php if($user_design_info_show['wrapper_box_opacity'] == '' || $user_design_info_show['wrapper_box_opacity'] ==',1)' || $user_design_info_show['wrapper_box_opacity'] =='null'){ echo $user_design_info_show['wrapper_box_color']; } else { echo "rgba=\"".$user_design_info_show['wrapper_box_opacity']."\""; } ?> onChange="change_wrapper_opacity(this.value)">
                            <option value="1" <?php if(strpos($user_design_info_show['wrapper_box_opacity'],',1)')){; ?>selected<?php } ?>>None</option>
                            <option value="0.9" <?php if(strpos($user_design_info_show['wrapper_box_opacity'],'0.9')){; ?>selected<?php } ?>>10%</option>
                            <option value="0.8" <?php if(strpos($user_design_info_show['wrapper_box_opacity'],'0.8')){; ?>selected<?php } ?>>20%</option>
                            <option value="0.7" <?php if(strpos($user_design_info_show['wrapper_box_opacity'],'0.7')){; ?>selected<?php } ?>>30%</option>
                            <option value="0.6" <?php if(strpos($user_design_info_show['wrapper_box_opacity'],'0.6')){; ?>selected<?php } ?>>40%</option>
                            <option value="0.5" <?php if(strpos($user_design_info_show['wrapper_box_opacity'],'0.5')){; ?>selected<?php } ?>>50%</option>
                            <option value="0.4" <?php if(strpos($user_design_info_show['wrapper_box_opacity'],'0.4')){; ?>selected<?php } ?>>60%</option>
                            <option value="0.3" <?php if(strpos($user_design_info_show['wrapper_box_opacity'],'0.3')){; ?>selected<?php } ?>>70%</option>
                            <option value="0.2" <?php if(strpos($user_design_info_show['wrapper_box_opacity'],'0.2')){; ?>selected<?php } ?>>80%</option>
                            <option value="0.1" <?php if(strpos($user_design_info_show['wrapper_box_opacity'],'0.1')){; ?>selected<?php } ?>>90%</option>
                            <option value="0" <?php if(strpos($user_design_info_show['wrapper_box_opacity'],',0)')){; ?>selected<?php } ?>>100%</option>
                        </select>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div style="border-bottom:1px dotted #aaa;margin:4px 0;padding:4px 0;">
                    <div style="float:left;">
                        Inside box opacity:
                    </div>
                    <div style="float:right;">
                        <select id="inner_box_opacity" <?php if($user_design_info_show['inner_box_opacity'] == '' || $user_design_info_show['inner_box_opacity'] =='1' || $user_design_info_show['inner_box_opacity'] =='null'){ echo $user_design_info_show['inner_box_color']; } else { echo "rgba=\"".$user_design_info_show['inner_box_opacity']."\""; } ?> onChange="change_inner_box_opacity(this.value)">
                            <option value="1" <?php if(strpos($user_design_info_show['inner_box_opacity'],',1)')){; ?>selected<?php } ?>>None</option>
                            <option value="0.9" <?php if(strpos($user_design_info_show['inner_box_opacity'],'0.9')){; ?>selected<?php } ?>>10%</option>
                            <option value="0.8" <?php if(strpos($user_design_info_show['inner_box_opacity'],'0.8')){; ?>selected<?php } ?>>20%</option>
                            <option value="0.7" <?php if(strpos($user_design_info_show['inner_box_opacity'],'0.7')){; ?>selected<?php } ?>>30%</option>
                            <option value="0.6" <?php if(strpos($user_design_info_show['inner_box_opacity'],'0.6')){; ?>selected<?php } ?>>40%</option>
                            <option value="0.5" <?php if(strpos($user_design_info_show['inner_box_opacity'],'0.5')){; ?>selected<?php } ?>>50%</option>
                            <option value="0.4" <?php if(strpos($user_design_info_show['inner_box_opacity'],'0.4')){; ?>selected<?php } ?>>60%</option>
                            <option value="0.3" <?php if(strpos($user_design_info_show['inner_box_opacity'],'0.3')){; ?>selected<?php } ?>>70%</option>
                            <option value="0.2" <?php if(strpos($user_design_info_show['inner_box_opacity'],'0.2')){; ?>selected<?php } ?>>80%</option>
                            <option value="0.1" <?php if(strpos($user_design_info_show['inner_box_opacity'],'0.1')){; ?>selected<?php } ?>>90%</option>
                            <option value="0" <?php if(strpos($user_design_info_show['inner_box_opacity'],',0)')){; ?>selected<?php } ?>>100%</option>
                        </select>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                
                </div>
                <div style="clear:both;"></div>
                <div><button class="mb mb_g_b" onClick="save_profile_design()"><b><?php echo $save_changes; ?></b></button></div>
            </div>
<div id="modules_box" class="hidded" style="display:none;border:1px solid #aaa;background-color:#fff;padding:8px;"></div>
<div id="videos_and_playlists_box" class="hidded" style="display:none;border:1px solid #aaa;background-color:#fff;padding:8px;">Video to show:<select><option></option></select></div>
            </div>
        </div><?php } ?>
        <div id="channel_body" class="channel_body c1" style="<?php if($user_design_info_show['background_image']!=='') {?>background-image:url(http://localhost/pb/<?php echo $user_design_info_show['background_image']; ?>);<?php } ?>font-family:<?php echo $user_design_info_show['font']; ?>;font-size:12px;border-top:2px solid <?php echo $user_design_info_show['wrapper_color']; ?>;background-color:<?php echo $user_design_info_show['background_color']; ?>;min-height:100vh;">
<div style="width:960px;padding:10px 0;margin:0 auto;">
   <div id="wrapper_box" class="wrapper_box wrapper_box_c c2" style="<?php if($user_design_info_show['wrapper_box_opacity']==',1)' || $user_design_info_show['wrapper_box_opacity']==''){ ?>background-color:<?php echo $user_design_info_show['wrapper_color']; ?>;<?php } else { echo "background:".$user_design_info_show['wrapper_box_opacity']; } ?>">
       <div class="inner-box c3" style="padding:2px;">
           <div class="wrapper_box_c c2" style="float:left;background-color:<?php echo $user_design_info_show['wrapper_color']; ?>;">
               <div style="float:left;padding:4px;border-top-left-radius:2px;border-bottom-left-radius:2px;">
                   <div style="height:36px;width:36px;overflow:hidden;border:1px double;background-color:#fff;">
                         <div style="width:400px;text-align:center;margin-left:-182px;">
                             <a href="http://localhost/<?php echo $user_comments_info_show['user1']; ?>"><img id="profile_img2" src="<?php if($user_design_info_show['profile_image']==''){ ?>http://localhost/img/no_videos_140-vfl121214.png<?php } else { ?>http://localhost/pi/<?php echo $user_design_info_show['profile_image']; ?><?php } ?>" style="height:36px;"></a>
                         </div>
                     </div>
               </div>
               <div style="float:left;padding:13px 4px 8px;font-size:16px;">
                   <?php echo $user_info_show['username']; ?>'s Channel
               </div>
               <div style="clear:both;"></div>
           </div>
           <div id="right_arrow" class="wrapper_box_c" style="float:left;border-width:23px 0 23px 12px;border-style:solid;border-bottom-color:transparent;border-top-color:transparent;border-left-color:<?php echo $user_design_info_show['wrapper_color']; ?>;">
                   
               </div>
           <div style="float:left;padding:13px;">
               <?php if($user_videos_total==0){echo $user_info_show['username'].' '.$has_no_videos_available;} else { ?><a class="top_channel_links" href="">All</a><a class="top_channel_links" href="">Uploads</a><a class="top_channel_links" href="">Favorites</a><?php } ?>
           </div>
           <div style="clear:both"></div>
       </div>
       <?php if($user_videos_total!==0){ ?>
       <div>
           <div style="float:left;width:640px;">
               <div style="width:640px;background-color:#000;"><embed type="application/x-shockwave-flash" src="watch-vfl84938.swf" width="640" height="385" id="movie_player" name="movie_player" bgcolor="#000000" quality="high" allowfullscreen="true" allowscriptaccess="always" flashvars="video_id=<?php echo $user_videos_show['url']; ?>&autoplay=0&iurl=http://localhost/<?php if($user_videos_info_show['thumb']!==''){ ?>vids_thumbnails/<?php echo $user_videos_info_show['url'].".jpg"; } else { ?>img/default.jpg<?php } ?>"></div>
               <div style="margin-top:8px;" class="inner-box c3"><div style="font-size:16px;font-weight:bold;"><a href="http://localhost/watch?v=<?php echo $user_videos_show['url']; ?>"><?php if($user_videos_show['title']==''){echo $user_videos_show['name'];} else { echo $user_videos_show['title']; } ?></a></div><div style="margin:2px 0;padding:2px 0;font-size:11px;">From: <a href="http://localhost/<?php echo $user_videos_show['username']; ?>"><?php echo $user_videos_show['username']; ?></a></div></div>
           </div>
           <div style="float:right;width:295px;">
               <div class="inner-box c3" style="min-height:285px;">
                   <div style="font-size:14px;font-weight:bold">Uploads (<?php echo $user_videos_total; ?>)</div>
                   <?php
                   while($user_videos_info_show = mysqli_fetch_array($user_videoss))
                   {
                   ?>
                   <div style="padding:8px 0;">
                       <div style="float:left;margin-right:8px;"><a href="http://localhost/watch?v=<?php echo $user_videos_info_show['url']; ?>"><img src="http://localhost/<?php if($user_videos_info_show['thumb']!==''){ ?>vids_thumbnails/<?php echo $user_videos_info_show['url'].".jpg"; } else { ?>img/default.jpg<?php } ?>" style="width:105px;height:60px;"></a></div>
                       <div style="float:left;width:160px;overflow:hidden;"><div><a href="http://localhost/watch?v=<?php echo $user_videos_info_show['url']; ?>"><b><?php if($user_videos_info_show['title']==''){echo $user_videos_info_show['name'];} else { echo $user_videos_info_show['title']; } ?></b></a></div><div><?php if($_COOKIE['lang'] == 'en'){echo time_stamp_en($user_videos_info_show['upload_date']);} else { echo time_stamp_es($user_videos_info_show['upload_date']); } ?></div></div>
                       <div style="clear:both;"></div>
                   </div>
                   <?php
                   }
                   ?>
               </div>
           </div>
           <div style="clear:both;"></div>
       </div>
       <?php } ?>
   </div>
   <div id="wrapper_box2" class="wrapper_box wrapper_box_c c2" style="<?php if($user_design_info_show['wrapper_box_opacity']==',0)' || $user_design_info_show['wrapper_box_opacity']==''){ ?>background-color:<?php echo $user_design_info_show['wrapper_color']; ?>;<?php } else { echo "background:".$user_design_info_show['wrapper_box_opacity']; } ?>;">
       <div style="float:left;width:295px;">
          <div class="inner-box c3">
             <div style="float:left;height:88px;width:88px;overflow:hidden;border:3px double;margin-right:10px;background-color:#fff;">
                         <div style="width:400px;text-align:center;margin-left:-157px;">
                             <a href="http://localhost/<?php echo $user_info_show['username']; ?>"><img id="profile_img" src="<?php if($user_design_info_show['profile_image']==''){ ?>http://localhost/img/no_videos_140-vfl121214.png<?php } else { ?>http://localhost/pi/<?php echo $user_design_info_show['profile_image']; ?><?php } ?>" style="height:88px;"></a>
                         </div>
                     </div>
                     <div style="float:left;width:160px;overflow:hidden;">
                         <?php if(isset($_SESSION['username']) && $user_info_show['username']==$my_info_show['username']){ ?>
                         <div style="opacity:0.6;padding-left:5px;margin-left:5px;">Your channel viewers will see links here, including "Add as Friend" and "Subscribe".</div>
                 
                 <?php } else { ?>
                 <div style="font-size:14px;margin-bottom:5px;" title="<?php echo $user_info_show['username']; ?>"><?php echo $user_info_show['username']; ?></div>
                 <div style="margin-bottom:5px;"><?php if(isset($_SESSION['username'])){ if($user_subscribers_check1_total==1){ ?><a style="display:inline-block;padding:0 10px;border-radius:3px;border:1px solid #ecc101;color:#994800;background:#fed81c url(img/master-vfl136487.png) repeat-x center -2202px;line-height:24px;" id="subscribe_btn" class="mb mb_g_w" onClick="unsubscribe_f();"><b>Unsubscribe</b></a><?php } else { ?><a style="display:inline-block;padding:0 10px;border-radius:3px;border:1px solid #ecc101;color:#994800;background:#fed81c url(img/master-vfl136487.png) repeat-x center -2202px;line-height:24px;" id="subscribe_btn" class="mb mb_g_y" onClick="subscribe_f();"><b><?php echo $subscribe_txt; ?></b></a><?php } } else if(!isset($_SESSION['username'])){ ?><a href="http://localhost/login?u=<?php echo $user_info_show['username']; ?>" style="display:inline-block;padding:0 10px;border-radius:3px;border:1px solid #ecc101;color:#994800;background:#fed81c url(img/master-vfl136487.png) repeat-x center -2202px;line-height:24px;" id="subscribe_btn" class="mb mb_g_y"><b><?php echo $subscribe_txt; ?></b></a><?php } ?></div>
                 <div style="margin-bottom:5px;"><?php if(isset($_SESSION['username'])){ ?><?php if($my_friends_requests_info_show['user2']==$user_info_show['username']){ ?><a id="add_as_friend_btn" href="javascript:;" onClick="delete_friend_request_f()">Cancel friend request</a><?php } else if($my_friends_check>0){?><a id="add_as_friend_btn" href="javascript:;" onClick="delete_friend_f();">Delete from friends</a><?php } else { ?><a id="add_as_friend_btn" href="javascript:;" onClick="add_as_friend_f()">Add as Friend</a><?php } ?><?php } else { ?><a id="add_as_friend_btn" href="http://localhost/login?u<?php echo $user_info_show['username']; ?>"><?php } ?> | <a href="javascript:;" onclick="alert('Are you sure you want to block this user?')">Block User</a> | <a href="http://localhost/inbox">Send Message</a></div>
                 <?php } ?>
             </div>
             <div style="clear:both"></div>
          </div>
          
          <div class="inner-box c3">
             <div style="float:left;font-size:18px;" class="c5">
                 <?php echo $profile; ?>
             </div>
             <div style="float:right;">
                 <?php if(isset($_SESSION['username']) && $user_info_show['username']==$my_info_show['username']){ ?><a onClick="s_h('profile_info_box')" href="javascript:;" class="c4" style="border-bottom:1px dotted;text-decoration:none;color:<?php echo $user_design_info_show['links_color']; ?>;">edit</a><?php } ?>
             </div>
             <div style="clear:both;"></div>
             <div id="profile_info_box" style="display:none;color:#000;border:1px solid #ccc;background-color:#fff;padding:8px;"><div id="save_changes_info_box" style="display:none;padding:3px 5;font-weight:bold;background:#6AA84F;color:#fff;border-radius:3px;"></div>
                 <div id="c_name_box" style="<?php if($user_info_show['visibility_c_name']=='1'){ echo "opacity:1;"; } else { echo "opacity:0.5;"; } ?>border-bottom:1px dotted #ccc;padding:4px 0;margin:4px 0;" class="c6">
                     <div style="float:left;"><input style="vertical-align:middle;" type="checkbox" id="c_name" onClick="if(document.getElementById('c_name').checked==true){document.getElementById('c_name_box').style.opacity='1';document.getElementById('c_name').setAttribute('check_mode','1');} else { document.getElementById('c_name_box').style.opacity='0.5';document.getElementById('c_name').setAttribute('check_mode','2');}" check_mode="<?php echo $user_info_show['visibility_c_name']; ?>" <?php if($my_info_show['visibility_c_name']=='1'){ echo "checked=\"checked\""; } ?>> Name:</div>
                     <div style="float:right;"><input type="text" value="<?php echo $user_info_show['name']; ?>" style="font-size:12px;" id="c_name_info"></div>
                     <div style="clear:both;"></div>
                 </div>
                 <div id="c_last_sign_in_box" style="<?php if($user_info_show['visibility_c_last_sign_in']=='1'){ echo "opacity:1;"; } else { echo "opacity:0.5;"; } ?>border-bottom:1px dotted #ccc;padding:4px 0;margin:4px 0;" class="c6">
                     <div style="float:left;"><input style="vertical-align:middle;" type="checkbox" id="c_last_sign_in" onClick="if(document.getElementById('c_last_sign_in').checked==true){document.getElementById('c_last_sign_in_box').style.opacity='1';document.getElementById('c_last_sign_in').setAttribute('check_mode','1');} else { document.getElementById('c_last_sign_in_box').style.opacity='0.5';document.getElementById('c_last_sign_in').setAttribute('check_mode','2');}" check_mode="<?php echo $user_info_show['visibility_c_last_sign_in']; ?>" <?php if($my_info_show['visibility_c_last_sign_in']=='1'){ echo "checked=\"checked\""; } ?>> Last Sign In:</div>
                     <div style="float:right;"><?php if($_COOKIE['lang'] == 'en'){echo time_stamp_en($user_info_show['last_login']);} else { echo time_stamp_es($user_info_show['last_login']); } ?></div>
                     <div style="clear:both;"></div>
                 </div>
                 <div id="c_subscribers_box" style="<?php if($user_info_show['visibility_c_subscribers']=='1'){ echo "opacity:1;"; } else { echo "opacity:0.5;"; } ?>border-bottom:1px dotted #ccc;padding:4px 0;margin:4px 0;" class="c6">
                     <div style="float:left;"><input style="vertical-align:middle;" type="checkbox" id="c_subscribers" onClick="if(document.getElementById('c_subscribers').checked==true){document.getElementById('c_subscribers_box').style.opacity='1';document.getElementById('c_subscribers').setAttribute('check_mode','1');} else { document.getElementById('c_subscribers_box').style.opacity='0.5';document.getElementById('c_subscribers').setAttribute('check_mode','2');}" check_mode="<?php echo $user_info_show['visibility_c_subscribers']; ?>" <?php if($my_info_show['visibility_c_subscribers']=='1'){ echo "checked=\"checked\""; } ?>> Subscribers:</div>
                     <div style="float:right;"><?php echo $user_subscribers_total; ?></div>
                     <div style="clear:both;"></div>
                 </div>
                 <div id="c_about_box" style="<?php if($user_info_show['visibility_c_about']=='1'){ echo "opacity:1;"; } else { echo "opacity:0.5;"; } ?>border-bottom:1px dotted #ccc;padding:4px 0;margin:4px 0;" class="c6">
                     <div><input style="vertical-align:middle;" type="checkbox" id="c_about" onClick="if(document.getElementById('c_about').checked==true){document.getElementById('c_about_box').style.opacity='1';document.getElementById('c_about').setAttribute('check_mode','1');} else { document.getElementById('c_about_box').style.opacity='0.5';document.getElementById('c_about').setAttribute('check_mode','2');}" check_mode="<?php echo $user_info_show['visibility_c_about']; ?>" <?php if($my_info_show['visibility_c_about']=='1'){ echo "checked=\"checked\""; } ?>> About:</div>
                     <div><textarea id="c_about_info" rows="3" style="font-size:12px;width:100%;box-sizing:border-box;"><?php echo $user_info_show['about']; ?></textarea></div>
                     <div style="clear:both;"></div>
                 </div>
                 <div id="c_country_box" style="<?php if($user_info_show['visibility_c_country']=='1'){ echo "opacity:1;"; } else { echo "opacity:0.5;"; } ?>border-bottom:1px dotted #ccc;padding:4px 0;margin:4px 0;" class="c6">
                     <div style="float:left;"><input style="vertical-align:middle;" type="checkbox" id="c_country" onClick="if(document.getElementById('c_country').checked==true){document.getElementById('c_country_box').style.opacity='1';document.getElementById('c_country').setAttribute('check_mode','1');} else { document.getElementById('c_country_box').style.opacity='0.5';document.getElementById('c_country').setAttribute('check_mode','2');}" check_mode="<?php echo $user_info_show['visibility_c_country']; ?>" <?php if($my_info_show['visibility_c_about']=='1'){ echo "checked=\"checked\""; } ?>> Country:</div>
                     <div style="float:right;"><select style="width:180px;" id="c_country_info">
	<option value="AF">Afghanistan</option>
	<option value="AX">Åland Islands</option>
	<option value="AL">Albania</option>
	<option value="DZ">Algeria</option>
	<option value="AS">American Samoa</option>
	<option value="AD">Andorra</option>
	<option value="AO">Angola</option>
	<option value="AI">Anguilla</option>
	<option value="AQ">Antarctica</option>
	<option value="AG">Antigua and Barbuda</option>
	<option value="AR">Argentina</option>
	<option value="AM">Armenia</option>
	<option value="AW">Aruba</option>
	<option value="AU">Australia</option>
	<option value="AT">Austria</option>
	<option value="AZ">Azerbaijan</option>
	<option value="BS">Bahamas</option>
	<option value="BH">Bahrain</option>
	<option value="BD">Bangladesh</option>
	<option value="BB">Barbados</option>
	<option value="BY">Belarus</option>
	<option value="BE">Belgium</option>
	<option value="BZ">Belize</option>
	<option value="BJ">Benin</option>
	<option value="BM">Bermuda</option>
	<option value="BT">Bhutan</option>
	<option value="BO">Bolivia, Plurinational State of</option>
	<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
	<option value="BA">Bosnia and Herzegovina</option>
	<option value="BW">Botswana</option>
	<option value="BV">Bouvet Island</option>
	<option value="BR">Brazil</option>
	<option value="IO">British Indian Ocean Territory</option>
	<option value="BN">Brunei Darussalam</option>
	<option value="BG">Bulgaria</option>
	<option value="BF">Burkina Faso</option>
	<option value="BI">Burundi</option>
	<option value="KH">Cambodia</option>
	<option value="CM">Cameroon</option>
	<option value="CA">Canada</option>
	<option value="CV">Cape Verde</option>
	<option value="KY">Cayman Islands</option>
	<option value="CF">Central African Republic</option>
	<option value="TD">Chad</option>
	<option value="CL">Chile</option>
	<option value="CN">China</option>
	<option value="CX">Christmas Island</option>
	<option value="CC">Cocos (Keeling) Islands</option>
	<option value="CO">Colombia</option>
	<option value="KM">Comoros</option>
	<option value="CG">Congo</option>
	<option value="CD">Congo, the Democratic Republic of the</option>
	<option value="CK">Cook Islands</option>
	<option value="CR">Costa Rica</option>
	<option value="CI">Côte d'Ivoire</option>
	<option value="HR">Croatia</option>
	<option value="CU">Cuba</option>
	<option value="CW">Curaçao</option>
	<option value="CY">Cyprus</option>
	<option value="CZ">Czech Republic</option>
	<option value="DK">Denmark</option>
	<option value="DJ">Djibouti</option>
	<option value="DM">Dominica</option>
	<option value="DO">Dominican Republic</option>
	<option value="EC">Ecuador</option>
	<option value="EG">Egypt</option>
	<option value="SV">El Salvador</option>
	<option value="GQ">Equatorial Guinea</option>
	<option value="ER">Eritrea</option>
	<option value="EE">Estonia</option>
	<option value="ET">Ethiopia</option>
	<option value="FK">Falkland Islands (Malvinas)</option>
	<option value="FO">Faroe Islands</option>
	<option value="FJ">Fiji</option>
	<option value="FI">Finland</option>
	<option value="FR">France</option>
	<option value="GF">French Guiana</option>
	<option value="PF">French Polynesia</option>
	<option value="TF">French Southern Territories</option>
	<option value="GA">Gabon</option>
	<option value="GM">Gambia</option>
	<option value="GE">Georgia</option>
	<option value="DE">Germany</option>
	<option value="GH">Ghana</option>
	<option value="GI">Gibraltar</option>
	<option value="GR">Greece</option>
	<option value="GL">Greenland</option>
	<option value="GD">Grenada</option>
	<option value="GP">Guadeloupe</option>
	<option value="GU">Guam</option>
	<option value="GT">Guatemala</option>
	<option value="GG">Guernsey</option>
	<option value="GN">Guinea</option>
	<option value="GW">Guinea-Bissau</option>
	<option value="GY">Guyana</option>
	<option value="HT">Haiti</option>
	<option value="HM">Heard Island and McDonald Islands</option>
	<option value="VA">Holy See (Vatican City State)</option>
	<option value="HN">Honduras</option>
	<option value="HK">Hong Kong</option>
	<option value="HU">Hungary</option>
	<option value="IS">Iceland</option>
	<option value="IN">India</option>
	<option value="ID">Indonesia</option>
	<option value="IR">Iran, Islamic Republic of</option>
	<option value="IQ">Iraq</option>
	<option value="IE">Ireland</option>
	<option value="IM">Isle of Man</option>
	<option value="IL">Israel</option>
	<option value="IT">Italy</option>
	<option value="JM">Jamaica</option>
	<option value="JP">Japan</option>
	<option value="JE">Jersey</option>
	<option value="JO">Jordan</option>
	<option value="KZ">Kazakhstan</option>
	<option value="KE">Kenya</option>
	<option value="KI">Kiribati</option>
	<option value="KP">Korea, Democratic People's Republic of</option>
	<option value="KR">Korea, Republic of</option>
	<option value="KW">Kuwait</option>
	<option value="KG">Kyrgyzstan</option>
	<option value="LA">Lao People's Democratic Republic</option>
	<option value="LV">Latvia</option>
	<option value="LB">Lebanon</option>
	<option value="LS">Lesotho</option>
	<option value="LR">Liberia</option>
	<option value="LY">Libya</option>
	<option value="LI">Liechtenstein</option>
	<option value="LT">Lithuania</option>
	<option value="LU">Luxembourg</option>
	<option value="MO">Macao</option>
	<option value="MK">Macedonia, the former Yugoslav Republic of</option>
	<option value="MG">Madagascar</option>
	<option value="MW">Malawi</option>
	<option value="MY">Malaysia</option>
	<option value="MV">Maldives</option>
	<option value="ML">Mali</option>
	<option value="MT">Malta</option>
	<option value="MH">Marshall Islands</option>
	<option value="MQ">Martinique</option>
	<option value="MR">Mauritania</option>
	<option value="MU">Mauritius</option>
	<option value="YT">Mayotte</option>
	<option value="MX">Mexico</option>
	<option value="FM">Micronesia, Federated States of</option>
	<option value="MD">Moldova, Republic of</option>
	<option value="MC">Monaco</option>
	<option value="MN">Mongolia</option>
	<option value="ME">Montenegro</option>
	<option value="MS">Montserrat</option>
	<option value="MA">Morocco</option>
	<option value="MZ">Mozambique</option>
	<option value="MM">Myanmar</option>
	<option value="NA">Namibia</option>
	<option value="NR">Nauru</option>
	<option value="NP">Nepal</option>
	<option value="NL">Netherlands</option>
	<option value="NC">New Caledonia</option>
	<option value="NZ">New Zealand</option>
	<option value="NI">Nicaragua</option>
	<option value="NE">Niger</option>
	<option value="NG">Nigeria</option>
	<option value="NU">Niue</option>
	<option value="NF">Norfolk Island</option>
	<option value="MP">Northern Mariana Islands</option>
	<option value="NO">Norway</option>
	<option value="OM">Oman</option>
	<option value="PK">Pakistan</option>
	<option value="PW">Palau</option>
	<option value="PS">Palestinian Territory, Occupied</option>
	<option value="PA">Panama</option>
	<option value="PG">Papua New Guinea</option>
	<option value="PY">Paraguay</option>
	<option value="PE">Peru</option>
	<option value="PH">Philippines</option>
	<option value="PN">Pitcairn</option>
	<option value="PL">Poland</option>
	<option value="PT">Portugal</option>
	<option value="PR">Puerto Rico</option>
	<option value="QA">Qatar</option>
	<option value="RE">Réunion</option>
	<option value="RO">Romania</option>
	<option value="RU">Russian Federation</option>
	<option value="RW">Rwanda</option>
	<option value="BL">Saint Barthélemy</option>
	<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
	<option value="KN">Saint Kitts and Nevis</option>
	<option value="LC">Saint Lucia</option>
	<option value="MF">Saint Martin (French part)</option>
	<option value="PM">Saint Pierre and Miquelon</option>
	<option value="VC">Saint Vincent and the Grenadines</option>
	<option value="WS">Samoa</option>
	<option value="SM">San Marino</option>
	<option value="ST">Sao Tome and Principe</option>
	<option value="SA">Saudi Arabia</option>
	<option value="SN">Senegal</option>
	<option value="RS">Serbia</option>
	<option value="SC">Seychelles</option>
	<option value="SL">Sierra Leone</option>
	<option value="SG">Singapore</option>
	<option value="SX">Sint Maarten (Dutch part)</option>
	<option value="SK">Slovakia</option>
	<option value="SI">Slovenia</option>
	<option value="SB">Solomon Islands</option>
	<option value="SO">Somalia</option>
	<option value="ZA">South Africa</option>
	<option value="GS">South Georgia and the South Sandwich Islands</option>
	<option value="SS">South Sudan</option>
	<option value="ES">Spain</option>
	<option value="LK">Sri Lanka</option>
	<option value="SD">Sudan</option>
	<option value="SR">Suriname</option>
	<option value="SJ">Svalbard and Jan Mayen</option>
	<option value="SZ">Swaziland</option>
	<option value="SE">Sweden</option>
	<option value="CH">Switzerland</option>
	<option value="SY">Syrian Arab Republic</option>
	<option value="TW">Taiwan, Province of China</option>
	<option value="TJ">Tajikistan</option>
	<option value="TZ">Tanzania, United Republic of</option>
	<option value="TH">Thailand</option>
	<option value="TL">Timor-Leste</option>
	<option value="TG">Togo</option>
	<option value="TK">Tokelau</option>
	<option value="TO">Tonga</option>
	<option value="TT">Trinidad and Tobago</option>
	<option value="TN">Tunisia</option>
	<option value="TR">Turkey</option>
	<option value="TM">Turkmenistan</option>
	<option value="TC">Turks and Caicos Islands</option>
	<option value="TV">Tuvalu</option>
	<option value="UG">Uganda</option>
	<option value="UA">Ukraine</option>
	<option value="AE">United Arab Emirates</option>
	<option value="GB">United Kingdom</option>
	<option value="US">United States</option>
	<option value="UM">United States Minor Outlying Islands</option>
	<option value="UY">Uruguay</option>
	<option value="UZ">Uzbekistan</option>
	<option value="VU">Vanuatu</option>
	<option value="VE">Venezuela, Bolivarian Republic of</option>
	<option value="VN">Viet Nam</option>
	<option value="VG">Virgin Islands, British</option>
	<option value="VI">Virgin Islands, U.S.</option>
	<option value="WF">Wallis and Futuna</option>
	<option value="EH">Western Sahara</option>
	<option value="YE">Yemen</option>
	<option value="ZM">Zambia</option>
	<option value="ZW">Zimbabwe</option>
</select></div>
                     <div style="clear:both;"></div>
                 </div>
                 <div style="padding:2px 0;margin:2px 0;"><button class="mb mb_g_b" onClick="save_profile_info()"><b><?php echo $save_changes; ?></b></button></div>
             </div>
             <?php if($user_info_show['visibility_c_name']=='1'){ ?>
             <?php if($user_info_show['name']!==''){  ?>
             <div style="border-bottom:1px dotted;padding:4px 0;margin:4px 0;" class="c6">
                 <div style="float:left;"><b>Name:</b></div>
                 <div style="float:right;"><?php echo $user_info_show['name'];  ?></div>
                 <div style="clear:both;"></div>
             </div>
             <?php } ?>
             <?php } ?>
             <div style="border-bottom:1px dotted;padding:4px 0;margin:4px 0;" class="c6">
                 <div style="float:left;"><b><?php echo $joined; ?></b></div>
                 <div style="float:right;"><?php if($_COOKIE['lang'] == 'en'){echo date('M d, Y',$user_info_show['signed_date']);} else { echo date('d/m/Y',$user_info_show['signed_date']); } ?></div>
                 <div style="clear:both;"></div>
             </div>
             <?php if($user_info_show['visibility_c_last_sign_in']=='1'){ ?>
             <div style="border-bottom:1px dotted;padding:4px 0;margin:4px 0;" class="c6">
                 <div style="float:left;"><b><?php echo $last_sign_in; ?></b></div>
                 <div style="float:right;"><?php if($_COOKIE['lang'] == 'en'){echo time_stamp_en($user_info_show['last_login']);} else { echo time_stamp_es($user_info_show['last_login']); } ?></div>
                 <div style="clear:both;"></div>
             </div>
             <?php } ?>
             <?php if($user_info_show['visibility_c_about']=='1'){ ?>
             <?php if($user_info_show['about']!==''){ ?>
             <div style="border-bottom:1px dotted;padding:4px 0;margin:4px 0;" class="c6">
                 <div style="float:left;"><b>About</b></div>
                 <div style="clear:both;"></div>
                 <div style="white-space:pre-wrap;overflow:hidden;"><?php echo $user_info_show['about']; ?></div>
             </div>
             <?php } ?>
             <?php } ?>
             <?php if($user_info_show['visibility_c_subscribers']=='1'){ ?>
             <div style="border-bottom:1px dotted;padding:4px 0;margin:4px 0;" class="c6">
                 <div style="float:left;"><b><?php echo $subscribers; ?></b></div>
                 <div style="float:right;"><?php echo $user_subscribers_total; ?></div>
                 <div style="clear:both;"></div>
             </div>
             <?php } ?>
             <?php if($user_info_show['visibility_c_country']=='1'){ ?>
             <div style="border-bottom:1px dotted;padding:4px 0;margin:4px 0;" class="c6">
                 <div style="float:left;"><b>Country:</b></div>
                 <div style="float:right;"><?php echo $user_info_show['country']; ?></div>
                 <div style="clear:both;"></div>
             </div>
             <?php } ?>
          </div>
          <div class="inner-box c3">
             <div style="float:left;font-size:18px;padding-bottom:5px;" class="c5">
                 <?php echo $recent_activity; ?>
             </div>
             <div style="float:right;">
                 <?php if(isset($_SESSION['username']) && $user_info_show['username']==$my_info_show['username']){ ?><a href="javascript:;" class="c4" style="border-bottom:1px dotted;text-decoration:none;color:<?php echo $user_design_info_show['links_color']; ?>;color:<?php echo $user_design_info_show['links_color']; ?>;">edit</a><?php } ?>
             </div>
             <div style="clear:both;"></div>
          </div>
          <div class="inner-box c3">
             <div style="float:left;font-size:18px;padding-bottom:5px;" class="c5">
                 Subscriptions (<?php echo $user_subscriptions_total2; ?>)
             </div>
             <div style="float:right;">
                 <?php if(isset($_SESSION['username']) && $user_info_show['username']==$my_info_show['username']){ ?><a href="javascript:;" class="c4" style="border-bottom:1px dotted;text-decoration:none;color:<?php echo $user_design_info_show['links_color']; ?>;">edit</a><?php } ?>
             </div>
             <div style="clear:both;"></div>
             <?php
             if($user_subscriptions_total!==0){
                 while($user_subscriptions_info_show = mysqli_fetch_array($user_subscriptions_info)){
                    $user_subscriptions_image_info = mysqli_query($conn,"SELECT * FROM profile_design WHERE username='".$user_subscriptions_info_show['user2']."'");
                    $subscriptions_image = mysqli_fetch_array($user_subscriptions_image_info);
             ?>
             <div style="float:left;width:80px;margin-right:10px;min-height:80px;">
                 <center><div style="height:60px;width:60px;overflow:hidden;border:1px double;background-color:#fff;">
                         <div style="width:400px;text-align:center;margin-left:-170px;">
                             
                             <a href="http://localhost/<?php echo $user_subscriptions_info_show['user2']; ?>"><img src="<?php if($subscriptions_image['profile_image']==''){ ?>http://localhost/img/no_videos_140-vfl121214.png<?php } else { ?>http://localhost/pi/<?php echo $subscriptions_image['profile_image']; } ?>" style="height:60px;"></a>
                         </div>
                     </div>
                     <div style="font-size:11px;text-align:center;"><a href="http://localhost/<?php echo $user_subscriptions_info_show['user2']; ?>"><?php echo $user_subscriptions_info_show['user2']; ?></a></div></center>
             </div>
             <?php
             }
             }
             ?>
             <div style="clear:both;"></div>
          </div>
       </div>
       <div style="float:right;width:640px;">
          <div class="inner-box c3">
             <div style="float:left;font-size:18px;padding-bottom:5px;" class="c5">
                 <?php echo $subscribers; ?> (<?php echo $user_subscribers_total; ?>)
             </div>
             <div style="float:right;">
                 <?php if(isset($_SESSION['username']) && $user_info_show['username']==$my_info_show['username']){ ?><a href="javascript:;" class="c4" style="border-bottom:1px dotted;text-decoration:none;color:<?php echo $user_design_info_show['links_color']; ?>;">edit</a><?php } ?>
             </div>
             <div style="clear:both;"></div>
             <?php
             if($user_subscribers_total!==0){
                 while($user_subscribers_info_show = mysqli_fetch_array($user_subscribers_info)){
                    $subscriber_image_info = mysqli_query($conn,"SELECT * FROM profile_design WHERE username='".$user_subscribers_info_show['user1']."'");
                    $subscriber_image = mysqli_fetch_array($subscriber_image_info);
             ?>
             <div style="float:left;width:80px;margin-right:10px;min-height:80px;">
                 <center><div style="height:60px;width:60px;overflow:hidden;border:1px double;background-color:#fff;">
                         <div style="width:400px;text-align:center;margin-left:-170px;">
                             
                             <a href="http://localhost/<?php echo $user_subscribers_info_show['user1']; ?>"><img id="profile_img" src="<?php if($subscriber_image['profile_image']==''){ ?>http://localhost/img/no_videos_140-vfl121214.png<?php } else { ?>http://localhost/pi/<?php echo $subscriber_image['profile_image']; } ?>" style="height:60px;"></a>
                         </div>
                     </div>
                     <div style="font-size:11px;text-align:center;"><a href="http://localhost/<?php echo $user_subscribers_info_show['user1']; ?>"><?php echo $user_subscribers_info_show['user1']; ?></a></div></center>
             </div>
             <?php
             }
             }
             ?>
             <div style="clear:both;"></div>
          </div>
          <div class="inner-box c3">
             <div style="float:left;font-size:18px;padding-bottom:5px;" class="c5">
                 <?php echo $friends." (".$user_friends_total3.")"; ?>
             </div>
             <div style="float:right;">
                 <?php if(isset($_SESSION['username']) && $user_info_show['username']==$my_info_show['username']){ ?><a href="javascript:;" class="c4" style="border-bottom:1px dotted;text-decoration:none;color:<?php echo $user_design_info_show['links_color']; ?>;">edit</a><?php } ?>
             </div>
             <div style="clear:both;"></div>
             <?php
             if($user_friends_total3!==0){
                 while($user_friends_info_show = mysqli_fetch_array($user_friends_info)){
                    $friend_image_info = mysqli_query($conn,"SELECT * FROM profile_design WHERE username='".$user_friends_info_show['user1']."'");
                    $friend_image = mysqli_fetch_array($friend_image_info);
             ?>
             <div style="float:left;width:80px;margin-right:10px;min-height:80px;">
                 <center><div style="height:60px;width:60px;overflow:hidden;border:1px double;background-color:#fff;">
                         <div style="width:400px;text-align:center;margin-left:-170px;">
                             
                             <a href="http://localhost/<?php echo $user_friends_info_show['user1']; ?>"><img id="profile_img" src="<?php if($friend_image['profile_image']==''){ ?>http://localhost/img/no_videos_140-vfl121214.png<?php } else { ?>http://localhost/pi/<?php echo $friend_image['profile_image']; } ?>" style="height:60px;"></a>
                         </div>
                     </div>
                     <div style="font-size:11px;text-align:center;"><a href="http://localhost/<?php echo $user_friends_info_show['user1']; ?>"><?php echo $user_friends_info_show['user1']; ?></a></div></center>
             </div>
             <?php
             }
             }
             ?>
             <div style="clear:both;"></div>
          </div>
          <div class="inner-box c3">
             <div style="float:left;font-size:18px;padding-bottom:5px;" class="c5">
                 <?php echo $channel_comments; ?> (<?php echo $user_comments_total2; ?>)
             </div>
             <div style="float:right;">
                 <?php if(isset($_SESSION['username']) && $user_info_show['username']==$my_info_show['username']){ ?><a href="javascript:;" class="c4" style="border-bottom:1px dotted;text-decoration:none;color:<?php echo $user_design_info_show['links_color']; ?>;">edit</a><?php } ?>
             </div>
             <div style="clear:both;"></div>
             <div id="comment_list" style="border:1px solid;padding:5px;margin:5px 0;">
                 <div id="new_comment_list"></div>
                 <div id="comment_box_txt" style="display:none;"></div>
                 <div id="comments_pagination_box" style="display:none;"></div>
                 <?php if($user_comments_total2==0){ ?><div style="text-align:center;" class="c6">There is no comment for this user.</div>
                 <?php } else { ?>
                 <div id="actual_comment_list">
                 <?php
                 while($user_comments_info_show = mysqli_fetch_array($user_comments_info))
                 {
                     $comment_image_info = mysqli_query($conn,"SELECT * FROM profile_design WHERE username='".$user_comments_info_show['user1']."'");
                    $comment_image_info_show = mysqli_fetch_array($comment_image_info);
                 ?>
                 <div style="padding-bottom:10px;" id="<?php echo $user_comments_info_show['comment_url']; ?>">
                     <div style="float:left;margin-right:10px;">
                     <div style="height:46px;width:46px;overflow:hidden;background-color:#fff;">
                         <div style="width:400px;text-align:center;margin-left:-177px;background-color:#fff;">
                             <a href="http://localhost/<?php echo $user_comments_info_show['user1']; ?>"><img id="profile_image2" src="<?php if($comment_image_info_show['profile_image']==''||$comment_image_info_show['profile_image']=='default'){ ?>http://localhost/img/no_videos_140-vfl121214.png<?php } else { ?>http://localhost/pi/<?php echo $comment_image_info_show['profile_image']; } ?>" style="height:46px;"></a>
                         </div>
                     </div>
                     </div>
                     <div style="float:left;">
                         <a href="http://localhost/<?php echo $user_comments_info_show['user1']; ?>"><b><?php echo $user_comments_info_show['user1']; ?></b></a> (<?php if($_COOKIE['lang'] == 'en'){ echo time_stamp_en($user_comments_info_show['date']);} else { echo time_stamp_es($user_comments_info_show['date']); } ?>)
                     </div>
                     <div style="text-align:right;"><?php if(isset($_SESSION['username']) && $user_comments_info_show['user1']==$my_info_show['username'] || $user_comments_info_show['user2']==$my_info_show['username']){ ?><a href="javascript:;" onClick="delete_channel_comment('<?php echo $user_comments_info_show['comment_url']; ?>','<?php echo $user_comments_info_show['user1']; ?>')"><?php echo $delete; ?></a><?php } ?>&nbsp;</div>
                     <div style="margin-top:5px;overflow:hidden;" class="c6">
                         <?php echo $user_comments_info_show['comment']; ?>
                     </div>
                     <div style="clear:both;"></div>
                 </div>
                 <?php
                 }
                 ?>
                 </div>
                 <?php
                 }
                 ?>
                 
             </div>
             <div style="padding:2px 0;margin:2px 0;"><?php
                $page = 1;
$page_count = $page*10;

$results_info = mysqli_query($conn,"SELECT * FROM profile_comments WHERE user2='".$user_info_show['username']."' LIMIT $page_count,10");
$total_results = mysqli_num_rows($results_info);

$results_info2 = mysqli_query($conn,"SELECT * FROM profile_comments WHERE user2='".$user_info_show['username']."'");
$total_results2 = mysqli_num_rows($results_info2);

$divide_total_results = $total_results2/10;
?>
<?php if($page > 1 || $page == $divide_total_results){ ?><a href="javascript:;" onClick="pagination('<?php echo $page-1; ?>')"><?php echo " Previous"; ?></a><?php } ?>
<?php
for($x = 1; $x <= $divide_total_results; $x++){
?>
 <a href="javascript:;" onClick="pagination('<?php echo $x ?>')"><?php echo $x; ?></a> 
<?php
}
?>
<?php if($page < $divide_total_results-1){ ?><a href="javascript:;" onClick="pagination('<?php echo $page+1; ?>')"><?php echo "Next"; ?></a> <?php } ?></div>
             <?php
             if(isset($_SESSION['username'])){
             ?>
             <div>
                 <textarea rows="3" id="comment_box" style="width:98%;"></textarea>
             </div>
             <div>
                 <button onClick="post_comment()"><?php echo $add_comment; ?></button>
             </div>
             <?php
             } else {
             ?>
             <div style="margin:5px 0;padding:5px 0;"><a href="http://localhost/login?n=<?php echo $user_info_show['username']; ?>">Sign In</a> to post a comment.</div>
             <?php
             }
             ?>
          </div>
       </div>
       <div style="clear:both;"></div>
   </div>
</div>
</div>
    </body>
</html>
<?php
} else {
    ?>
    <center>This user does not exist.</center>
    <?php
}
?>