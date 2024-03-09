<?php
include('includes/dbconnect2.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$u = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['u']);
$p = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['p']);
$c = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['c']);
$e = preg_replace('/[^a-zA-Z0-9@.]/', '', $_POST['e']);
$check_info = mysqli_query($conn, "SELECT * FROM users WHERE username='".$u."'");
$check = mysqli_num_rows($check_info);
if($check==0){
    mysqli_query($conn,"INSERT INTO users VALUES('".$u."','".$p."','".$c."','".time()."','".time()."','','','','1','1','1','1','1','".$_SERVER['REMOTE_ADDR']."','0','','','','','','".$e."')");
    mysqli_query($conn,"INSERT INTO profile_design VALUES('".$u."','#CCCCCC','#999999','#eeeeff','#333333','#000000','#0000cc','Arial','','','','')");
?>
[{"display":"1"}]
<?php
} else {
?>
[{"display":"2"}]
<?php
}
?>