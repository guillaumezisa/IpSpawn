<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Modification des propriétaires de fichier / repertoires</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite à outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
      <?php include("../view/guide_chown.php"); ?>
      <form action="../controller/redirection.php" method="GET">
        <input type="hidden" name="action" value="group">
        <input type="hidden" name="under_action" value="add_right">
        <input type="hidden" name="under_actionx" value="gen_owner">
        <button class="btn btn-dark" onclick="append(event)" id="new"<button>Ajouter une modification de propriétaire</button>
        <button class="btn btn-dark" onclick="reload(event)">Réinitialiser</button>
        <button class="btn btn-dark" onclick="rm_last_div(event)">Supprimer le dernier propriétaire</button><br><br>
        <h6><input type="checkbox" name="recursion" value= "yes" > Activer la récursivité ( exécute pour tous les fichiers de l'arborescence )<br>
        <input type="checkbox" name="auto_destruction" value= "yes" > Détruire le script à la fin de l'exécution (Conseillé)</h6>
        <input type="hidden" name="email" value="" />
      </div><button class="btn btn-dark" id="choice" >Valider</button></center><br><br>
      </form>
    </div></center>
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
    var br = document.createElement('br');
    var text_q = document.createTextNode(' Nom de l\'utilisateur : ');
    var text_a = document.createTextNode(' Nom du groupe : ')
    var text_b = document.createTextNode(' Chemin du ficher ou du dossier : ')
    input_q.type = "text";
    input_q.name ="user[]";
    input_q.required = true;
    input_a.type = "text";
    input_a.name ="group[]";
    input_a.pattern = "^[\(\)a-zA-Z0-9,-_ ]{0,}$";
    input_a.required = true;
    input_b.type = "text";
    input_b.name ="path[]";
    input_b.pattern = "^[\(\)a-zA-Z0-9,-_ ]{0,}$";
    input_b.required = true;
    var parentDiv = document.getElementById("new").parentNode;
    parentDiv.append(div);
    div.append(text_q);
    div.append(input_q);
    div.append(text_a);
    div.append(input_a);
    div.append(text_b);
    div.append(input_b);
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
