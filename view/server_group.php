
<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Gestion de Serveur(s)</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>
    <section class="jumbotron ">
      <div class="ml-2"><center>
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
              <div class="card text-center text-white bg-danger">
                <div class="card-header">
                  <strong><h4>Création de groupe(s)</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card-title ">La création de groupe permet d'y insérer des utilisateurs puis de donner des droits aux groupes.<br><br>
                  </h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=group&under_action=add_group">Créer</a><br>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="card text-center text-white bg-danger">
                <div class="card-header">
                  <strong><h4>Ajout d'utilisateurs aux groupe(s)</h4></strong>
                </div>
                <div class="card-body">
                  <h5 class="card-title"><br>Prérequis :<br>Les utilisateurs doivent éxister avant de pouvoir les ajouter aux groupes.<br></h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=group&under_action=add_user">Ajouter</a><br>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="card text-center text-white bg-primary">
                <div class="card-header">
                  <strong><h4>Suppression de groupe(s)</h4></strong>
                </div>
                <div class="card-body">
                  <h5 class="card-title"><br>Prérequis:<br>Les groupes choisit doivent exister.<br><br><br></h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=group&under_action=del">Supprimer</a><br>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="card text-center text-white bg-primary">
                <div class="card-header">
                  <strong><h4>Ajout de privilège(s) au(x) groupe(s)</h4></strong>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Prérequis:<br>Nécéssite que les groupes éxiste & que les paquets des commandes existe bien.</h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=group&under_action=add_right">Ajouter</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="container"><br>
          <div class="row">
            <div class="col-sm-12">
              <div class="card text-center text-white bg-dark">
                <div class="card-header">
                  <strong><h4>Réinitialiser les privilèges</h4></strong>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Attention:<br>Supprime définitivement tous les réglagles de droits.</h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=group&under_action=mod_reset">Réinitialiser</a><br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div></center>
    </section>
</main>
