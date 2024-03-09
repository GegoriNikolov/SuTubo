<div style="border-bottom:1px solid #f3f3f3;">
<div style="width:970px;padding:8.5px 0 0;margin:0 auto 5px;">
    <div style="float:left;">
        <div style="width:110px;height:40px;"><a href="http://localhost/"><img style="width:110px;height:40px;" src="http://localhost/img/logo.jpg"></a></div>
    </div>
    <div id="masthead-utility" <?php if(isset($_SESSION['username'])){ echo "style=\"margin-top:10px;\""; } ?>>
        <a href="http://localhost/navegar" class="ml">Explore</a><a href="http://localhost/my_videos_upload" style="margin-right:60px;" class="ml">Upload</a><?php if(isset($_SESSION['username'])){ ?><span id="" style="position:relative;"><span style="display:none;" id="yt-uix-button-menu" class="yt-uix-button-menu yt-uix-button-menu-text"><a class="yt-uix-button-menu-item" href="http://localhost/<?php echo $my_info_show['username']; ?>">My channel</a><a class="yt-uix-button-menu-item" href="http://localhost/my_subscriptions">My subscriptions</a><a class="yt-uix-button-menu-item" href="http://localhost/inbox">Inbox</a><a class="yt-uix-button-menu-item" href="http://localhost/my_videos">My videos</a><a class="yt-uix-button-menu-item" href="http://localhost/account">Account</a><a class="yt-uix-button-menu-item" href="http://localhost/my_favorites">My favorites</a></span><button onclick="show_n_hide_ub('yt-uix-button-menu')" id="user-btn" class="yt-uix-button yt-uix-button-text"><?php echo $my_info_show['username']; ?> <span style="vertical-align:middle;display:inline-block;border:1px solid transparent;border-width:5px 5px 0;border-top-color:#666;"></span></button></span> <a href="http://localhost/salir" class="ml">Log Out</a><?php } else { ?><a href="http://localhost/crear_cuenta" style="border-left:0;" class="ml">Create Account</a><a href="http://localhost/acceder" class="ml">Log In</a><?php } ?>
    </div>
    <form method="get" onsubmit="if (_gel('masthead-search-term').value == '') return false;" style="overflow:hidden;padding-top:8px;">
        <button class="search-button yt-uix-button">Search</button>
        <div style="position:relative;overflow:hidden;border:1px solid;height:23px;border-color:#8c8c8c #999 #ccc #8c8c8c;">
        <input type="text" id="masthead-search-term" style="line-height:12px;border:2px solid #fff;width:100%;padding:2px 4px 3px;margin:0;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;font:12px arial;">
        </div>
    </form>
    <div style="clear:both;"></div>
</div></div>