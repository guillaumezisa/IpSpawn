<?php
echo $outil;
if ($_GET['status'] === "start"){
  echo "<center><h3>Convertion binaire / decimal</h3>";
  echo "Veuillez entrer la chaine de charactère binaire :<br>";
  echo "<form action='redirection.php' method='GET'>";
  echo "<input type='number' name='nb_binaire' value=''><br>";
  echo "<input type='hidden' name='action' value='binaire'>";
  echo "<button class='btn btn-dark' name='status' value='end'>Valider</button></center>";
}elseif($_GET['status'] === "end"){
  echo "<center><h2> Résultat convertion binaire :</h2><br>";
  echo "11111111 = 255 ";
}
?>
