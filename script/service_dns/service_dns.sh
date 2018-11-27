#!/bin/bash


statut=$('whoami')
hostname="labsr.joranprigent.itinet.fr"
ip="192.168.80.135"
domain="joranprigent.itinet.fr"
exist="$(grep search /etc/resolv.conf)"
ipexist="$(grep $ip /etc/resolv.conf)"
option="master"
reverse="$(echo $ip | awk -F. '{print $3"."$2"."$1}')"
zonexist="$(grep $domain /etc/bind/named.conf.local)"
reversexist="$(grep $reverse /etc/bind/named.conf.local)"
date_creation=`date +%Y%m%d`01
declare -A l
num_columns=# il en veut combien le mec ?

# -----Il faut integrer les entrées utilisateur !!------
# Création de la liste 2D 
for (( i=1; i<=$num_columns; i++ ))
do
	for (( j=1; j<=3; j++ ))
	do
		l[$i,$j]=# Entrer user (variables PHP)
	done
done

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

# Ajout du FQDN dans le fichier hostname
echo "$hostname" > /etc/hostname

# Modification du fichier hosts
sed -i -r "2s/.*/$ip	$hostname/g" /etc/hosts

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
zone '$domain' {
	type $option;
	file '/etc/bind/db.$domain';
};" >>/etc/bind/named.conf.local
else
	: ne fais rien
fi
# Je fais la même vérification pour la zone reverse
if [ -z "$reversexist" ]
then
echo "
zone '$reverse.in-addr.arpa' {
	type $option;
	file '/etc/bind/db.$reverse.in-addr.arpa'
};" >>/etc/bind/named.conf.local
else
	: ne fais rien	
fi

# Création des fichiers des enregistrements
touch /etc/bind/db.$domain
touch /etc/bind/db.$reverse.in-addr.arpa

# Contenu du fichier d'enregistrement
# Penser à ajouter la boucle pour les enregistrements !!!!
echo "
\$TTL 86400
$domain.	IN	SOA	$hostname. root.$domain. (
				$date_creation
				21600
				3600
				64800
				86400 )

`
for (( i=1; i<=$num_columns; i++ ))
do
	echo -e "${l[$i,0]}			IN		${l[$i,1]}		${l[$i,2]}\n"
done
`" >>/etc/bind/db.$domain
# El reverse +9000
echo "
\$TTL 86400
@	IN	SOA	$hostname. root.$domain. (
				$date_creation
				21600
				3600
				64800
				86400 )

`
for (( i=1; i<=$num_columns; i++ ))
do
	echo -e "${l[$i,0]}			IN		${l[$i,1]}		${l[$i,2]}\n"
done
`" >>/etc/bind/db.$reverse.in-addr.arpa

echo ""
echo "---------- Fin de la configuration ----------"
sleep 2

fi