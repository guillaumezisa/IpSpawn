<?php
  include("view/header_index.php");
  include("controller/collecte_log.php");
?>
   <main role="main">
     <section class="jumbotron text-center">
       <div class="container">
         <center><img width='30%'src='style/images/Logo_black.png'></center><br>
           <p class="lead text-muted">IpSpawn rassemble une boite a outil de calcul de plage, de conversion binaire a decimal ainsi que la mise en place de service sur un serveur debian 9.</p>
         <p>
           <a href="controller/redirection.php?enter=outils" class="btn btn-success my-2">Boite a outils</a>
           <a href="controller/redirection.php?enter=serveur" class="btn btn-primary my-2">Gestion de serveur Debian 9</a
         </p>
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
