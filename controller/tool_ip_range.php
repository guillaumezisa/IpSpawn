<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Convertisseur</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
include("../script/script_tools/script_ip_range.php");
  #VERIFICATION DES VARIABLES IMPORTANTES---------------------------------------
  if (isset($_GET['ip']) && isset($_GET['mask'])){
    calc_plage($_GET['ip'], intval($_GET['mask']));
  } else {
    echo "blyat";
  }
?>
