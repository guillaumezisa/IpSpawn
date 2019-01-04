   <main role="main">
       <center><div class="container">
          <br><center><h3><strong>Gestion de Serveur(s)</strong></h3></center>
          <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite à outils</a>
          <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
         </p>
       </div></center>
       <section class="jumbotron">
         <div class="ml-2">
           <div class="container">
             <div class="row">
               <div class="col-sm-3">
                 <div class="card text-center text-white bg-danger">
                   <div class="card-header bg-danger">
                     <strong><h4>Installation d'un serveur web</h4></strong>
                   </div>
                   <div class="card-body bg-danger">
                     <h5 class="card4"><bold>Installation d'un serveur web contenant les services suivants :<br>Apache2 ou Nginx, Mysql & PHP.</bold>
                     </h5>
                   </div>
                   <div class="card-footer bg-danger">
                     <center><a class="btn btn-dark" href="../controller/redirection.php?action=server_web">Serveur Web</a></center>
                   </div>
                 </div>
               </div>
               <div class="col-sm-3">
                 <div class="card text-center text-white bg-danger">
                   <div class="card-header bg-danger">
                     <strong><h4>Installation d'un serveur DNS</h4></strong>
                   </div>
                   <div class="card-body bg-danger">
                     <h5 class="card4"><bold>Installation d'un serveur dns avec les services suivants : Bind9 & Dnsutils.</bold>
                     </h5>
                   </div>
                   <div class="card-footer bg-danger">
                     <center><a class="btn btn-dark" href="../controller/redirection.php?action=server_dns">Serveur DNS</a></center>
                   </div>
                 </div>
               </div>
               <div class="col-sm-3">
                 <div class="card text-center text-white bg-danger">
                   <div class="card-header bg-danger">
                     <strong><h4>Installation d'un serveur mail</h4></strong>
                   </div>
                   <div class="card-body bg-danger">
                     <h5 class="card4"><bold>Installation d'un serveur mail avec PostFix</bold>
                     </h5>
                   </div>
                   <div class="card-footer bg-danger">
                     <center><a class="btn btn-dark" href="../controller/redirection.php?action=server_mail">Serveur Mail</a></center>
                   </div>
                 </div>
               </div>
               <div class="col-sm-3">
                 <div class="card text-center text-white bg-danger">
                   <div class="card-header bg-danger">
                     <strong><h4>Installation d'un serveur Samba</h4></strong>
                   </div>
                   <div class="card-body bg-danger">
                     <h5 class="card4"><bold>Installation d'un serveur Samba & configuration des zones de stockages.</bold>
                     </h5>
                   </div>
                   <div class="card-footer bg-danger">
                     <center><a class="btn btn-dark" href="../controller/redirection.php?action=server_samba">Serveur Samba</a></center>
                   </div>
                 </div>
               </div>
             </div><br>
             <div class="row">
               <div class="col-sm-4">
                 <div class="card text-center text-white bg-dark">
                   <div class="card-header bg-dark">
                     <strong><h4>Configuration Ip Fixe</h4></strong>
                   </div>
                   <div class="card-body bg-secondary">
                     <h5 class="card4"><bold>Configuration d'une ip fixe et de la résolution de noms.</bold>
                     </h5>
                   </div>
                   <div class="card-footer bg-dark">
                     <a class="btn btn-dark" href="../controller/redirection.php?action=ip_static">IpFixe</a>
                   </div>
                 </div>
               </div>
               <div class="col-sm-4">
                 <div class="card text-center text-white bg-dark">
                   <div class="card-header bg-dark">
                     <strong><h4>Gestion des utilisateurs</h4></strong>
                   </div>
                   <div class="card-body bg-secondary">
                     <h5 class="card4"><bold>Ajouter & supprimer des utilisateurs, modification de nom ou de mot de passe d'utilisateurs.</bold>
                     </h5>
                   </div>
                   <div class="card-footer bg-dark">
                     <center><a class="btn btn-dark" href="../controller/redirection.php?action=user">Gestion des utilisateurs</a></center>
                   </div>
                 </div>
               </div>
               <div class="col-sm-4">
                 <div class="card text-center text-white bg-dark">
                   <div class="card-header bg-dark">
                     <strong><h4>Gestion des groupes</h4></strong>
                   </div>
                   <div class="card-body bg-secondary">
                     <h5 class="card4"><bold>Installation du service sudo, création et modification de groupes d'utilisateurs & gestion de privilèges.</bold>
                     </h5>
                   </div>
                   <div class="card-footer bg-dark">
                     <center><a class="btn btn-dark" href="../controller/redirection.php?action=group">Gestion des groupes</a></center>
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
