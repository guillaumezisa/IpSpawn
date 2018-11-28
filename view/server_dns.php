<main role="main">
    <center><div class="container">
       <br><center><h3><strong>D.N.S</h3></center>
       <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
       <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
      </p>
    </div></center>
    <section class="jumbotron ">
      <div class="ml-2"><center>
      <strong><h4>Installation d'un DNS</h4></strong>
      <div class="container">
        <div class="row">
          <div class="col-sm-1">

          </div>
          <div class="col-sm-10">
            <div class="text-light bg-info" style="width:100%;border:solid black 1.5px;border-radius:4px; margin: 30px auto;">
              <br><h1>Prérequis : </h1> <h5>
			  <br>	- Avoir les droits administrateurs.
			  <br>	- Ne pas oublier de donner les droits d'éxécution au script (chmod +x "nomduscript").
			  <br>	- Avoir un nom de domaine.
			  <br>	- Avoir configurer sa machine en IP FIXE.</h5>
			  <br>
            </div>
			</div>
          </div>
          <div class="col-sm-1"></div>
        </div>
      </div>
	   <form action="../controller/redirection.php" method="GET">
        <input type="hidden" name="action" value="dns">
        <input type="hidden" name="under_action" value="gen_dns">
		<center>
		<br> <h2>Gestion de la machine</h2>
		Nom de la machine : <input type="textarea" name="hostname">
		<br>
        Nom du domaine : <input type="textarea" name="domain">
		<br>
		Ajout de la fonction qui boucle les enregistrements !
		<h6><input type="checkbox" name="auto_destruction" value= "yes" > Détruire le script a la fin de l'éxécution (conseiller)</h6>
        <button type="submit" class="btn btn-dark" id="choice" >Valider</button><br><br>
	</div></center>
    </section>
</main>
