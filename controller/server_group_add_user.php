
<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Ajout de d'utilisateur(s) a des groupe(s)</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
    </p>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT D'AJOUT D'UTILISATEURS AU GROUPES
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLE DE FICHIERS--------------------------------------------
$file_path="../script/script_client/add_user_group_".session_id().".sh";
$file_name="add_user_group.sh";

#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }

#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
if(isset($_GET['action']) && isset($_GET['under_action'])){
    if(isset($_GET['username']) && isset($_GET['groupname'])){
      $nb = count($_GET['username']);
      #CONCATENATION DE TABLEAUX BASH---------------------------------------------
      for( $i=0 ;$i<$nb ;$i++){
        if ($i === 0 ){
          $username="user[$i]=".$_GET['username'][$i]."\n";
          $groupname="group[$i]=".$_GET['groupname'][$i]."\n";
        } else {
          $username=$username."user[$i]=".$_GET['username'][$i]."\n";
          $groupname=$groupname."group[$i]=".$_GET['groupname'][$i]."\n";
        }
      }

      #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-----------------
      $user = '${user[$y]}';
      $group = '${group[$y]}';

      #GÉNÉRATION DU SCRIPT-----------------------------------------------------
      $firstline = "
      #!/bin/bash
      #-------------------------------------------------------------------------
      #SCRIPT D'AJOUT D'UTILISATEURS généré par IpSpawn.com
      #-------------------------------------------------------------------------\n";
      $script="
        for ((y=0;y<".$nb.";y++))
        do
          #VÉRIFIE L'EXISTANCE DES L'UTILISATEURS-------------------------------
          id -u ".$user."> /dev/null 2>&1
          if [ $? == 0 ];
          then
            #AJOUT DES UTILISATEURS NON-EXISTANT--------------------------------
            usermod -G ".$group." ".$user." > /dev/null
            echo L'utilisateur a bien été ajouté.
          fi
        done\n";

      #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
      $new_script = $firstline . $username . $groupname . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);

    }
  }
?>

</section>
</main>