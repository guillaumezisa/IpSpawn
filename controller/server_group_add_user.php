
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
$file_path="../script/script_client/add_user_group_".session_id().".sh";
$file_name="add_user_group.sh";
//OPTIONS D'AUTODESTRUTION
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");
if(isset($_GET['action']) && isset($_GET['under_action'])){
    if(isset($_GET['username']) && isset($_GET['groupname'])){
      $nb = count($_GET['username']);
      $firstline = "#!/bin/bash\n\n";
      for( $i=0 ;$i<$nb ;$i++){
        $user=$_GET['username'][$i]."\n";
        $group=$_GET['groupname'][$i]."\n";
        if ($i === 0 ){
          $username="user[$i]=".$_GET['username'][$i]."\n";
          $groupname="group[$i]=".$_GET['groupname'][$i]."\n";
        } else {
          $username=$username."user[$i]=".$_GET['username'][$i]."\n";
          $groupname=$groupname."group[$i]=".$_GET['groupname'][$i]."\n";
        }
      }
      $user = '${user[$y]}';
      $group = '${group[$y]}';
      $script="
        for ((y=0;y<".$nb.";y++))
        do
          id -u ".$user."> /dev/null 2>&1
          if [ $? == 0 ];
          then
            usermod -G ".$group." ".$user." > /dev/null
            echo L utilisateur a bien été ajouté.
            ok
          fi
        done\n";
      $new_script = $firstline . $username . $groupname . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);

    }
  }
?>

</section>
</main>
