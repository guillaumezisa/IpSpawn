<?php
#-------------------------------------------------------------------------------
#--------------------RÉCUPÉRATION D'INFORMATIONS DU CLIENT----------------------
#-------------------------------------------------------------------------------
#RÉCUPÉRATION DES INFORMATIONS DU CLIENT----------------------------------------
	$ip = $_SERVER["REMOTE_ADDR"];
	$nav = $_SERVER["HTTP_USER_AGENT"];
	$day = date("d.m.y");
	$time = date ("H:i:s");
	$when = "[".$time."|".$day."]";
#CONCATÉNATION DES INFORMATIONS & CRÉATION DU FICHIER DE LOG--------------------
	$x = $when." ".$ip." | ".$nav."\n";
	$monfichier = fopen("logs/log_visiteur.txt", 'a+');
	fputs($monfichier, $x);
	fclose($monfichier);
?>
