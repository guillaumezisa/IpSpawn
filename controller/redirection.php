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
        if ($_GET['under_action'] === "gen_dns"){
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
    if ($_GET['under_action'] ==="install_gen"){
      include('../controller/server_samba_install.php');
    }
  }else {
    include('../view/server_samba_install.php');
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
          include("../controller/server_user_del.php");
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
        #GESTION DES GROUPES AVANCÉE-✔------------------------------------------
        }elseif ($_GET['under_action'] === "add_right"){
          if (isset($_GET['under_actionx'])){
            #AJOUT DE GROUPES AU SUDOERS-✔--------------------------------------
            if ($_GET['under_actionx'] === "sudoers"){
              include("../view/server_group_add_to_sudoers.php");
            }elseif ($_GET['under_actionx'] === "gen_sudoers"){
              include("../controller/server_group_add_to_sudoers.php");
            #AJOUT DES DROITS DES REPERTOIRES-✔---------------------------------
            }elseif ($_GET['under_actionx'] === "right"){
              include("../view/server_group_change_right.php");
            }elseif ($_GET['under_actionx'] === "gen_right"){
              include("../controller/server_group_change_right.php");
            #AJOUT DES PROPRIETAIRES DES RÉPERTOIRES----------------------------
          }elseif ($_GET['under_actionx'] === "owner"){
              include("../view/server_group_change_owner.php");
            }elseif ($_GET['under_actionx'] === "gen_owner"){
              include("../controller/server_group_change_owner.php");
            #MODIFICATION DES DROITS COMMANDES DES GROUPES----------------------
            }elseif ($_GET['under_actionx'] === "restrict"){
              include("../view/server_group_restrict.php");
            }elseif ($_GET['under_actionx'] === "gen_restrict"){
              include("../controller/server_group_restrict.php");
            }
          }else{
            include("../view/server_group_add_right.php");
          }
        #MODIFICATION-✔---------------------------------------------------------
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
