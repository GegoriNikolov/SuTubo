<?php
include('includes/dbconnect.php');
include('includes/functions.php');

$v = $_GET['v'];

$v_info = mysqli_query($conn,"SELECT * FROM videos WHERE url='".$v."'");
$v_info_show = mysqli_fetch_array($v_info);
$increase = $v_info_show['visitas']+1;

$check_ip_info = mysqli_query($conn,"SELECT * FROM videos_views WHERE ip='".$_SERVER['REMOTE_ADDR']."' AND url='".$v_info_show['url']."'");
$check_ip = mysqli_num_rows($check_ip_info);
if($check_ip<=100){
mysqli_query($conn,"INSERT INTO videos_views VALUES('".$_SERVER['REMOTE_ADDR']."','$increase','".$v_info_show['url']."')");
}
$show_video_views_info = mysqli_query($conn,"SELECT * FROM videos_views WHERE url='".$v_info_show['url']."'");
$show_video_views = mysqli_num_rows($show_video_views_info);
$user_subscribers_info = mysqli_query($conn,"SELECT * FROM profile_subscribers WHERE user2='".$v_info_show."'");
$user_subscribers_total = mysqli_num_rows($user_subscribers_info);
$user_subscribers_infoo = mysqli_query($conn,"SELECT * FROM profile_subscribers WHERE user2='".$v_info_show['username']."'");

$user_subscribers_info_showw = mysqli_fetch_array($user_subscribers_infoo);
if(isset($_SESSION['username'])){
$user_subscribers_check1 = mysqli_query($conn,"SELECT * FROM profile_subscribers WHERE user2='".$v_info_show['username']."' AND user1='".$my_info_show['username']."'");
$user_subscribers_check1_total = mysqli_num_rows($user_subscribers_check1);
}
$video_user_design_info = mysqli_query($conn,"SELECT * FROM profile_design WHERE username='".$v_info_show['username']."'");
$video_user_design_info_show = mysqli_fetch_array($video_user_design_info);

?>

<html>

    <head>

        

        <title>SuTubo - <?php if($v_info_show['title']==''){echo $v_info_show['name'];} else { echo $v_info_show['title']; }?></title>

        

        <link rel="stylesheet" type="text/css" href="http://localhost/css/styles.css">

    <link rel="icon" href="http://localhost/favicon.ico" type="image/x-icon">

    <link rel="shortcut icon" href="http://localhost/favicon.ico" type="image/x-icon">

        

        <script>

            var username = "<?php echo $v_info_show['username']; ?>";

            function subscribe_f()

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

    document.getElementById('subscribe_btn').innerHTML = '<b><?php echo $subscribed_txt; ?></b>';

    document.getElementById('subscribe_btn').className = 'mb mb_g_w';

    } else {

    document.getElementById('comment_box_txt').innerHTML = '<?php echo $please_check_every_field_and_try_again; ?>';

    }

    }

};

xmlhttp.open("POST", 'subscribe_file.php', true);

xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

xmlhttp.send('u='+username+'');

            }
function post_vid_comment() {
    var xmlhttp = new XMLHttpRequest();
    document.getElementById('loading-box').innerHTML = 'Loading...';
    document.getElementById('loading-box').style.display = 'block';
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var arr = JSON.parse(this.responseText);
            var out = "";
            for (i = 0; i < arr.length; i++) {
                out += arr[i].display;
            }
            if (out == '1') {
                document.getElementById('loading-box').innerHTML = 'Comment posted.';
            } else {
                document.getElementById('loading-box').innerHTML = 'Something went wrong... Please, try again.';
            }
        }
    };
    xmlhttp.open("POST", 'post_vid_comment.php', true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send('c=' + document.getElementById('vid_comment_box') + '');
}
        </script>

        

    </head>

    <body>

        <?php include("templates/head.php"); ?>
        <?php include("templates/head2.php"); ?>

<div style="width:960px;padding:10px 0;margin:0 auto;border-top:1px solid #ccc;">

   <div style="font-size:19px;padding:4px 0;margin:4px 0;font-weight:bold;"><?php if($v_info_show['title']==''){echo $v_info_show['name'];} else { echo $v_info_show['title']; }?></div>

   <div style="float:left;width:640px;">
   <video width="640" height="385" controls>
  <source src="http://localhost/videos/<?php echo $v_info_show['url']; ?>.mp4" type="video/mp4" style="width:640px;height:285px;background-color:#000;">
