
#!/bin/bash

apt install apache2 -y

apt install php -y

apt install mariadb-client -y

apt install mariadb-server -y

apt update -y

apt upgrade -y

mysql_secure_installation

