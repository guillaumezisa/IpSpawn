
<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Modification de mot(s) de passe d'utilisateur(s)</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>
    <section class="jumbotron ">
      <div class="ml-2"><center>
<?php
//GENERATION DU SCRIPT
//OPTIONS D'AUTODESTRUTION
if (isset( $_GET["auto_destruction"] )){ $rm = "rm adduser.sh"; } else { $rm = ""; }
//GÉNÉRATIONDES VARIABLE DE FICHIERS
$file_path="../script/script_client/mod_user_pass_".session_id().".sh";
$file_name="mod_user_pass.sh";
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");
if(isset($_GET['action']) && isset($_GET['under_action'])){
    if(isset($_GET['username']) && isset($_GET['password'])){
      $nb = count($_GET['username']);
      $firstline = "#!/bin/bash\n\n";
      for( $i=0 ;$i<$nb ;$i++){
        $user=$_GET['username'][$i]."\n";
        $pass=$_GET['password'][$i]."\n";
        if ($i === 0 ){
          $username="user[$i]=".$_GET['username'][$i]."\n";
          $password="pass[$i]=".$_GET['password'][$i]."\n";
        } else {
          $username=$username."user[$i]=".$_GET['username'][$i]."\n";
          $password=$password."pass[$i]=".$_GET['password'][$i]."\n";
        }
      }
      $user = '${user[$y]}';
      $pass = '${pass[$y]}';
      $script="
        for ((y=0;y<".$nb.";y++))
        do
          echo -e $pass\n$pass | passwd $user
        done\n";
      $new_script = $firstline . $username . $password . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);

    }
  }
?>

</section>
</main>
