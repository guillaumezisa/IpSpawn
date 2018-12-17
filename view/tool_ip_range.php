<main role="main"><center>
  <div class="container"><br>
    <center><h3><strong>Convertisseur</strong></h3></center>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
        <?php
            include("../view/guide_execution_ip_range.php");
        ?>
      <p align="center">
          <font size="4" color="#850606">
              <b>
                  Input
              </b>
          </font>
      </p>
      <table border="0" width="100%" id="table1">
          <form name="" action="../controller/redirection.php" method="GET">
          <input type="hidden" name="action" value="ip_range">
          <input type="hidden" name="under_action" value="result">
          <tr>
              <td width="50%" align="right">Adresse IP :</td>
              <td><input type="text" name="ip" id="ip" maxlength="50"></td>
          </tr>
          <tr>
              <td width="50%" align="right">Masque de sous réseau :</td>
              <td><input type="text" name="mask" id="mask"maxlength="50"></td>
              <td><input type="hidden" name="email" value="" /></td>
          </tr>
          <tr>
              <td width="50%" align="right"><input type="submit" class="btn btn-dark" value="Submit"></td>
          </tr>
          </form>
      </table>
    </div></center>
  </section>
</main>
