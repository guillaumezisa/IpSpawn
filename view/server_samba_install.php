<style>label
{
	display: block;
	width: 500px;
}
</style>
<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Installation & configuration d'un serveur Samba</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite à outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
		<div class="ml-2"><center>
		<div class="container" style="margin-top:-4%">
			<div class="row">
				<div class="col-sm-1">
				</div>
				<div class="col-sm-10">
					<div class="text-light bg-info" style="width:100%;border:solid black 1.5px;border-radius:4px; margin: 30px auto;">
						<br><h1>Prérequis : </h1> <h5>
			<br>	- Avoir les ports 137 et 445.
			<br>	- Avoir une serveur avec une adresse IP Fixe disposé à héberger le service de partage.
			<br>	- Être administrateur du système.
			<br>	- Avoir la liste des groupes et utilisateurs du service samba.
			<br>	- Ne pas oublier de donner les droits d'exécution au script (chmod +x "nomduscript").</h5>
			<br>
					</div>
					</div>
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
    <div class="ml-2" style="margin-top:-2%">
      <form action="../controller/redirection.php" method="GET">
        <input type="hidden" name="action" value="server_samba">
        <input type="hidden" name="under_action" value="install_gen">
        <h4><strong>Configuration de la zone de partage commune à tous les utilisateurs</strong></h4><br>
		<label for="zone"><strong>Veuillez entrer un chemin vers un dossier commun à tous :</strong></label><input type="text" name="zone" maxlength="50" required value="" /><br/><br>
        <h4><strong>Configuration des utilisateurs</strong></h4><br>
        <button class="btn btn-dark" onclick="append(event)" id="new"<button>Ajouter un sous-dossier</button>
        <button class="btn btn-dark" onclick="rm_last_div(event)">Supprimer le dernier dossier</button><br><br>
        </div>
        <h6><input type="checkbox" name="auto_destruction" value= "yes" > Détruire le script à la fin de l'exécution (Conseillé)</h6>
        <input type="hidden" name="email" value="" />
        <button type="submit" class="btn btn-dark" id="choice" >Valider</button></center></center>
      </form>
    </div>
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
    var input_b = document.createElement('input');
    var input_a = document.createElement('input');
    var br = document.createElement('br');
    var text_q = document.createTextNode(' Nom du dossier : ');
    var text_b = document.createTextNode(' Groupe gérant : ');
    var text_a = document.createTextNode(' Mot de passe d\'accès : ');
    input_q.type = "text";
    input_q.name ="dossier[]";
    input_q.required = true;
    input_b.type = "text";
    input_b.name ="group[]";
    input_b.required = true;
    input_b.pattern = "^[\(\)a-zA-Z0-9,-_ ]{0,}$";
    input_a.type = "text";
    input_a.name ="password[]";
    input_a.pattern = "^[\(\)a-zA-Z0-9,-_ ]{0,}$";
    input_a.required = true;
    var parentDiv = document.getElementById("new").parentNode;
    parentDiv.append(div);
    div.append(text_q);
    div.append(input_q);
    div.append(text_b);
    div.append(input_b);
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
