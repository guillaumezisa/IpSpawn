<?php
include('../view/header.php');
  if ( isset($_GET['enter'])){
    if ($_GET["enter"] === "contact"){
      include('../view/contact.php');
    }elseif($_GET["enter"] === "tools"){
      include('../view/tools.php');
    }elseif($_GET["enter"] === "servers"){
      include('../view/servers.php');
    }
  }elseif ( isset($_GET['action'])){
    if ($_GET["action"] === "ip_range"){
      include('../view/tool_ip_range.php');
    }elseif($_GET["action"] === "binary_converter"){
      include('../view/tool_binary_converter.php');
    }elseif($_GET['action'] === "server_web"){
      include('../view/server_web.php');
    }elseif($_GET['action'] === "server_dns"){
      include('../view/server_dns.php');
    }elseif($_GET['action'] === "mail"){
      include('../view/server_mail.php');
#-------------------------------------------------------------------------------
# UTILISATEURS
#-------------------------------------------------------------------------------
    }elseif($_GET['action'] === "user"){
      if (isset($_GET['under_action'])){
        //$under_action_value=['add','add_gen','del','del_gen','mod','mod_pass','mod_pass','mod_pass_gen','mod_name','mod_name_gen']
        //$under_action_path=['../view/server_user_add.php','../controller/server_user_add.php','../view/server_user_delete.php','../view/server_user_modify.php','../view/server_user_modify_name.php','../view/server_user_modify_pass.php']
        if ($_GET['under_action'] === "add"){
          include("../view/server_user_add.php");
        }elseif ($_GET['under_action'] === "add_gen"){
          include("../controller/server_user_add.php");
        }elseif ($_GET['under_action'] === "del"){
          include("../view/server_user_delete.php");
        }elseif ($_GET['under_action'] === "del_gen"){
          include("../controller/server_user_delete.php");
        }elseif ($_GET['under_action'] === "mod"){
          include("../view/server_user_modify.php");
        }elseif ($_GET['under_action'] === "mod_pass"){
          include("../view/server_user_modify_pass.php");
        }elseif ($_GET['under_action'] === "mod_pass_gen"){
          include("../controller/server_user_modify_pass.php");
        }elseif ($_GET['under_action'] === "mod_name"){
          include("../view/server_user_modify_name.php");
        }elseif ($_GET['under_action'] === "mod_name_gen"){
          include("../controller/server_user_modify_name.php");
        }
      } else {
        include("../view/server_user.php");
      }
    }elseif($_GET['action'] === "server_user"){
      include("../view/server_user.php");
    } elseif($_GET['action'] === "group"){
      include('../view/server_group.php');
    } elseif($_GET['action'] === "privilege"){
      include('../view/server_privilege.php');
    }
  }else {
    header("location:../index.php");
  }
  include('../view/footer.php');
?>
