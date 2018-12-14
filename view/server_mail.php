<style>label
{
	display: block;
	width: 250px;
}
<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Service de messagerie</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>
    <section class="jumbotron ">
      <div class="ml-2"><center>
      <div class="container" style="margin-top:-4%">
        <div class="row">
          <div class="col-sm-1">
          </div>
          <div class="col-sm-10">
            <div class="text-light bg-info" style="width:100%;border:solid black 1.5px;border-radius:4px; margin: 30px auto;">
              <br><h1>Prérequis : </h1> <h5>
			  <br>	- Avoir les ports 25 et 143 d'ouverts sur sa box.
			  <br>	- Avoir une machine avec une IP FIXE disposé à héberger le service.
			  <br>	- Être administrateur du système.
			  <br>	- Avoir un enregistrement DNS MX pointant sur la machine hôte du serveur.
			  <br>	- Avoir la liste de ses utilisateurs du service de messagerie.
			  <br>	- Ne pas oublier de donner les droits d'éxécution au script (chmod +x "nomduscript").</h5>
			  <br>
            </div>
            </div>
          </div>
          <div class="col-sm-1"></div>
        </div>
      </div>
      <form action="../controller/redirection.php" method="GET">
        <input type="hidden" name="action" value="server_mail">
        <input type="hidden" name="under_action" value="gen_mail">
        <center>
		<br>
		<h4><strong>Administrateur</strong></h4>
		<br>
			<label for="name_admin"><strong>    Nom Admin :</strong></label><input type="text" name="name_admin" maxlength="50" required /><br/><br>
			<label for="passwrd_admin"><strong> Mot de passe Admin :</strong></label><input type="password" name="passwrd_admin" maxlength="50" required /><br/><br>
			<label for="domain"><strong>  		Nom de domaine :</strong></label><input type="text" name="domain" maxlength="50" required /><br/><br>
			<label for="hostname"><strong>		Nom de la machine :</strong></label><input type="text" name="hostname" maxlength="50" required /><br/><br>
        <h4><strong>Users</strong></h4>
        <p>
        <button class="btn btn-dark" onclick="append(event)" id="new"<button>Ajouter un utilisateur</button>
        <button class="btn btn-dark" onclick="reload(event)">Réinitialiser</button>
        <button class="btn btn-dark" onclick="rm_last_div(event)">Supprimer le dernier utilisateur</button><br><br>
        <h6><input type="checkbox" name="auto_destruction" value= "yes" > Détruire le script a la fin de l'éxécution (conseiller)</h6>
        <input type="hidden" name="email" value="" />
        <button type="submit" class="btn btn-dark" id="choice" >Valider</button><br><br>
      </form>
    </div></TABLE></center>
  </section>
</main>

    <script>
      function rm_last_div(event){
        event.preventDefault();
        var liste = document.getElementsByClassName('allDivs');
        liste[liste.length-1].remove();
      }
      var count = 0;
      function append(event){
        event.preventDefault();
        var div = document.createElement('div');
        div.id = count;
        div.setAttribute('class','allDivs');
        var input_q = document.createElement('input');
        var input_a = document.createElement('input');
        var br = document.createElement('br');
        var text_q = document.createTextNode(' Nom d\'utilisateur : ');
        var text_a = document.createTextNode(' Mot de passe utilisateur : ')
        input_q.type = "text";
        input_q.name ="username[]";
        input_q.required = true;
        input_a.type = "text";
        input_a.name ="psswrd[]";
        input_a.pattern = "^[\(\)a-zA-Z0-9,-_ ]{0,}$";
        input_a.required = true;
        var parentDiv = document.getElementById("new").parentNode;
        parentDiv.append(div);
        div.append(text_q);
        div.append(input_q);
        div.append(text_a);
        div.append(input_a);
        div.append(parentDiv);
        count++;
      }
      function reload(event){
        var letsPlay = document.getElementsByTagName('input');
        for(i = 0; i < letsPlay.length; i++){
          letsPlay[i].required = false;
          letsPlay[i].removeAttribute('pattern');
        }
      }
</script>
    </div></center>
    </section>
</main>
