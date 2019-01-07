
<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Gestion des groupes</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite à outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>

    <section class="jumbotron ">
      <div class="ml-2"><center>
        <div class="container">
          <h4>Gestion des droits sur les fichiers</h4><br>
          <div class="row">
            <div class="col-sm-6">
              <div class="card text-center text-white bg-danger">
                <div class="card-header">
                  <strong><h4>Modifier les droits d'exécution/d'accès</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card2">Modifier les droits d'exécutions et d'accès peut vous être utile pour sécuriser des zones, faites tout de même bien attention à ne pas rendre des fichiers de commandes inaccessible(/bin) ou des fichiers de configuration inaccesible(/etc) cela pourrait détruire votre système.</h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=group&under_action=add_right&under_actionx=right">Modifier</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card text-center text-white bg-primary">
                <div class="card-header">
                  <strong><h4>Modifier le propriétaire</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card2">Modifier le propriétaire peut vous être utile car le propriétaire à tous les droits sur un fichier / dossier, faites tout de même attention car si vous n'êtes pas sur de ce que vous faites vous pourriez corrompre votre systeme et le fragiliser</h5><br>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=group&under_action=add_right&under_actionx=owner">Modifier</a><br>
                </div>
              </div>
            </div>
          </div>
        </div><br>
        <div class="container">
          <h4>Gestion du sudoers</h4><br>
          <div class="row">
            <div class="col-sm-6">
              <div class="card text-center text-white bg-success">
                <div class="card-header">
                  <strong><h4>Ajouter un groupe au sudoers</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card2">Cela permet d'autoriser tous les membres du groupes l'utilisation de la commande sudo, <br>faites également attention de ne pas donner ce privilège à n'importe qui. </h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=group&under_action=add_right&under_actionx=sudoers">Ajouter</a><br>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card text-center text-white bg-success">
                <div class="card-header">
                  <strong><h4>Restrictions ou privilèges à un groupe </h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card2">Cela permet de restreindre certaines commandes à certain groupes ou bien de donner le droit d'exécuter certaine commande sans demander de mot de passe .</h5><br><br>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=group&under_action=add_right&under_actionx=restrict">Ajouter</a><br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div></center>
  </section>
</main>
