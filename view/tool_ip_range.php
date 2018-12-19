<style>label
{
	display: block;
	width: 250px;
}
</style>
<main role="main"><center>
  <div class="container"><br>
    <center><h3><strong>Calcul de plage</strong></h3></center>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
        <?php
            include("../view/guide_execution_ip_range.php");
        ?>
    <form name="" action="../controller/tool_ip_range.php" method="GET">
    <input type="hidden" name="action" value="ip_range">
    <input type="hidden" name="under_action" value="result">
	<label for="ip"><strong>Adresse Ip :</strong></label><input type="text" id="ip" name="ip" maxlength="50" required value=""/><br/><br>
	<label for="ip"><strong>Masque de sous réseau :</strong></label><input type="text" id="mask" name="mask" maxlength="50" required value=""/><br/><br>
	<button type="submit" class="btn btn-dark">Valider</button></center><br><br>
    </form>
    </div>
  </section>
</main>
