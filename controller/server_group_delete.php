
<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Suppression de groupe(s)</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>
    <section class="jumbotron ">
      <div class="ml-2"><center>
<?php
//GENERATION DU SCRIPT
//OPTIONS D'AUTODESTRUTION
if (isset( $_GET["auto_destruction"] )){ $rm = "rm addgroup.sh"; } else { $rm = ""; }
  //GÉNÉRATIONDES VARIABLE DE FICHIERS
  $file_path="../script/script_client/del_group_".session_id().".sh";
  $file_name="del_group.sh";
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
        } else {
          $groupname=$groupname."group[$i]=".$_GET['groupname'][$i]."\n";
        }
      }
      $group = '${group[$y]}';
      $script="
        for ((y=0;y<".$nb.";y++))
        do
          groupdel ".$group."\n
        done\n";
      $new_script = $firstline . $groupname . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);
    }
  }
?>

</section>
</main>
