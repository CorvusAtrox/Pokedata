<html>
<title>Species List</title>
<style>
body {
    background-color: #00FF00;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<?php

$kanto = file("kanto.txt");
$tkan = array_map('trim',$kanto);

$snum = 0;

$off = $_COOKIE['off'];
$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
$data = json_decode($jin, true);

$dex = file("NatLine Dex.txt");
$tdex = array_map('trim',$dex);

$el = count($data);

for ($j = 0; $j < $el; $j++){
	$data[$j]['LNum'] = array_search($data[$j]['Species'],$tdex);
}
/*for ($j = 0; $j < $el; $j++){
	$gname = substr($data[$j]['Game'], 0, strrpos($data[$j]['Game'], '[')-1);
	if($gname === "Red" or $gname === "Blue" or $gname === "Yellow"){
		$data[$j]['Gen'] = 1;
	}
	if($gname === "Gold" or $gname === "Silver" or $gname === "Crystal"){
		$data[$j]['Gen'] = 2;
	}
	if($gname === "Ruby" or $gname === "Sapphire" or $gname === "Emerald" or $gname === "FireRed" or $gname === "LeafGreen" or $gname === "Colosseum" or $gname === "XD"){
		$data[$j]['Gen'] = 3;
	}
	if($gname === "Diamond" or $gname === "Pearl" or $gname === "Platinum" or $gname === "HeartGold" or $gname === "SoulSilver" or $data[$j]['Game'] === "Ranch"){
		$data[$j]['Gen'] = 4;
	}
	if($gname === "Black" or $gname === "White" or $gname === "Black 2" or $gname === "White 2"){
		$data[$j]['Gen'] = 5;
	}
	if($gname === "X" or $gname === "Y" or $gname === "Omega Ruby" or $gname === "Alpha Sapphire" or $data[$j]['Game'] === "Bank"){
		$data[$j]['Gen'] = 6;
	}
	if($gname === "Sun" or $gname === "Moon"){
		$data[$j]['Gen'] = 7;
	}
}*/
usort($data, 'mySort');

$nam = "";
$t = false;
$g = 0;

for ($j = 0; $j < $el; $j++){
	if($g != $data[$j]['Gen']){
		$g = $data[$j]['Gen'];
		$t = false;
		$nam = $data[$j]['Species'];
		echo "Gen " . $g . "<br>"; 
	} else if (strcmp($nam, $data[$j]['Species']) != 0) {
		$nam = $data[$j]['Species'];
		$t = false;
	} else if(strcmp($nam, $data[$j]['Species']) == 0 and $t == false){
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($snum != 0){
			echo "<img src='icons/". $snum .".png' border=0>";
		}
		echo $nam . "<br>";
		$t = true;
	}
}


function mySort($a, $b)
{
    $diff = (int)$a['Gen'] - (int)$b['Gen'];
	if($diff == 0){
		$diff = (int)$a['LNum'] - (int)$b['LNum'];
		if($diff == 0){
			$diff = (int)$a['Lv'] - (int)$b['Lv'];
			if($diff == 0){
				return strcmp($a['Name'],$b['Name']); 
			} else {
				return $diff;
			}  
		} else {
			return $diff;
		}  
	} else {
		return $diff;
	}      
}

?>
</html>