<style>label
{
	display: block;
	width: 250px;
}
</style>
<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Installation d'un Dns</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2" style="margin-top:-2%"><center>
	 <div class="container" style="margin-top:-4%">
        <div class="row">
          <div class="col-sm-1">
          </div>
          <div class="col-sm-10">
            <div class="text-light bg-info" style="width:100%;border:solid black 1.5px;border-radius:4px; margin: 30px auto;">
              <br><h1>Prérequis : </h1> <h5>
			  <br>	- Avoir un nom de domaine.
			  <br>	- Être administrateur du système.
			  <br>	- Avoir une machine avec une IP FIXE disposé à héberger le service.
			  <br>	- Ne pas oublier de donner les droits d'éxécution au script (chmod +x "nomduscript").</h5>
			  <br>
            </div>
            </div>
          </div>
          <div class="col-sm-1"></div>
        </div>
      </div>
	<form action="../controller/redirection.php" method="GET">
		<input type="hidden" name="action" value="dns">
		<input type="hidden" name="under_action" value="install_dns_gen">
		<h4><strong>Configuration de la machine master</strong></h4>
		<br>
		<label for="domain"><strong>Nom du domaine :</strong></label><input type="text" name="domain" maxlength="50" required /><br/><br>
		<label for="master"><strong>Nom de la machine master :</strong></label><input type="text" name="master" maxlength="50" required /><br/><br>
	<label for="private_ip"><strong>Ip privée de la machine master :</strong></label><input type="text" name="private_ip" maxlength="50" required /><br/><br>
        <h4><strong>Configuration de vos zones</strong></h4>
        <button class="btn btn-dark" onclick="append(event)" id="new"<button>Ajouter une machine</button>
        <button class="btn btn-dark" onclick="reload(event)">Réinitialiser</button>
        <button class="btn btn-dark" onclick="rm_last_div(event)">Supprimer la dernière machine</button><br><br>
        </div>
        <h6><input type="checkbox" name="auto_destruction" value= "yes" > Détruire le script a la fin de l'éxécution (conseiller)</h6>
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
    var text_q = document.createTextNode(' Nom de l\'hôte : ');
    var text_b = document.createTextNode(' Type d\'enregistrement : ');
    var text_a = document.createTextNode(' Ip local de la machine : ');
    input_q.type = "text";
    input_q.name ="hostname[]";
    input_q.required = true;
    input_b.type = "text";
    input_b.name ="type_name[]";
    input_b.required = true;
    input_b.pattern = "^[\(\)a-zA-Z0-9,-_ ]{0,}$";
    input_a.type = "text";
    input_a.name ="private_ip[]";
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
