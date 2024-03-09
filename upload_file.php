<?php
include('includes/dbconnect2.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$fileName = htmlentities($_FILES["file1"]["name"]);
$fileTmpLoc = htmlentities($_FILES["file1"]["tmp_name"]);
$fileType = $_FILES["file1"]["type"];
$fileSize = $_FILES["file1"]["size"];
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
$url = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-'),1,13);
function getDuration($file){
   $dur = shell_exec("C:\\ffmpeg\\bin\\ffmpeg -i ".$file." 2>&1");
   if(preg_match("/: Invalid /", $dur)){
      return false;
   }
   preg_match("/Duration: (.{2}):(.{2}):(.{2})/", $dur, $duration);
   if(!isset($duration[1])){
      return false;
   }
   return $duration[1].":".$duration[2].":".$duration[3];
}
if (isset($_SESSION['username']) && $fileType == 'video/mp4' || $fileType == 'application/octet-stream' || $fileType == 'video/avi' || $fileType == 'video/wmv' || $fileType == 'video/mov') {
	mysqli_query($conn, "INSERT INTO videos VALUES('$fileName','".htmlentities($_POST['vid_title']).
		"','".htmlentities($_POST['vid_description']).
		"','".htmlentities($_POST['vid_tag']).
		"','".htmlentities($_POST['vid_category']).
		"','".time().
		"','".time().
		"','".$my_info_show['username'].
		"','test','".htmlentities($_POST['vid_privacy']).
		"','','0')");
		$ffmpeg = "C:\\ffmpeg\\bin\\ffmpeg";
		$videoFile = $_FILES['file1']['tmp_name'];
		for($num = 1; $num <= 3; $num++)
		{
		   $interval = $num * 3;
		   $getvideocapture = str_replace(":","",getDuration($videoFile))/$interval;
		   shell_exec("$ffmpeg -i $videoFile -an -ss $getvideocapture -s 120x90 videos_thumbnails/test-$num.jpg");
		}
		shell_exec("$ffmpeg -i $videoFile videos/test.mp4");
?>
[{"display":"test"}]
<?php } else { ?>
[{"display":"2"}]
<?php } ?>
