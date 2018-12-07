
<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Gestion des groupes</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>

    <section class="jumbotron ">
      <div class="ml-2"><center>
        <div class="container">
          <div class="row">
            <div class="col-sm-4">
              <div class="card text-center text-white bg-danger">
                <div class="card-header">
                  <strong><h4>Modifier les droits d'execution/d'acces</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card-title ">Modifier les droits d'executions et d'acces peut vous être utile pour sécuriser des zones, faites tous de meme bien attention a ne pas rendre des fichiers de commandes innacceble(/bin) ou des fichier de configuration innaccesible(/etc) cela pourrait casser votre système.</h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=user&under_action=add">Modifier</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card text-center text-white bg-primary">
                <div class="card-header">
                  <strong><h4>Modifier le propriétaire</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card-title ">Modifier le propriétaire peut vous être utile car le propriétaire a tous les droits sur un fichier / dossier, faites tous de meme attention car si vous n'êtes pas sure de ce que vous faites vous pourriez corrompre votre systeme et le fragilisé</h5><br><br>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=user&under_action=del">Modifier</a><br>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card text-center text-white bg-success">
                <div class="card-header">
                  <strong><h4>Ajouter un groupe au sudoers</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card-title ">Cela permet d'autoriser tous les membres du groupes l'utilisation de la commande sudo, <br>faite egalement attention de ne pas donner ce privilege a n'importe qui. </h5><br><br><br>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=user&under_action=mod">Ajouter</a><br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div></center>
  </section>
</main>
