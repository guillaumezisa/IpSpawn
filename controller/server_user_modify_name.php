
<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Modification d\'utilisateurs(s)</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>
    <section class="jumbotron ">
      <div class="ml-2"><center>
<?php
//GENERATION DU SCRIPT
//GÉNÉRATIONDES VARIABLE DE FICHIERS
$file_name="mod_name.sh";
$file_path="../script/script_client/mod_name_".session_id().".sh";
//OPTIONS D'AUTODESTRUTION
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }

echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");
if(isset($_GET['action']) && isset($_GET['under_action'])){
    if(isset($_GET['username1']) && isset($_GET['username2'])){
      $nb = count($_GET['username1']);
      $firstline = "#!/bin/bash\n\n";
      //CONCATENATION DE TABLEAUX BASH
      for( $i=0 ;$i<$nb ;$i++){
        if ($i === 0 ){
          $username1="user1[$i]=".$_GET['username1'][$i]."\n";
          $username2="user2[$i]=".$_GET['username2'][$i]."\n";
        } else {
          $username1=$username1."user1[$i]=".$_GET['username1'][$i]."\n";
          $username2=$username2."user2[$i]=".$_GET['username2'][$i]."\n";
        }
      }
      $user1 = '${user1[$y]}';
      $user2 = '${user2[$y]}';
      $script="
        for ((y=0;y<".$nb.";y++))
        do
          usermod --login $user2 --home /home/\"$user2\" --move-home $user1
        done\n";
      $new_script = $firstline . $username1 . $username2 . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);

    }
  }
?>

</section>
</main>
