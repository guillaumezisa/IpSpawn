<?php

/*
Script plage d'IP
V.1
Le : 2018/12/06
Script par Henri Fumey-Humbert: fumey-humbert@intechinfo.fr
*/

function calc_plage ($calcul_adresse_ip, $calcul_mask){
    foreach ($_REQUEST as $key => $val) 
	{
	$val = trim(stripslashes(htmlentities($val)));
	$_REQUEST[$key] = $val;
	}  
    // ============================================
    // Validation du champs IP
    // ============================================
    $calcul_inetaddr=ip2long($calcul_adresse_ip); // Initialisation
    $calcul_adresse_ip=long2ip($calcul_inetaddr); // Initialisation

    // ============================================
    // Vérification du saisie
    // ============================================
    $erreur=0; // Initialisation
    if (($calcul_inetaddr==0)||($calcul_inetaddr==-1)) {masque_erreur(1);}
    if (($calcul_mask<1)||($calcul_mask>32)) {masque_erreur(2);}

    // ============================================
    // Conversion d'un octet du mask en puissance de 2
    // ============================================
    function oct_pow ($n) {
        $s=0; // Initialisation
        for ($i=7; $n>0 ; $i--) { 
            $s+=pow(2,$i);
            $n--;
        }
        return $s;
    }

    // ============================================
    // Conversion du masque
    // ============================================
    $mask=$calcul_mask; // Initialisation tmp
    $calcul_chaine_mask=""; // Initialisation
    for ($i=0; $i<4; $i++) { 
        if ($i<>3) {
            if (($mask-8)>=0) {
                $calcul_chaine_mask.=(pow(2,8)-1).".";
                $mask-=8;
            } elseif ($mask === 0) {
                $calcul_chaine_mask.="0.";
            } else {
                $calcul_chaine_mask.=oct_pow($mask).".";
                $mask=0;
            }
        } else {
            if ($mask === 0) {$calcul_chaine_mask.="0";} 
            else {$calcul_chaine_mask.=oct_pow($mask);}
        }
    }

    // ============================================
    // Calcul du nombre de host
    // ============================================
    if ($calcul_mask==32) {$calcul_host=1;}
    else {$calcul_host=pow(2,32-$calcul_mask)-2;}

    // ============================================
    // Calcul de l'adresse de réseau
    // ============================================
    $calcul_route=$calcul_inetaddr&ip2long($calcul_chaine_mask); // Ajoute l'IP et le masque en binaire
    $calcul_route=long2ip($calcul_route); // Convertit l'adresse inetaddr en IP

    // ============================================
    // Calcul de la premiere adresse
    // ============================================
    if ($calcul_mask==32) {
        $offset=0;
    } else {$offset=1;}

    if ($calcul_mask==31) {
        $calcul_premiere_ip="N/A";
    } else {
        $calcul_premiere_ip=ip2long($calcul_route)+$offset;
        $calcul_premiere_ip=long2ip($calcul_premiere_ip);
    }

    // ============================================
    // Calcul de la dernière adresse
    // ============================================
    if ($calcul_mask==32) {
        $offset=-1;
    } else {$offset=0;}

    if ($calcul_mask==31) {
        $calcul_derniere_ip="N/A";
    } else {
        $calcul_derniere_ip=ip2long($calcul_route)+$calcul_host+$offset;
        $calcul_derniere_ip=long2ip($calcul_derniere_ip);
    }

    // ============================================
    // Calcul du broadcast
    // ============================================
    if ($calcul_mask==32) {
        $offset=0;
    } else {$offset=1;}

    $calcul_broadcast=ip2long($calcul_route)+$calcul_host+$offset;
    $calcul_broadcast=long2ip($calcul_broadcast);

    // ============================================
    // Présentation des résultats
    // ============================================
    echo '
        <p align="center">
            <font size="4" color="#850606">
                <b>Masque de sous réseaux</b>
            </font>
        </p>
    ';

    echo '
        <table border="0" width="100%" id="table1">
            <tr>
                <td width="50%" align="right"><b>Les saisies</b></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td width="50%" align="right">Adresse IP :</td>
                <td>'.$calcul_adresse_ip.'</td>
            </tr>
            <tr>
                <td width="50%" align="right">Masque de sous réseau :</td>
                <td>'.$calcul_mask.'</td>
            </tr>
            <tr>
                <td width="50%" align="right">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td width="50%" align="right"><b>Les résultats</b></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td width="50%" align="right">Masque de sous réseau :</td>
                <td>'.$calcul_chaine_mask.'</td>
            </tr>
            <tr>
                <td width="50%" align="right">Nombre maximum d\'hôte :</td>
                <td>'.$calcul_host.'</td>
            </tr>
            <tr>
                <td width="50%" align="right">L\'adresse de réseau (La route) :</td>
                <td>'.$calcul_route.'</td>
            </tr>
            <tr>
                <td width="50%" align="right">Première adresse d\'hôte :</td>
                <td>'.$calcul_premiere_ip.'</td>
            </tr>
            <tr>
                <td width="50%" align="right">Dernière adresse d\'hôte :</td>
                <td>'.$calcul_derniere_ip.'</td>
            </tr>
            <tr>
                <td width="50%" align="right">Adresse de broadcast :</td>
                <td>'.$calcul_broadcast.'</td>
            </tr>
        </table>
    ';
}
/*
// ============================================
// Fonction d'affichage de l'erreur saisie
// ============================================
function masque_erreur ($erreur) {
    // ============================================
    // Affichage du titre de l'erreur
    // ============================================
    echo
        '
        <p align="center">
            <b><font size="5" color="#008000">Erreur</font></b>
        </p><BR>
        ';

    // ============================================
    // Message d'erreur
    // ============================================
    switch ($erreur)
        {
        case 1:
            echo 'Le champ \'IP\' est vide ou non valide.';
        break;
        case 2:
            echo 'Le champ \'MASK\' est vide ou non valide.';
        break;
        }
}*/
?>