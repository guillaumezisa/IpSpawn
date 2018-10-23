<?php
include('../view/header.php');
  if ( isset($_GET['action'])){
    if ($_GET["action"] === "plage"){
      include('../view/outil_plage.php');
    }elseif($_GET["action"] === "binaire"){
      include('../view/outil_binaire.php');
    }elseif($_GET['action'] === "web"){
      include('../view/serveur_web.php');
    }elseif($_GET['action'] === "dns"){
      include('../view/serveur_dns.php');
    }elseif($_GET['action'] === "mail"){
      include('../view/serveur_mail.php');
    }elseif($_GET['action'] === "user"){
      include("../view/serveur_utilisateur.php");
    } elseif($_GET['action'] === "addgroup"){
      include('../view/serveur_ajouter_groupe.php');
    } elseif($_GET['action'] === "addprivilege"){
      include('../view/serveur_ajouter_privilege.php');
    }elseif($_GET['action'] === "adduser"){
      include("../view/serveur_ajouter_utilisateur.php");
    }
  }else {
    header("location:../index.php");
  }
  include('../view/footer.php');
?>
