
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
//GÉNÉRATIONDES VARIABLE DE FICHIERS
$file_path="../script/script_client/add_group_".session_id().".sh";
$file_name="add_group.sh";
//OPTIONS D'AUTODESTRUTION
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");
if(isset($_GET['action']) && isset($_GET['under_action'])){
    if(isset($_GET['groupname'])){
      $nb = count($_GET['groupname']);
      $firstline = "#!/bin/bash\n\n";
      for( $i=0 ;$i<$nb ;$i++){
        $group=$_GET['groupname'][$i]."\n";
        if ($i === 0 ){
          $groupname="user[$i]=".$_GET['groupname'][$i]."\n";
        } else {
          $groupname=$username."user[$i]=".$_GET['groupname'][$i]."\n";
        }
      }
      $group = '${user[$y]}';
      $script="
        for ((y=0;y<".$nb.";y++))
        do
          if grep \"^".$group.":\" /etc/group > /dev/null;
          then
            echo Nom de groupe déjà utilisé .
          else
            addgroup $group > /dev/null
            echo Le groupe a bien été crée
          fi
        done\n";
      $new_script = $firstline . $groupname . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);
    }
  }
?>

</section>
</main>
