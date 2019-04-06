<html>
<title>Species List</title>
<style>
body {
    background-color: #9EDA71;
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
	
$gam = fopen("gameList.txt", "r");
$games = [];
$gens = [];
$systems = [];
while(! feof($gam)){
	$l = fgets($gam);
	$g = explode(',',$l);
	array_push($games,$g[0]);
	array_push($gens,$g[1]);
	array_push($systems,$g[2]);
}
fclose($gam);

$genset = ["Gen I","Gen II","Gen III","Gen IV","Gen V","Gen VI","Gen VII","LG I","Gen VIII"];
$systemset = ["GBA","DS","3DS","Switch"];

$el = count($data);

for ($j = 0; $j < $el; $j++){
	$data[$j]['LNum'] = array_search($data[$j]['Species'],$tdex);
	$data[$j]['GNum'] = array_search($data[$j]['Game'],$games);
	$data[$j]['Gen'] = $gens[$data[$j]['GNum']];
	$data[$j]['System'] = $systems[$data[$j]['GNum']];
	$data[$j]['SNum'] = array_search($data[$j]['Gen'],$genset);
	$data[$j]['VC'] = array_search($data[$j]['System'],$systemset);
}

usort($data, 'mySort');

$nam = $data[0]['Species'];
$snum = array_search($nam,$tkan) + 1;
$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);

$glc = [];
foreach($games as $ga){
	$glc[$ga] = 0;
}
foreach($genset as $ge){
	$glc[$ge] = 0;
}

for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($snum != 0){
			echo "<img src='icons/". $snum .".png' border=0>" . $nam. "; ";
		}
		//$glc = array_count_values($glist);
		foreach ($glc as $key => $value) {
			echo "$key: $value; ";
		}
		echo "</br>";
		$glc = [];
		foreach($games as $ga){
			$glc[$ga] = 0;
		}
		foreach($genset as $ge){
			$glc[$ge] = 0;
		}
		$glc[$data[$j]['Game']]++;
		$glc[$data[$j]['Gen']]++;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
	} else {
		$glc[$data[$j]['Game']]++;
		$glc[$data[$j]['Gen']]++;
	}
}

	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. "; ";
	}
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";


function mySort($a, $b)
{
    $diff = (int)$a['LNum'] - (int)$b['LNum'];
	if($diff == 0){ 
		$diff = (int)$a['GNum'] - (int)$b['GNum'];
		if($diff == 0){	
			$diff = (int)$a['Lv'] - (int)$b['Lv'];
			if($diff == 0){
				$diff = strcmp($a['Ball'],$b['Ball']);
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
	} else {
			return $diff;
	}   
}

?>
</html>
