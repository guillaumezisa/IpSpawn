<?php
  $bro=$_SERVER['HTTP_USER_AGENT'];
  $brow=explode( " ",$bro );
  for ($i=0 ;$i < count($brow) ;$i++){
    $brows=explode( "/", $brow[$i]);
    for($y=0;$y< count($brows); $y++){
      if( $brows[$y] === "Firefox"){
        $browser="firefox";
      }
    }
  }
  if ( isset($index) && $index === true ){
    if ($browser === "firefox"){
      //echo "<link rel='stylesheet' href='style/card_style_firefox.css' >";
    }else{
      echo "<link rel='stylesheet' href='style/card_style.css' >";
    }
  }else{
    if ($browser === "firefox"){
      //echo "<link rel='stylesheet' href='../style/card_style_firefox.css' >";
    }else{
      echo "<link rel='stylesheet' href='../style/card_style.css' >";
    }
  }

?>
