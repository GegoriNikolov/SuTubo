<?php
include('dbconnect2.php');
   session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["password"]);
   header("Location: http://www.sutubo.epizy.com/");
?>