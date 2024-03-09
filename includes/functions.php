<?php
function time_stamp_es($session_time) 
{ 
$time_difference = time() - $session_time ; 

$seconds = $time_difference ; 
$minutes = round($time_difference / 60 );
$hours = round($time_difference / 3600 ); 
$days = round($time_difference / 86400 ); 
$weeks = round($time_difference / 604800 ); 
$months = round($time_difference / 2419200 ); 
$years = round($time_difference / 29030400 ); 
// Seconds
if($seconds <= 59)
{
echo "hace $seconds segundos"; 
}
//Minutes
else if($minutes <=59)
{

   if($minutes==1)
  {
   echo "hace 1 minuto"; 
   }
   else
   {
    echo "hace $minutes minutos"; 
   }

}
//Hours
else if($hours <=23)
{

   if($hours==1)
  {
   echo "hace 1 hora";
  }
  else
  {
   echo "hace $hours horas";
  }

}
//Days
else if($days <= 6)
{

  if($days==1)
  {
   echo "hace 1 dia";
  }
  else
  {
   echo "hace $days dias";
   }

}
//Weeks
else if($weeks <= 3)
{

   if($weeks==1)
  {
   echo "hace 1 semana";
   }
  else
  {
   echo "hace $weeks semanas";
  }

}
//Months
else if($months <=11)
{

   if($months==1)
  {
   echo "hace 1 mes";
   }
  else
  {
   echo "hace $months meses";
   }

}
//Years
else
{

   if($years==1)
   {
    echo "hace 1 año";
   }
   else
  {
    echo "hace $years años";
   }

}
}
function time_stamp_en($session_time) 
{ 
$time_difference = time() - $session_time ; 

$seconds = $time_difference ; 
$minutes = round($time_difference / 60 );
$hours = round($time_difference / 3600 ); 
$days = round($time_difference / 86400 ); 
$weeks = round($time_difference / 604800 ); 
$months = round($time_difference / 2419200 ); 
$years = round($time_difference / 29030400 ); 
// Seconds
if($seconds <= 59)
{
echo "$seconds seconds ago"; 
}
//Minutes
else if($minutes <=59)
{

   if($minutes==1)
  {
   echo "1 minute ago"; 
   }
   else
   {
    echo "$minutes minutes ago"; 
   }

}
//Hours
else if($hours <=23)
{

   if($hours==1)
  {
   echo "1 hours ago";
  }
  else
  {
   echo "$hours hours ago";
  }

}
//Days
else if($days <= 6)
{

  if($days==1)
  {
   echo "1 day ago";
  }
  else
  {
   echo "$days days ago";
   }

}
//Weeks
else if($weeks <= 3)
{

   if($weeks==1)
  {
   echo "1 week ago";
   }
  else
  {
   echo "$weeks weeks ago";
  }

}
//Months
else if($months <=11)
{

   if($months==1)
  {
   echo "1 month ago";
   }
  else
  {
   echo "hace $months meses";
   }

}
//Years
else
{

   if($years==1)
   {
    echo "1 year ago";
   }
   else
  {
    echo "$years years ago";
   }

}
}
function getDuration($file){
if (file_exists($file)){
 ## open and read video file
$handle = fopen($file, "r");
## read video file size
$contents = fread($handle, filesize($file));
fclose($handle);
$make_hexa = hexdec(bin2hex(substr($contents,strlen($contents)-3)));
if (strlen($contents) > $make_hexa){
$pre_duration = hexdec(bin2hex(substr($contents,strlen($contents)-$make_hexa,3))) ;
$post_duration = $pre_duration/1000;
$timehours = $post_duration/3600;
$timeminutes =($post_duration % 3600)/60;
$timeseconds = ($post_duration % 3600) % 60;
$timehours = explode(".", $timehours);
$timeminutes = explode(".", $timeminutes);
$timeseconds = explode(".", $timeseconds);
$duration = $timehours[0]. ":" . $timeminutes[0]. ":" . $timeseconds[0];}
return $duration;
}
else {
return false;
}
}
?>