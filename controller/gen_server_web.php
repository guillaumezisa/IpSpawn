<?php
$script = "
#!/bin/bash\n
apt install apache2 -y\n
apt install php -y\n
apt install mariadb-client -y\n
apt install mariadb-server -y\n
apt update -y\n
apt upgrade -y\n
mysql_secure_installation\n
";
$file_name = "../script/gen_server_web.sh";

$file = fopen($file_name, 'w+');
fputs($file, $script);

echo "<center><a class='btn btn-dark' href='".$file_name."'download='gen_server_web.sh' target='_blank'>Télécharger le script</a></center><br>";
echo "
<div class='container'>
        <div class='row'>
          <div class='col-sm'>
          </div>
          <div class='col-sm'>
          #!/bin/bash<br>
          apt install apache2 -y<br>
          apt install php -y<br>
          apt install mariadb-client -y<br>
          apt install mariadb-server -y<br>
          apt update -y<br>
          apt upgrade -y<br>
          mysql_secure_installation<br>
          </div>
          <div class='col-sm'>
          </div>
        </div>
      </div>";

?>
