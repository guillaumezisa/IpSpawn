#!/bin/bash

#----------------------------------------#
# Script de DNS générer par ipspawn.com  #
# Auteur : Prigent Joran				 #
# Mail : jprigent@intechinfo.fr	         #
# Version : 1.1 						 #
# Date : 06/12/2018						 #
#----------------------------------------#

statut=$('whoami')

# Variables à changer en fonction des besoins et de la machine
hostname="debian"
ip="192.168.70.134"
domain="rocuvillier.itinet.fr"
num_columns=6
test_resolution=("" "NS" "ns1.rocuvillier.itinet.fr." "ns1" "A" "192.168.70.134")
test_reverse=("" "NS" "ns1.rocuvillier.itinet.fr." "192.168.70.134" "PTR" "ns1.rocuvillier.itinet.fr.") 

# Réglage du DNS en Master
option="master"
# Récupère la date de création pour générer le fichier Bind
date_creation=`date +%Y%d`


# Vérification du statut de l'utilisateur qui lance le script
if [ $statut != root ]
then
	echo ""
	echo "Vous n'avez pas les droits n'écéssaires, contactez votre administrateur .."
	echo ""
	sleep 1
	exit

elif [ $statut = root ]
then

# Mise à jour

apt-get -y update
apt-get -y upgrade

# Installation des paquets nécéssaires

apt-get -y install bind9
apt-get -y install dnsutils

echo ""
echo "---------- Fin de l'installation ----------"
echo ""
sleep 2
echo "---------- Début de la configuration ---------"
sleep 2

# Mise en place des variables de configuration
exist="$(grep search /etc/resolv.conf)"
ipexist="$(grep $ip /etc/resolv.conf)"
reverse="$(echo $ip | awk -F. '{print $3"."$2"."$1}')"
zonexist="$(grep $domain /etc/bind/named.conf.local)"
reversexist="$(grep $reverse /etc/bind/named.conf.local)"
conf_exist="$(grep "listen-on { any; };" /etc/bind/named.conf.options)"


# Ajout du FQDN dans le fichier hostname
`sudo hostnamectl set-hostname $hostname.$domain`
# Modification du fichier hosts
sed -i -r "2s/.*/$ip	$hostname.$domain/g" /etc/hosts

# Modifications du fichier resolv.conf
sed -i -r "s/search.*/search $domain/g" /etc/resolv.conf

# Je vérifie si la section domain exite, sinon je l'ajoute
if [ ! -z "$exist" ]
then
	sed -i -r "s/domain.*/domain $domain/g" /etc/resolv.conf
else
	sed -i -r "/search.*/a \domain $domain" /etc/resolv.conf
fi

# Je vérifie que le nameserver n'ai pas déjà été rentré
if [ -z "$ipexist" ]
then
	sed -i -r "/search.*/a \nameserver $ip" /etc/resolv.conf
else
	: ne fais rien
fi
# Je vérifier que les zones n'aient pas déjà été créers
if [ -z "$zonexist" ]
then
echo "
zone "$domain" {
	type $option;
	file \""/etc/bind/db.$domain"\";
};" >>/etc/bind/named.conf.local
else
	: ne fais rien
fi
# Je fais la même vérification pour la zone reverse
if [ -z "$reversexist" ]
then
echo "
zone "$reverse.in-addr.arpa" {
	type $option;
	file "\"/etc/bind/db.$reverse.in-addr.arpa\"";
};" >>/etc/bind/named.conf.local
else
	: ne fais rien	
fi

# Vérification de la configuration du fichier named.conf.options

# problème de tabulation
if [ -z "$conf_exist" ]
then
	sed -i '25d' /etc/bind/named.conf.options
	echo -e "	listen-on { any; };\n};" >> /etc/bind/named.conf.options
else
	: ne fais rien
fi

# Création des fichiers des enregistrements
touch /etc/bind/db.$domain
touch /etc/bind/db.$reverse.in-addr.arpa

# Contenu du fichier d'enregistrement

echo "
\$TTL 86400
@	IN	SOA	$domain. root.$domain. (
				$date_creation
				21600
				3600
				64800
				86400 )

" >>/etc/bind/db.$domain

# Boucle qui permet de rajouter les enregistrements

for (( i=0; i<$num_columns; i+=3 ))
do

	echo -e "${test_resolution[$i]}		IN		${test_resolution[$i+1]}		${test_resolution[$i+2]} ">>/etc/bind/db.$domain

done

# La partie des enregsitrements en reverse
echo "
\$TTL 86400
@	IN	SOA	$domain. root.$domain. (
				$date_creation
				21600
				3600
				64800
				86400 )

" >>/etc/bind/db.$reverse.in-addr.arpa

# Boucle qui permet d'insérer les enregistrements dans la zone reverse

for (( i=0; i<$num_columns; i+=3 ))
do
	cuted_ip="$(echo "${test_reverse[$i]}" | awk -F. '{print $4}')"
	echo -e "$cuted_ip		IN		${test_reverse[$i+1]}		${test_reverse[$i+2]}" >>/etc/bind/db.$reverse.in-addr.arpa
 
done

# Redémarage des services

`sudo service bind9 restart`
`sudo service networking restart`

echo ""
echo "---------- Fin de la configuration ----------"
sleep 2

fi
