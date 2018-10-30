<?php
		$ip = $_SERVER["REMOTE_ADDR"];
		$nav = $_SERVER["HTTP_USER_AGENT"];
		$day = date("d.m.y");
		$time = date ("H:i:s");
		$when = "[".$time."|".$day."]";

		$x = $when." ".$where." ".$ip." | ".$nav."\n";
		$monfichier = fopen("logs/log_visiteur.txt", 'a+');
		fputs($monfichier, $x);
		fclose($monfichier);
?>
