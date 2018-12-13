<html>
  <head>
    <title>IpSpawn</title>
    <script src="style/bootstrap1.js" ></script>
    <script src="style/bootstrap2.js" ></script>
    <script src="style/bootstrap3.js" ></script>
    <link rel="stylesheet" href="style/bootstrap.css" >
    <link rel="shortcut icon" type="image/x-icon" href="../style/images/favicon.png" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  </head>
  <body>
    <?php
      session_start();
      include("controller/browser.php");
    ?>
    <header>
     <div class="navbar navbar-dark bg-dark shadow-sm">
       <div class="container">
         <div class="row">
           <div class="col-3"> <a href='index.php'><img src='style/images/Logo_white.png' width='75%'></a></div>
           <div class="col-7"></div>
           <div class="col-2 mt-2 text-light"><a href='controller/redirection.php?enter=contact' style='color:white; text-decoration:none'><img src='style/images/contact.svg' width='20%'><strong><font size="4"> &#x200b Contacts</font></strong></div>
         </div>
       </div>
     </div>
   </header>
