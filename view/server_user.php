
<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Gestion de Serveur(s)</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite à outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>

    <section class="jumbotron ">
      <div class="ml-2"><center>
        <div class="container">
          <?php
            include("../view/guide_user.php");
          ?>
          <div class="row">
            <div class="col-sm-4">
              <div class="card text-center text-white bg-danger">
                <div class="card-header">
                  <strong><h4>Ajout d'utilisateur(s)</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card3 ">L'ajout d'utilisateur(s) est la première étape pour permettre à d'autres personnes l'accès au serveur.</h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=user&under_action=add">Ajouter</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card text-center text-white bg-danger">
                <div class="card-header">
                  <strong><h4>Suppression d'utilisateur(s)</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card3">Si vous avez créer des utilisateurs que vous souhaitez supprimer.</h5><br>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=user&under_action=del">Supprimer</a><br>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card text-center text-white bg-danger">
                <div class="card-header">
                  <strong><h4>Modification d'utilisateur(s)</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card3">Si vous souhaitez modifier le(s) nom(s) ou mot(s) de passe d'utilisateur(s).
                  </h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=user&under_action=mod">Modifier</a><br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div></center>
  </section>
</main>
