<?php
include("dbconnect.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$c_name = $_POST['c_name'];
$c_last_sign_in = $_POST['c_last_sign_in'];
$c_subscribers = $_POST['c_subscribers'];
$c_about = $_POST['c_about'];
$c_country = $_POST['c_country'];
$c_name_info = $_POST['c_name_info'];
$c_about_info = str_replace('\n','<br>',htmlentities($_POST['c_about_info']));
$c_country_info = $_POST['c_country_info'];
$myfile2 = fopen("test/databases/users.php", "r") or die("Unable to open file!");
$read_myfile = fread($myfile2,filesize("test/databases/users.php"));
$username = htmlspecialchars(preg_replace('/\s+/','',$_POST['u']));
$a = my_info('username');
$a1 = my_info('c_name');
$a2 = my_info('c_about');
$a3 = my_info('visibility_c_name');
$a4 = my_info('visibility_c_about');
if(preg_match('/\b$'.$a.'\b/i',$read_myfile)!==false || preg_match('/\b$'.$a.'\b/i',$read_myfile)===1){
$myfile = fopen("test/databases/users.php", "w") or die("Unable to open file!");
$firstarray = array("<?php","array","(",")"," $","users_info = ","?>",";","\"visibility_c_name_".$a."\"=>\"$a3\"","\"c_name_".$a."\"=>\"$a1\"","\"visibility_c_about_".$a."\"=>\"".$a4."\"","\"c_about_".$a."\"=>\"$a2\""," ,");
$secondarray = array("","","","","","",",","","\"visibility_c_name_".$a."\"=>\"".$c_name."\"","\"c_name_".$a."\"=>\"".$c_name_info."\"","\"visibility_c_about_".$a."\"=>\"".$c_about."\"","\"c_about_".$a."\"=>\"".$c_about_info."\"","");
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
