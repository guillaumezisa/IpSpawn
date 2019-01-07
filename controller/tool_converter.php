<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Convertisseur</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite à outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
  #ATTENTION ZONE A DEBUGGER
  #CHARGEMENT DE LA FONCTION
  include("../script/script_tools/script_convert.php");
  #VERIFICATION DE L'EXISTENCE DES VARIABLES IMPORTANTES
  if ( isset($_GET['nb']) && isset($_GET['convtype']) ){
    #ADAPTATION DES VARIABLES AVEC LA FONCTION
    $entry = $_GET['nb'];
    $value = $_GET['convtype'];
	  echo "Votre entré : ".$entry."<br>";
    #GESTION DE L'ENTRÉE BINAIRE
    if($value === "0"){
      $bin_to = array(3, 10, 4);
	  $bin_to_name = array("Oct", "Dec", "Hex");
      for($i = 0; $i < 3; $i++){
        $n = $bin_to[$i];
        echo $bin_to_name[$i]." : ".Converter($entry, $n)."<br>";
      }
    #GESTION DU RESTE
    }else{
      echo "Bin : ".Converter($entry, -$value);
    }
  }
?>
