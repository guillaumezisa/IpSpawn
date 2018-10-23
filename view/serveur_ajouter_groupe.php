<?php
echo $serveur;
if($_GET['status'] === "start"){
  echo "<center><h3>Ajout d'un groupe'</h3><br>";
  echo "<Nom du groupe : </h5>";
  echo "<form action='../controller/redirection.php' method='GET'>";
  echo "<input type='hidden' name='action' value='addgroup'>";
  echo "<input type='text' name='group' =''>";
  echo "<br><button class='btn btn-dark' name='status' value='end'>Continuer</button>";
  echo "</form>";
}elseif($_GET['status'] === "end"){
  echo "<center><h3>Génération du script (add_group_".$_GET['group'].".sh)</h3></center>";
  echo "<center><h5>Il est conseiller de mettre vos script dans /root/scripts/ </br>Pour les executer vous devrez faire chmod +x add_group_".$_GET['group'].".sh <br>puis ./add_group_".$_GET['group'].".sh  .<br></center>";
  require('../controller/gen_add_group.php');
}
?>
