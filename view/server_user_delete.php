<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Suppression d'utilisateur(s)</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite à outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron">
    <div class="ml-2">
      <form action="../controller/redirection.php" method="GET">
        <input type="hidden" name="action" value="user">
        <input type="hidden" name="under_action" value="del_gen">
        <button class="btn btn-dark" onclick="append(event)" id="new"<button>Supprimer un utilisateur</button>
        <button class="btn btn-dark" onclick="rm_last_div(event)">Supprimer le dernier champ</button><br><br>
        <h6><input type="checkbox" name="auto_destruction" value= "yes" > Détruire le script à la fin de l'exécution (Conseillé)</h6>
        <input type="hidden" name="email" value="" />
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
    var input_a = document.createElement('input');
    var br = document.createElement('br');
    var text_a = document.createTextNode(' Nom de l\'utilisateur : ')
    input_a.type = "username";
    input_a.name ="username[]";
    input_a.pattern = "^[\(\)a-zA-Z0-9,-_ ]{0,}$";
    input_a.required = true;
    var parentDiv = document.getElementById("new").parentNode;
    parentDiv.append(div);
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
