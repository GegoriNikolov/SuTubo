<?php
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
echo getDuration("videos/QUOc89Gb6rv24.mp4");
?>