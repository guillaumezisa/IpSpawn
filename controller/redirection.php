<?php
include('../view/header.php');
#-------------------------------------------------------------------------------
# REDIRECTION VERS LES ACTIONS PRINCIPALES
#-------------------------------------------------------------------------------
  if ( isset($_GET['enter'])){
    if ($_GET["enter"] === "contact"){
      include('../view/contact.php');
    }elseif($_GET["enter"] === "tools"){
      include('../view/tools.php');
    }elseif($_GET["enter"] === "servers"){
      include('../view/servers.php');
    }
  }elseif ( isset($_GET['action'])){
#-------------------------------------------------------------------------------
#   PLAGE IP
#-------------------------------------------------------------------------------
    if ($_GET["action"] === "ip_range"){
      include('../view/tool_ip_range.php');
#-------------------------------------------------------------------------------
#   CONVERTISSEUR BINAIRE
#-------------------------------------------------------------------------------
    }elseif($_GET["action"] === "binary_converter"){
      include('../view/tool_binary_converter.php');
#-------------------------------------------------------------------------------
#   INSTALLATION SERVEUR WEB
#-------------------------------------------------------------------------------
    }elseif($_GET['action'] === "server_web"){
      include('../view/server_web.php');
#-------------------------------------------------------------------------------
#   INSTALLATION SERVEUR DNS
#-------------------------------------------------------------------------------
    }elseif($_GET['action'] === "server_dns"){
      include('../view/server_dns.php');
#-------------------------------------------------------------------------------
#   INSTALLATION SERVEUR MAIL
#-------------------------------------------------------------------------------
    }elseif($_GET['action'] === "mail"){
      include('../view/server_mail.php');
#-------------------------------------------------------------------------------
#   GESTION DES UTILISATEURS
#-------------------------------------------------------------------------------
    }elseif($_GET['action'] === "user"){
      if (isset($_GET['under_action'])){
        #CREATION UTILISATEURS--------------------------------------------------
        if ($_GET['under_action'] === "add"){
          include("../view/server_user_add.php");
        }elseif ($_GET['under_action'] === "add_gen"){
          include("../controller/server_user_add.php");
        #SUPPRESSION UTILISATEURS-----------------------------------------------
        }elseif ($_GET['under_action'] === "del"){
          include("../view/server_user_delete.php");
        }elseif ($_GET['under_action'] === "del_gen"){
          include("../controller/server_user_delete.php");
        #MODIFICATION UTILISATEURS ( NOM,MDP)-----------------------------------
        }elseif ($_GET['under_action'] === "mod"){
          include("../view/server_user_modify.php");
        }elseif ($_GET['under_action'] === "mod_pass"){
          include("../view/server_user_modify_pass.php");
        }elseif ($_GET['under_action'] === "mod_pass_gen"){
          include("../controller/server_user_modify_pass.php");
        #MODIFICATION-----------------------------------------------------------
        }elseif ($_GET['under_action'] === "mod_name"){
          include("../view/server_user_modify_name.php");
        }elseif ($_GET['under_action'] === "mod_name_gen"){
          include("../controller/server_user_modify_name.php");
        }
      } else {
        include("../view/server_user.php");
      }
#-------------------------------------------------------------------------------
# GROUPES
#-------------------------------------------------------------------------------
    } elseif($_GET['action'] === "group"){
      if (isset($_GET['under_action'])){
        #CREATION DE GROUPES
        if ($_GET['under_action'] === "add"){
          include("../view/server_group_add.php");
        }elseif ($_GET['under_action'] === "add_user"){
          include("../controller/server_group_add_user.php");
        }elseif ($_GET['under_action'] === "add_gen"){
          include("../controller/server_group_add.php");
        #SUPPRESSION DE GROUPES
        }elseif ($_GET['under_action'] === "del"){
          include("../view/server_group_delete.php");
        }elseif ($_GET['under_action'] === "del_gen"){
          include("../controller/server_group_delete.php");
        #AJOUT DE DROITS
        }elseif ($_GET['under_action'] === "add_right"){
          include("../view/server_group_add_right.php");
        }elseif ($_GET['under_action'] === "add_right_gen"){
          include("../controller/server_group_add_right.php");
        #MODIFICATION
        }elseif ($_GET['under_action'] === "mod_name"){
          include("../view/server_group_modify_name.php");
        }elseif ($_GET['under_action'] === "mod_name_gen"){
          include("../controller/server_group_modify_name.php");
        }elseif ($_GET['under_action'] === "mod_reset"){
          include("../view/server_reset.php");
        }elseif ($_GET['under_action'] === "mod_reset_gen"){
          include("../controller/server_group_reset.php");
        }
      } else {
        include('../view/server_group.php');
      }
    } else {
      header("location:../index.php");
    }
  }else {
    header("location:../index.php");
  }
  include('../view/footer.php');
?>
