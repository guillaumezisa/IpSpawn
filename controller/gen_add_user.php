<?php
$script = "
#!/bin/bash\n
if [ ! -f users ];\n
then\n
  touch users\n
fi\n
user_name=".$_GET['user']."\n
if grep -q $user_name groups >> /dev/null && grep -q $user_name /etc/passwd >> /dev/null;\n
then\n
  echo 'Cette utilisateur existe déja .'\n
else\n
  echo $user_name >> users\n
  adduser $user_name\n
  echo 'Veuillez entrer le nom du groupe ou placer $user_name'\n
  read group\n
  usermod -g $group $user_name\n
fi\n
";

$file_name = "../script/add_user_".$_GET['user'].".sh";

$file = fopen($file_name, 'w+');
fputs($file, $script);

echo "<center><a class='btn btn-dark' href='".$file_name."'download='add_user_".$_GET['user'].".sh' target='_blank'>Télécharger le script</a></center><br>";
echo "
<div class='container'>
        <div class='row'>
          <div class='col-sm'>
          </div>
          <div class='col-sm'>
          #!/bin/bash<br>
          if [ ! -f users ];<br>
          then<br>
            touch users<br>
          fi<br>
          user_name=".$_GET['user']."<br>
          if grep -q $user_name groups >> /dev/null && grep -q $user_name /etc/passwd >> /dev/null;<br>
          then<br>
            echo 'Cette utilisateur existe déja .'<br>
          else<br>
            echo $user_name >> users<br>
            adduser $user_name<br>
            echo 'Veuillez entrer le nom du groupe ou placer $user_name'<br>
            read group<br>
            usermod -g $group $user_name<br>
          fi<br>
          </div>
          <div class='col-sm'>
          </div>
        </div>
      </div>";

?>
