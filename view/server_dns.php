<style>
label
{
	display: block;
	width: 260px;
}
</style>
<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Installation d'un DNS</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boîte à outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div><br></center>
  <section class="jumbotron ">
		<?php
			include("../view/guide_dns.php");
		?>
    <div class="ml-2" style="margin-top:-2%"><center>
      <form action="../controller/redirection.php" method="GET">
        <input type="hidden" name="action" value="server_dns">
        <input type="hidden" name="under_action" value="gen_dns">
        <h4><strong>Configuration de la machine master</strong></h4>
		<br>
		<table style='border-collapse: collapse;'>
		  <tr>
		    <th ><label for="domain"><strong><center>Nom du domaine :</center></strong></label></th>
		    <th ><label for="master"><strong><center>Hostname :</center></strong></label></th>
		    <th ><label for="private_ip"><strong><center>IP privée de l'host :</center></strong></label></th>
			<th ><label for="ttl"><strong><center>TTL :</center></strong></label></th>
		  </tr>
		  <tr>
		    <th ><center><input type="text" name="domain_name" maxlength="50" required></center></th>
		    <td ><center><input type="text" name="master_name" maxlength="50" required></center></td>
		    <td ><center><input type="text" name="master_ip" maxlength="50" required></center></td>
			<td ><center><input type="text" name="ttl" maxlength="50" required></center></td>
		  </tr>
		</table><br>
        <h4><strong>Configuration de vos zones</strong></h4><br>
        <button class="btn btn-dark" onclick="append(event)" onkeyup="cancel(this.key)" id="new">Ajouter un enregistrement</button>
        <button class="btn btn-dark" onclick="rm_last_div(event)">Supprimer le dernier enregistrement</button><br><br>
        <div id="JS"></div>
		</div><center>
        <h6><input type="checkbox" name="auto_destruction" value= "yes" > Détruire le script à la fin de l'exécution (Conseillé)</h6>
        <button type="submit" class="btn btn-dark" id="choice">Valider</button></center>
      </form>
    </div>
  </section>
  </center>
</main>

