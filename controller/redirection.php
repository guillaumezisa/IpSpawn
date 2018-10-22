<html>
  <head>
    <title>IpSpawn</title>
    <script src="../style/bootstrap1.js" ></script>
    <script src="../style/bootstrap2.js" ></script>
    <script src="../style/bootstrap3.js" ></script>
    <link rel="stylesheet" href="../style/bootstrap.css" >
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  </head>
  <body>
  <header>
     <div class="navbar navbar-dark bg-dark shadow-sm">
       <div class="container d-flex justify-content-between">
         <a href="../../index.html" class="navbar-brand d-flex align-items-center"><strong>IpSpawn</strong></a>
         <a href="../view/contact.php" class="navbar-brand d-flex align-items-center"><strong>Contacts</strong></a>
       </div>
     </div>
   </header>

   <main role="main">
<?php
       $outil="<center><div class='container'>
          <br><center><h3><strong>Boite a outils</strong></h3></center>
           <a href='../view/outils.php' class='btn btn-success my-2'>Boite a outils</a>
           <a href='../view/serveur.php' class='btn btn-primary my-2'>Gestion de serveur(s) Debian 9</a>
           <a href='../view/contact.php' class='btn btn-danger my-2'>Guide d'utilisation</a>
         </p>
       </div></center>
       <section class='jumbotron'>";
       $serveur="<center><div class='container'>
          <br><center><h3><strong>Gestion de Serveur</strong></h3></center>
           <a href='../view/outils.php' class='btn btn-success my-2'>Boite a outils</a>
           <a href='../view/serveur.php' class='btn btn-primary my-2'>Gestion de serveur(s) Debian 9</a>
           <a href='../view/contact.php' class='btn btn-danger my-2'>Guide d'utilisation</a>
         </p>
       </div></center>
       <section class='jumbotron'>";

  if ( isset($_GET['action'])){
    if ($_GET["action"] === "plage"){
      echo $outil;
      if ($_GET['status'] === "start"){
        echo "<center><h3>Découpage de plages</h3>";
        echo "Veuillez entrer le nombre de sous réseaux a former :<br>";
        echo "<form action='redirection.php' method='GET'>";
        echo "<input type='number' name='nb_networks' value=''><br>";
        echo "<input type='hidden' name='action' value='plage'>";
        echo "<button name='status' value='go'>Valider</button></center>";
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
          echo "<button name='status' value='end'>Valider</button>";
          echo "</center>";
        }
      }elseif($_GET['status'] === "end"){
        echo "<center><h2> Résultat Calcul de plage :</h2><br>";
        echo "
                Reseau : IpSpawn <br>
                Nombre d'hotes : 5 <br>
                Adresse de départ : 192.168.0.0<br>
                Dernier hote : 192.168.0.254<br>
                Addresse de Broadcast : 192.168.0.255<br></center>
              ";
      }
    }elseif($_GET["action"] === "binaire"){
      echo $outil;
      if ($_GET['status'] === "start"){
        echo "<center><h3>Convertion binaire / decimal</h3>";
        echo "Veuillez entrer la chaine de charactère binaire :<br>";
        echo "<form action='redirection.php' method='GET'>";
        echo "<input type='number' name='nb_binaire' value=''><br>";
        echo "<input type='hidden' name='action' value='binaire'>";
        echo "<button name='status' value='end'>Valider</button></center>";
      }elseif($_GET['status'] === "end"){
        echo "<center><h2> Résultat convertion binaire :</h2><br>";
        echo "11111111 = 255 ";
      }
    }elseif($_GET['action'] === "services"){
      echo $serveur;
      echo "<center><h3>Installation des services</h3>";
      echo "<h5>Une fois le script télécharger faite un su et executez le avec ./nomduscript</h5>";
      include("../controller/gen_services.php");
    }elseif($_GET['action'] === "web"){
      echo $serveur;
      echo "<center><h3>Installation d'un serveur Web</h3>";
      echo "<h5>Une fois le script télécharger faite un su et executez le avec ./nomduscript</h5>";
      include("../controller/gen_server_web.php");
    }elseif($_GET['action'] === "dns"){
      echo $serveur;
      echo "<center><h3>Installation d'un serveur Dns'</h3>";
      echo "<button class='btn'>Télécharger le script</button>";
      echo "<h5>Une fois le script télécharger faite un su et executez le avec ./nomduscript</h5>";
      echo "<br>ici un script !<br>ici un script !<br>ici un script !<br>ici un script !<br>ici un script !<br>ici un script !<br>ici un script !<br>ici un script !<br>ici un script !<br>";
    }elseif($_GET['action'] === "mail"){
      echo $serveur;
      echo "<center><h3>Installation d'un serveur mail'</h3>";
      echo "<button class='btn'>Télécharger le script</button>";
      echo "<h5>Une fois le script télécharger faite un su et executez le avec ./nomduscript</h5>";
      echo "<br>ici un script !<br>ici un script !<br>ici un script !<br>ici un script !<br>ici un script !<br>ici un script !<br>ici un script !<br>ici un script !<br>ici un script !<br>";
    }elseif($_GET['action'] === "user"){
      echo $serveur;
      echo "<center><h3>Gestion des utilisateurs</h3>";
      echo "<h5>Que voulez vous faire ?</h5><br>";
      echo "<a class='btn btn-dark' href='../controller/redirection.php?action=addgroup&status=start'>Ajouter un groupe</a>";
      echo "<a class='btn btn-dark' href='../controller/redirection.php?action=addprivilege&status=start'>Ajouter des privilèges a un groupe</a>";
      echo "<a class='btn btn-dark' href='../controller/redirection.php?action=adduser&status=start'>Ajouter un utilisateur</a><br><br>";
      echo "<a class='btn btn-dark' href='../controller/redirection.php?action=modgroup&status=start'>Modifier un groupe</a>";
      echo "<a class='btn btn-dark' href='../controller/redirection.php?action=modprivilege&status=start'>Modifier les privilèges d'un groupe</a>";
      echo "<a class='btn btn-dark' href='../controller/redirection.php?action=moduser&status=start'>Modifier un utilisateur</a><br><br>";
      echo "<a class='btn btn-dark' href='../controller/redirection.php?action=delgroup&status=start'>Supprimer un groupe</a>";
      echo "<a class='btn btn-dark' href='../controller/redirection.php?action=deluser&status=start'>Supprimer un utilisateur</a><br><br>";
      echo "<a class='btn btn-dark' href='../controller/redirection.php?action=listgroup&status=start'>Lister les groupes et leurs droits</a>";
    } elseif($_GET['action'] === "addgroup"){
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
    } elseif($_GET['action'] === "addprivilege"){
      echo $serveur;
      if($_GET['status'] === "start"){

      }
    }elseif($_GET['action'] === "adduser"){
      echo $serveur;
      if($_GET['status'] === "start"){
        echo "<center><h3>Ajout d'un utilisateur</h3><br>";
        echo "<h5>Nom de l'utilisateur : </h5>";
        echo "<form action='../controller/redirection.php' method='GET'>";
        echo "<input type='hidden' name='action' value='adduser'>";
        echo "<input type='text' name='user' =''>";
        echo "<br><button class='btn btn-dark' name='status' value='end'>Continuer</button>";
        echo "</form>";
      }elseif($_GET['status'] === "end"){
        echo "<center><h3>Génération du script (add_user_".$_GET['user'].".sh)</h3></center>";
        echo "<center><h5>Il est conseiller de mettre vos script dans /root/scripts/ </br>Pour les executer vous devrez faire chmod +x add_group_".$_GET['group'].".sh <br>puis ./add_group_".$_GET['group'].".sh  .<br></center>";
        require('../controller/gen_add_user.php');
      }
    }
  }else {
    header("location:../index.php");
  }
?>
</main>
<footer class="text-muted">
  <div class="container">
    <center><p>Henry Fumey-Humbert . Joran Prigent . Robin Cuvillier . Rodney Nguengue . Guillaume Zisa</p></center>
  </div>
</footer>
</body>
</html>
