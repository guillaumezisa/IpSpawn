<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Ajout de droits aux groupes</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>

    <section class="jumbotron ">
      <div class="container">
        <div class="row">
          <div class="col-sm-1">

          </div>
          <div class="col-sm-10">
            <div class="text-light bg-info" style="width:100%;border:solid black 1.5px;border-radius:4px;"><br>
              <center> Veuillez séparer chaqu'une de vos commandes par des ",".<br>
                Si vous voulez que le groupe ne puisse pas utiliser une commande veuillez ajouter "!" devant la commande.<br>
                Faites bien attention a rentrer des commandes éxistante sans fautes .<br><br>
            </div>
            </div>
          </div>
          <div class="col-sm-1"></div>
        </div><br>
      </div>
      <div class="ml-2"><center>
      <form action="../controller/redirection.php" method="GET">
        <input type="hidden" name="action" value="group">
        <input type="hidden" name="under_action" value="add_right_gen">
        <button class="btn btn-dark" onclick="append(event)" id="new"<button>Ajouter une commande</button>
        <button class="btn btn-dark" onclick="reload(event)">Réinitialiser</button>
        <button class="btn btn-dark" onclick="rm_last_div(event)">Supprimer la dernière commande</button><br><br>
        <h6><input type="checkbox" name="auto_destruction" value= "yes" > Détruire le script a la fin de l'éxécution (conseiller)</h6>
        Nom du groupe :<input type="text" name="groupname" value="">
    </div></center>
    <center><button type="submit" class="btn btn-dark" id="choice" >Valider</button></center><br><br>
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
    var text_a = document.createTextNode(' Commandes autorisé : ')
    input_a.type = "text";
    input_a.name ="commands[]";
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
