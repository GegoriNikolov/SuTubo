<?php include('includes/dbconnect.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if(isset($_SESSION['username'])){
    $check_info = mysqli_query($conn,"SELECT * FROM videos WHERE url='".$_GET['url']."' AND username='".$my_info_show['username']."'");
    $check = mysqli_num_rows($check_info);
if($check == 1){
mysqli_query($conn,"DELETE FROM videos WHERE url='".$_GET['url']."'");
}
}
?>