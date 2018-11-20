#!/bin/bash
source function_verify.sh
source function_begin.sh

begin

if [ $statut = root ]
then

# Lancement de l'installation des différents paquets

# Valeur (mail.ipspawn.com) à remplacer par une variable d'input de l'user du le site
debconf-set-selections <<< "postfix postfix/mailname string mail.ipspawn.com"
verify
debconf-set-selections <<< "postfix postfix/main_mailer_type string 'Internet Site'"
verify
apt-get install -y postfix
verify
apt-get install -y dovecot-imapd
verify
apt-get install -y mariadb-server
verify
apt-get install -y postfix-mysql
verify
apt-get install -y telnet
verify
apt-get install -y mailutils
verify

echo "---------- Fin de l'installation ---------"
sleep 1
# Début de configuration de POSTFIX
echo ""
# Installation d'une base de donnée MYSQL pour gérer les utilisateurs

echo "---------- Début configuration MYSQL ----------"
echo "";

# Récupération des données du nouvel utilisateur

echo "----- Création d'un administrateur MYSQL -----"
echo ""

# Remplacer par les variables des forms PHP
read -p "Définir un Utilisateur : " user
echo ""
read -p "Définir un mot de passe MYSQL : " mdp
echo ""
read -p "Le nom de vôtre domaine : " domain


# Création du nouvel utilisateur et attribution des droits
sudo mysql -u root  -e "CREATE USER '$user' IDENTIFIED BY '$mdp' ;"
sudo mysql -u root  -e "GRANT ALL PRIVILEGES ON messagerie.* to '$user'@'localhost' IDENTIFIED BY '$mdp' ;"

# On vérifie si la base de donnée n'existe pas déjà
verify_sql="$(sudo mysql -u root -e 'SHOW DATABASES' | grep messagerie)"

if [ "$verify_sql" == 'messagerie' ]
then
	echo " Vous avez déjà une base de donnée 'messagerie' "

elif [ "$verify_sql" != 'messagerie' ]
then
# Création de la base de donnée à exploiter
sudo mysql -u root <<EOF
CREATE DATABASE messagerie;
EOF

# Création des différentes tables
sudo mysql -u root messagerie <<EOF
CREATE TABLE domains (
id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(50) NOT NULL,
PRIMARY KEY (id) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
EOF

sudo mysql -u root messagerie <<EOF
CREATE TABLE users (
id INT NOT NULL AUTO_INCREMENT,
domain_id INT NOT NULL,
password VARCHAR(106) NOT NULL,
email VARCHAR(120) NOT NULL,
maildir VARCHAR(150) NOT NULL,
PRIMARY KEY (id),
UNIQUE KEY email  (email),
FOREIGN KEY (domain_id) REFERENCES domains(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
EOF
fi

# Récupération des informations des nouveaux utilisateurs du service de messagerie

# INSERT BOUCLE HERE !!!

# Ne pas oublier d'ENCRYPT les mdp en PhP

# Création des INSERT
sudo mysql -u root messagerie <<EOF 
INSERT INTO domains VALUES ('', '$domain');
INSERT INTO users VALUES ('', 1, PASSWORD('$mdp'), '$user@$domain', '$domain/$user/');
EOF

echo ""
echo "---------- Fin de configuration MYSQL ----------"
sleep 2

fi
