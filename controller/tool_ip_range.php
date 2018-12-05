<?php
  #VERIFICATION DES VARIABLES IMPORTANTES---------------------------------------
  if (isset($_GET['ip']) && isset($_GET['netmask']) && isset($_GET['cat']) && isset($_GET['nb'])){
    #AFFICHAGE DE LA SAISIE-----------------------------------------------------
    echo "
    La saisie:<br>
    Adresse IP : ".$_GET['ip']."<br>
    Masque de sous réseau :".$_GET['netmask']."<br><br>
    ";

    #DÉCOUPAGE DE L'IP & DU MASQUE----------------------------------------------
    $ip=explode(".",$_GET['ip']);
    $mask=explode(".",$_GET['netmask']);

    #CRÉATION DES VARIABLES IMPORTANTES-----------------------------------------
    $value=[
              ["0","128","192","224","240","252","254","255"],
              ["8", "7",  "6",  "5",  "4",  "3",  "2",  "1" ],
            ];

    #CALCUL DE LA PLAGE TOTAL---------------------------------------------------
    for($i=count($mask); $i>0 ; $i--){
      if($mask[$i] != 0 ){
        $which_octet=$i;
        break;
      }
    }

    #RÉCUPÉRATION DES BITS A 1--------------------------------------------------
    for($i=0 ; $i < count($value[0]) ;$i++){
      if ($mask[$which_octet] === $value[0][$i]){
        $last_bit=$value[1][$i];
        break;
      }
    }
    $all_bit=$which_octet*8+$last_bit;

    #NOMBRE D'HOTES-------------------------------------------------------------
    $host=pow(2,32-$all_bit)-2;

    #DÉCOUVERTE DU NOMBRE MAGIQUE ET CALCULE DE LA TAILLE MAXIMAL DES PLAGES----
    $magic_number= 256-$mask[$which_octet];

    #CRÉATION DES PREMIERES ADDRESSES DE RÉSEAUX ET DERNIERES-------------------
    $last_ip=$ip;
    $first_ip=$ip;
    if ($ip[$which_octet]%$magic_number === 0 ){
      $first_ip[$which_octet+1]=1;
      $last_ip[$which_octet]=$ip[$which_octet]+$magic_number-1;
      $last_ip[$which_octet+1] = 255-1;
      $broadcast_ip=$last_ip;
      $broadcast_ip[$which_octet+1] = 255;
    }else{
      #A REVOIR
      $last_ip[$which_octet]=$ip[$which_octet]-$magic_number-1;
      $first_ip[$which_octet+1]=$first_ip[$which_octet]+1;
      $broadcast_ip[$which_octet+1]=$last_ip[$which_octet]+1;
    }

    #STRINGIFICATION DES PERMIERES ET DERNIERES ADRESSES DE RÉSEAU--------------
    for ( $i =0 ; $i < count($last_ip) ; $i++){
      if($i === 0){
        $plage[0]=$first_ip[$i];
        $plage[1]=$last_ip[$i];
        $plage[2]=$broadcast_ip[$i];
      }else {
        $plage[0]=$plage[0].".".$first_ip[$i];
        $plage[1]=$plage[1].".".$last_ip[$i];
        $plage[2]=$plage[2].".".$broadcast_ip[$i];
      }
    }

    #AFFICHAGE DE LA PLAGE TOTAL------------------------------------------------
    echo "
    La plage totale:<br>
    Masque de sous réseau : ".$_GET['ip']."<br>
    Nombre maximum d'hôte : ".$host."<br>
    Adresse du réseau : ".$_GET['ip']."<br>
    Première adresse d'hôte : ".$plage[0]."<br>
    Dernière adresse d'hôte : ".$plage[1]."<br>
    Addresse de broadcast : ".$plage[2]."<br>
    ";
    echo "<br><br><br>";

    #DÉCOUPAGE DES RESEAUX & CRÉATION DES TABLEAUX DES RÉSEAUX------------------
    $nb_range = count($_GET['cat']);
    for ($i = 0;$i < $nb_range;$i++){

      #RECHERCHE DU NOMBRE DE BIT A 1-------------------------------------------
      for ( $y = 0 ; $y < 400 ; $y++ ){
        $pow=pow(2, $y);
        if ($pow > $_GET['nb'][$i]){
           $nb_pow[$i]=$y;
          break;
        }
      }
      #CRÉATION DES MASQUES-------------------------------------------------------
      #CRÉATION DES VARIABLES IMPORTANTES-----------------------------------------
      $value=[
              ["0","128","192","224","240","252","254","255"],
              ["8", "7",  "6",  "5",  "4",  "3",  "2",  "1" ],
              ];

      if ($nb_pow[$i] > 8){
        echo "debug-1-".$nb_pow[$i];
        if ($nb_pow[$i] < 16){
          echo "debug-2-".$nb_pow[$i]."<br>";
          for( $y=0 ; $y<count($value) ; $y++){
            echo $value[1][$y]." : ".$nb_pow[$i]."<br>";
            if ($value[1][$y] === $nb_pow[$i] ){
              echo "lol1";
              $mask[$i]="255.255.".$value[0][$y].".0";
              break;
            }
          }
        }elseif ($nb_pow[$i] > 16){
          if ($nb_pow[$i] < 24){
            echo "debug-3-".$nb_pow[$i];
            for( $y=0 ; $y<count($value) ; $y++){
              if ($value[1][$y] === $nb_pow[$i] ){
                $mask[$i]="255.255.".$value[0][$y].".0";
                break;
              }
            }
          } elseif ($nb_pow[$i] > 24){
            echo "debug-4-".$nb_pow[$i];
            for( $y=0 ; $y<count($value) ; $y++){
              if ($value[1][$y] === $nb_pow[$i] ){
                $mask[$i]="255.255.".$value[0][$y].".0";
                break;
              }
            }
          }
        }
      }elseif($nb_pow[$i] <= 8){
        echo "debug-0-".$nb_pow[$i];
        for( $y=0 ; $y<count($value) ; $y++){
          if ($value[1][$y] === $nb_pow[$i] ){
            $mask[$i]="255.255.255.".$value[0][$y];
            break;
          }
        }
      } else {
        echo "error";
      }

    }
    for ($i=0; $i < count($mask); $i++) {
      echo $mask[$i].":".$i.":".$nb_pow[$i]."<br>";
    }
  } else {
    echo "blyat";
  }
?>
