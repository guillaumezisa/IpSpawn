<?php
  include("view/header_index.php");
  include("controller/collect_log.php");
?>
   <main role="main">
     <section class="jumbotron text-center">
       <div class="container">
         <center><img width='30%'src='style/images/Logo_black.png'></center><br>
           <p class="lead text-muted">IpSpawn rassemble une boîte à outils de calcul de plage, de conversion binaire a décimal ainsi que la mise en place de services sur un serveur debian 9.</p>
         <p>
           <a href="controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
           <a href="controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur Debian 9</a
             <?php
              echo '${user[$y]}' ;
             ?>
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
