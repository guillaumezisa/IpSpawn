<?php
$script = "
#!/bin/bash\n
apt install python -y\n
apt install php -y\n
apt update -y\n
apt upgrade -y\n
mkdir /root/scripts/\n
";
$file_name = "../script/gen_services.sh";

$file = fopen($file_name, 'w+');
fputs($file, $script);

echo "<center><a class='btn btn-dark' href='".$file_name."'download='gen_services.sh' target='_blank'>Télécharger le script</a></center><br>";
echo "
<div class='container'>
        <div class='row'>
          <div class='col-sm'>
          </div>
          <div class='col-sm'>
          #!/bin/bash<br>
          apt install python -y<br>
          apt install php -y<br>
          apt update -y<br>
          apt upgrade -y<br>
          mkdir /root/scripts/<br>
          </div>
          <div class='col-sm'>
          </div>
        </div>
      </div>";

?>
