
<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Installation de serveur web</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite à outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>
    <section class="jumbotron ">
      <?php
        include("../view/guide_web.php");
      ?>
      <div class="ml-2"><center>
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <div class="card text-center text-white bg-danger">
                <div class="card-header">
                  <strong><h4>Installation d'un serveur Apache2</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card4 ">Apache est un serveur web simple et assez ancien avec énormément de documentation.
                  </h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=server_web&under_action=apache">Installer</a><br>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card text-center text-white bg-danger">
                <div class="card-header">
                  <strong><h4>Installation d'un serveur Nginx</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card4 ">Nginx est un serveur web assez simple, plutot récent il est l'avenir des serveurs web, il est plus optimisé que apache.
                  </h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=server_web&under_action=nginx">Installer</a><br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div></center>
  </section>
</main>
