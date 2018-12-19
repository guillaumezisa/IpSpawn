<div class='container' style='margin-top:-4%'>
  <div class='row'>
    <div class='col-sm-1'></div>
    <div class='col-sm-10'>
      <div class='text-light bg-info' style='width:100%;border:solid black 1.5px;border-radius:4px; margin: 30px auto;'>
        <br><h4>Mode d'emploi : </h4>
        Le niveau de protection se détermine généralement par 3 chiffres désignant chacun <br> une lettre <bold>U, G et P ( Utilisateurs, Groupes, Propriétaires)</bold>.
        <br>Voilà un tableau vous permettant de composer votre niveau de protection<br><br>
        <table style='border-collapse: collapse;'>
          <tr>
            <th style='border: 1px solid black'>Octal</th>
            <th style='border: 1px solid black'>Chiffre de protection</th>
            <th style='border: 1px solid black'>Permissions</th>

          </tr>
          <tr>
            <th style='border: 1px solid black'>000</th>
            <td style='border: 1px solid black'>0=(0+0+0)</td>
            <td style='border: 1px solid black'>Aucune autorisation</td>
          </tr>
          <tr>
            <th style='border: 1px solid black'>001</th>
            <td style='border: 1px solid black'>1=(0+0+1)</td>
            <td style='border: 1px solid black'>Autorisation Execution</td>
          </tr>
          <tr>
            <th style='border: 1px solid black'>010</th>
            <td style='border: 1px solid black'>2=(0+2+0)</td>
            <td style='border: 1px solid black'>Autorisation Ecriture</td>
          </tr>
          <tr>
            <th style='border: 1px solid black'>011</th>
            <td style='border: 1px solid black'>3=(0+2+1)</td>
            <td style='border: 1px solid black'>Autorisation Ecriture+Execution</td>
          </tr>
          <tr>
            <th style='border: 1px solid black'>100</th>
            <td style='border: 1px solid black'>4=(4+0+0)</td>
            <td style='border: 1px solid black'>Autorisation Lecture</td>
          </tr>
          <tr>
            <th style='border: 1px solid black'>101</th>
            <td style='border: 1px solid black'>5=(4+0+1)</td>
            <td style='border: 1px solid black'>Autorisation Lecture+Execution</td>
          </tr>
          <tr>
            <th style='border: 1px solid black'>110</th>
            <td style='border: 1px solid black'>6=(4+2+0)</td>
            <td style='border: 1px solid black'>Autorisation Lecture+Ecriture</td>
          </tr>
          <tr>
            <th style='border: 1px solid black'>111</th>
            <td style='border: 1px solid black'>7=(4+2+1)</td>
            <td style='border: 1px solid black'>Autorisation Lecture+Ecriture+Execution</td>
          </tr>
        </table><br>
        Exemple :
        <table style='border-collapse: collapse;'>
          <tr>
            <th style='border: 1px solid black'>Utilisateurs</th>
            <th style='border: 1px solid black'>Groupes</th>
            <th style='border: 1px solid black'>Propriétaires</th>

          </tr>
          <tr>
            <th style='border: 1px solid black'>7</th>
            <td style='border: 1px solid black'>7</td>
            <td style='border: 1px solid black'>7</td>
          </tr>
        </table><br>
        Si vous voulez changer les droits du dossier, vous devez ouvrir un terminal puis allez dans le dossier et tapez <bold>pwd</bold> vous aurez le chemin.<br><br>
        Pour les fichiers mettez-vous dans le dossier puis faites un <bold>pwd</bold> copier le chemin ici et rajouter le nom du fichier derrière le <bold>/.</bold><br><br>
      </div>
    </div>
  </div>
<div class='col-sm-1'></div>
</div>
