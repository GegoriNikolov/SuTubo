<?php
include("dbconnect.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$comments = $_POST['comments'];
$subscribers = $_POST['subscribers'];
$friends = $_POST['friends'];
$recent_activity = $_POST['recent_activity'];
$subscriptions = $_POST['subscriptions'];
$a = my_info('username');
$a1 = my_info('comments');
$a2 = my_info('subscribers');
$a3 = my_info('friends');
$a4 = my_info('subscriptions');
$myfile2 = fopen("test/databases/users.php", "r") or die("Unable to open file!");
$read_myfile = fread($myfile2,filesize("test/databases/users.php"));
if(preg_match('/\b$'.$a.'\b/i',$read_myfile)!==false || preg_match('/\b$'.$a.'\b/i',$read_myfile)===1){
$myfile = fopen("test/databases/users.php", "w") or die("Unable to open file!");
$firstarray = array("<?php","array","(",")"," $","users_info = ","?>",";","\"comments_".$a."\"=>\"".$a1."\"","\"subscribers_".$a."\"=>\"".$a2."\"","\"friends_".$a."\"=>\"".$a3."\"","\"subscriptions_".$a."\"=>\"".$a4."\""," ,");
$secondarray = array("","","","","","",",","","\"comments_".$a."\"=>\"".$comments."\"","\"subscribers_".$a."\"=>\"".$subscribers."\"","\"friends_".$a."\"=>\"".$friends."\"","\"subscriptions_".$a."\"=>\"".$subscriptions."\"","");
$firstarray_ = str_replace($firstarray,$secondarray,$read_myfile);
$txt = "<?php $"."users_info = array(".$firstarray_."); ?>";
fwrite($myfile, $txt);
?>
[{"display":"1"}]
<?php
} else {
?>
[{"display":"2"}]
<?php
} 
?>