<?php include('includes/dbconnect.php');header("Access-Control-Allow-Origin: *");header("Content-Type: application/json; charset=UTF-8");$u = $_POST['u'];$check_info = mysqli_query($conn, "SELECT * FROM users WHERE username='".$u."'");$check = mysqli_num_rows($check_info);$check_infoo = mysqli_query($conn, "SELECT * FROM friends WHERE user1='".$u."' AND user2='".$my_info_show['username']."'");$checkk = mysqli_num_rows($check_infoo);if(isset($_SESSION['username']) && $my_info_show['username'] !== $u && $check == 1 && $checkk > 0){mysqli_query($conn,"DELETE FROM friends WHERE user1='".$u."' AND user2='".$my_info_show['username']."'");mysqli_query($conn2,"DELETE FROM friends WHERE user1='".$u."' AND user2='".$my_info_show['username']."'");mysqli_query($conn,"DELETE FROM friends WHERE user2='".$u."' AND user1='".$my_info_show['username']."'");mysqli_query($conn2,"DELETE FROM friends WHERE user2='".$u."' AND user1='".$my_info_show['username']."'"); ?>[{"display":"1"}] <?php } else { ?>[{"display":"2"}]<?php } ?>