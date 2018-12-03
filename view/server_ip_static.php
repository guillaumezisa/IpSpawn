<main role="main"><center>
  <div class="container"><br>
    <center><h3><strong>Mettre l'ip d'une machine static</strong></h3></center>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
      <form action="../controller/redirection.php" method="GET">
        <input type="hidden" name="action" value="ip_static">
        <input type="hidden" name="under_action" value="gen">
        Veuillez entrer l'ip sur laquelle vous voulez devenir statique.<br>
        <input type="text" name="ip" value=""><br>
        <h6><input type="checkbox" name="auto_destruction" value="yes"> Détruire le script a la fin de l'éxécution (conseiller)</h6>
        <button type="submit" class="btn btn-dark">Valider</button></center><br><br>
      </form>
    </div></center>
  </section>
</main>