<script>

  $(window).keydown(function(e){
      switch(e.which){
          case(13):
                  e.preventDefault();
              break;

  }
  });
  function append(event){
    event.preventDefault();
    count = liste = document.getElementsByClassName('allDivs').length;
    var div = document.createElement('div');
    div.id = count;
    div.setAttribute('class','allDivs');
    var text_q = document.createElement('span');
    text_q.setAttribute('id','span'+ count);
    text_q.textContent = "Nom de l'hôte : ";

    var input_q = document.createElement('input');
	  input_q.setAttribute('disabled','true');
    input_q.type = "text";
    input_q.name ="hostname[]";
    input_q.setAttribute('class','firstInp');
    input_q.required = true;

    var input_x = document.createElement('input');
	  input_x.setAttribute('disabled','true');
    input_x.type = "text";
    input_x.name ="fqdn[]";
    input_x.setAttribute('class','firstInp');
    input_x.required = true;

    var input_b = document.createElement('input');
    input_b.type = "text";
    input_b.name ="name[]";
    input_b.required = true;

    var text_a = document.createElement('span');
    text_a.setAttribute('id','spanInput'+ count);
    text_a.textContent = " FQDN : ";
    var input_c = document.createElement('input');
    var input_a = document.createElement('input');
    var br = document.createElement('br');

    // Création du SELECT
    var text_b = document.createElement('select');
    text_b.setAttribute('class','selectMach');
    text_b.setAttribute('onchange','checkSelect()');
    text_b.name = "type_name[]";
    input_a.type = "text";
    input_a.setAttribute('class','secInp');

    // Options du select
    var option0 = document.createElement('option');
    option0.value = "NS";
    option0.innerText = "NS";
    text_b.append(option0);
    var option1 = document.createElement('option');
    option1.value = "MX";
    option1.innerText = "MX";
    text_b.append(option1);
	  var option2 = document.createElement('option'); // Bloc à copier coller pour ajout d'options
    option2.value = "A";
    option2.innerText = "A";
    text_b.append(option2);
    var option3 = document.createElement('option');
    option3.value = "CNAME";
    option3.innerText = "CNAME";
    text_b.append(option3 );

    // Restrictions
    var text_3 = document.createTextNode(' Type d\'enregistrement : ');
    input_b.pattern = "^[\(\)a-zA-Z0-9,-_ ]{0,}$";
    input_a.name ="hostname[]";
    input_a.pattern = "^[A-Za-z0-9/.]+[.]{1}$";
    input_a.setAttribute('id','submit' + count);
    input_a.required = true;

    // Application du js
    var parentDiv = document.getElementById("JS");
    parentDiv.append(div);
    div.append(text_q);
    div.append(input_q);
    div.append(text_3);
    div.append(text_b);
    div.append(text_a);
    div.append(input_a);
    div.append(text_x);
    div.append(input_x);

    count = count + 1;
  }

  </script>

  <script>


  function rm_last_div(event){
    event.preventDefault();
    var liste = document.getElementsByClassName('allDivs');
    liste[liste.length-1].remove();
  }
  function reload(event){
    var letsPlay = document.getElementsByTagName('input');
    for(i = 0; i < letsPlay.length; i++){
      letsPlay[i].required = false;
      letsPlay[i].removeAttribute('pattern');
    }
  }


  function checkSelect()
  {
    var list = document.getElementsByClassName('selectMach'); // Options du select
    var check = document.getElementsByClassName('firstInp'); // premier input
    var check0 = document.getElementsByClassName('secInp');  // deuxième input
    for(let i = 0;i < list.length;i++)
    {
      if(list[i].value === "NS")
      {
        check[i].setAttribute('disabled','true');
        check[i].value = "";
        check0[i].type = "text";
        check0[i].value = "";
        document.getElementById('span'+ i).textContent = " Nom d'hôte : ";
        document.getElementById('spanInput'+ i).textContent = " FQDN : ";
        check0[i].setAttribute('pattern', "^[A-Za-z0-9/.]+[.]{1}$");
      }  else if(list[i].value === "CNAME"){
		check[i].removeAttribute('disabled');
        check[i].type = "text";
        check0[i].type = "text";
        check0[i].value = "";
        document.getElementById('span'+ i).textContent = " FQDN : ";
		check[i].setAttribute('pattern',"^[A-Za-z0-9/.]+[.]{1}$");
        document.getElementById('spanInput'+ i).textContent = " FQDN : ";
        check0[i].setAttribute('pattern',"^[A-Za-z0-9/.]+[.]{1}$");
      } else if (list[i].value === "MX"){
		check[i].removeAttribute('disabled');
        liste = document.getElementsByClassName("allDivs");
        where = liste[i];
        check[i].value = "";
		check[i].removeAttribute('readonly');
        check0[i].value = "1";
        check0[i].type = "number";
        check0[i].max = 900;
        document.getElementById('span'+ i).textContent = " FQDN : ";
        check[i].setAttribute('pattern',"^[A-Za-z0-9/.]+[.]{1}$");
        check0[i].removeAttribute('pattern');
        document.getElementById('spanInput'+ i).textContent = " Valeur de priorité : ";
      } else {
		check[i].removeAttribute('disabled');
        check[i].removeAttribute('readonly');
        check[i].type = "text";
        check0[i].type = "text";
        check0[i].value = "";
        check[i].value = "";
        document.getElementById('span'+ i).textContent = " Nom d'hôte : ";
        document.getElementById('spanInput'+ i).textContent = " IP de la machine : ";
        check0[i].setAttribute('pattern',"^[0-9]{1,3}.{1}[0-9]{1,3}.{1}[0-9]{1,3}.{1}[0-9]{1,3}$");
      }
    }
  }
</script>
