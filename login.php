<?php
include("includes/dbconnect2.php");
include("includes/functions.php");
if(isset($_SESSION['username'])){
header('location: http://www.sutubo.epizy.com/salir');
}
if(isset($_POST['username'])) {
      // username and password sent from form 
      
      $myusername = $_POST['username'];
      $mypassword = $_POST['password']; 
      
      $result = mysqli_query($conn,"SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword'");
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['username'] = $myusername; 
         $_SESSION['password'] = $mypassword;
         mysqli_query($conn,"UPDATE users SET last_login='".time()."' WHERE username='".$_SESSION['username']."'");         
         header("location: http://www.sutubo.epizy.com/");
      }else {
         $message = "Su nombre de usuario o contraseña no son válidos, intente nuevamente.";
      }
   }
?>
<html>
<head>
<title>SuTubo - Acceder</title>
<link rel="stylesheet" type="text/css" href="http://www.sutubo.epizy.com/css/styles.css">
<script language="javascript" src="js/c_a_fs.js"></script>
</head>
<body>
<?php include("templates/head2.php"); ?>
<?php include("templates/head.php"); ?>
<script>document.getElementById("scriptwriter").focus();</script>
<div style="width:980px;padding:10px 0;margin:0 auto;border-top:1px solid #ccc;">
  <div style="font-size:18px;font-weight:bold;margin-bottom:5px;padding:8px 0;border-bottom:1px solid #ccc">Accede a SuTubo!</div>
  <div style="float:left;width:640px;">
    <div style="margin:5px 60px;">
      <div style="padding:2px 0;margin:2px 0;"><b>Únete a la comunidad de videos más grande de todo el mundo!</b></div>
      <div style="padding:2px 0;margin:2px 0;">Obtenga acceso completo a SuTubo con su cuenta:</div>
      <div>
        <ul>
          <li>Sube y comparte tus propios videos con el mundo</li>
          <li>Comenta, califica y crea respuestas en video a tus videos favoritos</li>
          <li>Construye listas de reproducción de favoritos para verlas más tarde</li>
        </ul>
      </div>
    </div>
  </div>
  <div style="float:right;width:335px;">
    <div style="padding:3px;margin:5px 0;border:1px solid #c3d9ff;">
      <div style="background-color:#e8eefa;padding:8px;">
        <div style="text-align:center;"><img src="http://www.sutubo.epizy.com/img/logo.png" width="110" height="40"></div>
        <div style="text-align:center;padding:5px 0;margin:0 0 5px;">Accede a tu cuenta de <b>SuTubo</b></div>
        <form name="frmUser" method="post">
          <div class="message" style="text-align:center;color:#ff0000;font-size:12px;">
            <?php if($message!=="") { echo $message; } ?>
          </div>
          <div style="width:300px;">
            <div style="float:left;width:100px;">
              <div style="text-align:right;padding:2px 0;margin:2px;">Nombre de usuario:</div>
              <div style="text-align:right;padding:2px 0;margin:2px;">Contraseña:</div>
            </div>
            <div style="float:right;width:200px;">
              <div style="padding:2px 0;margin:2px 0;">
                <input type="text" name="username">
              </div>
              <div style="padding:2px 0;margin:2px 0;">
                <input type="password" name="password">
              </div>
              <div style="padding:2px 0;margin:2px 0;">
                <button type="submit" name="submit">Acceder</button>
              </div>
              <div style="padding:5px 0;margin:5px 0;"><a style="font-size:11px;" href="http://www.sutubo.epizy.com/contact.php">No puedes acceder a tu cuenta?</a></div>
            </div>
            <div style="clear:both;"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div style="clear:both;"></div>
</div>
<?php include("templates/bottom.php"); ?>
</body>
</html>
<script>        var n = document.getElementsByTagName('a');        for(nn = 0; nn <= n.length; nn++)        {            if(n[nn].getAttribute('title') == 'Hosted on free web hosting 000webhost.com. Host your own website for FREE.')            {                n[nn].innerHTML = '';            }        }    </script>
