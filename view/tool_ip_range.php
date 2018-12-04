<main role="main"><center>
  <div class="container"><br>
    <center><h3><strong>Calcul de plage</strong></h3></center>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
      <form action="../controller/redirection.php" method="GET">
        Calculer une plage permet d'obtenir l'espaces total d'un réseau, et par la suite le découper en plusieurs plage de reseaux.
        <input type="hidden" name="action" value="ip_range"><br>
        <input type="hidden" name="under_action" value="gen">
        Ip de départ :<input type="text" name="ip" value=""><br>
        Masque de l'IP :<input type="text" name="netmask" value=""><br><br>
        <button class="btn btn-dark" onclick="append(event)" id="new"<button>Ajouter une categorie d'utilisateur</button>
        <button class="btn btn-dark" onclick="reload(event)">Réinitialiser</button>
        <button class="btn btn-dark" onclick="rm_last_div(event)">Supprimer la dernière catégorie</button><br><br>
      </div><button type="submit" class="btn btn-dark">Valider</button>
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
    var br = document.createElement('br');
    var text_q = document.createTextNode(' Catégorie de personne : ');
    var text_a = document.createTextNode(' Nombre de personne : ');
    input_q.type = "text";
    input_q.name ="cat[]";
    input_q.required = true;
    input_a.type = "number";
    input_a.name ="nb[]";
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
