<?php
  echo"
  <div class='container' style='margin-top:-4%'>
    <div class='row'>
      <div class='col-sm-1'></div>
      <div class='col-sm-10'>
        <div class='text-light bg-info' style='width:100%;border:solid black 1.5px;border-radius:4px; margin: 30px auto;'>
          <br><h4>Prérequis : </h4>
          - Si vous avez déjà installer apache2 vous devez le désinstaller avec les commandes suivantes :<br>
          service apache2 stop , apt purge apache2 , apt autoremove.<br><br>
          - Avoir les privilèges root ( su ou sudo avant les commandes suivantes ).<br><br>
          - Ne pas oublier de donner les droits d'éxécution au : script chmod +x ".$file_name." <br><br>
          - Pour executer un script : ./".$file_name."  <br><br>
          - Pour désinstaller nginx ecrivez : apt purge nginx , apt autoremove<br><br>
          </div>
        </div>
      </div>
    <div class='col-sm-1'></div>
  </div>
</div>";
?>
