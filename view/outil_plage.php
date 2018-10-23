<?php
echo $outil;# $outils contient le titre de la page ( Boite a outil ) <3
  if ($_GET['status'] === "start"){
    echo "<center><h3>Découpage de plages</h3>";
    echo "Veuillez entrer le nombre de sous réseaux a former :<br>";
    echo "<form action='redirection.php' method='GET'>";
    echo "<input type='number' name='nb_networks' value=''><br>";
    echo "<input type='hidden' name='action' value='plage'>";
    echo "<button class='btn btn-dark' name='status' value='go'>Valider</button></center>";
  }elseif($_GET['status'] === "go"){
    if (isset($_GET['nb_networks'])){
      echo "<center><h3>Découpage de plages<br></h3>";
      echo "<form action='redirection.php' method='GET'>";
      echo "L'addresse de départ :<br>";
      echo "<input type='text' name='addr_network' value=''><br>";
      echo "Le masque :<br>";
      echo "<input type='text' name='mask_network' value=''><br><br>";
      echo "<input type='hidden' name='nb_networks' value='".$_GET["nb_network"]."'>";
      for ($i =  0; $i < $_GET['nb_networks'];$i++){
        echo "Nom du réseau &#x200b &#x200b &#x200b";
        echo "<input type='text' name='name_network'.$i.' value=''>";
        echo "&#x200b &#x200b &#x200b Nombre d'hotes &#x200b &#x200b &#x200b";
        echo "<input type='number' name='nb_hote'.$i.' value=''>";
        echo "<br>";
      }
      echo "<input type='hidden' name='action' value='plage'><br>";
      echo "<button class='btn btn-dark' name='status' value='end'>Valider</button>";
      echo "</center>";
    }
  }elseif($_GET['status'] === "end"){
    echo "<center><h2> Résultat Calcul de plage :</h2><br>";
    echo "Reseau : IpSpawn <br>
          Nombre d'hotes : 5 <br>
          Adresse de départ : 192.168.0.0<br>
          Dernier hote : 192.168.0.6<br>
          Addresse de Broadcast : 192.168.0.7<br></center>
        ";
  }
?>
