<?php
$script = "
#!/bin/bash\n
if [ ! -f groups ];\n
then\n
touch groups\n
fi\n
if grep -q ".$_GET['group']." groups >> /dev/null && grep -q $group_name /etc/group >> /dev/null;\n
then\n
echo 'Le groupe existe déja .'\n
else\n
echo ".$_GET['group']." >> groups\n
groupadd ".$_GET['group']."\n
echo 'Le groupe a été ajouté avec succès .'\n
fi\n";
$file_name = "../script/add_group_".$_GET['group'].".sh";

$file = fopen($file_name, 'w+');
fputs($file, $script);

echo "<center><a class='btn btn-dark' href='".$file_name."'download='add_group_".$_GET['group'].".sh' target='_blank'>Télécharger le script</a></center><br>";
echo "
<div class='container'>
        <div class='row'>
          <div class='col-sm'>
          </div>
          <div class='col-sm'>
          #!/bin/bash<br>
          if [ ! -f groups ];<br>
          then<br>
            touch groups<br>
          fi<br>

          group_name=".$_GET['group']."<br>

          if grep -q $group_name groups >> /dev/null && grep -q $group_name /etc/group >> /dev/null;<br>
          then<br>
            echo 'Le groupe existe déja .'<br>
          else<br>
            echo $group_name >> groups<br>
            groupadd $group_name<br>
            echo 'Le groupe a été ajouté avec succès .'<br>
          fi<br>
          </div>
          <div class='col-sm'>
          </div>
        </div>
      </div>";

?>
