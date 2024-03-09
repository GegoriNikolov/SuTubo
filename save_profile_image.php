<?php
include('includes/dbconnect.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$fileName = $_FILES["file2"]["name"]; // The file name
$fileTmpLoc = $_FILES["file2"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file2"]["type"]; // The type of file it is
$fileSize = $_FILES["file2"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file2"]["error"]; // 0 for false... and 1 for true
$url = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,100);

?>
<?php
if(isset($_SESSION['username'])){
if($fileType=='image/jpeg' || $fileType=='image/png' || $fileType=='image/gif'){
   if($fileType=='image/jpeg'){
   move_uploaded_file($fileTmpLoc, 'channel_profile_images/'.$url.'.jpg');

   } else if($fileType=='image/png') {
   move_uploaded_file($fileTmpLoc, 'channel_profile_images/'.$url.'.png');

   } else if($fileType=='image/gif') {
   move_uploaded_file($fileTmpLoc, 'channel_profile_images/'.$url.'.gif');

   }
}
?>
[{"display":"<?php if($fileType=='image/jpeg'){ echo $url.".jpg"; } else if($fileType=='image/png'){ echo $url.".png"; } else if($fileType=='image/gif'){ echo $url.".gif"; }; ?>"}]
<?php
} else {
?>
[{"display":"2"}]
<?php
}
?>