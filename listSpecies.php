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

//var_dump($tdex);

$el = count($data);

for ($j = 0; $j < $el; $j++){
	$data[$j]['LNum'] = array_search($data[$j]['Species'],$tdex);
}

usort($data, 'mySort');

$nam = $data[0]['Species'];
$snum = array_search($nam,$tkan) + 1;
$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
$count = 0;
$g1 = "";
$g2 = "";
$g3 = "";
$g4 = "";
$g5 = "";
$g6 = "";
$g7 = "";

for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($snum != 0){
			echo "<br><img src='icons/". $snum .".png' border=0>";
		}
		echo $nam.": ".$count.$g1.$g2.$g3.$g4.$g5.$g6.$g7."</br>";
		$g1 = "";
		$g2 = "";
		$g3 = "";
		$g4 = "";
		$g5 = "";
		$g6 = "";
		$g7 = "";
		$count = 1;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
	} else {
		$count++;
	}
	$gname = substr($data[$j]['Game'], 0, strrpos($data[$j]['Game'], '[')-1);
	if($gname === "Red" or $gname === "Blue" or $gname === "Yellow"){
		$g1 = " I";
	}
	if($gname === "Gold" or $gname === "Silver" or $gname === "Crystal"){
		$g2 = " II";
	}
	if($gname === "Ruby" or $gname === "Sapphire" or $gname === "Emerald" or $gname === "FireRed" or $gname === "LeafGreen" or $gname === "Colosseum" or $gname === "XD"){
		$g3 = " III";
	}
	if($gname === "Diamond" or $gname === "Pearl" or $gname === "Platinum" or $gname === "HeartGold" or $gname === "SoulSilver" or $data[$j]['Game'] === "Ranch"){
		$g4 = " IV";
	}
	if($gname === "Black" or $gname === "White" or $gname === "Black 2" or $gname === "White 2"){
		$g5 = " V";
	}
	if($gname === "X" or $gname === "Y" or $gname === "Omega Ruby" or $gname === "Alpha Sapphire" or $gname === "Bank VI"){
		$g6 = " VI";
	}
	if($gname === "Sun" or $gname === "Moon"  or $gname === "Ultra Sun" or $gname === "Ultra Moon"  or $gname === "Bank VII"){
		$g7 = " VII";
	}
}

if($snum != 0){
		echo "<br><img src='icons/". $snum .".png' border=0>";
	}
echo $nam.": ".$count.$g1.$g2.$g3.$g4.$g5.$g6.$g7."</br>";


function mySort($a, $b)
{
    $diff = (int)$a['LNum'] - (int)$b['LNum'];
	if($diff == 0){
		return strcmp($a['Name'],$b['Name']); 
	} else {
		return $diff;
	}   
}

?>
</html>