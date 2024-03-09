<?php
include('includes/dbconnect.php');
include('includes/functions.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$page = $_POST['n'];
$u = $_POST['u'];
$page_count = $page*10;

$results_info = mysqli_query($conn,"SELECT * FROM profile_comments WHERE user2='".$u."' ORDER BY date DESC LIMIT $page_count,10");
$total_results = mysqli_num_rows($results_info);

$outp = "[";
while($results_info_show = mysqli_fetch_array($results_info))
{
    $user_image = mysqli_query($conn,"SELECT * FROM profile_design WHERE username='".$results_info_show['user1']."'");
    $user_image_show = mysqli_fetch_array($user_image);
    if ($outp !== "[") {$outp .= ",";}
    $outp .= '{"c_user1":"'.$results_info_show["user1"].'",';
    $outp .= '"c_image":"'.htmlentities($user_image_show["profile_image"]).'",';
    $outp .= '"c_date":"'.date('M d, Y, '.$results_info_show["date"].'').'",';
    $outp .= '"c_comment":"'.htmlentities($results_info_show["comment"]). '",';
    $outp .= '"c_comment_url":"'.htmlentities($results_info_show["comment_url"]).'"}';
}
$outp .="]"; 

echo $outp;
?>