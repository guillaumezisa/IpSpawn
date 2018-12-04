<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Convertisseur</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
  #ATTENTION ZONE A DEBUGGER
  #CHARGEMENT DE LA FONCTION
  include("../script/script_convert.php");
  #VERIFICATION DE L'EXISTANCE DES VARIABLES IMPORTANTES
  if ( isset($_GET['nb']) && isset($_GET['convtype']) ){
    #ADAPTATION DES VARIABLES AVEC LA FONCTION
    $entry=$_GET['nb'];
    $value=$_GET['convtype'];
    #GESTION DE L'ENTRÉE BINAIRE
    if($value === "0"){
      $bin_to = array(-3, -10, -4);
      for($i = 0; $i < 3; $i++){
        $n = $bin_to[$i];
        echo Converter($entry, $n)."\n";
      }
    #GESTION DU RESTE
    }else{
      echo Converter($entry, $value);
    }
  }
?>
