<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Installation d'un serveur web Apache2</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a><br><br>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">

<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT D'INSTALLATION D'APACHE2
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLE DE FICHIERS--------------------------------------------
$file_path="../script/script_client/install_apache2_".session_id().".sh";
$file_name="install_apache2.sh";

#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
include("../view/guide_execution_server_web_apache.php");
echo "<center><a class='btn btn-danger' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script d'installation </a></center><br>";

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
if(isset($_GET['action']) && isset($_GET['under_action'])){
    #CREATION DE VARIABLE D'ISOLEMENT
    $apache='"dpkg -l | grep apache2"';
    #GÉNÉRATION DU SCRIPT-------------------------------------------------------
    $firstline = "
    #!/bin/bash
    #---------------------------------------------------------------------------
    #SCRIPT D'INSTALLATION D'APACHE2 généré par IpSpawn.com
    #---------------------------------------------------------------------------\n";

    $script="

      apt install apache2 -y
      apt install php -y
      apt install mariadb-server

    ";

    #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
    $new_script = $firstline . $script ;
    $file = fopen($file_path, 'w+');
    fputs($file,$new_script);

  }
?>
    </div>
  </section>
</main>
