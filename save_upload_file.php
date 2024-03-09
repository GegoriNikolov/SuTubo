<?php
include('includes/dbconnect.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if(isset($_SESSION['username'])){

$vid_title = htmlentities($_POST['vid_title']);
$vid_description = htmlentities($_POST['vid_description']);
$vid_tag = htmlentities($_POST['vid_tag']);
$vid_category = htmlentities($_POST['vid_category']);
$vid_privacy = htmlentities($_POST['vid_privacy']);
$url = $_POST['vid_url'];

mysqli_query($conn, "UPDATE videos SET title='$vid_title',description='$vid_description',tag='$vid_tag',category='$vid_category',modified_date='".time()."',privacy='$vid_privacy',thumb='' WHERE url='$url'");
?>
[{"display":"<?php echo $url; ?>"}]
<?php
} else {
?>
[{"display":"2"}]
<?php
}
?>