<style>label
{
	display: block;
	width: 250px;
}
</style>
<main role="main"><center>
  <div class="container"><br>
    <center><h3><strong>Convertisseur</strong></h3></center>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
      <?php
        include("../view/guide_execution_converter.php");
      ?>
      <form action="../controller/redirection.php" method="GET">
        <input type="hidden" name="action" value="converter">
        <input type="hidden" name="under_action" value="result">
		<label for="nb"><strong>Nombre :</strong></label><input type="text" name="nb" maxlength="50" required value="" /><br/><br>
		<span><strong>Type de conversion :</strong></span><br>
        <select name="convtype">
          <option value="0">Binaire</option>
          <option value="3">Octal</option>
          <option value="10">Décimal</option>
          <option value="4">Héxadécimal</option>
        </select>
		<br>
        <input type="hidden" name="email" value="" />
		<br>
        <button type="submit" class="btn btn-dark">Valider</button></center><br><br>
      </form>
    </div></center>
  </section>
</main>
