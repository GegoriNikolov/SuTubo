<?php
include('includes/dbconnect.php');
    
    $user = 'SuTuboVEVO5';
    mysqli_query($conn,"DELETE FROM users WHERE username='$user'");
    mysqli_query($conn,"DELETE FROM profile_design WHERE username='$user'");
    mysqli_query($conn,"DELETE FROM friends WHERE user1='$user'");
    mysqli_query($conn,"DELETE FROM friends WHERE user2='$user'");
    mysqli_query($conn,"DELETE FROM friends_requests WHERE user1='$user'");
    mysqli_query($conn,"DELETE FROM friends_requests WHERE user2='$user'");
    mysqli_query($conn,"DELETE FROM profile_subscribers WHERE user1='$user'");
    mysqli_query($conn,"DELETE FROM profile_subscribers WHERE user2='$user'");
    mysqli_query($conn,"DELETE FROM profile_comments WHERE user1='$user'");
    mysqli_query($conn,"DELETE FROM profile_comments WHERE user2='$user'");
    /* mysqli_query($conn,"INSERT INTO friends VALUES('Herotrap','xLegend','1561817606')");
    mysqli_query($conn,"UPDATE videos SET thumb='1' WHERE url='QvN5f-aOoCM4n'");
    mysqli_query($conn,"UPDATE videos SET thumb='1' WHERE url='HqDJLyvme6sY9'");
    mysqli_query($conn,"UPDATE videos SET thumb='1' WHERE url='2wzeBqDGp_EX1'");
    $check = mysqli_query($conn,"SELECT * FROM friends ORDER BY date DESC");
    while($check_show = mysqli_fetch_array($check))
    {
        echo $check_show['user1']." / ".$check_show['user2']."<br>";
    } */
?>