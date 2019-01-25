<style>label
{
	display: block;
	width: 250px;
}
</style>
<main role="main">
	<center><div class="container">
		<br><center><h3><strong>Gestion du serveur mail</strong></h3></center>
		<a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boîte à outils</a>
		<a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a></p>
	</div></center>
	<section class="jumbotron ">
		<div class="ml-2"><center>
			<div class="container" style="margin-top:-4%">
				<div class="row">
					<div class="col-sm-1">
					</div>
					<div class="col-sm-10">
						<?php
							include("../view/guide_mail.php");
						?>
					</div>
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
		<form action="../controller/redirection.php" method="GET">
			<input type="hidden" name="action" value="server_mail">
			<input type="hidden" name="under_action" value="gen_mail">
			<center><br>
				<h4><strong>Administrateur</strong></h4><br>
				<table style='border-collapse: collapse;'>
		  	<tr>
		    	<th><label for="name_admin"><strong>    Nom Admin :</strong></label></th>
		    	<th><label for="passwrd_admin"><strong> Mot de passe Admin :</strong></label></th>
		    	<th><label for="domain"><strong>  		Nom de domaine :</strong></label></th>
					<th><label for="hostname"><strong>		Hostname :</strong></label></th>
				</tr>
				<tr>
				  <th><input type="text" name="name_admin" maxlength="50" required /></th>
				  <td><input type="password" name="passwrd_admin" maxlength="50" required /></td>
				  <td><input type="text" name="domain" maxlength="50" placeholder="exemple.com." required /></td>
					<td><input type="text" name="hostname" maxlength="50" required /></td>
				</tr>

		</table><br>
        <h4><strong>Utilisateurs</strong></h4><br>
        <p>
        <button class="btn btn-dark" onclick="append(event)" id="new"<button>Ajouter un utilisateur</button>
        <button class="btn btn-dark" onclick="rm_last_div(event)">Supprimer le dernier utilisateur</button><br><br>
        <h6><input type="checkbox" name="auto_destruction" value= "yes" > Détruire le script à la fin de l'exécution (Conseillé)</h6>
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
