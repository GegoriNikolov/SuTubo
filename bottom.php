<script>
function s_h(n){
    if(document.getElementById(n).style.display=='block')
    {
       document.getElementById(n).style.display='none'; 
    } else {
       document.getElementById(n).style.display='block';
    }
}
</script>
<div style="width:960px;padding:10px 0;margin:0 auto;border-top:1px solid #ccc;">
    <div><a class="bottom_ls" href="">Help</a><a class="bottom_ls" href="">About</a><a class="bottom_ls" href="">Privacy</a><a class="bottom_ls" href="">Terms</a></div><div style="padding:5px 0;margin:5px 0;"><span style="color:#444;padding-right:10px;padding-right:10px;">© 2010 SuTubo, LLC</span><span style="color:#444;padding-right:10px;padding-right:10px;"><?php echo $language_txt ?>: <a class="bottom_ls" onmouseover="s_h('language_list_box');" href="javascript:;"><?php echo $_COOKIE['lang']; ?></a></span></div>
    <div id="language_list_box" style="display:none;">
        <div>
            <a href="http://www.sutubo.tk/?lang=en">English</a>
        </div>
        <div>
            <a href="http://www.sutubo.tk/?lang=es">Español</a>
        </div>
    </div>
</div>