<?php
echo $serveur;
echo "<center><h3>Gestion des utilisateurs</h3>";
echo "<h5>Que voulez vous faire ?</h5><br>";
echo "<a class='btn btn-dark' href='../controller/redirection.php?action=addgroup&status=start'>Ajouter un groupe</a>";
echo "<a class='btn btn-dark' href='../controller/redirection.php?action=addprivilege&status=start'>Ajouter des privilèges a un groupe</a>";
echo "<a class='btn btn-dark' href='../controller/redirection.php?action=adduser&status=start'>Ajouter un utilisateur</a><br><br>";
echo "<a class='btn btn-dark' href='../controller/redirection.php?action=modgroup&status=start'>Modifier un groupe</a>";
echo "<a class='btn btn-dark' href='../controller/redirection.php?action=modprivilege&status=start'>Modifier les privilèges d'un groupe</a>";
echo "<a class='btn btn-dark' href='../controller/redirection.php?action=moduser&status=start'>Modifier un utilisateur</a><br><br>";
echo "<a class='btn btn-dark' href='../controller/redirection.php?action=delgroup&status=start'>Supprimer un groupe</a>";
echo "<a class='btn btn-dark' href='../controller/redirection.php?action=deluser&status=start'>Supprimer un utilisateur</a><br><br>";
echo "<a class='btn btn-dark' href='../controller/redirection.php?action=listgroup&status=start'>Lister les groupes et leurs droits</a>";
?>
