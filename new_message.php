<?php
include('includes/dbconnect.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if(isset($_SESSION['username'])){
$url = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,200);
$my_info = mysqli_query($conn,"SELECT * FROM users WHERE username='".$_SESSION['username']."'");
$my_info_show = mysqli_fetch_array($my_info);
$my_info_check = mysqli_num_rows($my_info);
$check_user2_info = mysqli_query($conn,"SELECT * FROM users WHERE username='".htmlentities($_POST['compose_to'])."'");
$check_user2 = mysqli_num_rows($check_user2_info);
if($my_info_check!==0 && $check_user2!==0 && $_POST['compose_to'] !== $my_info_show['username']){
mysqli_query($conn,"INSERT INTO messages VALUES('','".$my_info_show['username']."','".htmlentities($_POST['compose_to'])."','".time()."','".htmlentities($_POST['compose_subject'])."','".htmlentities($_POST['compose_message'])."','$url')");
?>
[{"display":"1"}]
<?php
} else {
?>
[{"display":"2"}]
<?php
}
}
?>