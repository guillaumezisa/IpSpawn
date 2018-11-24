
<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Ajout de d'utilisateur(s) a des groupe(s)</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>
    <section class="jumbotron ">
      <div class="ml-2"><center>
<?php
//GENERATION DU SCRIPT
//GÉNÉRATION DES VARIABLE DE FICHIERS
$file_path="../script/script_client/add_right_group_".session_id().".sh";
$file_name="add_right_group.sh";
//OPTIONS D'AUTODESTRUTION
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");
if(isset($_GET['action']) && isset($_GET['under_action'])){
    if(isset($_GET['groupname'])){
      $nb = count($_GET['commands']);
      $firstline = "#!/bin/bash\n\n";
      //CONCATENATION DE TABLEAUX BASH
      $groupname="group=".$_GET['groupname']."\n";
      for( $i=0 ;$i<$nb ;$i++){
        if ($i === 0 ){
          $commands="com[$i]=".$_GET['commands'][$i]."\n";
        } else {
          $commands=$commands."com[$i]=".$_GET['commands'][$i]."\n";
        }
      }
      $group ='$group';
      $group_new='$group_new';
      $com ='${com[$y]}';
      $comm='${com[$y]:1}';
      $which='$(which $neutre)';
      $which_simple='$which';
      $which_com='$(which ${com[$y]})';
      $path ='${path[$y]}';
      $y='$y';
      $string='$string';
      //GÉNÉRATION DU SCRIPT
      $script="
      apt install sudo
      for ((y=0;y<".$nb.";y++))
      do
        if [[ ".$com." =~ ^[!] ]];then
          if [ ".$y." -eq 0 ];then
            neutre=".$comm."
            which=".$which.";
            path[$y]=!".$which_simple."
            echo -n ".$path." > tmp
          else
            neutre=".$comm."
            which=".$which.";
            path[$y]=,!".$which_simple."
            echo -n ".$path." >> tmp
          fi
        else
          if [ ".$y." -eq 0 ];then
            which=".$which_com.";
            path[$y]=".$which_simple."
            echo -n ".$path." > tmp
          else
            which=".$which_com.";
            path[$y]=,".$which_simple."
            echo -n ".$path." >> tmp
          fi
        fi
      done
      group_new='%'".$group.";
      string=$(cat tmp)
      echo ".$group_new."'	ALL=(ALL)' ".$string." >> /etc/sudoers;
      rm tmp
      service sudo restart";

      //RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT
      $new_script = $firstline . $groupname . $commands . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);

    }
  }
?>

</section>
</main>
