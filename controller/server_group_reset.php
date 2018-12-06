<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Reinitialisation des droit(s)</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT DE REINITIALISATION DES DROITS
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLE DE FICHIERS--------------------------------------------
$file_path="../script/script_client/reset_".session_id().".sh";
$file_name="reset_right.sh";

#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }

#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------

#GÉNÉRATION DU SCRIPT-----------------------------------------------------------
$firstline = "
#!/bin/bash
#-------------------------------------------------------------------------------
#SCRIPT DE REINITIALISATION généré par IpSpawn.com
#V.1.2
#Le : 2018/12/06
#Script par Guillaume Zisa : zisa@intechinfo.fr
#-------------------------------------------------------------------------------\n";
$script="
echo 'Defaults	env_reset' > /etc/sudoers
echo 'Defaults	mail_badpass' >> /etc/sudoers
echo 'Defaults	secure_path=\"/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin\"' >> /etc/sudoers
echo 'root	ALL=(ALL:ALL) ALL' >> /etc/sudoers
";

#RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------------
$new_script = $firstline . $script . $rm;
$file = fopen($file_path, 'w+');
fputs($file,$new_script);

?>
    </div>
  </section>
</main>
