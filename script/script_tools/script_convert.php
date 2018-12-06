<?php
/*
Script convertisseur
V.1
Le : 2018/12/06
Script par Henri Fumey-Humbert: fumey-humbert@intechinfo.fr
*/

#$entry est ce que l'on veut convertir

# si n=0 converti de (octal, decimal, héxadecimal) en binaire
# si n=3 converti de binaire en octal
# si n=10 converti de binaire en decimal
# si n=4 converti de binaire en héxadecimal

function Converter($entry, $n){
	$entry = preg_replace('/[^0-9a-fA-F]/', "", $entry);
	// (Oct, Dec, Hex) => (Bin)
	if($n === 3 || $n === 4 || $n === 10){
		$sum_array = [1,2,4,8];
		$sauce_array = [0,1,2,3,4,5,6,7,8,9,"A","B","C","D","E","F"];
		$entry = strrev($entry);
		// (Oct, Hex) => (Bin)
		if($n === 3 || $n === 4){
			$sauce = "";
			$s = str_split($entry, $n);
			for($i = 0; $i < count($s); $i++){
				$val = $s[$i];
				$sum = 0;
				for($j = 0; $j < strlen($val); $j++){
					if($val[$j] === "1"){$sum += $sum_array[$j];}
				}
				$sauce .= $sauce_array[$sum];
			}
			$new_sauce = strrev($sauce);
			return $new_sauce;
			// (Dec) => (Bin)
		}elseif($n === 10){
			$sum = 0;
			for($i = 0; $i < strlen($entry); $i++){
				if($entry[$i] === "1"){
					$sum += pow(2, $i);
				}
			}
			return $sum;
		}
	// (Bin) => (Oct, Dec, Hex)
	}elseif($n === -3 || $n === -4){
		// (Bin) => (Oct, Hex)
		if($n === -3 || $n === -4){
			$entry = str_split($entry, 1);
			for($k = 0; $k < count($entry); $k++){$entry[$k] = strtr($entry[$k], ["A" => "10", "B" => "11", "C" => "12", "D" => "13", "E" => "14", "F" => "15"]);}
			$out = false;
			for($i = 0; $i < count($entry); $i++) {
				$bin = "";
				$dec = $entry[$i];
				for($j = -$n-1; $j >= 0; $j--){
					if($dec >= pow(2, $j)){
						$bin .= "1";
						$dec -= pow(2, $j);
					}else {$bin .= "0";}
				}
				if($i === 0){$bin = ltrim($bin, "0");}
				$out .= $bin;
			}
			return chunk_split($out, 4);
		// (Bin) => (Dec)
		}elseif($n === -10){
			$bin = "";
			$p = (int)log($entry, 2);
			for($i = $p; $i >= 0; $i--){
				if($entry >= pow(2, $i)){
					$bin .= "1";
					$entry -= pow(2, $i);
				}else {$bin .= "0";}
				if($i === 0){$bin = ltrim($bin, "0");}
			}
			return chunk_split($bin, 4);
		}
	}
}
?>