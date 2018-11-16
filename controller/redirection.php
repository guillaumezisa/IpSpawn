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
    }elseif($_GET['action'] === "user"){
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
