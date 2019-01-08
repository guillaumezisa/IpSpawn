<style>label
{
	display: block;
	width: 250px;
}
</style>
<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Ajout de restriction(s)ou de droit(s) a un groupe du sudoers</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite à outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron">
    <div class="ml-2">
      <form action="../controller/redirection.php" method="GET">
        <input type="hidden" name="action" value="group">
        <input type="hidden" name="under_action" value="add_right">
        <input type="hidden" name="under_actionx" value="gen_restrict">
		<h4><strong>Groupe</strong></h4>
		<br>
		<label for="group"><strong>Nom du groupe à modifier :</strong></label><input type="text" name="group" maxlength="50" required value="" /><br/><br>
		<h4><strong>Restriction de commande(s)</strong></h4>
		<br>
        <button class="btn btn-dark" onclick="append(event)" id="new"<button>Ajouter une commande à restreindre</button>
        <button class="btn btn-dark" onclick="rm_last_div(event)">Supprimer la derniere commande</button><br><br>
        <h6><input type="checkbox" name="auto_destruction" value= "yes" > Détruire le script à la fin de l'exécution (Conseillé)</h6>
        <input type="hidden" name="email" value=""
      </div>
      <button type="submit" class="btn btn-dark" id="choice" >Valider</button></center><br><br>
    </form>
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
    var input_b = document.createElement('input');
    var input_c = document.createElement('input');
    var input_d = document.createElement('input');
    var br = document.createElement('br');
    var br1 = document.createElement('br');
    var br2 = document.createElement('br');
    var br3 = document.createElement('br');
    var br4 = document.createElement('br');
    var br5 = document.createElement('br');
    var br6 = document.createElement('br');
    var text_q = document.createTextNode(' Commande : ');
    var text_mdp = document.createTextNode(' Les membres du groupes devront entrer le mot de passe pour utiliser cette commande : ');
    var text_exe = document.createTextNode(' La commande ne pourra pas être exécuter par les membres du groupes : ');
    var text_a = document.createTextNode(' Oui: ');
    var text_b = document.createTextNode(' Non: ');
    var text_c = document.createTextNode(' Oui: ');
    var text_d = document.createTextNode(' Non: ');
    input_q.type = "text";
    input_q.name ="command[]";
    input_q.required = true;
    input_a.type = "radio";
    input_a.value="yes"
    input_a.name ="password[]";
    input_b.type = "radio";
    input_b.value="no"
    input_b.name ="password[]";
    input_c.type = "radio";
    input_c.value="yes"
    input_c.name ="executable[]";
    input_d.type = "radio";
    input_d.value="no"
    input_d.name ="executable[]";
    var parentDiv = document.getElementById("new").parentNode;
    parentDiv.append(div);
    div.append(br);
    div.append(text_q);
    div.append(input_q);
    div.append(br1);
    div.append(br5);
    div.append(text_mdp);
    div.append(br2);
    div.append(text_a);
    div.append(input_a);
    div.append(text_b);
    div.append(input_b);
    div.append(br3);
    div.append(br6);
    div.append(text_exe);
    div.append(br4);
    div.append(text_c);
    div.append(input_c);
    div.append(text_d);
    div.append(input_d);
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
