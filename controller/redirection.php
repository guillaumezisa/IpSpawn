<?php
#-------------------------------------------------------------------------------
# GESTION DE LA REDIRECTION DU SITE
#-------------------------------------------------------------------------------
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
      if (isset($_GET['under_action'])){
        include('../controller/tool_ip_range.php');
      }else {
        include('../view/tool_ip_range.php');
      }
#-------------------------------------------------------------------------------
#   CONVERTISSEUR
#-------------------------------------------------------------------------------
    }elseif($_GET["action"] === "converter"){
      if (isset($_GET['under_action']) && $_GET['under_action'] === "result"){
        include('../controller/tool_converter.php');
      } else {
        include('../view/tool_converter.php');
      }

#-------------------------------------------------------------------------------
#   INSTALLATION SERVEUR WEB
#-------------------------------------------------------------------------------
    }elseif($_GET['action'] === "server_web"){
      if(isset($_GET["under_action"])){
        if($_GET["under_action"] === "apache"){
          include('../controller/server_web_apache_gen.php');
        }elseif($_GET["under_action"] === "nginx"){
          include('../controller/server_web_nginx_gen.php');
        }else {
          include('../view/server_web.php');
        }
      }else {
        include('../view/server_web.php');
      }
#-------------------------------------------------------------------------------
#   INSTALLATION SERVEUR DNS
#-------------------------------------------------------------------------------
    }elseif($_GET['action'] === "server_dns"){
      if( isset($_GET['under_action']) ){
        if ($_GET['under_action'] === "install_dns_gen"){
          include('../controller/server_dns.php');
        } else {
          include('../view/server_dns.php');
        }
      }else {
        include('../view/server_dns.php');
      }
#-------------------------------------------------------------------------------
#   INSTALLATION SERVEUR MAIL
#-------------------------------------------------------------------------------
}elseif($_GET['action'] === "server_mail"){
  if (isset($_GET['under_action'])){
    if ($_GET['under_action'] === "gen_mail"){
      include('../controller/server_mail.php');
    }
  }else {
    include('../view/server_mail.php');
  }
#-------------------------------------------------------------------------------
#   INSTALLATION SERVEUR SAMBA
#-------------------------------------------------------------------------------
}elseif($_GET['action'] === "server_samba"){
  if (isset($_GET['under_action'])){
    if ($_GET['under_action'] === "install"){
    #INSTALLATION CRÉATION DES ZONES DE STOCKAGES-------------------------------
      include('../view/server_samba_install.php');
    } elseif ($_GET['under_action'] ==="install_gen"){
      include('../controller/server_samba_install.php');
    #MODIFICATION DES ZONES DE STOCKAGE-----------------------------------------
    }elseif ($_GET['under_action'] ==="mod"){
      include('../view/server_samba_modify.php');
    }elseif ($_GET['under_action'] ==="mod_gen"){
      include('../controller/server_samba_modify.php');
    }
  }else {
    include('../view/server_samba.php');
  }
#-------------------------------------------------------------------------------
#   MISE EN PLACE D'UNE IP FIXE
#-------------------------------------------------------------------------------
}elseif($_GET['action'] === "ip_static"){
  if (isset($_GET['under_action'])){
    #GÉNÉRATION DES SCRIPTS IP STATIC ET REINITIALISATION-✔---------------------
    if ($_GET['under_action'] === "gen"){
      include('../controller/server_ip_static.php');
    }
  }else {
    include('../view/server_ip_static.php');
  }
#-------------------------------------------------------------------------------
#   GESTION DES UTILISATEURS
#-------------------------------------------------------------------------------
    }elseif($_GET['action'] === "user"){
      if (isset($_GET['under_action'])){
        #CREATION UTILISATEURS-✔-----------------------------------------------
        if ($_GET['under_action'] === "add"){
          include("../view/server_user_add.php");
        }elseif ($_GET['under_action'] === "add_gen"){
          include("../controller/server_user_add.php");
        #SUPPRESSION UTILISATEURS-----------------------------------------------
        }elseif ($_GET['under_action'] === "del"){
          include("../view/server_user_delete.php");
        }elseif ($_GET['under_action'] === "del_gen"){
          include("../controller/server_user_delete.php");
        #MODIFICATION UTILISATEURS ( NOM,MDP)-✔---------------------------------
        }elseif ($_GET['under_action'] === "mod"){
          include("../view/server_user_modify.php");
        #MODIFICATION ( MDP )-✔-------------------------------------------------
        }elseif ($_GET['under_action'] === "mod_pass"){
          include("../view/server_user_modify_pass.php");
        }elseif ($_GET['under_action'] === "mod_pass_gen"){
          include("../controller/server_user_modify_pass.php");
        #MODIFICATION ( NOM )-✔-------------------------------------------------
        }elseif ($_GET['under_action'] === "mod_name"){
          include("../view/server_user_modify_name.php");
        }elseif ($_GET['under_action'] === "mod_name_gen"){
          include("../controller/server_user_modify_name.php");
        }
      } else {
        include("../view/server_user.php");
      }
#-------------------------------------------------------------------------------
#   GROUPES
#-------------------------------------------------------------------------------
    } elseif($_GET['action'] === "group"){
      if (isset($_GET['under_action'])){
        #CREATION DE GROUPES-✔--------------------------------------------------
        if ($_GET['under_action'] === "add_group"){
          include("../view/server_group_add.php");
        }elseif ($_GET['under_action'] === "add_group_gen"){
          include("../controller/server_group_add.php");
        #AJOUT D'UTILISATEURS AUX GROUPES-✔-------------------------------------
        }elseif ($_GET['under_action'] === "add_user"){
          include("../view/server_group_add_user.php");
        }elseif ($_GET['under_action'] === "add_user_gen"){
          include("../controller/server_group_add_user.php");
        #SUPPRESSION DE GROUPES-✔-----------------------------------------------
        }elseif ($_GET['under_action'] === "del"){
          include("../view/server_group_delete.php");
        }elseif ($_GET['under_action'] === "del_gen"){
          include("../controller/server_group_delete.php");
        #AJOUT DE DROITS--------------------------------------------------------
        }elseif ($_GET['under_action'] === "add_right"){
          include("../view/server_group_add_right.php");
        }elseif ($_GET['under_action'] === "add_right_gen"){
          include("../controller/server_group_add_right.php");
        #MODIFICATION-----------------------------------------------------------
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
