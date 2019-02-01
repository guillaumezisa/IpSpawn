<div class='container' style='margin-top:-4%'>
  <div class='text-light bg-info' style='width:100%;border:solid black 1.5px;border-radius:4px; margin: 30px auto; mar'><br>
    <h5 style='margin-left:10%'>
	     Cette partie du site est consacrée à la mise en place d'un serveur DNS dans un réseau local,<br>
       Pour mettre en place votre serveur DNS veillez à avoir tous vos serveurs sur ip fixe,<br>
       ainsi qu'un nom de domaine. Votre serveur principal DNS sera votre DNS master,<br>
       par la suite nous vous demanderons de créer vos zones :<br><br>

      <b style="color:red">NS</b> : Un enregistrement NS identifie les serveurs de noms de la zone hébergée.<br>
      <i style="grey">votre.domaine.fr.   NS   ns1.nameserver.fr.</i><br>
      <b style="color:red">A</b> : Pointe le nom de l'hôte vers une adresse IP.<br>
      <i style="grey">votre.domaine.fr.   A   192.168.0.0</i><br>
      <b style="color:red">CNAME</b> : Pointe le nom de l'hôte vers un autre nom d'hôte.</br>
      <i style="grey">ftp.votredomaine.fr.  CNAME  votredomaine.fr.</i><br>
      <b style="color:red">MX</b> : Pointe le nom de l'hôte vers l'hôte d'un serveur de messagerie électronique.<br>
      <i style="grey">mail.votredomaine.fr.  MX  10 votredomaine.fr..</i><br>
  </div>
</div><br>
