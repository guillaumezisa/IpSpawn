<?php
  if(isset($_GET['action']) && isset($_GET['under_action'])){
    if(isset($_GET['username']) && isset($_GET['password'])){
      $nb = count($_GET['username']);
      echo $nb;
      for( $i=0 ;$i<$nb ;$i++){
        echo "useradd -m -d \"/home/".$_GET['username'][$i]."\" -s /bin/bash ".$_GET['username'][$i]."<br>";
        echo "echo \"".$_GET['username'][$i].":".$_GET['password'][$i]."\"| chpasswd <br>";
        echo "groupdel -f  ".$_GET['username'][$i]."<br>";
        echo "<br>";
      }
    }
  }
?>
