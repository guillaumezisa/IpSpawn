<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Gestion de groupe(s)</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boîte à outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>
    <section class="jumbotron ">
      <?php
        include("../view/guide_group.php");
      ?>
      <div class="ml-2"><center>
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
              <div class="card text-center text-white bg-danger">
                <div class="card-header">
                  <strong><h4>Création de groupe(s)</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card4">La création de groupe permet d'y insérer des utilisateurs puis de donner des droits aux groupes.<br><br>
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
                  <h5 class="card4">Prérequis :<br>Les utilisateurs doivent éxister avant de pouvoir les ajouter aux groupes.<br></h5>
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
                  <h5 class="card4">Prérequis:<br>Les groupes choisis doivent exister.</h5>
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
                  <h5 class="card4">Prérequis:<br>Nécéssite que les groupes existent & que les paquets de commandes soient installés.</h5>
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
            <div class="col-sm-6">
              <div class="card text-center text-white bg-dark">
                <div class="card-header">
                  <strong><h4>Modifier nom(s) de groupe(s)</h4></strong>
                </div>
                <div class="card-body bg-secondary">
                  <h5 class="card2">Attention :<br>Si vous avez déjà donner des droits au(x) groupe(x)<br> de départ, vous devriez réinitialiser les droits avant de modifier vos groupes.</h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-secondary" href="../controller/redirection.php?action=group&under_action=mod_name">Modifier</a><br>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card text-center text-white bg-dark">
                <div class="card-header">
                  <strong><h4>Modifier les droits d'exécution/d'accès</h4></strong>
                </div>
                <div class="card-body bg-secondary">
                  <h5 class="card2">Modifier les droits d'exécutions et d'accès peut vous être utile pour sécuriser des zones, faites tout de même bien attention à ne pas rendre des fichiers de commandes inaccessible(/bin) ou des fichiers de configuration inaccesible(/etc) cela pourrait détruire votre système.</h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-secondary" href="../controller/redirection.php?action=group&under_action=add_right&under_actionx=right">Modifier</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div></center>
  </section>
</main>
