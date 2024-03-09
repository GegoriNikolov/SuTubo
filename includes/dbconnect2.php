<?php
/* header("location: http://www.sutubo.tk/redirect.php"); */
@ini_set( 'upload_max_size' , '100M' );
@ini_set( 'post_max_size', '100M');
@ini_set( 'max_execution_time', '2000' );
date_default_timezone_set('America/New_York');

session_start();
$conn = new mysqli("localhost", "root", "", "sutubo");
if(isset($_SESSION['username'])){
$my_info = mysqli_query($conn,"SELECT * FROM users WHERE username='".$_SESSION['username']."' AND password='".$_SESSION['password']."'");
$my_info_show = mysqli_fetch_array($my_info);
}
if($_COOKIE['lang']=='en')
{
   setcookie('lang', 'en', time() + (86400 * 30), "/");
   include('templates/en.php');   
}
if($_COOKIE['lang']=='es')
{
   setcookie('lang', 'es', time() + (86400 * 30), "/");
   include('templates/es.php');   
}
if(!$_COOKIE['lang'] || $_COOKIE['lang'] == '')
{
   setcookie('lang', 'en', time() + (86400 * 30), "/");
   include('templates/en.php');   
}
include('templates/'.$_COOKIE['lang'].'.php');
if(isset($_GET['lang']))
{
   if($_GET['lang']=='en')
   {
      setcookie('lang', 'en', time() + (86400 * 30), "/");
      include('templates/en.php');  
   }
   if($_GET['lang']=='es')
   {
      setcookie('lang', 'es', time() + (86400 * 30), "/");
      include('templates/es.php');  
   }
}
?>