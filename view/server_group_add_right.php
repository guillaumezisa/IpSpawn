
<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Gestion des groupes</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boîte à outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>
    <section class="jumbotron ">
      <?php
        include("../view/guide_group_right.php");
      ?>
      <div class="ml-2"><center>
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <div class="card text-center text-white bg-primary">
                <div class="card-header">
                  <strong><h4>Réinitialiser les privilèges</h4></strong>
                </div>
                <div class="card-body bg-primary">
                  <h5 class="card2"><br>Attention:<br>Supprime définitivement tous les réglages du sudoers.<br><br></h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-secondary" href="../controller/redirection.php?action=group&under_action=mod_reset_gen">Réinitialiser</a><br>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card text-center text-white bg-primary">
                <div class="card-header">
                  <strong><h4>Modifier le propriétaire</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card2">Modifier le propriétaire peut vous être utile car le propriétaire à tous les droits sur un fichier / dossier, faites tout de même attention car si vous n'êtes pas sur de ce que vous faites vous pourriez corrompre votre système et le fragiliser.</h5><br>
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
                  <strong><h4>Ajout de groupe(s) au sudoers</h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card2">Cela permet d'autoriser à tous les membres du groupe l'utilisation de la commande sudo, <br>faites également attention de ne pas donner ce privilège à n'importe qui. </h5>
                </div>
                <div class="card-footer text-muted">
                  <a class="btn btn-dark" href="../controller/redirection.php?action=group&under_action=add_right&under_actionx=sudoers">Ajouter</a><br>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card text-center text-white bg-success">
                <div class="card-header">
                  <strong><h4>Restriction(s) ou privilège(s) à un groupe </h4></strong>
                </div>
                <div class="card-body ">
                  <h5 class="card2">Cela permet de restreindre certaines commandes à certains groupes ou bien de donner le droit d'exécuter certaines commandes sans demander de mot de passe.</h5><br><br>
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
