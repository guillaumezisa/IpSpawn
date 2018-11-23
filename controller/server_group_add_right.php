
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
      $nb = count($_GET['groupname']);
      $firstline = "#!/bin/bash\n\n";
      //CONCATENATION DE TABLEAUX BASH
      for( $i=0 ;$i<$nb ;$i++){
        if ($i === 0 ){
          $groupname="group[$i]=".$_GET['groupname'][$i]."\n";
          $commandyes="yes[$i]=".$_GET['commandyes'][$i]."\n";
          $commandno="no[$i]=".$_GET['commandno'][$i]."\n";
        } else {
          $groupname=$groupname."group[$i]=".$_GET['groupname'][$i]."\n";
          $commandyes=$commandyes."yes[$i]=".$_GET['commandyes'][$i]."\n";
          $commandno=$commandno."no[$i]=".$_GET['commandno'][$i]."\n";
        }
      }
      $group = '${group[$y]}';
      $yes = '${yes[$y]}';
      $no = '${no[$y]}';
      //GÉNÉRATION DU SCRIPT
      $script="
        for ((y=0;y<".$nb.";y++))
        do

        done\n";
      //RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT
      echo $new_script = $firstline . $groupname . $commandyes . $commandno . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);

    }
  }
?>

</section>
</main>
