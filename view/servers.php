   <main role="main">
       <center><div class="container">
          <br><center><h3><strong>Gestion de Serveur(s)</strong></h3></center>
          <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
          <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
         </p>
       </div></center>
       <section class="jumbotron ">
         <div class="ml-2">
           <div class="container">
             <div class="row">
               <div class="col-sm-3">
                 <div class="card text-center text-white bg-danger">
                   <div class="card-header">
                     <strong><h4>Installation d'un serveur web</h4></strong>
                   </div>
                   <div class="card-body ">
                     <h5 class="card-title ">Installation de lamp <br>Apache2 ou Nginx, Mariadb <br>& Php.
                     </h5>
                   </div>
                   <div class="card-footer text-muted">
                     <a class="btn btn-dark" href="../controller/redirection.php?action=server_web">Serveur Web</a><br>
                   </div>
                 </div>
               </div>
               <div class="col-sm-3">
                 <div class="card text-center text-white bg-danger">
                   <div class="card-header">
                     <strong><h4>Installation d'un serveur dns</h4></strong>
                   </div>
                   <div class="card-body">
                     <h5 class="card-title">Installation d'un dns <br>( Bind9 , Dnsutils ) .<br><br></h5>
                   </div>
                   <div class="card-footer text-muted">
                     <a class="btn btn-dark" href="../controller/redirection.php?action=server_dns">Serveur Dns</a>
                   </div>
                 </div>
               </div>
               <div class="col-sm-3">
                 <div class="card text-center text-white bg-primary">
                   <div class="card-header">
                     <strong><h4>Installation d'un serveur mail</h4></strong>
                   </div>
                   <div class="card-body">
                     <h5 class="card-title">Installation d'un serveur de mail ( PostFix ).<br><br></h5>
                   </div>
                   <div class="card-footer text-muted">
                     <a class="btn btn-dark" href="../controller/redirection.php?action=server_mail">Serveur Mail</a>
                   </div>
                 </div>
               </div>
               <div class="col-sm-3">
                 <div class="card text-center text-white bg-primary">
                   <div class="card-header">
                     <strong><h4>Configuration IpFixe:</h4></strong>
                   </div>
                   <div class="card-body">
                     <h5 class="card-title">Configuration d'une ip fixe et de la résolution de noms.<br></h5>
                   </div>
                   <div class="card-footer text-muted">
                     <a class="btn btn-dark" href="../controller/redirection.php?action=server_ip">IpFixe</a>
                   </div>
                 </div>
               </div>
               <div class="container"><br>
                 <div class="row">
                   <div class="col-sm-6">
                     <div class="card text-center text-white bg-dark">
                       <div class="card-header">
                         <strong><h4>Gestion des utilisateurs:</h4></strong>
                       </div>
                       <div class="card-body">
                         <h5 class="card-title">Ajouter & supprimer des utilisateurs, modification de nom ou de mot de passe d'utilisateurs .</h5>
                       </div>
                       <div class="card-footer text-muted">
                         <a class="btn btn-dark" href="../controller/redirection.php?action=user">Gestion des utilisateurs</a>
                       </div>
                     </div>
                   </div>
                   <div class="col-sm-6">
                     <div class="card text-center text-white bg-dark">
                       <div class="card-header">
                         <strong><h4>Gestion des groupes:</h4></strong>
                       </div>
                       <div class="card-body">
                         <h5 class="card-title">Installation du service sudo, création et modification de groupes d'utilisateurs & gestion de privileges.</h5>
                       </div>
                       <div class="card-footer text-muted">
                         <a class="btn btn-dark" href="../controller/redirection.php?action=group">Gestion des groupes</a>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </section>
   </main>
 </body>
</html>
