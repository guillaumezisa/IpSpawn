<main role="main">
    <center><div class="container">
       <br><center><h3><strong>Ajout de groupe(s) au(x) sudoers</strong></h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boîte à outils</a>
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
              <center>Les groupes ajoutés au sudoers ont les droits sudo ( super utilisateur / root ), <br>faites attention de ne pas donner ces privilèges à n'importe qui.</center><br><br>
            </div>
            </div>
          </div>
          <div class="col-sm-1"></div>
        </div><br>
      </div>
      <div class="ml-2"><center>
      <form action="../controller/redirection.php" method="GET">
        <input type="hidden" name="action" value="group">
        <input type="hidden" name="under_action" value="add_right">
        <input type="hidden" name="under_actionx" value="gen_sudoers">
        <button class="btn btn-dark" onclick="append(event)" id="new"<button>Ajouter un groupe</button>
        <button class="btn btn-dark" onclick="rm_last_div(event)">Supprimer le dernier groupe </button><br><br>
        </center></div>
        <center>
        <h6><input type="checkbox" name="auto_destruction" value= "yes" > Détruire le script à la fin de l'exécution (Conseillé)</h6>
        <input type="hidden" name="email" value="" />
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
    var text_a = document.createTextNode(' Groupe : ')
    input_a.type = "text";
    input_a.name ="group[]";
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
