<?php
include("../view/header_section.php");
?>

   <main role="main">
       <center><div class="container">
          <br><center><h3><strong>Gestion de Serveur(s)</strong></h3></center>
           <a href="outils.php" class="btn btn-success my-2">Boite a outils</a>
           <a href="serveur.php" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
           <a href="guide.php" class="btn btn-danger my-2">Guide d'utilisation</a>
         </p>
       </div></center>
       <section class="jumbotron ">
         <div class="ml-2">
         <strong><h4>Installation d'un serveur web:</h4></strong>
         Installation de la suite lamp ( Linux , Apache2 , Mariadb , Php ).<br>
          <a class="btn btn-dark" href="../controller/redirection.php?action=web&status=start">Serveur Web</a><br><br>
          <strong><h4>Installation dns:</h4></strong>
          Installation dns ( Bind9 , Dnsutils ) .<br>
           <a class="btn btn-dark" href="../controller/redirection.php?action=dns&status=start">Serveur Dns</a><br><br>
           <strong><h4>Installation d'un serveur mail:</h4></strong>
           Installation d'un serveur de mail ( PostFix ).<br>
           <a class="btn btn-dark" href="../controller/redirection.php?action=mail&status=start">Serveur Mail</a><br><br>
           <strong><h4>Gestion des utilisateurs:</h4></strong>
           Installation du service sudo, création et modification de groupes et d'utilisateurs.<br> Ajout et modification de privileges .<br>
           <a class="btn btn-dark" href="../controller/redirection.php?action=user&status=start">Gestion des utilisateurs</a><br><br>
         </div>
       </section>
   </main>
   <footer class="text-muted">
     <div class="container">
       <center><p>Henry Fumey-Humbert . Joran Prigent . Robin Cuvillier . Rodney Nguengue . Guillaume Zisa</p></center>
     </div>
   </footer>
 </body>
</html>