Your browser does not support the video tag.
</video>
      <div style="padding:2px 0;margin:2px 0;">
          <div style="float:left;"></div>
          <div style="float:right;"><b><?php echo $show_video_views; ?></b> vistas</div>
          <div style="clear:both;"></div>
      </div>
      <div>
          <div><span style="font-size:16px;font-weight:bold;">Would you like to comment?</span> <a href="http://localhost/login?n=http://localhost/watch?v=<?php echo $v_info_show['url']; ?>">Sign In</a> or <a href="http://localhost/create_account">Create an account</a></div>
      </div>
   </div>

   <div style="float:right;width:310px;font-size:12px;">

       <div style="border:1px solid #ccc;background-color:#eee;padding:6px;">

           <div style="float:left;margin-right:6px;">

               <div style="width:46px;height:46px;overflow:hidden;border:3px double #999;background-color:#fff;">

                  <div style="margin-left:-177px;width:400px;float:left;text-align:center;">

                    <a href="http://localhost/<?php echo $v_info_show['username']; ?>"><img style="height:46px;" src="<?php if($video_user_design_info_show['profile_image']==''){ ?>http://localhost/img/no_videos_140-vfl121214.png<?php } else { ?>http://localhost/pi/<?php echo $video_user_design_info_show['profile_image']; ?><?php } ?>"></a>

                  </div>

               </div>

           </div>

           <div style="float:left;width:140px;overflow:hidden;">

               <div style="padding-bottom:3px;margin-bottom:3px;width:130px;overflow:hidden;text-overflow:ellipsis;"><a title="<?php echo $v_info_show['username']; ?>" href="http://localhost/<?php echo $v_info_show['username']; ?>"><b><?php echo $v_info_show['username']; ?></b></a></div>

               <div style="color:#333;">

                   <?php if($_COOKIE['lang'] == 'en'){echo date('M d, Y',$v_info_show['upload_date']);} else { echo date('d/m/Y',$v_info_show['upload_date']); } ?>

               </div>

           </div>

           <div style="float:left;">

               <?php if(isset($_SESSION['username'])){ if($user_subscribers_check1_total==1){ ?><a style="display:inline-block;padding:0 12px;border-radius:3px;border:1px solid #ecc101;color:#994800;background:#fed81c url(img/master-vfl136487.png) repeat-x center -2202px;line-height:17px;" href="javascript:;" onClick="subscribe_f();" id="subscribe_btn"><b>Suscrito</b></b></a><?php } else { ?><a style="display:inline-block;padding:0 12px;border-radius:3px;border:1px solid #ecc101;color:#994800;background:#fed81c url(img/master-vfl136487.png) repeat-x center -2202px;line-height:17px;" href="javascript:;" onClick="subscribe_f();" id="subscribe_btn"><b>Suscribirse</b></a><?php } } else if(!isset($_SESSION['username'])){ ?><a style="display:inline-block;padding:0 12px;border-radius:3px;border:1px solid #ecc101;color:#994800;background:#fed81c url(img/master-vfl136487.png) repeat-x center -2202px;line-height:17px;" href="javascript:;" onClick="subscribe_f();" id="subscribe_btn"><b>Suscribirse</b></a><?php } ?>

           </div>

           <div style="clear:both;"></div>

           <div style="padding:5px 0;margin:5px 0;border-bottom:1px solid #ccc;width:195px;text-overflow:ellipsis;overflow:hidden;max-height:50px;"><?php if($v_info_show['description']==''){?><span style="color:#666;font-style:italic;">No hay descripción para este video.</span><?php } else {
               echo $v_info_show['description']; }
?></div>

           <div style="font-size:11px;color:#666;margin-bottom:4px;"><span style="margin-right:8px;"><b>URL:</b></span><input type="text" value="http://localhost/watch?v=<?php echo $v_info_show['url']; ?>" style="font-size:10px;width:200px;"></div>

       </div>
       
       <div class="yt-uix-expander-head">
       <span class="yt-uix-expander-arrow yt-uix-expander-arrow-down"></span> <span style="font-size:16px;font-weight:bold;">Videos relacionados</span>
   </div>
   <div style="border:1px solid #ccc;padding:5px;overflow:auto;height:430px;">
   <?php
   $related_videos = mysqli_query($conn,"SELECT * FROM videos LIMIT 10");
   while($show_related_videos = mysqli_fetch_array($related_videos)){
       $show_video_views_info2 = mysqli_query($conn,"SELECT * FROM videos_views WHERE url='".$show_related_videos['url']."'");
$show_video_views2 = mysqli_num_rows($show_video_views_info2);
   ?>
   <div style="margin-bottom:5px;">
      <a href="http://localhost/watch?v=<?php echo $show_related_videos['url']; ?>" style="float:left;display:block;overflow:hidden;border:3px double #999;width:90px;height:54px;margin-right:10px;"><img src="http://localhost/<?php if($show_related_videos['thumb']==''){ echo "img/default.jpg"; } else { echo "vi/".$show_related_videos['url']."/hqdefault.jpg"; } ?>" style="margin-top:-10px;width:90px;height:70px;"></a>
      <div style="float:left;width:150px;">
          <div style="width:150px;overflow:hidden;overflow:hidden;text-overflow:ellipsis;max-height:32px;"><a href="http://localhost/watch?v=<?php echo $show_related_videos['url']; ?>"><b><?php if($show_related_videos['title']==''){echo $show_related_videos['name'];}else{echo $show_related_videos['title'];} ?></b></a></div>
          <div style="width:150px;overflow:hidden;overflow:hidden;text-overflow:ellipsis;color:#666;font-size:11px;"><?php echo $show_video_views2; ?> vistas</div>
          <div style="width:150px;overflow:hidden;overflow:hidden;text-overflow:ellipsis;font-size:11px;"><a title="<?php echo $show_related_videos['username']; ?>" href="http://localhost/<?php echo $show_related_videos['username']; ?>"><?php echo $show_related_videos['username']; ?></a></div>
      </div>
      <div style="clear:both;"></div>
   </div>
   <?php
   }
   ?>
   </div>

   </div>
   
   <div style="clear:both"></div>

</div>

        <?php include("templates/bottom.php"); ?>

    </body>

</html>

<script>
        var n = document.getElementsByTagName('a');
        for(nn = 0; nn <= n.length; nn++)
        {
            if(n[nn].getAttribute('title') == 'Hosted on free web hosting 000webhost.com. Host your own website for FREE.')
            {
                n[nn].innerHTML = '';
            }
        }
    </script>